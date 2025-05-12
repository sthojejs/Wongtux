<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Inventaris WongTux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
        }
        .card-body {
            padding: 2rem;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: 500;
            color: #333;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .form-control, .form-select {
            border: 1px solid #ced4da;
            border-radius: 6px;
            padding: 10px;
            transition: border-color 0.2s ease;
        }
        .password-container .form-control {
            padding-right: 35px; /* Ruang untuk ikon toggle */
        }
        .form-control:focus, .form-select:focus {
            border-color: #4a90e2;
            box-shadow: none;
        }
        .form-label {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 0.25rem;
        }
        .btn-primary {
            background-color: #4a90e2;
            border: none;
            border-radius: 6px;
            padding: 10px;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }
        .btn-primary:hover {
            background-color: #357abd;
        }
        .password-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 72%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            font-size: 0.8rem;
        }
        .alert {
            border-radius: 6px;
            font-size: 0.9rem;
            padding: 0.75rem;
        }
        .error-message {
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }
        a {
            color: #4a90e2;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .login-link {
            font-size: 0.9rem;
            color: #555;
            margin-top: 1.5rem;
        }
        .text-muted {
            font-size: 0.85rem;
        }
        @media (max-width: 576px) {
            .card {
                margin: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Register</h4>

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="/register" id="registerForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" id="name" class="form-control" required
                                       value="{{ old('name') }}" placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <small class="text-danger error-message">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required
                                       value="{{ old('email') }}" placeholder="Masukkan email">
                                @error('email')
                                    <small class="text-danger error-message">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 password-container">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required
                                       placeholder="Masukkan kata sandi">
                                <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                                @error('password')
                                    <small class="text-danger error-message">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="" {{ old('role') == '' ? 'selected' : '' }}>-- Pilih Peran --</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="staf" {{ old('role') == 'staf' ? 'selected' : '' }}>Staf Gudang</option>
                                </select>
                                @error('role')
                                    <small class="text-danger error-message">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Daftar</button>
                        </form>

                        <p class="text-center login-link">
                            Sudah punya akun? <a href="/login">Login</a>
                        </p>
                    </div>
                </div>
                <p class="text-center text-muted mt-3">PT WongTux © {{ date('Y') }}</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const toggleIcon = this;
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>