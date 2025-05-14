@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-person-circle me-2"></i>Profil Saya</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label"><i class="bi bi-person me-2"></i>Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label"><i class="bi bi-envelope me-2"></i>Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label"><i class="bi bi-shield me-2"></i>Role</label>
                            <input type="text" id="role" value="{{ ucfirst($user->role) }}" class="form-control" readonly>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('password.edit') }}" class="btn btn-outline-secondary"><i class="bi bi-key me-2"></i>Ubah Password</a>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .btn {
        transition: all 0.3s ease;
    }
</style>
@endpush
@endsection