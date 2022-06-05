<?php
session_start();
require '../controlador/pacientecontroller.php';
$paciente = new PacienteController();

if($paciente->Logeado()){
    $paciente->DatosRegistro();
}else{
    print "<script> window.location= 'iniciop.php'; </script> ";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Gestion De Citas PAP</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="css/local.css">
    <link rel="stylesheet" href="css/sweetalert.css">

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

     ===============================================================================================-->
</head>
<body>

<div class="limiter" > </div>


<div class="container-login100" style="background-image: url('images/Fondo.jpg');" >

    <div class="wrap-login100">


            <span class="login100-form-title p-b-34 p-t-27">
						Crear Usuario

            </span>
        <form  method="post" enctype="multipart/form-data">
            <div class="wrap-input100 validate-input" data-validate = "Enter username">

                    <input class="input100" type="text" name="username" placeholder="Usuario" required>

                <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Enter password">

                    <input class="input100" type="password" name="pass" placeholder="Contraseña" required>

                <span class="focus-input100" data-placeholder="&#xf191;"></span>
            </div>


            <div class="wrap-input100 validate-input" data-validate="Enter Nombre">

                    <input class="input100" type="text" name="nombre" placeholder="Nombres" required>

                <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Enter correo">

                    <input class="input100" type="email" name="email" placeholder="Correo" required>

                <span class="focus-input100" data-placeholder="&#xf15a;"></span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Enter Telefono">

                    <input class="input100" type="number" name="telefono" placeholder="Telefono" required>

                <span class="focus-input100" data-placeholder="&#xf2be;"></span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Enter Identificacion">

                    <input class="input100" type="number" name="identificacion" placeholder="Identificacion" required>

                <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>
            <div class="form-group col-6">
                <label for="frist_name">Fecha de Nacimiento</label>
                <input class="form-control" type="date" id="fechaN" name="Fecha" required>
            </div>
            <div class="form-group col-6">
                <label class="label" for="frist_name" >Sexo</label>

                    <select class="form-control" name="sexo" required>
                        <option value="M" select >Masculino</option>
                        <option value="F">Femenino</option>
                    </select>

            </div>


            <div class="container-login100-form-btn">
                <button class="login100-form-btn" name = "registro"  type="submit" value="send">
                    Crear
                </button>
            </div>
        </form>
        <div class="text-center p-t-90">
            <a class="txt1" href="login.php">
               Iniciar Sesion
            </a>
        </div>
        <div class="text-center p-t-90">
            <a class="txt1" href="">
                Recordar Contraseña
            </a>
        </div>


    </div>

</div>




<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>
<!--===============================================================================================-->
<script src="js/sweetalert2@8.js"></script>
<!--===============================================================================================-->
<script src="js/Operaciones.js"></script>
<!--
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
-->



</body>
</html>
