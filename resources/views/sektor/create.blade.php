@extends('layouts.app')

@section('title', 'Tambah Data Metabase')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Tambah Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('sektor.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Sektor</label>
                            <input type="text" class="form-control @error('sektor') is-invalid @enderror"
                                   name="sektor" required placeholder="Masukkan Sektor">
                            @error('sektor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan"
                                      class="form-control @error('keterangan') is-invalid @enderror"
                                      rows="3">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
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
