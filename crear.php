<?php

include("conexion.php");
include("funciones.php");

if ($_POST["operacion"] == "Crear") {
    $imagen = '';
    if ($_FILES["imagen_usuario"]["name"] != '') {
        $imagen = subir_imagen();
    }
    $stmt = $conexion->prepare("INSERT INTO usuarios(nombre, apellidos, imagen, telefono, correo)VALUES(:nombre, :apellidos, :imagen, :telefono, :correo)");

    $resultado = $stmt->execute(
        array(
            ':nombre'    => $_POST["nombre"],
            ':apellidos'    => $_POST["apellidos"],
            ':telefono'    => $_POST["telefono"],
            ':correo'    => $_POST["email"],
            ':imagen'    => $imagen
        )
    );
  
    if (!empty($resultado)) {
        echo 'Registro creado';
    }
}
if ($_POST["operacion"] == "Editar") {
    $imagen = '';
    if ($_FILES["imagen_usuario"]["name"] != '') {
        $imagen = subir_imagen();
    }else{
        $imagen = $_POST["imagen_usuario_oculta"];
    }
    $id_usuario = (int)$_POST["id_usuario"];

    $stmt = $conexion->prepare("UPDATE usuarios SET nombre=:nombre, apellidos=:apellidos, imagen=:imagen,   telefono=:telefono, correo=:correo WHERE id =:id ");

    $resultado = $stmt->execute(
        array(
            ':nombre'    => $_POST["nombre"],
            ':apellidos' => $_POST["apellidos"],
            ':telefono'  => $_POST["telefono"],
            ':correo'    => $_POST["email"],
            ':imagen'    => $imagen,
            ':id'        => $id_usuario
        )
    );
    if (!empty($resultado)) {
        echo 'Registro actualizado';
    }
    
}   