<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Backup;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BackupController extends Controller
{
    public function index(Request $request)
    {
        // Query gawe njupuk kabeh tabel
        $tables = DB::select("
            SELECT table_name
            FROM information_schema.tables
            WHERE table_schema = 'public'
            AND table_type = 'BASE TABLE'
            ORDER BY table_name
        ");

        $database_tables = array_map(function($table) {
            return $table->table_name;
        }, $tables);

        $selected_table = $request->query('table');
        $data = [];
        $columns = [];
        $perPage = $request->query('perPage', 10); // Default 10 item per page

        // Nek ono table sing dipilih, langsung tampilno data ne
        if ($selected_table) {
            try {
                // Ganti get() dengan paginate() gawe pagination
                $data = DB::table($selected_table)->paginate($perPage);

                if ($data->count() > 0) {
                    // Jupuk columns seko item pertama
                    $firstItem = (array)$data->items()[0];
                    $columns = array_keys($firstItem);
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal njupuk data: ' . $e->getMessage());
            }
        }

        // Ambil daftar API yang tersedia
        $apis = DB::table('api')->get();

        return view('index', compact('database_tables', 'selected_table', 'data', 'columns', 'apis', 'perPage'));
    }

    public function backup(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'table' => 'required',
                'api_url' => 'required'
            ]);

            // Ambil URL API dari form
            $apiUrl = $request->api_url;

            // Catat neng log gawe debugging
            Log::info("Tabel: " . $request->table);
            Log::info("API URL: " . $apiUrl);
            
            // Njupuk data seko API
            $response = Http::withoutVerifying()->get($apiUrl);

            // Catat response API neng log
            Log::info("API Response: " . $response->body());

            // Cek nek API-ne sukses opo ora
            if (!$response->successful()) {
                Log::error("API Error: " . $response->status() . " - " . $response->body());
                return back()->with('error', 'Waduh, gagal njupuk data seko API! Status: ' . $response->status());
            }

            $responseData = $response->json();

            // Validasi struktur response
            if (!isset($responseData['data']) || !isset($responseData['data']['data'])) {
                Log::error("Invalid API Response Structure: " . json_encode($responseData));
                return back()->with('error', 'Format data seko API ora valid');
            }

            // Jupuk data seko response JSON-e
            $data = $responseData['data']['data'];

            // Cek nek datane kosong
            if (empty($data) || !is_array($data)) {
                return back()->with('error', 'Ora ono data sing ditemokke neng periode iki');
            }

            // Variabel gawe ngitung jumlah data
            $count = 0;      // Total data sing diproses
            $updated = 0;    // Jumlah data sing diupdate
            $created = 0;    // Jumlah data anyar

            // Mulai transaction database
            DB::beginTransaction();
            try {
                foreach ($data as $item) {
                    // Validasi item data
                    if (!is_array($item) || !isset($item['no_permohonan'])) {
                        Log::warning("Invalid item structure: " . json_encode($item));
                        continue;
                    }

                    // Cek nek data wes ono opo durung berdasarkan no_permohonan
                    $existingData = Backup::where('no_permohonan', $item['no_permohonan'])->first();

                    // Siapke data sing arep disimpen
                    $dataToSave = collect($item)
                        ->except(['created_at', 'updated_at'])
                        ->toArray();

                    try {
                        // Nek datane wes ono, update
                        if ($existingData) {
                            $existingData->update($dataToSave);
                            $updated++;
                        }
                        // Nek durung ono, gawe data anyar
                        else {
                            $dataToSave['created_at'] = Carbon::now();
                            $dataToSave['updated_at'] = Carbon::now();
                            Backup::create($dataToSave);
                            $created++;
                        }
                        $count++;
                    } catch (\Exception $e) {
                        Log::error("Error processing item: " . json_encode($item) . " - " . $e->getMessage());
                        continue;
                    }
                }

                if ($count === 0) {
                    DB::rollback();
                    return back()->with('error', 'Ora ono data sing iso diproses');
                }

                // Nek kabeh sukses, commit perubahan neng database
                DB::commit();
                return back()->with('success', "Alhamdulillah! Total $count data berhasil di-backup ($created data anyar, $updated data diupdate) 😊");

            } catch (\Exception $e) {
                // Nek ono error, batalke kabeh perubahan
                DB::rollback();
                Log::error("Transaction Error: " . $e->getMessage());
                throw $e;
            }

        } catch (\Exception $e) {
            Log::error("Backup Error: " . $e->getMessage());
            return back()->with('error', 'Waduh enek error: ' . $e->getMessage());
        }
    }
}
