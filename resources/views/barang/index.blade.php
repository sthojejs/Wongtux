@extends('layouts.app')

@section('content')
    <h4>Data Barang</h4>

    <a href="{{ route('barang.create') }}" class="btn btn-success mb-3">+ Tambah Barang</a>

    {{-- Form Import Excel --}}
    <form action="{{ route('barang.import') }}" method="POST" enctype="multipart/form-data" class="row g-2 mb-4 align-items-center">
        @csrf
        <div class="col-auto">
            <input type="file" name="file" class="form-control" required>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-success">Import Excel</button>
        </div>
        <div class="col-auto">
            <a href="{{ route('barang.template') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-download"></i> Unduh Template
            </a>
        </div>
    </form>

    {{-- ALERTS --}}
    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning mt-2">
            {{ session('warning') }}
        </div>
    @endif

    {{-- Tabel Data Barang --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Kode</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kategori->nama ?? '-' }}</td>
                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus barang ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
