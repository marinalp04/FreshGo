<?php
/** @var string $last_username */
/** @var \Symfony\Component\Security\Core\Exception\AuthenticationException|null $error */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="/css/style.css"> 
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>

        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error->getMessage()); ?></p>
        <?php endif; ?>

        <form method="post">
            <label for="username">Usuario:</label>
            <input type="text" name="_username" id="username" value="<?php echo htmlspecialchars($lastUsername); ?>" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="_password" id="password" required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
