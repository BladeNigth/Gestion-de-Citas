<?php
session_start();
if(!isset($_SESSION['userA'])){
    if(!isset($_SESSION['user'])){
        if(!isset($_SESSION['paciente'])){

        }else{
            print "<script> window.location= 'Iniciop.php'; </script> ";
        }
    }else{
        print "<script> window.location= 'Inicio.php'; </script> ";
    }
}else{
    print "<script> window.location= 'IndexA.php'; </script> ";
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
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/sweetalert.css">
    <!--===============================================================================================-->
</head>
<body style="background-color: #f5f1ee">
    <div id="division">
    <div id="fondo" style="background-image: url('images/Fondo1.png')"></div>
    </div>
    <footer id="footer-index">
        <form>
            <div class="botones">
                <a href="login.php" class="paciente" id="Paciente" >
                    <i class="ion ion-android-exit"> </i> Paciente
                </a>
                <a href="loginpsicologo.php" class="paciente"  id="Psicologo" >
                    <i class="ion ion-android-exit"> </i> Psicologo
                </a>
            </div>
        </form>
    </footer>
</body>
</html>