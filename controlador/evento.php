<?php
    require_once 'usuariocontroller.php';

    $usuario = new UsuarioController();

    $result = $_POST["evento"];

    switch ($result){
        case 'cambiarcontra':
        $usuario->verificarContra($_POST["user"],$_POST["contra"],$_POST["contraN"]);
        break;


    }
