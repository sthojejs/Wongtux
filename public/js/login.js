    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    
    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
    
   
    const inputs = document.querySelectorAll('.form-control');
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
        
        
        if (input.value) {
            formGroup.classList.add('focused');
        }
    });
    

    const rememberCheckbox = document.getElementById('rememberCheckbox');
    const rememberMe = document.getElementById('rememberMe');
    
    rememberCheckbox.addEventListener('click', () => {
        rememberCheckbox.classList.toggle('checked');
        rememberMe.checked = !rememberMe.checked;
    });
    
n
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', (e) => {
        const submitBtn = loginForm.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Logging in...';
        submitBtn.disabled = true;
    });
    

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
