<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NibImport;
use Exception;

class NibImportController extends Controller
{
    /**
     * Tampilkan form upload Excel.
     */
    public function showImportForm()
    {
        return view('import');
    }

    /**
     * Proses upload dan import Excel ke database.
     */
    public function import(Request $request)
    {

        

        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls|max:2048' // Maksimal 2MB
        ]);

        try {
            // Simpan file ke storage sementara
            $file = $request->file('file')->store('temp');

            // Import data
            Excel::import(new NibImport, storage_path('app/' . $file));

            return back()->with('success', 'Data berhasil diimpor!');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }
}
