@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Header cetak hanya muncul saat print --}}
    <div class="text-center mb-4 d-none d-print-block">
        <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 60px;" class="mb-2">
        <h5 class="fw-bold mb-0">LAPORAN TRANSAKSI BARANG</h5>
        <p class="mb-0">PT WongTux</p>
        <small>Tanggal Cetak: {{ now()->format('d-m-Y H:i') }}</small>
    </div>

    <h4 class="d-print-none mb-4">📊 Laporan Transaksi</h4>

    {{-- Filter tanggal --}}
    <form method="GET" class="card shadow-sm p-3 rounded-4 mb-4 bg-light d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="start_date" class="form-label fw-semibold mb-0">Dari Tanggal</label>
                <input type="date" name="start_date" id="start_date"
                       class="form-control border-primary-subtle"
                       value="{{ request('start_date') }}">
            </div>
            <div class="col-auto">
                <label for="end_date" class="form-label fw-semibold mb-0">Sampai Tanggal</label>
                <input type="date" name="end_date" id="end_date"
                       class="form-control border-primary-subtle"
                       value="{{ request('end_date') }}">
            </div>
            <div class="col-auto mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-funnel-fill me-1"></i> Filter
                </button>
            </div>
        </div>
    </form>

    {{-- Tabel transaksi responsive --}}
    <div class="card shadow-sm rounded-4 p-3">
        <div class="table-responsive">
            <table class="table table-bordered mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>Barang</th>
                        <th>Supplier</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi as $t)
                        <tr>
                            <td>{{ $t->created_at->format('d-m-Y') }}</td>
                            <td>{{ $t->barang->nama ?? '-' }}</td>
                            <td>{{ $t->supplier->nama ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $t->jenis == 'masuk' ? 'success' : 'danger' }}">
                                    {{ ucfirst($t->jenis) }}
                                </span>
                            </td>
                            <td>{{ $t->jumlah }}</td>
                            <td>{{ $t->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tombol export dan cetak --}}
    <div class="mt-3 d-flex flex-wrap gap-2 d-print-none">
        <a href="{{ route('laporan.transaksi.excel', request()->query()) }}" class="btn btn-success btn-sm shadow-sm rounded-4">
            <i class="bi bi-file-earmark-excel-fill me-1"></i> Export Excel
        </a>
        <button onclick="window.print()" class="btn btn-outline-primary btn-sm shadow-sm rounded-4">
            <i class="bi bi-printer me-1"></i> Cetak
        </button>
    </div>
</div>
@endsection
