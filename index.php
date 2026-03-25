<?php
session_start();
// session_destroy();

$mensaje = $_SESSION["mensaje"] ?? "";
$tipo = $_SESSION["tipo"] ?? "";
$errores = $_SESSION["errores"] ?? [];
$datos = $_SESSION["datos"] ?? [];
$usuario = $_SESSION["usuario"] ?? null;


// LIMPIAR SESIÓN (IMPORTANTE)
unset($_SESSION["mensaje"], $_SESSION["tipo"], $_SESSION["errores"], $_SESSION["datos"]);
?>


<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title>Registro</title>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<!-- BOTÓN ARRIBA DERECHA -->
<form action="logout.php" method="POST" class="cerrar-superior">
    <button type="submit">Cerrar sesión</button>
</form>

<div class="contenedor">

    <!-- FORMULARIO -->
    <div class="formulario">

    <?php
    if($mensaje != ""){
        if($tipo == "errores"){
            echo "<div class='alerta'>";
            echo "<div class='errores'>$mensaje</div>";
            echo "</div>";
        } else {
            echo "<div class='alerta exito'>$mensaje</div>";
        }
    }
    ?>

    <div class="icono">
        <i class="fa-solid fa-user"></i>
    </div>

    <h2>REGISTRO</h2>

    <form method="POST" action="recibe.php">

    <!-- NOMBRE -->
    <input type="text" name="nombre" placeholder="Nombre completo"
    value="<?php echo $datos['nombre'] ?? ''; ?>"
    class="<?php echo isset($errores['nombre']) ? 'input-error' : ''; ?>">
    <div class="error-text"><?php echo $errores["nombre"] ?? ""; ?></div>

    <!-- EMAIL -->
    <input type="text" name="email" placeholder="Email"
    value="<?php echo $datos['email'] ?? ''; ?>"
    class="<?php echo isset($errores['email']) ? 'input-error' : ''; ?>">
    <div class="error-text"><?php echo $errores["email"] ?? ""; ?></div>

    <!-- PASSWORDS EN FILA -->
    <div class="fila-password">

        <div class="campo">
            <input type="password" name="password" placeholder="Contraseña"
            class="<?php echo isset($errores['password']) ? 'input-error' : ''; ?>">
            <div class="error-text"><?php echo $errores["password"] ?? ""; ?></div>
        </div>

        <div class="campo">
            <input type="password" name="confirmar" placeholder="Confirmar contraseña"
            class="<?php echo isset($errores['confirmar']) ? 'input-error' : ''; ?>">
            <div class="error-text"><?php echo $errores["confirmar"] ?? ""; ?></div>
        </div>

    </div>

    <button type="submit">Registrarse</button>

    </form>

    <p class="login">
    ¿Ya tienes cuenta? <a href="#">Iniciar sesión</a>
    </p>

    </div>

    <!-- IMAGEN DERECHA -->
    <div class="imagen-derecha">
        <img src="ilustracion.png" alt="Ilustración">
    </div>

</div>

</body>
</html>