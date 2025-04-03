<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
</head>
<body>
    <h1>Bienvenido a Fresh&Go</h1>
    <p>Tu plataforma de comida saludable</p>
    <a href="/login">
        <button>Iniciar Sesión</button>
    </a>

    <h2>Categorías</h2>
    <ul>
        <?php foreach ($categorias as $categoria): ?>
            <li>
                <a href="categoria.php?id=<?= $categoria['id'] ?>">
                    <?= htmlspecialchars($categoria['nombre']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
