document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-login');
    const boton = document.getElementById('login_submit');

    //Para desactivar el boton de submit y mostrar el spinner
    if (form && boton) {
        form.addEventListener('submit', function () {
            boton.disabled = true;
            boton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Entrando...';
        });
    }

    //Para mostrar/ocultar la contraseña
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('inputPassword');
    const icon = document.getElementById('iconPassword');

    togglePassword.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    });
});
