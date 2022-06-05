<?php
session_start();

require '../controlador/usuariocontroller.php';
$usuario = new UsuarioController();
if(!$usuario->Logeado()){
    $usuario->cerrarSesion('cerrarSesion');
}else{
    print "<script> window.location= 'loginpsicologo.php'; </script> ";
}

$perf = "";
$perf = $_SESSION['userA'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Inicio</title>
    <link rel="icon" type="image/png" href="images/icons/Fondo.ico"/>
    <link rel="stylesheet" href="dist/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

    <link rel="stylesheet" href="dist/modules/summernote/summernote-lite.css">
    <link rel="stylesheet" href="dist/modules/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="dist/css/demo.css">
    <link rel="stylesheet" href="dist/css/style.css">


</head>

<body>
<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="ion ion-search"></i></a></li>
                </ul>

            </form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
                        <i class="ion ion-android-person d-lg-none"></i>
                        <div class="d-sm-none d-lg-inline-block"><?php echo $perf?></div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="PerfilPsicologo.php" class="dropdown-item has-icon">
                            <i class="ion ion-android-person"></i> Perfil
                        </a>

                        <form method="post">
                            <button class="dropdown-item has-icon" name="cerrarSesion" id="cerrarSesion" type="submit" value="send" >
                                <i class="ion ion-log-out"></i> Cerrar Sesion
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="indexA.php">Gestion De Citas</a>
                </div>
                <div class="sidebar-user">
                    <div class="sidebar-user-picture">
                        <?php

                        ?>
                    </div>
                    <div class="sidebar-user-details">
                        <div class="user-name"> <?php
                            $usuario->mostrarNombre($perf);
                            ?></div>
                        <div class="user-role">
                            PRACTICANTE
                        </div>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header">Principal</li>
                    <li class="active">
                        <a href="indexA.php"><i class="ion ion-home"></i><span>Agenda de Citas</span></a>
                    </li>

                    <li class="menu-header">Opciones</li>
                    <li>
                        <a href="ListaPsicologos.php" ><i class="ion ion-ios-albums-outline"></i><span>Psicologos</span></a>
                    </li>
                    <li>
                        <a href="ListaPacientes.php" ><i class="ion ion-ios-albums-outline"></i><span>Pacientes</span></a>
                    </li>

                </ul>

            </aside>
        </div>
        <div class="main-content" >
            <section class="section">
                <h1 class="section-header">
                    <div>Editar</div>
                </h1>
                <div class="row">

                    <div  class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="card card-primary">
                            <div style="text-align: center" class="card-header"><h4>Editar</h4></div>

                            <div class="card-body">
                                <form method="POST">
                                    <?php
                                    $usuario->verpacienteaEditar($_POST['editar']);
                                    $usuario->editapaciente($_POST['editar']);
                                    ?>
                                    <!-- <div class="form-group">-->
                                    <button name = "edita"  type="submit" value="send" class="btn btn-primary btn-block">
                                        Editar
                                    </button>
                                    <!-- </div>-->
                                </form>

                                <div class=" text-center dropdown-item has-icon">
                                    <a class="txt1" href="ListaPacientes.php">
                                        Cancelar
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2022 <div class="bullet"></div> Design By <a>Andres Brieva/Leonardo Liñan/Juan Arias</a>
            </div>
            <div class="footer-right"></div>
        </footer>
    </div>
</div>

<script src="dist/modules/jquery.min.js"></script>
<script src="dist/modules/popper.js"></script>
<script src="dist/modules/tooltip.js"></script>
<script src="dist/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
<script src="dist/js/sa-functions.js"></script>

<script src="dist/modules/chart.min.js"></script>
<script src="dist/modules/summernote/summernote-lite.js"></script>
<script src="dist/js/scripts.js"></script>
<script src="js/sweetalert2@8.js"></script>
<!--=============================================================================================-->
<script src="js/Operaciones.js"></script>

</body>
</html>