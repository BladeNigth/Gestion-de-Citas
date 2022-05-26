<?php
    require_once "../modelo/dao/conexion.php";
    require_once "../modelo/entidad/usuario.php";
    require_once "../modelo/dao/usuariodao.php";

    class UsuarioController {
        private $usuario;
        private $usuariodao;

        public function __construct()
        {
            $this->usuariodao = new Usuariodao();
        }

        public function Logeado(){
            if(!isset($_SESSION['Tipo_user']) )
                return true;
            return false;
        }
        public function LogeadoPracticante(){
            if(!isset($_SESSION['user']) )
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
            $this->usuariodao->Logear($info_usuario);

        }

        public function cerrarSesion($nombreBoton){
            if(isset($_POST[$nombreBoton])){
                //remove all session variables
                session_unset();
                //destroy session
                session_destroy();
                print "<script> window.location= 'loginpsicologo.php'; </script> ";
            }
        }

        public function mostrarNombre($uss){
            $this->usuariodao->buscarNombre($uss);
        }

        public function mostrarPerfil($user){
            $mostrar = $this->usuariodao->mostrarPerfilA($user);
            echo '<strong> Usuario: </strong>'.$mostrar['nombre_usuario'].'<br>';
            echo '<strong> Nombre: </strong>'.$mostrar['nombre_completo'].'<br>';
            echo '<strong> Correo: </strong>'.$mostrar['correo'].'<br>';
            echo '<strong> Telefono: </strong>'.$mostrar['telefono'].'<br>';
            if($mostrar['genero'] === "m" ){
                echo '<strong> Genero: </strong>Masculino<br>';
            }else{
                echo '<strong> Genero: </strong>Femenino<br>';
            }
            echo '<strong> Fecha de Creacion: </strong>'.$mostrar['fecha_de_creacion'].'<br>';

        }

        public function verusuarioaEditar($user){
            $datos = $this->usuariodao->buscarUsuario($user);
            echo '<div class="form-group col-6">
                      		<label for="frist_name">Nombre y Apellidos</label>
						<input class="form-control" type="text" name="nombre" placeholder="Nombre Completo"
						value="'.$datos['nombre_completo'].'">
					</div>
					
					<div class="form-group col-6">
                      		<label for="frist_name">Correo</label>
						<input class="form-control" type="email" name="email" placeholder="Correo"
						value="'.$datos['correo'].'">
					</div>
					
					<div class="form-group col-6">
                      		<label for="frist_name">Telefono</label>
						<input class="form-control" type="text" name="telefono" placeholder="Telefono"
						value="'.$datos['telefono'].'">
					</div>

					<input style="visibility: hidden" name="editar" value = "'.$user.'">';
        }

        public function editar($user){

            if(isset($_POST['edita'])) {
                $this->usuariodao->edit($user);
            }
        }

        public function cambiarContra(){
            /*
            if(isset($_POST['ccontra'])){

                if(isset($_POST['passActual']) && isset($_POST['passNueva']) && isset($_POST['passNuevaC']) ) {

                    $passActual = $_POST['passActual'];
                    $passNueva = $_POST['passNueva'];
                    $passNuevaC = $_POST['passNuevaC'];
                    $user = $_SESSION["userA"];

                    if($this->usuariodao($passActual)){



                    }else{



                    }

                }

            }
            */

        }


        public function verificarContra($usuario, $clave,$claveN){

            if($this->usuariodao->Verificandocontra($usuario,$clave,$claveN)){
                echo 'correcto';
            }else{
                echo 'incorrecto';
            }

        }
    }
