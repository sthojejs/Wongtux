@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 480px;">
    <div class="card p-4 shadow-sm rounded-4 border-0" style="background: #ffffff;">
        <h4 class="mb-4 fw-semibold text-secondary">🔐 Ubah Password</h4>

        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center rounded-3 shadow-sm" role="alert" style="font-weight: 600;">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger rounded-3 shadow-sm">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <div class="mb-4">
                <label for="current_password" class="form-label fw-semibold text-muted">Password Lama</label>
                <input type="password" name="current_password" id="current_password" class="form-control rounded-3 border border-secondary-subtle" required style="background:#fefefe; transition: box-shadow 0.3s ease;">
                <div class="invalid-feedback">
                    Masukkan password lama kamu.
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label fw-semibold text-muted">Password Baru</label>
                <input type="password" name="password" id="password" class="form-control rounded-3 border border-secondary-subtle" required minlength="6" style="background:#fefefe; transition: box-shadow 0.3s ease;">
                <div class="invalid-feedback">
                    Password baru wajib diisi dan minimal 6 karakter.
                </div>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-semibold text-muted">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-3 border border-secondary-subtle" required style="background:#fefefe; transition: box-shadow 0.3s ease;">
                <div class="invalid-feedback">
                    Konfirmasi password wajib diisi dan harus sama dengan password baru.
                </div>
            </div>

            <button type="submit" class="btn btn-soft-primary w-100 py-2 fw-semibold rounded-pill" style="font-size: 1.1rem;">
                Update Password
            </button>
        </form>
    </div>
</div>

@push('styles')
<style>
    .form-control:focus {
        box-shadow: 0 0 8px 2px rgba(100, 149, 237, 0.3) !important; /* soft cornflower blue */
        background: #fff !important;
        outline: none;
    }
    .btn-soft-primary {
        background-color: #a8c0ff;
        border: none;
        color: #334d6e;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }
    .btn-soft-primary:hover {
        background-color: #7f9eff;
        color: #1f2a44;
        box-shadow: 0 6px 12px rgba(127, 158, 255, 0.4);
    }
</style>
@endpush

@push('scripts')
<script>
    (() => {
        'use strict';
        const form = document.querySelector('.needs-validation');
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                const pw = form.querySelector('#password').value;
                const confirmPw = form.querySelector('#password_confirmation').value;
                if(pw !== confirmPw) {
                    event.preventDefault();
                    event.stopPropagation();
                    const confirmInput = form.querySelector('#password_confirmation');
                    confirmInput.classList.add('is-invalid');
                    confirmInput.nextElementSibling.textContent = 'Konfirmasi password tidak sama.';
                }
            }
            form.classList.add('was-validated');
        });
        form.querySelector('#password_confirmation').addEventListener('input', e => {
            e.target.classList.remove('is-invalid');
        });
    })();
</script>
@endpush
@endsection
