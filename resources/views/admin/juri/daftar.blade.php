@extends('layouts.app')
@section('title', 'Daftar Gugus Juri')

@section('main')
<div class="main-content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h5>Gugus yang Dinilai: {{ $juri->name }}</h5>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Gugus</th>
                            <th>Email</th>
                            <th>Departemen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peserta as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->unit_kerja ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada gugus</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <a href="{{ route('admin.juri.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </div>

    </div>
</div>
@endsection
