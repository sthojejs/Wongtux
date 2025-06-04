<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventaris WongTux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/variables.css') }}" rel="stylesheet">

</head>
<body>
<div class="login-container">
    <div class="card">
        <div class="card-header">
            <div class="brand-logo floating">WongTux</div>
            <div class="card-subtitle mt-2">Inventory Management System</div>
        </div>
        <div class="card-body">
            <h2 class="text-center mb-4">Welcome Back</h2>
            <p class="text-center text-muted mb-4">Please login to access your account</p>

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="/login" id="loginForm">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" id="email" class="form-control" required autofocus placeholder="your@email.com">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" id="password" class="form-control" required placeholder="••••••••">
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="checkbox-container">
                        <div class="custom-checkbox" id="rememberCheckbox"></div>
                        <span>Remember me</span>
                        <input type="checkbox" id="rememberMe" name="remember" style="display: none;">
                    </div>
                </div>

                <button type="submit" class="btn btn-login btn-primary w-100 mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </button>

                <p class="text-center mt-4 mb-0">
                    Don't have an account? <a href="/register" class="register-link">Sign up</a>
                </p>
            </form>
        </div>
    </div>
    <p class="footer-text">PT WongTux © {{ date('Y') }}. All rights reserved.</p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/login.js') }}"></script>

</body>
</html>