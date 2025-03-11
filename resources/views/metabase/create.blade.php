@extends('layouts.app')

@section('title', 'Tambah Data Metabase')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Metabase</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Tambah Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('metabase.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Sektor</label>
                            <select class="form-control @error('id_sektor') is-invalid @enderror" name="id_sektor" required>
                                <option value="">-- Pilih Sektor --</option>
                                @foreach($sektor as $sektor)
                                    <option value="{{ $sektor->id_sektor }}">
                                        {{ $sektor->sektor }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_sektor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" name="kategori"
                                   class="form-control @error('kategori') is-invalid @enderror"
                                   value="{{ old('kategori', $sektor->kategori) }}" required>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Link Metabase</label>
                            <input type="text" name="link_metabase"
                                   class="form-control @error('link_metabase') is-invalid @enderror"
                                   value="{{ old('link_metabase') }}" required>
                            @error('link_metabase')
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
