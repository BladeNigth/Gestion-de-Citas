<?php

    function conectar(){

        $servidor = "localhost";
        $usuario = "root";
        $contraseña = "";
        $bd = "bdgestioncitas";
        $conexion='';

        try{
            $conexion = new PDO("mysql:host=$servidor;dbname=$bd;",$usuario,$contraseña);
            $conexion->exec("set names utf8");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        }catch(PDOException $e){
            return NULL;
        }
    }

?>