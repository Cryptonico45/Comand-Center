@extends('layouts.app')

@section('title', 'Tambah Data Database')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Database</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Tambah Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('Api.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Pilih Tabel</label>
                            <select name="tabel" class="form-control @error('tabel') is-invalid @enderror">
                                <option value="">-- Pilih Tabel --</option>
                                @foreach($database_tables as $table)
                                    <option value="{{ $table }}" {{ old('tabel') == $table ? 'selected' : '' }}>{{ $table }}</option>
                                @endforeach
                            </select>
                            @error('tabel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Link API</label>
                            <input type="text" name="link_api"
                                   class="form-control @error('link_api') is-invalid @enderror"
                                   value="{{ old('link_api') }}" required>
                            @error('link_api')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
