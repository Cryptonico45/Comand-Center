<?php

namespace App\Http\Controllers;

use App\Models\Metabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MetabaseGuestController extends Controller
{
    public function index()
    {
        $sectors = [
            'Perhubungan',
            'Pembangunan',
            'Perizinan',
            'Kesehatan',
            'SIG',
            'Kepegawaian',
            'Kependudukan',
            'Keuangan',
        ];

        $sectorsData = DB::table('sektor')
            ->whereIn('sektor', $sectors)
            ->get();

        return view('welcome', compact('sectorsData'));
    }

    public function showSectorCategories(Request $request, $sector)
    {
        $sectorModel = DB::table('sektor')->where('id_sektor', $sector)->first();
        
        $categories = Metabase::where('id_sektor', $sector)
            ->distinct()
            ->get();
            
        // Hardcoded demo URLs untuk testing
        // Ganti dengan URL public embedding yang sebenarnya dari Metabase Anda
        $demoUrls = [
            1 => 'https://demo.metabase.com/public/dashboard/eea8980e-fb51-4380-8b0d-915c7b23bde0',
            2 => 'https://demo.metabase.com/public/dashboard/57e0b545-49ee-4e24-a2c8-2c84b968c3b0',
            3 => 'https://demo.metabase.com/public/dashboard/7374fcd4-50b7-4ea7-86d6-7a3ccd24ba61',
            4 => 'https://demo.metabase.com/public/dashboard/17b10230-911c-42f1-9157-6a6c9feee8b2',
            5 => 'https://demo.metabase.com/public/dashboard/c899e6c9-bfd7-4d71-a401-9a0e8a32788f',
            6 => 'https://demo.metabase.com/public/dashboard/7ba47983-2b45-48f4-a92d-f5c3e3a1d6c3',
            7 => 'https://demo.metabase.com/public/dashboard/74ec5fc0-5be1-437b-8c18-754eadfbf46c',
            8 => 'https://demo.metabase.com/public/dashboard/905e5c64-5846-4833-9497-5c5d3497ee94',
        ];
        
        // Prioritaskan URL dari database jika tersedia, jika tidak gunakan demo URL
        $url_dashboard = '';
        if ($categories->isNotEmpty() && !empty($categories->first()->link_metabase)) {
            $url_dashboard = $categories->first()->link_metabase;
        } elseif (isset($demoUrls[$sector])) {
            $url_dashboard = $demoUrls[$sector];
        }
        
        $sectorName = $sectorModel ? $sectorModel->sektor : 'Sektor ' . $sector;
        
        return view('sector', compact('sector', 'categories', 'url_dashboard', 'sectorName'));
    }
}
