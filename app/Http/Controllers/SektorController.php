<?php

namespace App\Http\Controllers;

use App\Models\Sektor;
use Illuminate\Http\Request;

class SektorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sektor = Sektor::orderBy('id_sektor', 'desc')->get();
        return view('sektor.index', compact('sektor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sektor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sektor' => 'required',
            'keterangan' => 'nullable'
        ]);

        Sektor::create($request->all());

        return redirect()->route('sektor.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Sektor $sektor)
    {
        return view('sektor.edit', compact('sektor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sektor $sektor)
    {
        $request->validate([
            'sektor' => 'required',
            'keterangan' => 'nullable'
        ]);

        $sektor->update($request->all());

        return redirect()->route('sektor.index')
            ->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sektor $sektor)
    {
        $sektor->delete();

        return redirect()->route('sektor.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
