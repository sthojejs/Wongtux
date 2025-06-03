@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-sm rounded-4 border-0" style="background: #fff;">
                <div class="card-header bg-primary text-white rounded-top" style="box-shadow: 0 4px 8px rgb(13 110 253 / 0.3);">
                    <h4 class="mb-0">
                        <i class="bi bi-person-circle me-2"></i>Profil Saya
                    </h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center mb-3 rounded-3 shadow-sm" role="alert" style="font-weight: 600;">
                            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger d-flex align-items-center mb-3 rounded-3 shadow-sm" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-secondary">
                                <i class="bi bi-person me-2"></i>Nama
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control rounded-3 border border-secondary-subtle" required style="background:#fefefe; transition: box-shadow 0.3s ease;">
                            <div class="invalid-feedback">
                                Nama wajib diisi.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold text-secondary">
                                <i class="bi bi-envelope me-2"></i>Email
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control rounded-3 border border-secondary-subtle" required style="background:#fefefe; transition: box-shadow 0.3s ease;">
                            <div class="invalid-feedback">
                                Email wajib diisi dan harus valid.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label fw-semibold text-secondary">
                                <i class="bi bi-shield-lock me-2"></i>Role
                            </label>
                            <input type="text" id="role" value="{{ ucfirst($user->role) }}" class="form-control rounded-3 border border-secondary-subtle" readonly style="background:#f8f9fa;">
                        </div>

                        <div class="d-flex gap-3 justify-content-between">
                            <a href="{{ route('password.edit') }}" class="btn btn-outline-secondary rounded-pill px-4" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah password akun kamu">
                                <i class="bi bi-key me-2"></i>Ubah Password
                            </a>
                            <button type="submit" class="btn btn-soft-primary rounded-pill px-4">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
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
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 0.8rem 1.2rem rgba(0,0,0,0.12);
    }
    .form-control:focus {
        box-shadow: 0 0 8px 2px rgba(100, 149, 237, 0.3) !important; /* soft cornflower blue */
        border-color: #6495ED !important;
        background: #fff !important;
        outline: none;
    }
    .btn {
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }
    .btn-soft-primary {
        background-color: #a8c0ff;
        border: none;
        color: #334d6e;
    }
    .btn-soft-primary:hover, .btn-soft-primary:focus {
        background-color: #7f9eff;
        color: #1f2a44;
        box-shadow: 0 6px 12px rgba(127, 158, 255, 0.4);
    }
    .btn-outline-secondary {
        border-radius: 50px !important;
        padding-left: 1.5rem !important;
        padding-right: 1.5rem !important;
    }
</style>
@endpush

@push('scripts')
<script>
    // Bootstrap 5 form validation
    (() => {
      'use strict'
      const forms = document.querySelectorAll('.needs-validation')
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })

      // Initialize Bootstrap tooltips
      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      tooltipTriggerList.map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    })()
</script>
@endpush
@endsection
