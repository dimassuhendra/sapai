@extends('layouts.admin.master')

@section('title', 'Beranda Admin')

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <h3 class="fw-bold text-dark">Selamat Datang, Admin!</h3>
        <p class="text-muted">Ringkasan data berdasarkan aktivitas sistem saat ini.</p>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm border-start border-primary border-4">
            <div class="card-body text-center">
                <h6 class="text-muted small text-uppercase fw-bold">Total Siswa</h6>
                <h2 class="fw-bold mb-0">{{ $stats['total_siswa'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm border-start border-success border-4">
            <div class="card-body text-center">
                <h6 class="text-muted small text-uppercase fw-bold">Program Aktif</h6>
                <h2 class="fw-bold mb-0">{{ $stats['total_program'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm border-start border-warning border-4">
            <div class="card-body text-center">
                <h6 class="text-muted small text-uppercase fw-bold">Pendaftaran Pending</h6>
                <h2 class="fw-bold mb-0">{{ $stats['pendaftaran_baru'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm border-start border-info border-4">
            <div class="card-body text-center">
                <h6 class="text-muted small text-uppercase fw-bold">Total Omzet</h6>
                <h4 class="fw-bold mb-0 text-truncate">Rp {{ number_format($stats['total_omzet'], 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-info">Grafik Pendaftaran Per Bulan</h6>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                @if($chartData->isEmpty())
                <p class="text-muted italic">Data grafik belum tersedia</p>
                @else
                <div id="chart-data-container"
                    data-labels="{{ json_encode($chartData->pluck('bulan')) }}"
                    data-values="{{ json_encode($chartData->pluck('total')) }}"
                    style="width: 100%; height: 300px;">
                    <canvas id="pendaftaranChart"></canvas>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-info">Program Terpopuler</h6>
            </div>
            <div class="card-body">
                @forelse($popular_programs as $p)
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <div class="fw-bold small">{{ $p->nama_program }}</div>
                        <small class="text-muted">{{ $p->enrollments_count }} Pendaftar</small>
                    </div>
                    <span class="badge bg-light text-primary border">IDR {{ number_format($p->harga / 1000) }}k</span>
                </div>
                <hr class="my-2 opacity-50">
                @empty
                <p class="text-muted text-center py-5">Data belum tersedia</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-info">Pendaftaran Terbaru</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 small">SISWA</th>
                                <th class="small">PROGRAM</th>
                                <th class="small">TANGGAL</th>
                                <th class="small">STATUS</th>
                                <th class="text-center small">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_enrollments as $enroll)
                            <tr>
                                <td class="px-4">
                                    <div class="fw-bold">{{ $enroll->user->nama_lengkap }}</div>
                                    <small class="text-muted">{{ $enroll->user->email }}</small>
                                </td>
                                <td>{{ $enroll->program->nama_program }}</td>
                                <td>{{ $enroll->created_at->format('d M Y') }}</td>
                                <td>
                                    <span class="badge {{ $enroll->status_bayar == 'lunas' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($enroll->status_bayar) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $enroll->id }}">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalDetail{{ $enroll->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title">Detail Pendaftaran #{{ $enroll->id }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <label class="text-muted small">Nama Siswa</label>
                                                    <p class="fw-bold">{{ $enroll->user->nama_lengkap }}</p>
                                                </div>
                                                <div class="col-6">
                                                    <label class="text-muted small">Program</label>
                                                    <p class="fw-bold">{{ $enroll->program->nama_program }}</p>
                                                </div>
                                                <div class="col-6">
                                                    <label class="text-muted small">Tanggal Daftar</label>
                                                    <p>{{ $enroll->created_at->format('d F Y H:i') }}</p>
                                                </div>
                                                <div class="col-6">
                                                    <label class="text-muted small">Harga</label>
                                                    <p class="text-primary fw-bold">Rp {{ number_format($enroll->program->harga) }}</p>
                                                </div>
                                                <div class="col-12">
                                                    <label class="text-muted small">Status Pembayaran</label>
                                                    <p><span class="badge {{ $enroll->status_bayar == 'lunas' ? 'bg-success' : 'bg-warning' }}">{{ strtoupper($enroll->status_bayar) }}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                            @if($enroll->status_bayar == 'pending')
                                            <a href="#" class="btn btn-success btn-sm">Konfirmasi Pembayaran</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Data pendaftaran belum tersedia</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if(!$chartData->isEmpty())
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dataContainer = document.getElementById('chart-data-container');

        // Mengambil data dari atribut HTML
        const chartLabels = JSON.parse(dataContainer.getAttribute('data-labels'));
        const chartValues = JSON.parse(dataContainer.getAttribute('data-values'));

        const ctx = document.getElementById('pendaftaranChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Pendaftar',
                    data: chartValues,
                    borderColor: '#2193b0',
                    backgroundColor: 'rgba(33, 147, 176, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#2193b0'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endif
@endsection