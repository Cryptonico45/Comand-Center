@extends('layouts.app')

@section('title', 'Edit Data Database')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Database</h1>
        </div>
        <form action="{{ route('Api.update', $api->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Pilih Tabel</label>
                <select name="tabel" class="form-control @error('tabel') is-invalid @enderror">
                    <option value="">-- Pilih Tabel --</option>
                    @foreach($database_tables as $table)
                        <option value="{{ $table }}" {{ (old('tabel', $api->tabel) == $table) ? 'selected' : '' }}>{{ $table }}</option>
                    @endforeach
                </select>
                @error('tabel')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="link_api">Link API</label>
                <input type="text" name="link_api" id="link_api" class="form-control" value="{{ $api->link_api }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </section>
</div>
@endsection
