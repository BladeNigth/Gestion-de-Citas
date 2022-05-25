<?php

    require_once "../modelo/dao/conexion.php";
    require_once "../modelo/entidad/paciente.php";
    require_once "../modelo/dao/pacientedao.php";

    class PacienteController {
        private $paciente;
        private $pacientedao;
        public function __construct()
        {
            $this->pacientedao = new Pacientedao();
        }

        public function Logeado(){
            if(!isset($_SESSION['paciente']) )
                return true;
            return false;
        }

        public function DatosLogin(){

            if(isset($_POST['login'])){
                if(isset($_POST['username']) && isset($_POST['pass'])){
                    $info_usuario = [];
                    array_push($info_usuario,$_POST['username']);
                    array_push($info_usuario,$_POST['pass']);
                    $this->IniciarSesion($info_usuario);
                }
            }
        }

        public function IniciarSesion($info_usuario){
            $this->pacientedao->Logear($info_usuario);

        }

        public function cerrarSesion($nombreBoton){
            if(isset($_POST[$nombreBoton])){
                //remove all session variables
                session_unset();
                //destroy session
                session_destroy();
                print "<script> window.location= 'login.php'; </script> ";
            }
        }

        public function mostrarNombre($uss){
            $this->pacientedao->buscarNombre($uss);
        }

        public function mostrarPerfil($uss){
            $mostrar = $this->pacientedao->mostrarPerfil($uss);
            echo '<strong> Usuario: </strong>'.$mostrar['usuario_paciente'].'<br>';
            echo '<strong> Nombre: </strong>'.$mostrar['nombre_completo'].'<br>';
            echo '<strong> Correo: </strong>'.$mostrar['correo'].'<br>';
            echo '<strong> Telefono: </strong>'.$mostrar['telefono'].'<br>';
            echo '<strong>Cedula: </strong>'.$mostrar['cedula_paciente'].'<br>';
            echo '<strong>Fecha de Nacimiento: </strong>'.$mostrar['fecha_de_nacimiento'].'<br>';
            if($mostrar['genero'] === "m" ){
                echo '<strong> Genero: </strong>Masculino<br>';
            }else{
                echo '<strong> Genero: </strong>Femenino<br>';
            }
            echo '<strong> Fecha de Creacion: </strong>'.$mostrar['fecha_de_creacion'].'<br>';
        }

        public function verusuarioaEditar($uss){

        }

    }