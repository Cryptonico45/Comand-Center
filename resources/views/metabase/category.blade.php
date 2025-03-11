@extends('layouts.app')

@section('title', 'Dashboard ' . $kategori)

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard {{ $kategori }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                @forelse($metabases as $metabase)
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item"
                                            src="{{ $metabase->link_metabase }}"
                                            allowfullscreen
                                            style="border: 0; width: 100%; height: 600px;">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            Belum ada data dashboard untuk kategori {{ $kategori }}
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
