@extends('layouts.app')

@section('title', 'Import Data NIB')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="main-sidebar sidebar-style-2">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <a href="">STISLA</a>
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="">STISLA</a>
                        </div>
                        <ul class="sidebar-menu">
                            <li>
                                <a href="{{ url('/') }}" class="nav-link">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>Kembali ke Beranda</span>
                                </a>
                            </li>
                            @php
                                $sectors = App\Models\Metabase::with(['sektor'])
                                    ->select('id_sektor', 'kategori', 'link_metabase')
                                    ->distinct()
                                    ->get()
                                    ->groupBy('id_sektor')
                                    ->map(function($items) {
                                        $firstItem = $items->first();
                                        return [
                                            'sektor' => $firstItem->sektor,
                                            'categories' => $items->unique('kategori')->map(function($item) {
                                                return [
                                                    'kategori' => $item->kategori,
                                                    'url_dashboard' => $item->link_metabase
                                                ];
                                            })
                                        ];
                                    });
                            @endphp

                            @if($sectors->count() > 0)
                                <li class="menu-header">Dashboard Sektor</li>
                                @foreach($sectors as $sectorData)
                                    <li class="dropdown">
                                        <a href="#" class="nav-link has-dropdown">
                                            <i class="fas fa-chart-pie"></i>
                                            <span>{{ $sectorData['sektor']->sektor }}</span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            @foreach($sectorData['categories'] as $category)
                                                <li>
                                                    <a class="nav-link" href="javascript:void(0)" onclick="updateDashboard('{{ $category['kategori'] }}', '{{ $category['url_dashboard'] }}')">
                                                        <span>{{ $category['kategori'] }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </aside>
                </div>
            </div>
            <div class="col-md-9">
                <div class="content">
                    <h1 id="category-title">{{ $sectorName }}</h1>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="dashboard-iframe" class="embed-responsive-item" src="{{ $url_dashboard }}" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

            <script>
                function updateDashboard(kategori, url) {
                    // Perbarui judul kategori
                    document.getElementById('category-title').textContent = kategori;

                    // Perbarui source iframe
                    document.getElementById('dashboard-iframe').src = url;
                }
            </script>
        </div>
    </div>
@endsection
