@extends('layouts.admin.master')

@section('title', 'Beranda Admin')

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <h3 class="fw-bold">Selamat Datang, Admin!</h3>
        <p class="text-muted">Berikut adalah ringkasan operasional bimbel hari ini.</p>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                <h6>Total Siswa</h6>
                <h2 class="fw-bold">{{ $stats['total_siswa'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                <h6>Program Aktif</h6>
                <h2 class="fw-bold">{{ $stats['total_program'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card bg-warning text-white shadow">
            <div class="card-body">
                <h6>Pendaftaran Pending</h6>
                <h2 class="fw-bold">{{ $stats['pendaftaran_baru'] }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection