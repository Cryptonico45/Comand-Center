@extends('layouts.app')

@section('title', 'Data Sektor')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Sektor</h1>
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
                    <h4>Daftar Sektor</h4>
                    <div class="card-header-action">
                        <a href="{{ route('sektor.create') }}" class="btn btn-primary">
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
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sektor as $sektor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sektor->sektor }}</td>
                                    <td>{{ $sektor->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('sektor.edit', $sektor->id_sektor) }}"
                                           class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('sektor.destroy', $sektor->id_sektor) }}"
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
