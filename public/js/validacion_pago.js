document.addEventListener("DOMContentLoaded", function () {
    const tarjetaInput = document.getElementById("tarjeta");
    const caducidadInput = document.getElementById("caducidad");
    const cvvInput = document.getElementById("cvv");
    const form = document.getElementById("form-pago");

    const regexTarjeta = /^(?:\d{4} ?){4}$/;       
    const regexCaducidad = /^(0[1-9]|1[0-2])\/\d{2}$/; 
    const regexCVV = /^\d{3}$/;

    function validarInput(input, regex) {
        if (regex.test(input.value.trim())) {
            input.classList.remove("is-invalid");
            input.classList.add("is-valid");
            return true;
        } else {
            input.classList.remove("is-valid");
            input.classList.add("is-invalid");
            return false;
        }
    }

    tarjetaInput.addEventListener("input", () => validarInput(tarjetaInput, regexTarjeta));
    caducidadInput.addEventListener("input", () => validarInput(caducidadInput, regexCaducidad));
    cvvInput.addEventListener("input", () => validarInput(cvvInput, regexCVV));

    form.addEventListener("submit", function (e) {
        const esValido = validarInput(tarjetaInput, regexTarjeta) &&
                         validarInput(caducidadInput, regexCaducidad) &&
                         validarInput(cvvInput, regexCVV);
        if (!esValido) {
            e.preventDefault();
        }
    });
});
