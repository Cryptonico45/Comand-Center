@extends('layouts.app')

@section('title', 'Data Metabase')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Metabase</h1>
        </div>

        <div class="section-body">
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

            <div class="card">
                <div class="card-header">
                    <h4>Daftar Metabase</h4>
                    <div class="card-header-action">
                        <a href="{{ route('metabase.create') }}" class="btn btn-primary">
                            Tambah Data
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Sektor</th>
                                    <th>Kategori</th>
                                    <th>Link Metabase</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($metabase as $metabase)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $metabase->sektor->sektor }}</td>
                                    <td>{{ $metabase->kategori }}</td>
                                    <td>{{ $metabase->link_metabase }}</td>
                                    <td>{{ $metabase->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('metabase.edit', $metabase->id) }}"
                                           class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('metabase.destroy', $metabase->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin hapus data?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
