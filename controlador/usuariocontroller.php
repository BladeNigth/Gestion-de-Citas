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
            if(!isset($_SESSION['userA']) )
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

        public function DatosRegistro(){

            if(isset($_POST['registro'])){
                if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['nombre']) &&
                    isset($_POST['pass']) && isset($_POST['telefono'])
                    && isset($_POST['sexo']) && isset($_POST['turno']))
                {
                    $info_usuario = [];
                    array_push($info_usuario,$_POST['username']);
                    array_push($info_usuario,$_POST['pass']);
                    array_push($info_usuario,$_POST['nombre']);
                    array_push($info_usuario,$_POST['email']);
                    array_push($info_usuario,$_POST['telefono']);
                    array_push($info_usuario,$_POST['sexo']);
                    array_push($info_usuario,$_POST['turno']);

                    if($this->usuariodao->ComprobarUsuario($info_usuario[0])) {
                        echo "<script> window.onload = function (){
                      MensajeError('El usuario Ya Existe')  
                      }</script>";
                    }else{
                        $this->usuariodao->Registrar($info_usuario);
                        echo "<script> window.onload = function (){
                      MensajeCorrecto('El Usuario ha sido Registrado'); 
                      }</script>";
                    }


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

        public function verpacienteaEditar($user){

            $datos = $this->usuariodao->buscarPaciente($user);
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
						<input class="form-control" type="number" name="telefono" placeholder="Telefono"
						value="'.$datos['telefono'].'">
					</div>
					<div class="form-group col-6">
                      		<label for="frist_name">Cedula</label>
						<input class="form-control" type="number" name="cedula" placeholder="Cedula"
						value="'.$datos['cedula_paciente'].'">
					</div>
					<div class="form-group col-6">
                      		<label for="frist_name">Fecha de Nacimiento</label>
						<input class="form-control" type="date" name="fecha" placeholder="Fecha de Nacimiento"
						value="'.$datos['fecha_de_nacimiento'].'">
					</div>
					<input style="visibility: hidden" name="editar" value = "'.$user.'">';
        }

        public function editar($user){

            if(isset($_POST['edita'])) {
                $this->usuariodao->edit($user);
            }
        }

        public function editapaciente($user){
            if(isset($_POST['edita'])){
                $this->usuariodao->editPaciente($user);
            }
        }

        public function edita($user){
            if(isset($_POST['edita'])){
                $this->usuariodao->editPsicolog($user);
            }
        }



        public function verificarContra($usuario, $clave,$claveN){

            if($this->usuariodao->Verificandocontra($usuario,$clave,$claveN)){
                echo 'correcto';
            }else{
                echo 'incorrecto';
            }

        }

        public function MostrarUsuarios(){

           $this->usuariodao->hayUsuarios();

        }

        public function MostrarPacientes(){

            $this->usuariodao->hayPacientes();

        }

        public function mostrarCPsicologo($user){

            $this->usuariodao->HaycitasPsicologo($user);

        }

        public function HistocitasPsico($user){

            $this->usuariodao->hayhistocitasPsico($user);

        }

        public function vercitas (){

            $this->usuariodao->hayCitas();

        }

        public function cancelarCita($idcita){

           $this->usuariodao->cancelarc($idcita);


        }

    }
