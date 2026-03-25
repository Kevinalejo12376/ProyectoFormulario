<?php

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

// PASSWORD 
if($password == ""){
    $errores["password"] = "*Obligatorio";
} else {

    $faltantes = [];

    // Mayúscula
    if(!preg_match("/[A-Z]/", $password)){
        $faltantes[] = "una mayúscula";
    }

    // Número
    if(!preg_match("/[0-9]/", $password)){
        $faltantes[] = "un número";
    }

    // Carácter especial
    if(!preg_match("/[\W]/", $password)){
        $faltantes[] = "un carácter especial (@, #, $, %)";
    }

    // Longitud mínima
    if(strlen($password) < 8){
        $faltantes[] = "mínimo 8 caracteres";
    }

    // Si falta algo → mensaje dinámico
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

// SI HAY ERRORES
if(!empty($errores)){
    $query = http_build_query([
        "errores" => $errores,
        "datos" => $datos
    ]);
    header("Location: index.php?$query");
    exit();
}

// TODO CORRECTO
header("Location: index.php?mensaje=Usuario registrado correctamente&tipo=exito");
exit();

}
?>