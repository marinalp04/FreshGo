document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-registro');

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
            id: 'registration_contrasena',
            validar: function (valor) {
                if (valor.trim() === '') return 'La contraseña no puede estar vacía.';
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
        }
    });
});

