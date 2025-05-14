@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Dashboard Header -->
    <div class="p-4 bg-white rounded shadow-sm mb-4">
        <h3 class="mb-3">Dashboard</h3>

        <!-- Low Stock Alert -->
        @if ($stokMinim->count())
        <div class="alert alert-warning">
            <h5><i class="bi bi-exclamation-triangle-fill me-2"></i> Stok Menipis</h5>
            <ul class="mb-0">
                @foreach ($stokMinim as $item)
                <li><strong>{{ $item->nama }}</strong> hanya tersisa <strong>{{ $item->stok }}</strong></li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Summary Cards -->
        <div class="row text-center mb-4">
            <div class="col-md-3 mb-3">
                <div class="card border-primary shadow-sm h-100">
                    <div class="card-body">
                        <div class="fs-4 fw-bold text-primary">{{ $totalBarang }}</div>
                        <div class="text-muted">Jenis Barang</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-success shadow-sm h-100">
                    <div class="card-body">
                        <div class="fs-4 fw-bold text-success">{{ $totalStok }}</div>
                        <div class="text-muted">Total Stok</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-info shadow-sm h-100">
                    <div class="card-body">
                        <div class="fs-4 fw-bold text-info">{{ $masuk }}</div>
                        <div class="text-muted">Barang Masuk</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-danger shadow-sm h-100">
                    <div class="card-body">
                        <div class="fs-4 fw-bold text-danger">{{ $keluar }}</div>
                        <div class="text-muted">Barang Keluar</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Welcome Message -->
        <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->role }})</p>

        <!-- Action Buttons -->
        <div class="row mt-4">
            @if (Auth::user()->role === 'admin')
            <div class="col-md-4 mb-3">
                <a href="{{ route('barang.index') }}" class="btn btn-outline-primary w-100">
                    <i class="bi bi-box-seam me-2"></i> Kelola Barang
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-repeat me-2"></i> Data Transaksi
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('laporan.transaksi') }}" class="btn btn-outline-success w-100">
                    <i class="bi bi-file-earmark-bar-graph me-2"></i> Laporan Transaksi
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('laporan.stok') }}" class="btn btn-outline-success w-100">
                    <i class="bi bi-file-earmark-bar-graph me-2"></i> Laporan Stok
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('kategori.index') }}" class="btn btn-outline-dark w-100">
                    <i class="bi bi-tags me-2"></i> Data Kategori
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('supplier.index') }}" class="btn btn-outline-warning w-100">
                    <i class="bi bi-truck me-2"></i> Data Supplier
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-people-fill me-2"></i> Kelola Pengguna
                </a>
            </div>
            @elseif (Auth::user()->role === 'staf')
            <div class="col-md-6 mb-3">
                <a href="{{ route('barang.index') }}" class="btn btn-outline-primary w-100">
                    <i class="bi bi-box-seam me-2"></i> Lihat Barang
                </a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-repeat me-2"></i> Transaksi
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Transaction Chart -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Statistik Transaksi Bulanan</h5>
            <canvas id="transaksiChart" height="100"></canvas>
        </div>
    </div>

    <!-- Stock Composition Chart -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Komposisi Stok per Kategori</h5>
            <div class="chart-wrapper" style="max-width: 500px; margin: auto;">
                <canvas id="stokKategoriChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    #stokKategoriChart {
        width: 100% !important;
        height: auto !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Transaction Chart
        const initTransactionChart = () => {
            fetch('/dashboard/data')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('transaksiChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: Object.values(data.labels),
                            datasets: [
                                {
                                    label: 'Barang Masuk',
                                    data: Object.values(data.masuk),
                                    backgroundColor: 'rgba(40, 167, 69, 0.6)',
                                },
                                {
                                    label: 'Barang Keluar',
                                    data: Object.values(data.keluar),
                                    backgroundColor: 'rgba(220, 53, 69, 0.6)',
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Jumlah',
                                    },
                                },
                            },
                        },
                    });
                })
                .catch(error => console.error('Error loading transaction chart:', error));
        };

        // Initialize Stock Category Chart
        const initStockCategoryChart = () => {
            fetch('/dashboard/stok-kategori')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('stokKategoriChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                data: data.data,
                                backgroundColor: [
                                    '#0d6efd',
                                    '#198754',
                                    '#dc3545',
                                    '#ffc107',
                                    '#6f42c1',
                                ],
                            }],
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                },
                                title: {
                                    display: true,
                                    text: 'Distribusi Stok Barang per Kategori',
                                },
                            },
                        },
                    });
                })
                .catch(error => console.error('Error loading stock category chart:', error));
        };

        // Initialize both charts
        initTransactionChart();
        initStockCategoryChart();
    });
</script>
@endpush