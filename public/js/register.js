document.addEventListener('DOMContentLoaded', function() {
    
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    }
    
    if (toggleConfirmPassword && confirmPasswordInput) {
        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    }
    
    const inputs = document.querySelectorAll('.form-control, .form-select');
    inputs.forEach(input => {
        const formGroup = input.closest('.form-group');
        
        input.addEventListener('focus', () => {
            if (formGroup) formGroup.classList.add('focused');
        });
        
        input.addEventListener('blur', () => {
            if (formGroup && !input.value) {
                formGroup.classList.remove('focused');
            }
        });
        
        if (input.value && formGroup) {
            formGroup.classList.add('focused');
        }
    });
    
    
    const termsCheckbox = document.getElementById('termsCheckbox');
    const terms = document.getElementById('terms');
    
    if (termsCheckbox && terms) {
        termsCheckbox.addEventListener('click', () => {
            termsCheckbox.classList.toggle('checked');
            terms.checked = !terms.checked;
        });
    }
    
    
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', (e) => {
            const submitBtn = registerForm.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Registering...';
                submitBtn.disabled = true;
                
                if (terms && !terms.checked) {
                    e.preventDefault();
                    submitBtn.innerHTML = '<i class="fas fa-user-plus me-2"></i>Register';
                    submitBtn.disabled = false;
                    
                    if (termsCheckbox) {
                        termsCheckbox.style.animation = 'shake 0.5s';
                        setTimeout(() => {
                            termsCheckbox.style.animation = '';
                        }, 500);
                    }
                }
            }
        });
    }
    
    
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