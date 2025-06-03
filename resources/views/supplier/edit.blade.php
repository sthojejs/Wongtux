@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">✏️ Edit Supplier</h4>

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

    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST" class="card shadow-sm p-4 rounded-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Supplier</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $supplier->nama) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kontak</label>
            <input type="text" name="kontak" class="form-control" value="{{ old('kontak', $supplier->kontak) }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $supplier->email) }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $supplier->alamat) }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('supplier.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
            <button class="btn btn-primary">
                <i class="bi bi-save"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
