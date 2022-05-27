<?php
    require_once "conexion.php";
    class Pacientedao {

        private $paciente;

        public function __construct()
        {

        }

        public function ConectarDB(){
            $this->conexion = conectar();
            if($this->conexion == NULL){
                die('conexion fallida: ');
            }
        }

        public function Logear($info_usuario){
            $username = $info_usuario[0];
            $password = $info_usuario[1];
            if(!empty($username) || !empty($password)) {
                $this->ConectarDB();
                $query = $this->conexion->prepare("SELECT usuario_paciente,contraseña_paciente FROM paciente WHERE usuario_paciente=:username AND contraseña_paciente=:password ");
                $query->bindParam(':username', $username);
                $query->bindParam(':password', $password);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                if($query->rowCount() >= 1){
                    $_SESSION['paciente'] = $result["usuario_paciente"];
                    $_SESSION['time_start_login'] = time();
                    print "<script> window.location= 'InicioP.php'; </script> ";
                }else{
                    echo "<script> window.onload = function (){
                      MensajeError('Usuario o Contraseña Incorrectos')  
                      }</script>";
                }
            }else{
                echo "<script> window.onload = function (){
                      MensajeError('Campos Vacios')  
                      }</script>";
            }
        }

        public function Registrar($informacion){
            $username= $informacion[0];
            $clave = $informacion[1];
            $nombre = $informacion[2];
            $email = $informacion[3];
            $telefono = $informacion[4];
            $sexo = $informacion[5];
            $identificacion = $informacion[6];
            $fechaN = $informacion[7];

            $this->ConectarDB();
            $query = $this->conexion->prepare("INSERT INTO paciente(usuario_paciente,contraseña_paciente,nombre_completo,
                     correo,telefono,genero,cedula_paciente,fecha_de_nacimiento) VALUES ('$username','$clave','$nombre','$email','$telefono',
                     '$sexo','$identificacion','$fechaN')");
            $query->execute();

        }

        public function ComprobarUsuario($usuario){
            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT * FROM paciente WHERE usuario_paciente = '$usuario'");
            $query->execute();
            if($query->rowCount() >= 1){
                return true;
            }else{
                return false;
            }
        }

        public function buscarNombre($us){
            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT nombre_completo FROM paciente WHERE usuario_paciente = '$us'");
            $query->execute();
            $mostrar = $query->fetch(PDO::FETCH_ASSOC);
            echo $mostrar['nombre_completo'];
        }

        public function mostrarPerfil($user){
            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT * FROM paciente WHERE usuario_paciente = '$user' ");
            $query->execute();
            $mostrar = $query->fetch(PDO::FETCH_ASSOC);
            if($query->rowCount() >= 1){
                return $mostrar;
            }
        }

        public function buscarPaciente($user){
            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT * FROM paciente WHERE usuario_paciente = '$user'");
            $query->execute();
            $datos = $query->fetch(PDO::FETCH_ASSOC);
            if($query->rowCount() >= 1 ){
                return $datos;
            }else{
                echo "<script> window.onload = function (){
                      MensajeError('No se encuentra el Usuario')  
                      }</script>";
            }
        }

        public function edit($us){
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $cedula = $_POST['cedula'];
            $fecha = $_POST['fecha'];

            $this->ConectarDB();
            $query = $this->conexion->prepare("UPDATE paciente SET nombre_completo = '$nombre',
            correo = '$correo', cedula_paciente = '$cedula', telefono = '$telefono', fecha_de_nacimiento = 
                '$fecha' WHERE usuario_paciente = $us");
            $query->execute();
            echo "<script>window.onload = function(){
									EditPsicologo('los datos han sido actualizados exitosamente');
					  			}
					 </script>";
        }

        public function verificandocontra($user,$clave,$claveN){

            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT usuario_paciente, contraseña_paciente FROM paciente 
                                        WHERE usuario_paciente = '$user' AND contraseña_paciente = '$clave' ");
            $query->execute();
            if($query->rowCount() >= 1){

                $query2 = $this->conexion->prepare("UPDATE paciente SET contraseña_paciente = '$claveN'
                                        WHERE usuario_paciente = '$user'AND contraseña_paciente = '$clave' ");
                $query2->execute();
                return true;

            }else{
                return false;
            }

        }

    }