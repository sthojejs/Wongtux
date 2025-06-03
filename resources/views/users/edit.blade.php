@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm rounded-4 p-4">
        <h4 class="mb-4">✏️ Edit Pengguna</h4>

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf 
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label fw-semibold">Role</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="staf" {{ $user->role == 'staf' ? 'selected' : '' }}>Staf</option>
                </select>
            </div>

            <button type="submit" class="btn btn-warning">
                <i class="bi bi-pencil-square me-1"></i> Update
            </button>
        </form>
    </div>
</div>
@endsection
