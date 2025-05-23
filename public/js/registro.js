document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-registro');
    const boton = document.getElementById('registration_submit');

    //Validaciones en tiempo real
    const campos = [
        {
            id: 'registration_nombre',
            validar: function (valor) {
                if (valor.trim() === '') return 'El nombre no puede estar vacío.';
                return '';
            }
        },
        {
            id: 'registration_apellidos',
            validar: function (valor) {
                if (valor.trim() === '') return 'Los apellidos no pueden estar vacíos.';
                return '';
            }
        },
        {
            id: 'registration_email',
            validar: function (valor) {
                const emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
                if (valor.trim() === '') return 'El email no puede estar vacío.';
                if (!emailRegex.test(valor)) return 'Email inválido.';
                return '';
            }
        },
        {
            id: 'registration_direccion',
            validar: function (valor) {
                if (valor.trim() === '') return 'La dirección no puede estar vacía.';
                return '';
            }
        },
        {
            id: 'registration_telefono',
            validar: function (valor) {
                const telRegex = /^[0-9]{9}$/;
                if (valor.trim() === '') return 'El teléfono no puede estar vacío.';
                if (!telRegex.test(valor)) return 'Debe ser un número de 9 cifras.';
                return '';
            }
        },
        {
            id: 'registration_password',
            validar: function (valor) {
                if (valor.trim() === '') return 'La contraseña no puede estar vacía.';
                return '';
            }
        },
        {
            id: 'registration_confirmPassword',
            validar: function (valor) {
                const password = document.getElementById('registration_password').value;
                if (valor.trim() === '') return 'La confirmación de contraseña no puede estar vacía.';
                if (valor !== password) return 'Las contraseñas no coinciden.';
                return '';
            }
        }
    ];

    campos.forEach(campo => {
        const input = document.getElementById(campo.id);
        const errorDiv = document.getElementById(`error-${campo.id}`);

        if (input && errorDiv) {
            input.addEventListener('input', () => {
                const mensaje = campo.validar(input.value);
                errorDiv.textContent = mensaje;
            });
        }
    });

    //Validación al enviar el formulario
    form.addEventListener('submit', function (e) {
        let esValido = true;

        campos.forEach(campo => {
            const input = document.getElementById(campo.id);
            const errorDiv = document.getElementById(`error-${campo.id}`);
            const mensaje = campo.validar(input.value);

            if (mensaje) {
                errorDiv.textContent = mensaje;
                esValido = false;
            } else {
                errorDiv.textContent = '';
            }
        });

        if (!esValido) {
            e.preventDefault();
            alert('Corrige los errores antes de enviar el formulario.');
        }else {
            //Para desactivar el boton de submit y mostrar el spinner
            boton.disabled = true;
            boton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Registrando...';
        }
    });

    // Mostrar/Ocultar contraseña
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const targetSelector = this.getAttribute('data-target');
            const passwordInput = document.querySelector(targetSelector);
            const icon = this.querySelector('i');

            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';

            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });
    });

    //Para la fuerza de la contraseña
    const passwordInput = document.getElementById('registration_password');
    const strengthDiv = document.getElementById('password-strength');

    if (passwordInput && strengthDiv) {
        passwordInput.addEventListener('input', function () {
            const strength = getPasswordStrength(passwordInput.value);
            strengthDiv.textContent = strength.message;
            strengthDiv.className = `mt-1 small text-${strength.color}`;
        });
    }

    function getPasswordStrength(password) {
        let score = 0;
        if (password.length >= 8) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[a-z]/.test(password)) score++;
        if (/\d/.test(password)) score++;
        if (/[@$!%*?&#]/.test(password)) score++;

        if (score <= 2) {
            return { message: 'Débil', color: 'danger' };
        } else if (score <= 4) {
            return { message: 'Media', color: 'warning' };
        } else {
            return { message: 'Fuerte', color: 'success' };
        }
    }



});

