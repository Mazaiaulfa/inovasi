@extends('layouts.app')

@section('title', 'Admin Dashboard')

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

        <!-- Statistik Singkat -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Tim Terdaftar</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalUsers }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-file-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Judul Diajukan</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalKarya }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-file-upload"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Draft Makalah</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalProposal }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Finalisasi Makalah</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalFinalKarya }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row Chart 1: Judul & Proposal -->
        <div class="row mt-4">
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        {!! $judulChart->container() !!}
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        {!! $userTahapanChart->container() !!}

                    </div>
                </div>
            </div>
        </div>

        <!-- Row Chart 2: Final & Distribusi -->
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        {!! $proposalChart->container() !!}
                    </div>
                </div>
            </div>

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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
{!! $judulChart->script() !!}
{!! $proposalChart->script() !!}
{!! $finalChart->script() !!}
{!! $userTahapanChart->script() !!}
@endpush
@endsection