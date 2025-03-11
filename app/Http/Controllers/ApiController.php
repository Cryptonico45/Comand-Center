<?php

namespace App\Http\Controllers;

use App\Models\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $api = Api::latest()->get();
        return view('Api.index', compact('api'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            // Ambil daftar tabel dari database PostgreSQL
            $database_tables = DB::select("SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = 'public'");

            // Konversi hasil query menjadi array tabel
            $database_tables = array_map(function ($table) {
                return $table->tablename;
            }, $database_tables);

            $selected_table = old('tabel');

            return view('Api.create', compact('database_tables', 'selected_table'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tabel' => 'required',
            'link_api' => 'required|url',
        ]);

        Api::create([
            'tabel' => $request->tabel,
            'link_api' => $request->link_api
        ]);

        return redirect()->route('Api.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Api $api)
    {
        return view('Api.show', compact('api'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $api = Api::findOrFail($id); // Ambil data API berdasarkan ID

        // Ambil daftar tabel dari database PostgreSQL
        $database_tables = DB::select("SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = 'public'");
        $database_tables = array_map(fn($table) => $table->tablename, $database_tables);

        return view('Api.edit', compact('api', 'database_tables'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $api = Api::findOrFail($id);
        
        $request->validate([
            'tabel' => 'required',
            'link_api' => 'required|url',
        ]);

        $api->update([
            'tabel' => $request->tabel,
            'link_api' => $request->link_api
        ]);

        return redirect()->route('Api.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $api = Api::findOrFail($id);
        $api->delete();

        return redirect()->route('Api.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
