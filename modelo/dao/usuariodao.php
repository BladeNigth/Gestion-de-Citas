<?php
    require_once "conexion.php";
    class Usuariodao {

        private $usuario;

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
            if(!empty($username) || !empty($password)){
                $this->ConectarDB();
                $query = $this->conexion->prepare("SELECT nombre_usuario,password,Tipo_Usuario FROM usuario WHERE nombre_usuario=:username AND password=:password ");
                $query->bindParam(':username',$username);
                $query->bindParam(':password',$password);
                $query->execute();
                $result =$query->fetch(PDO::FETCH_ASSOC);

                if($query->rowCount() >= 1){

                    if($result['Tipo_Usuario'] === "ADMINISTRADOR"){
                        session_start();
                        $_SESSION['Tipo_user'] = $result["Tipo_Usuario"];
                        $_SESSION['userA'] = $result["nombre_usuario"];
                        $_SESSION['time_start_login'] = time();
                        print "<script> window.location= 'IndexA.php'; </script> ";
                    }else{

                        $_SESSION['user'] = $result["nombre_usuario"];
                        $_SESSION['time_start_login'] = time();
                        print "<script> window.location= 'Inicio.php'; </script> ";
                    }
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

        public function buscarNombre($us){
            $this->ConectarDB();
            $query =$this->conexion->prepare("SELECT nombre_completo FROM usuario WHERE nombre_usuario = '$us'");
            $query->execute();
            $mostrar = $query->fetch(PDO::FETCH_ASSOC);
            echo $mostrar['nombre_completo'];
        }

        public function mostrarPerfilA($user){
            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT * FROM usuario WHERE nombre_usuario = '$user' ");
            $query->execute();
            $mostrar = $query->fetch(PDO::FETCH_ASSOC);
            if($query->rowCount() >= 1){
                return $mostrar;
            }
        }

        public function buscarUsuario($user){
            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT * FROM usuario WHERE nombre_usuario = '$user'");
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
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];


                $this->ConectarDB();
                $query = $this->conexion->prepare("UPDATE usuario SET nombre_completo = '$nombre',
                   correo = '$email', telefono = '$telefono' WHERE nombre_usuario = '$us'");
                $query->execute();

                if(isset($_SESSION['userA'])){
                echo "<script>window.onload = function(){
									EditA('los datos han sido actualizados exitosamente');
					  			}
					 </script>";
                }else{
                    echo "<script>window.onload = function(){
									EditPsicologo('los datos han sido actualizados exitosamente');
					  			}
					 </script>";
                }
        }

        public function verificandocontra($user,$clave,$claveN){

            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT nombre_usuario, password FROM usuario WHERE
                                                 nombre_usuario = '$user' AND password = '$clave' ");
            $query->execute();
            if($query->rowCount() >= 1){

                $query2 = $this->conexion->prepare("UPDATE usuario SET password = '$claveN' WHERE
                                nombre_usuario = '$user'and password = '$clave' ");
                $query2->execute();
                return true;

            }else{
                return false;
            }

        }

    }
