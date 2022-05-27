<?php
    session_start();
    require '../controlador/pacientecontroller.php';
    $paciente = new PacienteController();

    if($paciente->Logeado()){
        $paciente->DatosLogin();
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
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.minnav.css">
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
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <link rel="stylesheet" href="dist/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

    <link rel="stylesheet" href="dist/modules/summernote/summernote-lite.css">
    <link rel="stylesheet" href="dist/modules/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="dist/css/demo.css">
    <link rel="stylesheet" href="dist/css/style.css">

    <link rel="stylesheet" href="css/sweetalert.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter" > </div>

<span class="title"> Gestion De Citas PAP</span>


        <div class="container-login100" style="background-image: url('images/Fondo.jpg');" >





            <div class="wrap-login100">


            <span class="login100-form-title p-b-34 p-t-27">
						Iniciar Sesion

            </span>
                <form  method="post">
                    <div class="wrap-input100 validate-input" data-validate = "Enter username">

                            <input class="input100" type="text" name="username" placeholder="Usuario">

                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">

                            <input class="input100" type="password" name="pass" placeholder="Contraseña">

                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="login" id="login" type="submit" value="send">
                            Iniciar
                        </button>
                    </div>
                </form>
                <div class="text-center p-t-90">
                    <a class="txt1" href="crearPaciente.php">
                        Crear Usuario
                    </a>
                </div>
                <div class="text-center p-t-90">
                    <a class="txt1" href="">
                        Recordar Contraseña
                    </a>
                </div>

                <div class="text-center p-t-90">
                    <a class="txt1" href="index.php">
                        Regresar a Home
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
</body>
</html>