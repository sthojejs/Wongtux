<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Inventaris WongTux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6c5ce7;
            --primary-hover: #5649c0;
            --secondary-color: #f8f9fa;
            --text-color: #2d3436;
            --light-text: #636e72;
            --border-radius: 14px;
            --box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #dfe6e9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        .register-container {
            max-width: 500px;
            width: 100%;
            padding: 0 20px;
            animation: fadeInUp 0.8s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            transition: var(--transition);
            transform: perspective(1000px) rotateX(0deg);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .card:hover {
            transform: perspective(1000px) rotateX(2deg) translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), #a29bfe);
            color: white;
            text-align: center;
            padding: 2rem;
            border-bottom: none;
            position: relative;
            overflow: hidden;
        }
        
        .card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
            animation: shine 8s infinite linear;
        }
        
        @keyframes shine {
            0% { transform: rotate(30deg) translate(-30%, -30%); }
            100% { transform: rotate(30deg) translate(30%, 30%); }
        }
        
        .card-title {
            font-size: 2rem;
            font-weight: 600;
            margin: 0;
            position: relative;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .card-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
            font-weight: 300;
            margin-top: 0.5rem;
        }
        
        .card-body {
            padding: 2.5rem;
        }
        
        .form-control, .form-select {
            border: 1px solid #dfe6e9;
            border-radius: 10px;
            padding: 14px 20px 14px 45px;
            height: 50px;
            transition: var(--transition);
            font-size: 0.95rem;
            background-color: rgba(245, 245, 245, 0.4);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.2);
            background-color: white;
        }
        
        .form-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 0.7rem;
            display: block;
            transform: translateY(0);
            transition: var(--transition);
        }
        
        .form-group {
            margin-bottom: 1.8rem;
            position: relative;
        }
        
        .form-group.focused .form-label {
            transform: translateY(-10px);
            font-size: 0.8rem;
            color: var(--primary-color);
        }
        
        .btn-register {
            background: linear-gradient(135deg, var(--primary-color), #a29bfe);
            border: none;
            border-radius: 10px;
            padding: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 1rem;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 92, 231, 0.4);
        }
        
        .btn-register:active {
            transform: translateY(1px);
        }
        
        .btn-register::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
            opacity: 0;
            transition: var(--transition);
        }
        
        .btn-register:hover::after {
            opacity: 1;
            animation: shine 2s infinite linear;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 70%;
            transform: translateY(-50%);
            color: var(--light-text);
            font-size: 1.1rem;
            transition: var(--transition);
            z-index: 2;
        }
        
        .form-group.focused .input-icon {
            color: var(--primary-color);
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 70%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--light-text);
            transition: var(--transition);
            z-index: 2;
        }
        
        .password-toggle:hover {
            color: var(--primary-color);
            transform: translateY(-50%) scale(1.1);
        }
        
        .alert {
            border-radius: 10px;
            font-size: 0.9rem;
            padding: 0.9rem 1.25rem;
            transition: var(--transition);
            border: none;
        }
        
        .footer-text {
            font-size: 0.85rem;
            color: var(--light-text);
            text-align: center;
            margin-top: 2rem;
            animation: fadeIn 1s ease-out 0.3s both;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .login-link {
            color: var(--primary-color);
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            position: relative;
        }
        
        .login-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: var(--transition);
        }
        
        .login-link:hover {
            color: var(--primary-hover);
        }
        
        .login-link:hover::after {
            width: 100%;
        }
        
        .brand-logo {
            font-weight: 700;
            color: white;
            font-size: 1.8rem;
            letter-spacing: 1px;
            position: relative;
            display: inline-block;
        }
        
        .brand-logo::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background: white;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.4s ease;
        }
        
        .brand-logo:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .checkbox-container {
            display: flex;
            align-items: center;
        }
        
        .custom-checkbox {
            width: 18px;
            height: 18px;
            border: 2px solid #b2bec3;
            border-radius: 4px;
            margin-right: 8px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .custom-checkbox.checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .custom-checkbox.checked::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: white;
            font-size: 10px;
        }
        
        .select-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--light-text);
            pointer-events: none;
        }
        
        @media (max-width: 576px) {
            .card-body {
                padding: 1.8rem;
            }
            
            .card-title {
                font-size: 1.6rem;
            }
            
            .card-header {
                padding: 1.5rem;
            }
        }
    </style>
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
                        <option value="staf" {{ old('role') == 'staf' ? 'selected' : '' }}>Warehouse Staff</option>
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

<script>
    // Password toggle
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    
    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
    
    toggleConfirmPassword.addEventListener('click', function () {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
    
    // Form label animation
    const inputs = document.querySelectorAll('.form-control, .form-select');
    inputs.forEach(input => {
        const formGroup = input.closest('.form-group');
        
        input.addEventListener('focus', () => {
            formGroup.classList.add('focused');
        });
        
        input.addEventListener('blur', () => {
            if (!input.value) {
                formGroup.classList.remove('focused');
            }
        });
        
        // Initialize focused state if input has value
        if (input.value) {
            formGroup.classList.add('focused');
        }
    });
    
    // Custom checkbox
    const termsCheckbox = document.getElementById('termsCheckbox');
    const terms = document.getElementById('terms');
    
    termsCheckbox.addEventListener('click', () => {
        termsCheckbox.classList.toggle('checked');
        terms.checked = !terms.checked;
    });
    
    // Form submission animation
    const registerForm = document.getElementById('registerForm');
    registerForm.addEventListener('submit', (e) => {
        const submitBtn = registerForm.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Registering...';
        submitBtn.disabled = true;
        
        if (!terms.checked) {
            e.preventDefault();
            submitBtn.innerHTML = '<i class="fas fa-user-plus me-2"></i>Register';
            submitBtn.disabled = false;
            
            // Add shake animation to terms checkbox
            termsCheckbox.style.animation = 'shake 0.5s';
            setTimeout(() => {
                termsCheckbox.style.animation = '';
            }, 500);
        }
    });
    
    // Animate elements on load
    document.addEventListener('DOMContentLoaded', () => {
        const formGroups = document.querySelectorAll('.form-group');
        formGroups.forEach((group, index) => {
            group.style.opacity = '0';
            group.style.transform = 'translateY(20px)';
            group.style.transition = `all 0.5s ease ${index * 0.1}s`;
            
            setTimeout(() => {
                group.style.opacity = '1';
                group.style.transform = 'translateY(0)';
            }, 100);
        });
    });
    
    // Add shake animation
    const style = document.createElement('style');
    style.innerHTML = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
    `;
    document.head.appendChild(style);
</script>
</body>
</html>