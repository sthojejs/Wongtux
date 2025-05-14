@extends('layouts.app')

@section('content')
    {{-- Header cetak hanya muncul saat print --}}
    <div class="text-center mb-4 d-none d-print-block">
        <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 60px;" class="mb-2">
        <h5 class="fw-bold mb-0">LAPORAN TRANSAKSI BARANG</h5>
        <p class="mb-0">PT WongTux</p>
        <small>Tanggal Cetak: {{ now()->format('d-m-Y H:i') }}</small>
    </div>

    <h4 class="d-print-none">Laporan Transaksi</h4>

    {{-- Filter tanggal --}}
    <div class="border rounded p-3 mb-4 bg-light d-print-none">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-3 col-sm-6">
                <label for="start_date" class="form-label fw-medium">Dari Tanggal</label>
                <input type="date" name="start_date" id="start_date" 
                       class="form-control border-primary-subtle" 
                       value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3 col-sm-6">
                <label for="end_date" class="form-label fw-medium">Sampai Tanggal</label>
                <input type="date" name="end_date" id="end_date" 
                       class="form-control border-primary-subtle" 
                       value="{{ request('end_date') }}">
            </div>
            <div class="col-md-2 col-sm-12">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>

    {{-- Tabel transaksi --}}
    <table class="table table-bordered">
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

    {{-- Tombol export dan cetak --}}
    <div class="mt-3 d-flex gap-2 d-print-none">
        <a href="{{ route('laporan.transaksi.pdf', request()->query()) }}" class="btn btn-danger btn-sm">
            Export PDF
        </a>
        <a href="{{ route('laporan.transaksi.excel', request()->query()) }}" class="btn btn-success btn-sm">
            Export Excel
        </a>
        <button onclick="window.print()" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-printer me-1"></i> Cetak
        </button>
    </div>
@endsection
