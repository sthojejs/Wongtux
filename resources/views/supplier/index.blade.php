@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Card Header + Tombol --}}
    <div class="card shadow-sm rounded-4 p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-0">
            <h4 class="mb-0">Data Supplier</h4>
            <a href="{{ route('supplier.create') }}" class="btn btn-success">
                + Tambah Supplier
            </a>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
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
                        <th>Kontak</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($supplier as $s)
                        <tr>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->kontak }}</td>
                            <td>{{ $s->email }}</td>
                            <td>{{ $s->alamat }}</td>
                            <td class="text-center">
                                <a href="{{ route('supplier.edit', $s->id) }}" class="btn btn-warning btn-sm me-1" data-bs-toggle="tooltip" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('supplier.destroy', $s->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus supplier?');">
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
                            <td colspan="5" class="text-center text-muted">Belum ada data supplier.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
