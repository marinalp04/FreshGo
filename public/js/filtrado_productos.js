document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('buscador-productos');
            const contenedor = document.getElementById('contenedor-productos');

            input.addEventListener('input', function () {
                const termino = input.value.trim().toLowerCase();
                const productos = contenedor.querySelectorAll('.producto-item');

                let encontrados = 0;

                productos.forEach(producto => {
                    const nombre = producto.textContent.trim().toLowerCase();

                    if (nombre.includes(termino)) {
                        producto.classList.remove('d-none');
                        encontrados++;
                    } else {
                        producto.classList.add('d-none');
                    }
                });

                // (Opcional) mostrar mensaje si no se encuentra nada
                const sinResultados = document.getElementById('sin-resultados');
                if (sinResultados) {
                    sinResultados.style.display = encontrados === 0 ? 'block' : 'none';
                }
            });
        });