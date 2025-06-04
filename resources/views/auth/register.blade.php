<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Inventaris WongTux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <link href="{{ asset('css/variables.css') }}" rel="stylesheet">
    
</head>
<body>
<div class="register-container">
    <div class="card">
        <div class="card-header">
            <div class="brand-logo floating">WongTux</div>
            <div class="card-subtitle mt-2">Inventory Management System</div>
        </div>
        <div class="card-body">
            <h2 class="text-center mb-4">Create Account</h2>
            <p class="text-center text-muted mb-4">Fill in your details to register</p>

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="/register" id="registerForm">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Full Name</label>
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="name" id="name" class="form-control" required
                           value="{{ old('name') }}" placeholder="John Doe">
                    @error('name')
                        <small class="text-danger error-message">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" id="email" class="form-control" required
                           value="{{ old('email') }}" placeholder="your@email.com">
                    @error('email')
                        <small class="text-danger error-message">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" id="password" class="form-control" required
                           placeholder="••••••••">
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                    @error('password')
                        <small class="text-danger error-message">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required
                           placeholder="••••••••">
                    <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
                </div>

                <div class="form-group">
                    <label for="role" class="form-label">Role</label>
                    <i class="fas fa-user-tag input-icon"></i>
                    <select name="role" id="role" class="form-select" required>
                        <option value="" {{ old('role') == '' ? 'selected' : '' }}>-- Select Role --</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="staf" {{ old('role') == 'staf' ? 'selected' : '' }}>Staff</option>
                    </select>
                    @error('role')
                        <small class="text-danger error-message">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="checkbox-container d-flex align-items-center gap-2">
                        <div class="custom-checkbox" id="termsCheckbox"></div>
                        <label for="terms" class="mb-0">
                            I agree to the 
                            <a href="{{ route('terms') }}" style="color: var(--primary-color);" target="_blank">
                                Terms & Conditions
                            </a>
                        </label>
                        <input type="checkbox" id="terms" name="terms" style="display: none;" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-register btn-primary w-100 mb-3">
                    <i class="fas fa-user-plus me-2"></i>Register
                </button>

                <p class="text-center mt-4 mb-0">
                    Already have an account? <a href="/login" class="login-link">Login</a>
                </p>
            </form>
        </div>
    </div>
    <p class="footer-text">PT WongTux © {{ date('Y') }}. All rights reserved.</p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('js/register.js') }}"></script>

</body>
</html>