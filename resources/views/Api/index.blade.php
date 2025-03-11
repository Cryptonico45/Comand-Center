@extends('layouts.app')

@section('title', 'Data Database')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Database</h1>
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
                    <h4>Daftar Database</h4>
                    <div class="card-header-action">
                        <a href="{{ route('Api.create') }}" class="btn btn-primary">
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
                                    <th>Tabel</th>
                                    <th>Link API</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($api as $api)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $api->tabel }}</td>
                                    <td>{{ $api->link_api }}</td>
                                    <td>
                                        <a href="{{ route('Api.edit', $api->id) }}"
                                           class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('Api.destroy', $api->id) }}"
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
