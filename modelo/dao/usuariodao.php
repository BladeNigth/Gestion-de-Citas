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

        public function ComprobarUsuario($user){
            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT * FROM usuario WHERE nombre_usuario = '$user'");
            $query->execute();
            if($query->rowCount() >= 1){
                return true;
            }else{
                return false;
            }
        }

        public function Registrar($informacion){
            $username = $informacion[0];
            $clave = $informacion[1];
            $nombre = $informacion[2];
            $email = $informacion[3];
            $telefono = $informacion[4];
            $sexo = $informacion[5];
            $turno = $informacion[6];

            $this->ConectarDB();
            $query = $this->conexion->prepare("INSERT INTO usuario(nombre_usuario,password,nombre_completo,
                     correo,telefono,genero,turno_idturno,Tipo_Usuario)
                    VALUES ('$username','$clave','$nombre','$email','$telefono',
                     '$sexo','$turno','PRACTICANTE')");
            $query->execute();

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

        public function buscarPaciente($user){
            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT * FROM paciente WHERE usuario_paciente = '$user'");
            $query->execute();
            $datos = $query->fetch(PDO::FETCH_ASSOC);
            if($query->rowCount() >= 1 ){
                return $datos;
            }else{
                echo "<script> window.onload = function (){
                      MensajeError('No se encuentra el paciente')  
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

        public function editPsicolog($user){
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];


            $this->ConectarDB();
            $query = $this->conexion->prepare("UPDATE usuario SET nombre_completo = '$nombre',
                   correo = '$email', telefono = '$telefono' WHERE nombre_usuario = '$user'");
            $query->execute();
            echo "<script>window.onload = function(){
									EditarUA('los datos han sido actualizados exitosamente');
					  			}
					 </script>";


        }

        public function editPaciente($user){

            $nombre = $_POST['nombre'];
            $correo = $_POST['email'];
            $telefono = $_POST['telefono'];
            $cedula = $_POST['cedula'];
            $fecha = $_POST['fecha'];


            $this->ConectarDB();
            $query = $this->conexion->prepare("UPDATE paciente SET nombre_completo = '$nombre',
            correo = '$correo', cedula_paciente = '$cedula', telefono = '$telefono', fecha_de_nacimiento =
                '$fecha' WHERE usuario_paciente = '$user'");
            $query->execute();
            echo "<script>window.onload = function(){
									EditarPacienteA('los datos han sido actualizados exitosamente');
					  			}
					 </script>";
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

        public function hayUsuarios(){

            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT * FROM usuario WHERE Tipo_Usuario != 'ADMINISTRADOR' ");
            $query->execute();

            if($query->rowCount() >= 1 ){

                while ($datosUsuarios = $query->fetch(PDO::FETCH_ASSOC)){

                    echo '<div class="lista" ><tr>';
                    echo '<td>'.$datosUsuarios['idusuario'].'</td>';
                    echo '<td>'.$datosUsuarios['nombre_usuario'].'</td>';
                    echo '<td>'.$datosUsuarios['nombre_completo'].'</td>';
                    if($datosUsuarios['turno_idturno'] == '1') {
                        echo '<td> Mañana </td>';
                    }else if($datosUsuarios['turno_idturno'] == '2'){
                        echo '<td> Tarde </td>';
                    }else if($datosUsuarios['turno_idturno'] == '3'){
                        echo '<td> Completo </td>';
                    }
                    echo '<td align="center">';
                    echo '<form action="EditarUsuarioA.php" method="post"><button name="editar"  value="'.$datosUsuarios['nombre_usuario'].'"><i class="ion ion-android-create"></i></button></form>';
                    echo '<button name="eliminar"  onclick=eliminarU("'.$datosUsuarios['nombre_usuario'].'")><i class="ion ion-android-delete"></i></button>';
                    echo '</td>';
                    echo '</tr></div>';
                }

            }else{
                echo '<tr>No hay Practicantes Registrados</tr>';
            }

        }

        public function hayPacientes(){
            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT * FROM paciente");
            $query->execute();

            if($query->rowCount() >= 1 ){

                while ($datosUsuarios = $query->fetch(PDO::FETCH_ASSOC)){

                    echo '<div class="lista" ><tr>';
                    echo '<td>'.$datosUsuarios['idpaciente'].'</td>';
                    echo '<td>'.$datosUsuarios['usuario_paciente'].'</td>';
                    echo '<td>'.$datosUsuarios['nombre_completo'].'</td>';
                    echo '<td>'.$datosUsuarios['cedula_paciente'].'</td>';
                    echo '<td>'.$datosUsuarios['correo'].'</td>';
                    echo '<td>'.$datosUsuarios['nombre_completo'].'</td>';
                    echo '<td align="center">';
                    echo '<form action="EditarPacienteA.php" method="post"><button name="editar"  value="'.$datosUsuarios['usuario_paciente'].'"><i class="ion ion-android-create"></i></button></form>';
                    echo '<button name="eliminar"  onclick=eliminarPaciente("'.$datosUsuarios['usuario_paciente'].'")><i class="ion ion-android-delete"></i></button>';
                    echo '</td>';
                    echo '</tr></div>';
                }

            }else{
                echo '<tr>No hay Pacientes Registrados</tr>';
            }
        }
        public function EliminarUsuario($user){

            $this->ConectarDB();
            $query = $this->conexion->prepare("DELETE FROM usuario WHERE nombre_usuario = '$user'");
            $query->execute();
        }
        public function EliminarPaciente($user){

            $this->ConectarDB();
            $query = $this->conexion->prepare("DELETE FROM paciente WHERE usuario_paciente = '$user'");
            $query->execute();
        }

    }
