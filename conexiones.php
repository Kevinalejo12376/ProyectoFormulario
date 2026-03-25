<?php
session_start(); // 🔥 Necesario para usar sesiones

// 🔹 DATOS DE CONEXIÓN
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "register2";

// 🔹 CREAR CONEXIÓN
$conn = new mysqli($host, $user, $pass, $dbname);

// 🔹 VERIFICAR CONEXIÓN
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// 🔥 SOLO ENTRA AQUÍ SI VIENEN DATOS YA VALIDADOS
if (isset($_SESSION["usuario"])) {

    // 🔹 RECIBIR DATOS DESDE LA SESIÓN
    $nombre = $_SESSION["usuario"]["nombre"];
    $email = $_SESSION["usuario"]["email"];
    $password = $_SESSION["usuario"]["password"];

    // 🔹 INSERTAR EN LA BASE DE DATOS
    $sql = "INSERT INTO usuarios (nombre, email, password) 
            VALUES ('$nombre', '$email', '$password')";

    if ($conn->query($sql)) {

        // ✅ MENSAJE DE ÉXITO
        $_SESSION["mensaje"] = "Usuario registrado correctamente";
        $_SESSION["tipo"] = "exito";

    } else {

        // ❌ MENSAJE DE ERROR
        $_SESSION["mensaje"] = "Error al registrar: El email ya existe o hubo un problema"; ;
        $_SESSION["tipo"] = "errores";
        header("Location: index.php");
        exit();
    }

    // 🧼 LIMPIAR LOS DATOS PARA QUE NO SE REPITAN
    unset($_SESSION["usuario"]);
    unset($_SESSION["datos"]);

    // 🔄 VOLVER AL FORMULARIO
    header("Location: index.php");
    exit();
}

?>