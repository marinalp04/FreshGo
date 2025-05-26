document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('buscador-categorias');
        const contenedor = document.getElementById('contenedor-categorias');

        input.addEventListener('input', function () {
            const termino = input.value.trim().toLowerCase();
            const categorias = contenedor.querySelectorAll('.categoria-item'); 

            categorias.forEach(categoria => {
                const nombre = categoria.textContent.trim().toLowerCase();
                categoria.style.display = nombre.includes(termino) ? 'block' : 'none';
            });
        });
    });