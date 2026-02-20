@extends('layouts.app')

@section('title', 'User Dashboard')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <!-- Statistik Card -->
        <div class="row">
            <!-- Judul Diajukan -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Judul Diajukan</h4>
                        </div>
                        <div class="card-body">
                            {{ $judulDiajukan }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Draft Disetujui -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Draft Makalah Disetujui</h4>
                        </div>
                        <div class="card-body">
                            {{ $draftDisetujui }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Final Disetujui -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Final Disetujui</h4>
                        </div>
                        <div class="card-body">
                            {{ $finalDisetujui }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row">
            <!-- Karya Chart -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        {!! $karyaChart->container() !!}
                    </div>
                </div>
            </div>

            <!-- Final Chart -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        {!! $finalChart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
{!! $karyaChart->script() !!}
{!! $finalChart->script() !!}
@endpush