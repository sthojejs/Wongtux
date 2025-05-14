<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventaris WongTux</title>
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
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 6px;
            padding: 10px 30px 10px 10px;
        }
        .form-control:focus {
            border-color: #4a90e2;
            box-shadow: none;
        }
        .form-label {
            font-size: 0.9rem;
            color: #555;
        }
        .btn-primary {
            background-color: #4a90e2;
            border: none;
            border-radius: 6px;
            padding: 10px;
            font-weight: 500;
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
            top: 73%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            font-size: 0.8rem;
        }
        .alert {
            border-radius: 6px;
            font-size: 0.9rem;
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
                    <h4 class="card-title">Login</h4>

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="/login" id="loginForm">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required autofocus placeholder="Masukkan email">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3 password-container">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required placeholder="Masukkan kata sandi">
                            <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    <div class="mb-3">
                        <label for="captcha" class="form-label">Captcha</label>
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ captcha_src('flat') }}" alt="captcha" id="captchaImage">
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="reloadCaptcha">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                        <input type="text" name="captcha" class="form-control mt-2" required>
                        @error('captcha')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                    </form>

                    <p class="text-center mt-3 mb-0">
                        Belum punya akun? <a href="/register">Daftar di sini</a>
                    </p>
                </div>
            </div>
            <p class="text-center text-muted mt-3">PT WongTux © {{ date('Y') }}</p>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
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

    document.getElementById('reloadCaptcha').addEventListener('click', function () {
        fetch('/captcha/refresh')
            .then(res => res.json())
            .then(data => {
                document.getElementById('captchaImage').src = data.captcha;
            });
    });
</script>
</body>
</html>
