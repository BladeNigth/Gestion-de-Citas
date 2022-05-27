<?php
    require_once 'usuariocontroller.php';
    require_once 'pacientecontroller.php';
    $usuario = new UsuarioController();
    $paciente = new PacienteController();

    $result = $_POST["evento"];

    switch ($result){

        case 'cambiarcontra':
            $usuario->verificarContra($_POST["user"],$_POST["contra"],$_POST["contraN"]);
            break;
        case 'cambiarcontraP':
            $paciente->verificarContra($_POST["user"],$_POST["contra"],$_POST["contraN"]);
            break;

    }
