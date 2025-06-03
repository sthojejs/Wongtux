@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Header cetak hanya muncul saat print --}}
    <div class="text-center mb-4 d-none d-print-block">
        <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 60px;" class="mb-2">
        <h5 class="fw-bold mb-0">LAPORAN STOK BARANG</h5>
        <p class="mb-0">PT WongTux</p>
        <small>Tanggal Cetak: {{ now()->format('d-m-Y H:i') }}</small>
    </div>

    <h4 class="d-print-none mb-4">📊 Laporan Stok</h4>

    {{-- Filter kategori & pencarian --}}
    <form method="GET" class="card shadow-sm p-3 rounded-4 mb-4 bg-light d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="kategori" class="form-label fw-semibold mb-0">Kategori</label>
                <select name="kategori" id="kategori" class="form-select border-primary-subtle">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <label for="search" class="form-label fw-semibold mb-0">Cari Nama Barang</label>
                <input type="text" name="search" id="search" class="form-control border-primary-subtle" 
                       placeholder="Ketik nama barang..." value="{{ request('search') }}">
            </div>
            <div class="col-auto mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-funnel-fill me-1"></i> Filter
                </button>
            </div>
        </div>
    </form>

    {{-- Tabel stok responsive --}}
    <div class="card shadow-sm rounded-4 p-3">
        <div class="table-responsive">
            <table class="table table-bordered mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barang as $item)
                        <tr>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kategori->nama ?? '-' }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>{{ $item->stok }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tombol export dan cetak --}}
    <div class="mt-3 d-flex flex-wrap gap-2 d-print-none">
        <a href="{{ route('laporan.stok.excel', request()->query()) }}" class="btn btn-success btn-sm shadow-sm rounded-4">
            <i class="bi bi-file-earmark-excel-fill me-1"></i> Export Excel
        </a>
        <button onclick="window.print()" class="btn btn-outline-primary btn-sm shadow-sm rounded-4">
            <i class="bi bi-printer me-1"></i> Cetak
        </button>
    </div>
</div>
@endsection
