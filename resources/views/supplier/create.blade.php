@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">➕ Tambah Supplier Baru</h4>

    {{-- Notifikasi Error --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ups!</strong> Ada kesalahan saat mengisi form:
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('supplier.store') }}" method="POST" class="card shadow-sm p-4 rounded-4">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Supplier</label>
            <input type="text" name="nama" class="form-control" placeholder="Contoh: PT. Sumber Makmur" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kontak</label>
            <input type="text" name="kontak" class="form-control" placeholder="Contoh: 08123456789">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control" placeholder="contoh@email.com">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap supplier..."></textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('supplier.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
            <button class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
