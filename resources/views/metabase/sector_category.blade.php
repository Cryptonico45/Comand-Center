@extends('layouts.app')

@section('title', "Dashboard $sektorName - $category")

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard {{ $sektorName }} - {{ $category }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                @foreach($metabases as $metabase)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $metabase->sektor->sektor }}</h4>
                            </div>
                            <div class="card-body">
                                <p>{{ $metabase->keterangan ?: 'Tidak ada keterangan' }}</p>
                                <a href="{{ $metabase->link_metabase }}" class="btn btn-primary" target="_blank">
                                    Lihat Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
