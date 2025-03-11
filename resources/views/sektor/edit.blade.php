@extends('layouts.app')

@section('title', 'Edit Data Sektor')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Sektor</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Edit Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('sektor.update', $sektor->id_sektor) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Sektor</label>
                            <input type="text" name="sektor"
                                   class="form-control @error('sektor') is-invalid @enderror"
                                   value="{{ old('sektor', $sektor->sektor) }}" required>
                            @error('sektor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan"
                                      class="form-control @error('keterangan') is-invalid @enderror"
                                      rows="3">{{ old('keterangan', $sektor->keterangan) }}</textarea>
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
