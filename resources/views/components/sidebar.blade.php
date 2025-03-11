@auth
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
        <a href="">STISLA</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
        <a href="">STISLA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('home') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            @if (Auth::user()->role == 'superadmin')
            <li class="menu-header">Hak Akses</li>
            <li class="{{ Request::is('hakakses') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('hakakses') }}"><i class="fas fa-user-shield"></i> <span>Hak Akses</span></a>
            </li>
            @endif
            <!-- profile ganti password -->
            <li class="menu-header">Profile</li>
            <li class="{{ Request::is('profile/edit') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('profile/edit') }}"><i class="far fa-user"></i> <span>Profile</span></a>
            </li>
            <li class="{{ Request::is('profile/change-password') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('profile/change-password') }}"><i class="fas fa-key"></i> <span>Ganti Password</span></a>
            </li>
            <!-- Menu Metabase -->
            <li class="menu-header">Kategori Dashboard</li>
            <li class="{{ Request::is('metabase') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('metabase.index') }}">
                    <i class="fas fa-database"></i> <span>Data Metabase</span>
                </a>
            </li>
            <li class="{{ Request::is('sektor') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('sektor.index') }}">
                    <i class="fas fa-database"></i> <span>Data Sektor</span>
                </a>
            </li>
            <li class="{{ Request::is('Api/index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('Api.index') }}">
                    <i class="fas fa-database"></i> <span>Data Api</span>
                </a>
            </li>
            <!-- Menu Backup -->
            <li class="menu-header">Data Management</li>
            <li class="{{ Request::is('index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('index.index') }}">
                    <i class="fas fa-sync"></i> <span>Backup Data Sicantik</span>
                </a>
            </li>
                </a>
            </li>
            <li class="menu-header">Import Data Excel</li>
            <li class="{{ Request::is('import') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('import.showImportForm') }}">
                    <i class="fas fa-sync"></i> <span>Import Data</span>
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
                    <li class="dropdown {{ Request::is('metabase/sektor/'.$sectorData['sektor']->id_sektor.'/*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="fas fa-chart-pie"></i>
                            <span>{{ $sectorData['sektor']->sektor }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($sectorData['categories'] as $category)
                                <li>
                                    <a class="nav-link" href="{{ $category['url_dashboard'] }}" target="_blank">
                                        <i class="fas fa-chart-line"></i>
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
@endauth
