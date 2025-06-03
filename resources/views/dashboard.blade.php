@extends('layouts.app')

@section('content')
<div class="container-fluid px-lg-4 px-xl-5">
    <!-- Dashboard Header with Welcome Message -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-2 text-gray-900 fw-bold">Dashboard</h1>
            <p class="mb-0">
                Selamat datang kembali, 
                <span class="fw-bold text-primary">{{ Auth::user()->name }}</span> 
                <span class="badge bg-primary bg-opacity-10 text-primary ms-2 text-capitalize">{{ Auth::user()->role }}</span>
            </p>
        </div>
        <div class="d-none d-md-block">
            <span class="text-muted">Hari ini: </span>
            <span class="fw-bold">{{ now()->isoFormat('dddd, D MMMM Y') }}</span>
        </div>
    </div>

    <!-- Low Stock Alert - Improved Design -->
    @if ($stokMinim->count())
        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center mb-4">
            <div class="flex-shrink-0 me-3">
                <i class="bi bi-exclamation-triangle-fill fs-2"></i>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0 fw-bold">Peringatan Stok Menipis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="row g-2">
                    @foreach ($stokMinim as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="p-2 bg-warning bg-opacity-10 rounded">
                                <span class="fw-bold">{{ $item->nama }}</span> - 
                                tersisa <span class="badge bg-warning text-dark">{{ $item->stok }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Summary Cards - Improved Grid -->
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card border-start border-primary border-4 h-100 hover-scale">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Jenis Barang</h6>
                            <h2 class="mb-0 fw-bold text-primary">{{ $totalBarang }}</h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="bi bi-box-seam text-primary fs-4"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="fw-semibold {{ $barangGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                            <i class="bi {{ $barangGrowth >= 0 ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
                            {{ abs($barangGrowth) }}%
                        </span>
                        <span class="text-muted ms-2">dari bulan lalu</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card border-start border-success border-4 h-100 hover-scale">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Total Stok</h6>
                            <h2 class="mb-0 fw-bold text-success">{{ $totalStok }}</h2>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="bi bi-stack text-success fs-4"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="fw-semibold {{ $stokGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                            <i class="bi {{ $stokGrowth >= 0 ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
                            {{ abs($stokGrowth) }}%
                        </span>
                        <span class="text-muted ms-2">dari bulan lalu</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card border-start border-info border-4 h-100 hover-scale">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Barang Masuk</h6>
                            <h2 class="mb-0 fw-bold text-info">{{ $masuk }}</h2>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="bi bi-box-arrow-in-down text-info fs-4"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="fw-semibold {{ $masukGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                            <i class="bi {{ $masukGrowth >= 0 ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
                            {{ abs($masukGrowth) }}%
                        </span>
                        <span class="text-muted ms-2">dari bulan lalu</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card border-start border-danger border-4 h-100 hover-scale">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-uppercase text-muted mb-2">Barang Keluar</h6>
                            <h2 class="mb-0 fw-bold text-danger">{{ $keluar }}</h2>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded">
                            <i class="bi bi-box-arrow-up text-danger fs-4"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="fw-semibold {{ $keluarGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                            <i class="bi {{ $keluarGrowth >= 0 ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
                            {{ abs($keluarGrowth) }}%
                        </span>
                        <span class="text-muted ms-2">dari bulan lalu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons - Improved Layout -->
    <div class="row mb-4 g-3">
        @if (Auth::user()->role === 'admin')
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('barang.index') }}" class="btn btn-light w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 action-card">
                    <i class="bi bi-box-seam fs-2 text-primary mb-2"></i>
                    <span class="text-center">Kelola Barang</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('transaksi.index') }}" class="btn btn-light w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 action-card">
                    <i class="bi bi-repeat fs-2 text-secondary mb-2"></i>
                    <span class="text-center">Data Transaksi</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('laporan.transaksi') }}" class="btn btn-light w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 action-card">
                    <i class="bi bi-file-earmark-bar-graph fs-2 text-success mb-2"></i>
                    <span class="text-center">Laporan Transaksi</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('laporan.stok') }}" class="btn btn-light w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 action-card">
                    <i class="bi bi-clipboard-data fs-2 text-success mb-2"></i>
                    <span class="text-center">Laporan Stok</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('kategori.index') }}" class="btn btn-light w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 action-card">
                    <i class="bi bi-tags fs-2 text-dark mb-2"></i>
                    <span class="text-center">Data Kategori</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('supplier.index') }}" class="btn btn-light w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 action-card">
                    <i class="bi bi-truck fs-2 text-warning mb-2"></i>
                    <span class="text-center">Data Supplier</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('users.index') }}" class="btn btn-light w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 action-card">
                    <i class="bi bi-people-fill fs-2 text-info mb-2"></i>
                    <span class="text-center">Kelola Pengguna</span>
                </a>
            </div>
        @elseif (Auth::user()->role === 'staf')
            <div class="col-6 col-md-6">
                <a href="{{ route('barang.index') }}" class="btn btn-light w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 action-card">
                    <i class="bi bi-box-seam fs-2 text-primary mb-2"></i>
                    <span class="text-center">Kelola Barang</span>
                </a>
            </div>
            <div class="col-6 col-md-6">
                <a href="{{ route('transaksi.index') }}" class="btn btn-light w-100 h-100 d-flex flex-column align-items-center justify-content-center p-3 action-card">
                    <i class="bi bi-repeat fs-2 text-secondary mb-2"></i>
                    <span class="text-center">Transaksi</span>
                </a>
            </div>
        @endif
    </div>

    <!-- Charts Section - Improved Layout -->
    <div class="row g-4">
        <!-- Transaction Chart - Larger and More Detailed -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="bi bi-graph-up-arrow me-2 text-success"></i> Statistik Transaksi
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="chartRangeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Hari Ini
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="chartRangeDropdown">
                            <li><a class="dropdown-item chart-range-option active" href="#" data-range="day">Hari Ini</a></li>
                            <li><a class="dropdown-item chart-range-option" href="#" data-range="month">Tahun ini</a></li>
                            <li><a class="dropdown-item chart-range-option" href="#" data-range="year">Bulan ini</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="transaksiChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Composition Chart - With Legend -->
        <div class="col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h5 class="mb-0 fw-bold">Komposisi Stok per Kategori</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 250px;">
                        <canvas id="stokKategoriChart"></canvas>
                    </div>
                    <div class="mt-3" id="chartLegend"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-white border-bottom-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Aktivitas Terakhir</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Aktivitas</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentAktivitas as $t)
                            <tr>
                                <td>{{ $t->created_at->diffForHumans() }}</td>
                                <td>
                                    <span class="badge bg-{{ $t->jenis === 'masuk' ? 'success' : 'danger' }}">
                                        {{ ucfirst($t->jenis) }}
                                    </span>
                                </td>
                                <td>{{ $t->barang->nama ?? '-' }} (Qty: {{ $t->jumlah }})</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada aktivitas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Hover effects */
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-scale:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    /* Action cards */
    .action-card {
        transition: all 0.3s ease;
        border-radius: 0.5rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .action-card:hover {
        background-color: #f8f9fa;
        transform: translateY(-3px);
        box-shadow: 0 0.3rem 0.6rem rgba(0, 123, 255, 0.2);
    }

    /* Card header styling */
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .chart-container {
            height: 250px !important;
        }
    }

    @media (max-width: 576px) {
        .card-body {
            padding: 1rem;
        }

        .action-card {
            padding: 1rem 0.5rem !important;
        }

        .action-card i {
            font-size: 1.5rem !important;
        }
    }
</style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        // Global chart instance
        let transaksiChart = null;

        /**
         * Initialize Transaction Chart
         * @param {string} range - Time range for data (day, week, month, etc.)
         */
        const initTransactionChart = (range = 'day') => {
            fetch(`/dashboard/data?range=${range}`)
                .then(res => res.json())
                .then(data => {
                    const ctx = document.getElementById('transaksiChart').getContext('2d');
                    
                    // Destroy previous chart if exists
                    if (transaksiChart) {
                        transaksiChart.destroy();
                    }

                    // Create new chart
                    transaksiChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [
                                {
                                    label: 'Barang Masuk',
                                    data: data.masuk,
                                    backgroundColor: 'rgba(40, 167, 69, 0.6)',
                                    borderColor: 'rgba(40, 167, 69, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Barang Keluar',
                                    data: data.keluar,
                                    backgroundColor: 'rgba(220, 53, 69, 0.6)',
                                    borderColor: 'rgba(220, 53, 69, 1)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Jumlah'
                                    },
                                    grid: {
                                        display: true,
                                        drawBorder: false
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        boxWidth: 12,
                                        padding: 20
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: (context) => `${context.dataset.label}: ${context.raw}`
                                    }
                                }
                            },
                            interaction: {
                                intersect: false,
                                mode: 'index'
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error loading transaction data:', error);
                });
        };

        const initStockCategoryChart = () => {
            fetch('/dashboard/stok-kategori')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('stokKategoriChart').getContext('2d');
                    
                    // Generate consistent colors
                    const backgroundColors = data.labels.map((label, index) => {
                        const hue = (index * (360 / data.labels.length)) % 360;
                        return `hsl(${hue}, 70%, 60%)`;
                    });

                    // Create chart
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                data: data.data,
                                backgroundColor: backgroundColors,
                                borderWidth: 1,
                                borderColor: '#fff',
                                hoverOffset: 10,
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '70%',
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    callbacks: {
                                        label: (context) => {
                                            const value = context.raw;
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = Math.round((value / total) * 100);
                                            return `${context.label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                },
                                datalabels: { display: false }
                            },
                            animation: {
                                animateScale: true,
                                animateRotate: true,
                            },
                        },
                        plugins: [ChartDataLabels],
                    });

                    // Update legend - tampilkan horizontal kemudian wrap ke bawah
                    const legend = document.getElementById('chartLegend');
                    if (legend) {
                        legend.style.display = 'flex';
                        legend.style.flexWrap = 'wrap';
                        legend.style.gap = '12px';
                        legend.style.alignItems = 'center';
                        
                        legend.innerHTML = data.labels.map((label, i) => `
                            <div class="d-flex align-items-center" style="flex: 0 0 auto;">
                                <span class="legend-color rounded-circle" style="background-color:${backgroundColors[i]};width:12px;height:12px;display:inline-block;margin-right:6px;"></span>
                                <span class="text-muted small">${label}</span>
                            </div>
                        `).join('');
                    }
                })
                .catch(error => {
                    console.error('Error loading stock category data:', error);
                });
        };

        // Initialize charts when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            initTransactionChart();
            initStockCategoryChart();

            // Add event listeners for range selector buttons
            document.querySelectorAll('.chart-range-option').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const selectedRange = this.dataset.range;
                    
                    // Update UI
                    document.getElementById('chartRangeDropdown').textContent = this.textContent;
                    document.querySelectorAll('.chart-range-option').forEach(el => el.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Reload chart with new range
                    initTransactionChart(selectedRange);
                });
            });
        });
    </script>
@endpush