@extends('layouts.app')

@section('content')
<div class="text-center mb-4 d-none d-print-block">
    <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 60px;" class="mb-2">
    <h5 class="fw-bold mb-0">LAPORAN STOK BARANG</h5>
    <p class="mb-0">PT WongTux</p>
    <small>Tanggal Cetak: {{ now()->format('d-m-Y H:i') }}</small>
</div>

    <h4 class="d-print-none">Laporan Stok</h4>

    @if(session('success'))
        <div class="alert alert-success d-print-none">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
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

    <div class="mt-3 d-print-none d-flex gap-2">
        <a href="{{ route('laporan.stok.pdf') }}" class="btn btn-danger btn-sm">
            Export PDF
        </a>
        <a href="{{ route('laporan.stok.excel') }}" class="btn btn-success btn-sm">
            Export Excel
        </a>
        <button onclick="window.print()" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-printer me-1"></i> Cetak
        </button>
    </div>
@endsection
