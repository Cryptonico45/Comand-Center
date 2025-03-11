<?php

namespace App\Http\Controllers;

use App\Models\Metabase;
use App\Models\Sektor;
use Illuminate\Http\Request;

class MetabaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metabase = Metabase::with('sektor')->latest()->get();
        return view('metabase.index', compact('metabase'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sektor = Sektor::all();
        return view('metabase.create', compact('sektor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_sektor' => 'required|exists:sektor,id_sektor',
            'kategori' => 'required',
            'link_metabase' => 'required|url',
            'keterangan' => 'nullable'
        ]);

        Metabase::create($request->all());

        return redirect()->route('metabase.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Metabase $metabase)
    {
        return view('metabase.edit', compact('metabase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Metabase $metabase)
    {
        $request->validate([
            'kategori' => 'required',
            'link_metabase' => 'required|url',
            'keterangan' => 'nullable'
        ]);

        $metabase->update($request->all());

        return redirect()->route('metabase.index')
            ->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Metabase $metabase)
    {
        $metabase->delete();

        return redirect()->route('metabase.index')
            ->with('success', 'Data berhasil dihapus!');
    }

    public function showByCategory($kategori)
    {
        $metabases = Metabase::where('kategori', $kategori)->get();
        return view('metabase.category', compact('metabases', 'kategori'));
    }

    public function guestCategory($kategori)
    {
        $metabases = Metabase::where('kategori', $kategori)->get();
        return view('metabase.category', compact('metabases', 'kategori'));
    }

    public function showBySectorCategory($sector, $category)
    {
        $metabases = Metabase::where('id_sektor', $sector)
                            ->where('kategori', $category)
                            ->with('sektor')
                            ->get();
        
        $sektorName = Sektor::find($sector)->sektor;
        
        return view('metabase.sector_category', compact('metabases', 'sektorName', 'category'));
    }
}
