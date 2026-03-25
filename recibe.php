<?php
session_start();
require_once "conexiones.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$nombre = $_POST["nombre"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirmar = $_POST["confirmar"];

$errores = [];
$datos = [];

// NOMBRE
if($nombre == ""){
    $errores["nombre"] = "*Obligatorio";
} else {
    $datos["nombre"] = $nombre;
}

// EMAIL
if($email == ""){
    $errores["email"] = "*Obligatorio";
} else if(!preg_match("/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/", $email)){
    $errores["email"] = "*Debe tener un @ válido";
} else {
    $datos["email"] = $email;
}

// PASSWORD DINÁMICO
if($password == ""){
    $errores["password"] = "*Obligatorio";
} else {

    $faltantes = [];

    if(!preg_match("/[A-Z]/", $password)){
        $faltantes[] = "una mayúscula";
    }

    if(!preg_match("/[0-9]/", $password)){
        $faltantes[] = "un número";
    }

    if(!preg_match("/[\W]/", $password)){
        $faltantes[] = "un carácter especial (@, #, $, %)";
    }

    if(strlen($password) < 8){
        $faltantes[] = "mínimo 8 caracteres";
    }

    if(!empty($faltantes)){
        $errores["password"] = "*Debe tener: " . implode(", ", $faltantes);
    }
}

// CONFIRMAR
if($confirmar == ""){
    $errores["confirmar"] = "*Obligatorio";
} else if($password != $confirmar){
    $errores["confirmar"] = "*Las contraseñas no coinciden";
}

// GUARDAR EN SESIÓN
$_SESSION["errores"] = $errores;
$_SESSION["datos"] = $datos;

// SI HAY ERRORES
if(!empty($errores)){
    header("Location: index.php");
    exit();
}

// GUARDAR USUARIO (SIMULADO)
$_SESSION["usuario"] = [
    "nombre" => $nombre,
    "email" => $email,
    "password" => $password
];

$_SESSION["mensaje"] = "Usuario registrado correctamente";
$_SESSION["tipo"] = "exito";

header("Location: conexiones.php");
exit();

}
?>