@extends('layouts.app')

@section('content')
    <h4>Laporan Stok Barang</h4>

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Kode</th>
                <th>Stok Tersedia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kategori->nama ?? '-' }}</td>
                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->stok }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        <a href="{{ route('laporan.stok.pdf') }}" class="btn btn-danger btn-sm">Export PDF</a>
        <a href="{{ route('laporan.stok.excel') }}" class="btn btn-success btn-sm">Export Excel</a>
    </div>
@endsection