<?php
    require_once 'usuariocontroller.php';
    require_once 'pacientecontroller.php';
    require_once "../modelo/dao/usuariodao.php";

    $usuariodao = new Usuariodao();
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
        case 'eliminarUsuario':
            $usuariodao->EliminarUsuario($_POST["user"]);
            break;
        case 'eliminarPaciente':
            $usuariodao->EliminarPaciente($_POST["user"]);
            break;
        case 'cargarhorarios':

            $paciente->mostrarhorarios($_POST['fecha'],$_POST['user']);
            break;

    }
