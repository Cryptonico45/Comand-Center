@extends('layouts.app')

@section('title', 'Backup Data')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .form-group {
        margin-bottom: 15px;
    }
    .form-label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
    }
    .table-container {
        margin-top: 20px;
        overflow-x: auto;
    }
    .pagination-container {
        margin-top: 15px;
    }
    .per-page-container {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Backup Data</h3>
        </div>
        <div class="card-body">
            <!-- Form untuk tampilkan data -->
            <form method="GET" action="{{ route('index.index') }}" id="table-form">
                <!-- Pilihan Database -->
                <div class="form-group">
                    <label class="form-label">Pilih Database</label>
                    <select name="table" class="form-control" onchange="this.form.submit()">
                        <option value="">Pilih Database</option>
                        @foreach($database_tables as $table)
                            <option value="{{ $table }}" {{ $selected_table == $table ? 'selected' : '' }}>
                                {{ $table }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <!-- Row untuk form Backup dan Import -->
            <div class="row">
                <!-- Form Backup -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Backup Data</h4>
                        </div>
                        <div class="card-body">
                            @if($selected_table)
                                @php
                                    $api = $apis->where('tabel', $selected_table)->first();
                                @endphp
                                @if($api)
                                    <form action="{{ route('index.backup') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="table" value="{{ $selected_table }}">
                                        <div class="form-group">
                                            <label>Tautan API</label>
                                            <div class="input-group">
                                                <input type="text" name="api_url" class="form-control" value="{{ $api->link_api }}" required>
                                            </div>
                                            <small class="form-text text-muted">
                                                Anda dapat mengedit URL dan mengubah parameter key1 dan key2 sesuai kebutuhan.<br>
                                                Contoh: ...?key1='2024-02-01'&key2='2024-02-28'
                                            </small>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Backup Data</button>
                                    </form>
                                @else
                                    <div class="alert alert-warning">
                                        Belum ada konfigurasi API untuk tabel ini. Silakan tambahkan di menu Tautan API.
                                    </div>
                                @endif
                            @else
                                <div class="alert alert-info">
                                    Silakan pilih database terlebih dahulu.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Form Import -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Import Data</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('import.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="file">Pilih File Excel</label>
                                    <input type="file" class="form-control" id="file" name="file" required>
                                    <small class="form-text text-muted">Format file yang didukung: .xlsx, .xls</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Import Data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if(isset($data) && count($data) > 0)
                <!-- Form untuk atur jumlah item per halaman -->
                <div class="per-page-container">
                    <label for="perPage">Tampilkan:</label>
                    <select name="perPage" id="perPage" class="form-control" style="width: 80px;" onchange="changePerPage()">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span>data per halaman</span>
                </div>

                <div class="table-container">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                @foreach($columns as $column)
                                    <th>{{ $column }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                                <tr>
                                    @foreach($columns as $column)
                                        <td>{{ $row->$column }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-container">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            Menampilkan {{ $data->firstItem() }} sampai {{ $data->lastItem() }} dari {{ $data->total() }} data
                        </div>
                        <div>
                            {{ $data->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr(".datepicker", {
            dateFormat: "d/m/Y",
            allowInput: true
        });
    });

    function changePerPage() {
        // Jupuk nilai perPage sing dipilih
        const perPage = document.getElementById('perPage').value;

        // Tambahkan parameter perPage ke form
        const form = document.getElementById('table-form');

        // Cek nek wis ono input perPage, hapus disik
        const existingPerPage = form.querySelector('input[name="perPage"]');
        if (existingPerPage) {
            form.removeChild(existingPerPage);
        }

        // Tambah input baru gawe perPage
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'perPage';
        input.value = perPage;
        form.appendChild(input);

        // Submit form
        form.submit();
    }
</script>
@endpush
