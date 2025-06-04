@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Card Header + Tombol --}}
    <div class="card shadow-sm rounded-4 p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-0">
            <h4 class="mb-0">📂 Data Kategori</h4>
            <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
            </a>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Card Tabel --}}
    <div class="card shadow-sm rounded-4 p-4">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm align-middle mb-0" style="width: 100%; font-size: 0.9rem;">
                <thead class="table-dark text-center">
                    <tr>
                        <th style="width: 75%;">Nama</th>
                        <th style="width: 25%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategori as $k)
                        <tr>
                            <td class="text-center py-1 px-2">{{ $k->nama }}</td>
                            <td class="text-center py-1 px-2">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted py-1 px-2">Belum ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
