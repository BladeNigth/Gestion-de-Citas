<?php
session_start();
require_once '../controlador/pacientecontroller.php';
$paciente = new PacienteController();
if (!$paciente->Logeado()){
    $paciente->cerrarSesion('cerrarSesion');
   // $paciente->reagendarCita();
}else{
    print "<script> window.location= 'login.php'; </script> ";
}

$perf = "";
$perf = $_SESSION['paciente'];

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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
                        <a href="PerfilPaciente.php" class="dropdown-item has-icon">
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
                    <a href="iniciop.php">Gestion De Citas</a>
                </div>
                <div class="sidebar-user">
                    <div class="sidebar-user-picture">
                        <?php

                        ?>
                    </div>
                    <div class="sidebar-user-details">
                        <div class="user-name"> <?php
                            $paciente->mostrarNombre($perf);
                            ?></div>
                        <div class="user-role">
                            PACIENTE
                        </div>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header">Principal</li>
                    <li class="active">
                        <a href="iniciop.php"><i class="ion ion-home"></i><span>Mis Citas</span></a>
                    </li>

                    <li class="menu-header">Opciones</li>
                    <li>
                        <a href="PedirCita.php" ><i class="ion ion-ios-albums-outline"></i><span>Pedir Citas</span></a>
                    </li>
                    <li>
                        <a href="HcitasPaciente.php" ><i class="ion ion-ios-albums-outline"></i><span>Historial de citas</span></a>
                    </li>

                </ul>

            </aside>
        </div>
        <div class="main-content" >
            <section class="section">
                <h1 class="section-header">
                    <div>Agendar Cita</div>
                </h1>
                <div class="row">

                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="card card-primary">
                            <div class="card-header"><h4>Agendando Cita</h4></div>

                            <div class="card-body">
                              <!--  <form method="POST">-->

                                    <?php
                                    $paciente->Rdatoscita($_POST['reagendar']);
                                    echo '<input id="fechacorrecta" name = "fh" type="hidden" > ';
                                    echo '<input id="Tipo" name = "re" type="hidden" value="'.$_POST['reagendar'].'" > ';
                                    ?>

                                    <div class="form-group col-6">
                                        <label for="frist_name" style="color: #574B90">Seleccionar Fecha</label>
                                        <input type="text" class="form-control" name="calendario" />
                                    </div>
                                    <div id="respuesta"></div>


                                    <!-- <div class="form-group">-->
                                    <button  onclick=reagendar()  name = "reagen" class="btn btn-primary btn-block">
                                        Reagendar
                                    </button>
                                    <!--
                                    <button  type="submit" value="send" name = "reagen" class="btn btn-primary btn-block">
                                        Reagendar
                                    </button>-->
                                    <!-- </div>-->
                                <!--</form>-->
                            </div>
                            <div class="text-center dropdown-item has-icon">
                                <a class="txt1" href="iniciop.php">
                                    Cancelar
                                </a>
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

<!--<script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script  src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    $(function() {
        const fecha = new Date();
        $('input[name="calendario"]').daterangepicker({
            "singleDatePicker": true,
            "autoApply": true,
            "startDate": fecha,
            "minDate": fecha,

        }, function(start, end, label) {
            //console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            document.getElementById("fechacorrecta").value = start.format('YYYY/MM/DD');
            var evento = "evento=cargarhorarios&fecha="+start.format('YYYY/MM/DD')+"&user="+document.getElementById("Psico").value;
            $.ajax({
                url: '../controlador/evento.php',
                type: 'post',
                data: evento,
                datatype: "html",
                success: function (response){
                    $('#respuesta').html(response).fadeIn();
                }
            });
        });
    });


</script>


</body>
</html>