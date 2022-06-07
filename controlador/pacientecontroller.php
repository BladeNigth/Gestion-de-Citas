<?php

    require_once "../modelo/dao/conexion.php";
    require_once "../modelo/entidad/paciente.php";
    require_once "../modelo/dao/pacientedao.php";
    require_once "phpmailer.php";
    class PacienteController {
        private $paciente;
        private $pacientedao;
        private $enviarcorreos;
        public function __construct()
        {
            $this->pacientedao = new Pacientedao();
            $this->enviarcorreos = new EnviarCorreos();
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

        public function DatosRegistro(){
            if(isset($_POST['registro'])){

                if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['nombre']) &&
                    isset($_POST['pass']) && isset($_POST['telefono']) && isset($_POST['identificacion'])
                    && isset($_POST['sexo']) && isset($_POST['Fecha']))
                {

                    $info_usuario = [];
                    array_push($info_usuario,$_POST['username']);
                    array_push($info_usuario,$_POST['pass']);
                    array_push($info_usuario,$_POST['nombre']);
                    array_push($info_usuario,$_POST['email']);
                    array_push($info_usuario,$_POST['telefono']);
                    array_push($info_usuario,$_POST['sexo']);
                    array_push($info_usuario,$_POST['identificacion']);
                    array_push($info_usuario,$_POST['Fecha']);
                    if($this->pacientedao->ComprobarUsuario($info_usuario[0])){
                        echo "<script> window.onload = function (){
                      MensajeError('El usuario Ya Existe')  
                      }</script>";
                    }else{
                        $this->pacientedao->Registrar($info_usuario);
                        $this->enviarcorreos->pacientecreado($info_usuario[3],$info_usuario[0],$info_usuario[2]);
                        echo "<script> window.onload = function (){
                      MensajeCorrecto('El Usuario ha sido Registrado'); 
                      }</script>";
                    }
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
            $datos = $this->pacientedao->buscarPaciente($uss);
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
					<input style="visibility: hidden" name="editar" value = "'.$uss.'">';
        }

        public function editar($uss){
            if(isset($_POST['edita'])){
                $this->pacientedao->edit($uss);
            }
        }

        public function verificarContra($usuario, $clave,$claveN){

            if($this->pacientedao->Verificandocontra($usuario,$clave,$claveN)){
                echo 'correcto';
            }else{
                echo 'incorrecto';
            }

        }

        public function mostrarmisCitas($user){

            $this->pacientedao->hayCitas($user);

        }

        public function histocitas($user){
            $this->pacientedao->hayhistocitas($user);
        }

        public function mostrarPsicologos(){

            $usuarios = $this->pacientedao->buscarPsicologos();
            $cont = sizeof($usuarios);
            $sum = 0;

            echo '<option> - Seleccionar Psicologo - </option>';
            while($sum < $cont){
                echo '<option value="'.$usuarios[$sum].'"> '.$usuarios[$sum].' </option>';
                $sum = $sum + 1 ;
            }
            echo ' </select>';
        }

        public function mostrarhorarios($fecha,$user){

            $horarios = $this->pacientedao->buscarhorarios($fecha,$user);
            if(isset($horarios)) {

                if($horarios === "crearhorario"){
                    $this->pacientedao->crearHorarios($fecha,$user);
                    $horarios = $this->pacientedao->buscarhorarios($fecha,$user);
                    $cont = sizeof($horarios);
                    $sum = 0;
                    echo '<div class="form-group col-6">
                      		<label for="frist_name" style="color: #574B90">Horarios Disponibles</label>
						<select class="form-control" id="horario" name="horario" required>';
                    echo '<option> - Seleccionar Horario - </option>';
                    while ($sum < $cont) {
                        echo '<option value="' . $horarios[$sum] . '"> ' . $horarios[$sum] . ' </option>';
                        $sum = $sum + 1;
                    }
                    echo '</div>';
                }else {
                    $cont = sizeof($horarios);
                    $sum = 0;
                    echo '<div class="form-group col-6">
                      		<label for="frist_name" style="color: #574B90">Horarios Disponibles</label>
						<select class="form-control" id="horario" name="horario" required>';
                    echo '<option> - Seleccionar Horario - </option>';
                    while ($sum < $cont) {
                        echo '<option value="' . $horarios[$sum] . '"> ' . $horarios[$sum] . ' </option>';
                        $sum = $sum + 1;
                    }
                    echo '</div>';
                }
            }else{

               // $this->pacientedao->crearHorarios($fecha,$user);
            }

        }

        public function agendarCita(){

            if(isset($_POST['agendar'])) {
                $descripcion = $_POST['descripcion'];
                $tipo = $_POST['tipo'];
                $psicologo = $_POST['psico'];
                $fecha = $_POST['fh'];
                $horario = $_POST['horario'];
                $paciente = $_SESSION['paciente'];
                $est = 1;
                $ids = $this->pacientedao->saberids($psicologo,$paciente);
                $correo = $this->pacientedao->buscarcorreo($paciente);
                $this->enviarcorreos->citaregistrada($correo[0],$correo[1],$tipo,$psicologo,$fecha,$horario,$descripcion);
                $psicologo = $ids[1];
                $paciente = $ids[0];
                $this->pacientedao->agendar($descripcion,$tipo,$paciente,$fecha,$horario,$psicologo,$est);


            }

        }

        public function cancelarCitapaciente($idcita){


            $this->pacientedao->cancelarcPaciente($idcita);

        }

        public function Rdatoscita($id){

            $datos = $this->pacientedao->recuperar($id);

            echo '<input id="Tipo" name = "tipo" type="hidden" value="'.$datos['tc'].'" > ';
            echo '<input id="Psico" name = "psico" type="hidden" value="'.$datos['nc'].'" > ';
            echo '<input id="idcitas" name = "psico" type="hidden" value="'.$id.'" > ';


        }

        public function reagendarCita(){

            if(isset($_POST['reagen'])){
                $psicologo = $_POST['psico'];
                $fecha = $_POST['fh'];
                $horario = $_POST['horario'];
                $id = $_POST['re'];
                $this->pacientedao->reagendar($id,$fecha,$horario,$psicologo);
                echo "<script> window.onload = function (){
                     confirmacionreagendar('La cita ha sido reagendada ');
                      }</script>";
            }
        }

        public function ajaxreagendar($psicologo,$fecha,$horario,$id){
            $this->pacientedao->reagendar($id,$fecha,$horario,$psicologo);
        }

    }