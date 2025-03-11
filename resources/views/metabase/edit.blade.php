@extends('layouts.app')

@section('title', 'Edit Data Metabase')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Metabase</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Edit Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('metabase.update', $metabase->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control @error('kategori') is-invalid @enderror"
                                    name="kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Perizinan" {{ $metabase->kategori == 'Perizinan' ? 'selected' : '' }}>
                                    Perizinan
                                </option>
                                <option value="Kepegawaian" {{ $metabase->kategori == 'Kepegawaian' ? 'selected' : '' }}>
                                    Kepegawaian
                                </option>
                                <option value="Kesehatan" {{ $metabase->kategori == 'Kesehatan' ? 'selected' : '' }}>
                                    Kesehatan
                                </option>
                                <option value="Kependudukan" {{ $metabase->kategori == 'Kependudukan' ? 'selected' : '' }}>
                                    Kependudukan
                                </option>
                                <option value="Perhubungan" {{ $metabase->kategori == 'Perhubungan' ? 'selected' : '' }}>
                                    Perhubungan
                                </option>
                                <option value="Keuangan" {{ $metabase->kategori == 'Keuangan' ? 'selected' : '' }}>
                                    Keuangan
                                </option>
                                <option value="Pembangunan" {{ $metabase->kategori == 'Pembangunan' ? 'selected' : '' }}>
                                    Pembangunan
                                </option>
                                <option value="SIG" {{ $metabase->kategori == 'SIG' ? 'selected' : '' }}>
                                    SIG
                                </option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Link Metabase</label>
                            <input type="text" name="link_metabase"
                                   class="form-control @error('link_metabase') is-invalid @enderror"
                                   value="{{ old('link_metabase', $metabase->link_metabase) }}" required>
                            @error('link_metabase')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan"
                                      class="form-control @error('keterangan') is-invalid @enderror"
                                      rows="3">{{ old('keterangan', $metabase->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
