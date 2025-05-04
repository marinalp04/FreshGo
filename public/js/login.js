document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-login');
    const boton = document.getElementById('login_submit');

    if (form && boton) {
        form.addEventListener('submit', function () {
            boton.disabled = true;
            boton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Entrando...';
        });
    }
});
