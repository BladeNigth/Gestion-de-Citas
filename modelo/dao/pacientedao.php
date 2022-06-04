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
                     correo,telefono,genero,cedula_paciente,fecha_de_nacimiento)
                    VALUES ('$username','$clave','$nombre','$email','$telefono',
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
            $correo = $_POST['email'];
            $telefono = $_POST['telefono'];
            $cedula = $_POST['cedula'];
            $fecha = $_POST['fecha'];

            $this->ConectarDB();
            $query = $this->conexion->prepare("UPDATE paciente SET nombre_completo = '$nombre',
            correo = '$correo', cedula_paciente = '$cedula', telefono = '$telefono', fecha_de_nacimiento = 
                '$fecha' WHERE usuario_paciente = '$us'");
            $query->execute();
            echo "<script>window.onload = function(){
									EditPaciente('los datos han sido actualizados exitosamente');
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

        public function hayCitas($user){

            $this->ConectarDB();
            $query = $this->conexion->prepare(
                "SELECT u.nombre_completo as nombre,c.tipo_cita as servicio,c.fecha_cita as fecha,c.hora_cita as hora,
                    c.idcita as cita
                    FROM cita c inner join paciente p on c.paciente_idpaciente = p.idpaciente
                    inner join usuario u on c.usuario_idusuario = u.idusuario 
                    inner join estado e on c.estado_idestado = e.idestado 
                    where p.usuario_paciente = '$user' and e.nombre_estado = 'POR ATENDER'");
            $query->execute();
            if($query->rowCount() >= "1"){

                while ($datosUsuarios = $query->fetch(PDO::FETCH_ASSOC)){

                    echo '<div class="lista" ><tr>';
                    echo '<td>'.$datosUsuarios['nombre'].'</td>';
                    echo '<td>'.$datosUsuarios['servicio'].'</td>';
                    echo '<td>'.$datosUsuarios['fecha'].'</td>';
                    echo '<td>'.$datosUsuarios['hora'].'</td>';
                    echo '<td align="center"><form method="post"><button id="reagendar" name="reagendar" class="btn btn-default" value="'.$datosUsuarios['cita'].'"><em class="dropdown-item has-icon" >Reagendar</em></button></form></td>';
                    echo '<td align="center"><button onclick=cancelarcitapaciente("'.$datosUsuarios['cita'].'") id="cancelar" name="cancelar" class="btn btn-default" ><em class="dropdown-item has-icon" >Cancelar</em></button></td>';
                    echo '</tr></div>';

                }

            }else{
                echo '<tr>No tienes Citas por atender</tr>';
            }




        }

        public function hayhistocitas($user){
            $this->ConectarDB();
            $query = $this->conexion->prepare(
                "SELECT u.nombre_completo as nombre,c.tipo_cita as servicio,c.fecha_cita as fecha,c.hora_cita as hora,
                    c.idcita as cita, e.nombre_estado as estado
                    FROM cita c inner join paciente p on c.paciente_idpaciente = p.idpaciente
                    inner join usuario u on c.usuario_idusuario = u.idusuario 
                    inner join estado e on c.estado_idestado = e.idestado 
                    where p.usuario_paciente = '$user' and e.nombre_estado != 'POR ATENDER'");
            $query->execute();
            if($query->rowCount() >= "1"){
                while ($datosUsuarios = $query->fetch(PDO::FETCH_ASSOC)){

                    echo '<div class="lista" ><tr>';
                    echo '<td>'.$datosUsuarios['nombre'].'</td>';
                    echo '<td>'.$datosUsuarios['servicio'].'</td>';
                    echo '<td>'.$datosUsuarios['fecha'].'</td>';
                    echo '<td>'.$datosUsuarios['hora'].'</td>';
                    echo '<td>'.$datosUsuarios['estado'].'</td>';
                    if($datosUsuarios['estado'] === "ATENDIDA" ) {
                        echo '<td align="center"><form action="tramite.php" method="post"><button id="reagendar" name="reseña" class="btn btn-default" value="' . $datosUsuarios['cita'] . '"><em class="dropdown-item has-icon" >Reseña</em></button></form></td>';
                    }else{
                        echo '<td></td>';
                    }
                    //onclick=cancelarCita("'.$datosUsuarios['cita'].'")
                    echo '</tr></div>';

                }
            }else{
                echo '<tr>No hay Historial de citas</tr>';
            }
        }

        public function buscarPsicologos(){

            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT nombre_completo as nombre FROM usuario WHERE Tipo_Usuario = 'PRACTICANTE' ");
            $query->execute();
            $info_usuario = [];
            while ($Usuarios = $query->fetch(PDO::FETCH_ASSOC)){
                array_push($info_usuario,$Usuarios['nombre']);
            }
            return $info_usuario;

        }

        public function buscarhorarios($fecha,$user){

            $this->ConectarDB();
            $query = $this->conexion->prepare("select U.nombre_usuario as usuario,FH.fecha,t.nombre as turno,H.horario,EH.estado_horariocol, COUNT(t.nombre) as cont
                                        from usuario U inner join turno t on U.turno_idturno = t.idturno
                                        inner join fecha_horario FH on U.idusuario = FH.usuario_idusuario 
                                        inner join usuario_has_horario US on FH.id_fecha = US.fecha_horario_id_fecha
                                        inner join horarios H on US.horarios_idhorarios = H.idhorarios 
                                        inner join  estado_horario EH on US.estado_horario_id_estado = EH.id_estado
                                        where FH.fecha = '$fecha' and U.nombre_completo = '$user'");
            $query->execute();
            if($query->rowCount() >= 1){
                $comprobarH = $query->fetch(PDO::FETCH_ASSOC);
                if($comprobarH['cont'] !== 0) {
                    if ($comprobarH['cont'] === 3 and $comprobarH['turno'] === "tarde") {
                        $query1 = $this->conexion->prepare("select H.horario as horario from usuario U 
                                                    inner join turno t on U.turno_idturno = t.idturno 
                                                    inner join fecha_horario FH on U.idusuario = FH.usuario_idusuario 
                                                    inner join usuario_has_horario US on FH.id_fecha = US.fecha_horario_id_fecha
                                                    inner join horarios H on US.horarios_idhorarios = H.idhorarios 
                                                    inner join estado_horario EH on US.estado_horario_id_estado = EH.id_estado 
                                                    WHERE U.nombre_completo = '$user' and FH.fecha = '$fecha' and EH.id_estado = 1");
                        $query1->execute();
                        if ($query1->rowCount() >= 1) {
                            $dispohorarios = [];
                            while ($horarios = $query1->fetch(PDO::FETCH_ASSOC)) {
                                array_push($dispohorarios, $horarios['horario']);
                            }
                            return $dispohorarios;
                        } else {
                            echo 'no hay horarios disponibles para este dia';
                        }
                    } else if ($comprobarH['cont'] === 3 and $comprobarH['turno'] === "mañana") {
                        $query1 = $this->conexion->prepare("select H.horario as horario from usuario U 
                                                    inner join turno t on U.turno_idturno = t.idturno 
                                                    inner join fecha_horario FH on U.idusuario = FH.usuario_idusuario 
                                                    inner join usuario_has_horario US on FH.id_fecha = US.fecha_horario_id_fecha
                                                    inner join horarios H on US.horarios_idhorarios = H.idhorarios 
                                                    inner join estado_horario EH on US.estado_horario_id_estado = EH.id_estado 
                                                    WHERE U.nombre_completo = '$user' and FH.fecha = '$fecha' and EH.id_estado = 1");
                        $query1->execute();
                        if ($query1->rowCount() >= 1) {
                            $dispohorarios = [];
                            while ($horarios = $query1->fetch(PDO::FETCH_ASSOC)) {
                                array_push($dispohorarios, $horarios['horario']);
                            }
                            return $dispohorarios;
                        } else {
                            echo 'no hay horarios disponibles para este dia';
                        }
                    } else if ($comprobarH['cont'] === 6 and $comprobarH['turno'] === "completo") {
                        $query1 = $this->conexion->prepare("select H.horario as horario from usuario U 
                                                    inner join turno t on U.turno_idturno = t.idturno 
                                                    inner join fecha_horario FH on U.idusuario = FH.usuario_idusuario 
                                                    inner join usuario_has_horario US on FH.id_fecha = US.fecha_horario_id_fecha
                                                    inner join horarios H on US.horarios_idhorarios = H.idhorarios 
                                                    inner join estado_horario EH on US.estado_horario_id_estado = EH.id_estado 
                                                    WHERE U.nombre_completo = '$user' and FH.fecha = '$fecha' and EH.id_estado = 1");
                        $query1->execute();
                        if ($query1->rowCount() >= 1) {
                            $dispohorarios = [];
                            while ($horarios = $query1->fetch(PDO::FETCH_ASSOC)) {
                                array_push($dispohorarios, $horarios['horario']);
                            }
                            return $dispohorarios;
                        } else {
                            echo 'no hay horarios disponibles para este dia';
                        }
                    } else {
                        //aqui toca crear horarios para ese dia en especifico
                    }
                }else{
                    return "crearhorario";
                }
            }
        }

        public function crearHorarios($fecha,$user){
            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT idusuario as id,turno_idturno as turno FROM usuario WHERE nombre_completo = '$user'");
            $query->execute();
            $id = $query->fetch(PDO::FETCH_ASSOC);
            $us = $id['id'];
            $t = $id['turno'];
            if($t === 1) {

                $query = $this->conexion->prepare("INSERT INTO fecha_horario(fecha,usuario_idusuario) VALUES ('$fecha','$us')");
                $query->execute();

                $query = $this->conexion->prepare("select id_fecha  from fecha_horario where fecha = '$fecha' and usuario_idusuario = '$us' ");
                $query->execute();
                $idf = $query->fetch(PDO::FETCH_ASSOC);
                $fid = $idf['id_fecha'];
                $query = $this->conexion->prepare("INSERT INTO usuario_has_horario(horarios_idhorarios,
                                            fecha_horario_id_fecha,estado_horario_id_estado) values (1,'$fid',1), (2,'$fid',1), (3,'$fid',1)");
                $query->execute();
            }else if($t === 2){

                $query = $this->conexion->prepare("INSERT INTO fecha_horario(fecha,usuario_idusuario) VALUES ('$fecha','$us')");
                $query->execute();

                $query = $this->conexion->prepare("select id_fecha  from fecha_horario where fecha = '$fecha' and usuario_idusuario = '$us' ");
                $query->execute();
                $idf = $query->fetch(PDO::FETCH_ASSOC);
                $fid = $idf['id_fecha'];
                $query = $this->conexion->prepare("INSERT INTO usuario_has_horario(horarios_idhorarios,
                                            fecha_horario_id_fecha,estado_horario_id_estado) values (4,'$fid',1), (5,'$fid',1), (6,'$fid',1)");
                $query->execute();
            }else if($t === 3) {
                $query = $this->conexion->prepare("INSERT INTO fecha_horario(fecha,usuario_idusuario) VALUES ('$fecha','$us')");
                $query->execute();

                $query = $this->conexion->prepare("select id_fecha  from fecha_horario where fecha = '$fecha' and usuario_idusuario = '$us' ");
                $query->execute();
                $idf = $query->fetch(PDO::FETCH_ASSOC);
                $fid = $idf['id_fecha'];
                echo $fid;
                $query = $this->conexion->prepare("INSERT INTO usuario_has_horario(horarios_idhorarios, fecha_horario_id_fecha, estado_horario_id_estado)
                    VALUES (7,'$fid',1) , (8,'$fid',1) , (9,'$fid',1)
                                            , (10,'$fid',1) , (11,'$fid',1) , (12,'$fid',1) ");
                $query->execute();
            }
        }

        public function saberids($psico,$paciente){

            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT idpaciente from paciente where usuario_paciente ='$paciente'");
            $query->execute();
            $result = [];
            $id = $query->fetch(PDO::FETCH_ASSOC);
            array_push($result,$id['idpaciente']);
            $query = $this->conexion->prepare("SELECT idusuario FROM usuario WHERE nombre_completo = '$psico'");
            $query->execute();
            $id = $query->fetch(PDO::FETCH_ASSOC);
            array_push($result, $id['idusuario']);
            return $result;


        }
        public function agendar($descripcion,$tipo,$paciente,$fecha,$horario,$psico,$est){
            $this->ConectarDB();

            $query = $this->conexion->prepare("INSERT INTO cita(descripcion,tipo_cita,paciente_idpaciente,fecha_cita,hora_cita,
                                                usuario_idusuario,estado_idestado) VALUES('$descripcion','$tipo','$paciente','$fecha','$horario','$psico','$est')");
            $query->execute();
            $query = $this->conexion->prepare("select H.idhorarios as idh,FH.id_fecha as idf from usuario U inner join turno t on U.turno_idturno = t.idturno 
                                            inner join fecha_horario FH on U.idusuario = FH.usuario_idusuario 
                                            inner join usuario_has_horario US on FH.id_fecha = US.fecha_horario_id_fecha
                                            inner join horarios H on US.horarios_idhorarios = H.idhorarios 
                                            inner join estado_horario EH on US.estado_horario_id_estado = EH.id_estado 
                                            where U.idusuario = '$psico' and FH.fecha = '$fecha' and H.horario = '$horario'");
            $query->execute();
            $result = [];
            while ($horarios = $query->fetch(PDO::FETCH_ASSOC)){
                array_push($result,$horarios['idh']);
                array_push($result,$horarios['idf']);
            }
            $query = $this->conexion->prepare("UPDATE usuario_has_horario SET estado_horario_id_estado = 2 WHERE 
                                                            horarios_idhorarios = '$result[0]' and fecha_horario_id_fecha = '$result[1]'");
            $query->execute();

            echo "<script>window.onload = function(){
									Agendar('La cita ha sido agendada exitosamente');
					  			}
					 </script>";

        }

        public function cancelarcPaciente($idc){

            $this->ConectarDB();
            $query = $this->conexion->prepare("SELECT u.nombre_usuario as nu,u.idusuario as id,
                                            p.usuario_paciente as up, c.fecha_cita as fh , hora_cita as hc, 
                                            turno_idturno as t
                                            FROM cita c inner join usuario u on c.usuario_idusuario = 
                                            u.idusuario inner join paciente p on c.paciente_idpaciente =
                                            p.idpaciente WHERE idcita ='$idc' ");
            $query->execute();

            $datos = $query->fetch(PDO::FETCH_ASSOC);

            $t = $datos['t'];
            $hora = $datos['hc'];
            $fecha = $datos['fh'];
            $u = $datos['id'];
            $query2 = $this->conexion->prepare("SELECT id_fecha FROM fecha_horario WHERE fecha = '$fecha' and
                                         usuario_idusuario = '$u' ");
            $query2->execute();
            $idfecha = $query2->fetch(PDO::FETCH_ASSOC);
            $idf = $idfecha['id_fecha'];
            $query = $this->conexion->prepare("SELECT idhorarios FROM horarios WHERE horario = '$hora' 
                                                    and turno_idturno = '$t' ");
            $query->execute();
            $idh = $query->fetch(PDO::FETCH_ASSOC);
            $idhora = $idh['idhorarios'];

            $query2 = $this->conexion->prepare("UPDATE usuario_has_horario SET estado_horario_id_estado = 1
                                        WHERE fecha_horario_id_fecha = '$idf' and horarios_idhorarios = '$idhora' ");
            $query2->execute();

            $consulta = $this->conexion->prepare("UPDATE cita SET estado_idestado = 3 WHERE idcita = '$idc' ");
            $consulta->execute();
            echo "cita Cancelada";
        }



    }