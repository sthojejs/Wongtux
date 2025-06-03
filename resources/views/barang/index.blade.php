@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Card Header + Tombol Tambah + Form Import --}}
    <div class="card shadow-sm rounded-4 p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">📦 Data Barang</h4>
            <a href="{{ route('barang.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Tambah Barang
            </a>
        </div>

        {{-- Form Import Excel --}}
        <form action="{{ route('barang.import') }}" method="POST" enctype="multipart/form-data" class="row g-3 align-items-center">
            @csrf
            <div class="col-md-5">
                <input type="file" name="file" class="form-control form-control-sm" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-success btn-sm">
                    <i class="bi bi-upload me-1"></i> Import Excel
                </button>
            </div>
            <div class="col-auto">
                <a href="{{ route('barang.template') }}" class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                    <i class="bi bi-download me-1"></i> Unduh Template
                </a>
            </div>
        </form>
    </div>

    {{-- Alerts --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i> {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Card Tabel --}}
    <div class="card shadow-sm rounded-4 p-4">
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Kode</th>
                        <th>Stok</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barang as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kategori->nama ?? '-' }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->stok }}</td>
                            <td class="text-center">
                                <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning btn-sm me-1" data-bs-toggle="tooltip" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus barang ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data barang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
