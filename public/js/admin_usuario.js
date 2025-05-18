document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-usuario');
    const boton = document.getElementById('usuario_submit');

    if (!form) return;

    const campos = [
        {
            id: 'usuario_nombre',
            validar: valor => valor.trim() === '' ? 'El nombre no puede estar vacío.' : ''
        },
        {
            id: 'usuario_apellidos',
            validar: valor => valor.trim() === '' ? 'Los apellidos no pueden estar vacíos.' : ''
        },
        {
            id: 'usuario_email',
            validar: valor => {
                const emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
                if (valor.trim() === '') return 'El email no puede estar vacío.';
                if (!emailRegex.test(valor)) return 'Email inválido.';
                return '';
            }
        },
        {
            id: 'usuario_direccion',
            validar: valor => valor.trim() === '' ? 'La dirección no puede estar vacía.' : ''
        },
        {
            id: 'usuario_telefono',
            validar: valor => {
                const telRegex = /^[0-9]{9}$/;
                if (valor.trim() === '') return 'El teléfono no puede estar vacío.';
                if (!telRegex.test(valor)) return 'Debe ser un número de 9 cifras.';
                return '';
            }
        },
        {
            id: 'usuario_password',
            validar: valor => valor.trim() === '' ? 'La contraseña no puede estar vacía.' : ''
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
        } else {
            boton.disabled = true;
            boton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Creando...';
        }
    });
});
