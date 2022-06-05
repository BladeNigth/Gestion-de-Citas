<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/SMTP.php';


class EnviarCorreos {
    private $mail;
    private $email = 'gestioncitaspap@gmail.com';
    private $name = 'Administracion Gestion de citas PAP';
    public function __construct()
    {
       $this->mail = new PHPMailer(true);
    }

    public function credenciales(){

        $this->mail->SMTPOptions= array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $this->mail->SMTPDebug = 0;
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'gestioncitaspap@gmail.com';
        $this->mail->Password = 'administrador';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
    }

    public function pacientecreado($correo,$usuario,$nombre){

        try {
            $this->credenciales();
            $this->mail->setFrom($this->email, $this->name);
            $this->mail->addAddress($correo,$nombre);
            $this->mail->isHTML(true);
            $this->mail->Subject = "Paciente Registrado";
            $mensaje = "<h1 style='color:#3498db'> Hola!  $nombre </h1>";
            $mensaje .= "<p>su usuario ha sido creado Correctamente:</p>";
            $mensaje .= "<p>Su usuario: $usuario</p>";
            $mensaje .= "<p> Lo estaremos esperando en nuestra Pagina Web: </p>";
            $mensaje .= "<p> Un saludo </p>";
            $mensaje .= " <p> Administracion de citas PAP</p> ";
            $this->mail->Body = $mensaje;
            $this->mail->send();
        } catch (Exception $e) {
            echo 'Mensaje '.$this->mail->ErrorInfo;
        }

    }

    public function recuperarcontraseña($correo,$usuario,$password,$nombre){

        try {
            $this->credenciales();
            $this->mail->setFrom($this->email, $this->name);
            $this->mail->addAddress($correo,$nombre);
            $this->mail->isHTML(true);
            $this->mail->Subject = "Recuperar Datos de Acceso ";
            $mensaje = "<h1 style='color:#3498db'> Hola!  $nombre </h1>";
            $mensaje .= "<p>sus datos de acceso son: </p>";
            $mensaje .= "<p>Su usuario: $usuario</p>";
            $mensaje .= "<p> Su contraseña es: $password</p><br>";
            $mensaje .= "<p> Un saludo </p>";
            $mensaje .= " <p> Administracion de citas PAP</p> ";
            $this->mail->Body = $mensaje;
            $this->mail->send();
        } catch (Exception $e) {
            echo 'Mensaje '.$this->mail->ErrorInfo;
        }

    }

    public function citaregistrada($correo,$nombre,$tipo,$psicologo,$fecha,$hora,$asunto){
        try {
            $this->credenciales();
            $this->mail->setFrom($this->email, $this->name);
            $this->mail->addAddress($correo,$nombre);
            $this->mail->isHTML(true);
            $this->mail->Subject = "Cita Registrada";
            $mensaje = "<h1 style='color:#3498db'> Hola!  $nombre </h1>";
            $mensaje .= "<p>Su cita ha sigo registrada: </p>";
            $mensaje .= "<p>Tipo de cita: $tipo</p>";
            $mensaje .= "<p>su cita es con el Psicologo/a: $psicologo </p><br>";
            $mensaje .= "<p> Fecha y hora de la cita : $fecha $hora</p>";
            $mensaje .= "<p> Asunto: $asunto</p><br>";
            $mensaje .= "<p> Por favor no olvide acudir a su cita </p>";
            $mensaje .= " <p>..Lo estamos esperando..</p> ";
            $mensaje .= " <p> Administracion de citas PAP</p> ";
            $this->mail->Body = $mensaje;
            $this->mail->send();
        } catch (Exception $e) {
            echo 'Mensaje '.$this->mail->ErrorInfo;
        }
    }

    public function citacancelada($correo,$nombre,$psicologo,$fecha,$hora){
        try {
            $this->credenciales();
            $this->mail->setFrom($this->email, $this->name);
            $this->mail->addAddress($correo,$nombre);
            $this->mail->isHTML(true);
            $this->mail->Subject = "Cita Cancelada";
            $mensaje = "<h1 style='color:#3498db'> Hola!  $nombre </h1>";
            $mensaje .= "<p>La cita para el:  $fecha $hora</p>";
            $mensaje .= "<p>con el Psicologo/a: $psicologo </p><br>";
            $mensaje .= "<p>ha sido cancelada </p>";
            $mensaje .= " <p> Administracion de citas PAP</p> ";
            $this->mail->Body = $mensaje;
            $this->mail->send();
        } catch (Exception $e) {
            echo 'Mensaje '.$this->mail->ErrorInfo;
        }
    }


}