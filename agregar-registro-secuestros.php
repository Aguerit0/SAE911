<?php
// // LLAMANDO A LA BASE DE DATOS
//   include('conexion.php');
//   session_start();
//    // PREGUNTA SI HAY UN USUARIO REGISTRADO
//   if(!isset($_SESSION['usuario'])){
//   header('Location: index.php');
//   }

//   //INICIALIZAMOS DATOS
//   $idUsuario = $_SESSION['id'];
//   // $idComisaria=1;
//   if (isset($_POST['agregar'])) {
//     $txtFecha = $_POST['txtFecha'];
//     $txtComisaria = $_POST['txtComisaria'];
//     $txtTurno = $_POST['txtTurno'];
//     $txtSuperiorTurno = $_POST['txtSuperiorTurno'];
//     $txtOficialServicio = $_POST['txtOficialServicio'];
//     $txtCantPersonalGuardia = $_POST['txtCantPersonalGuardia'];
//     $txtMotoristas = $_POST['txtMotoristas'];
//     $txtMovilesFuncionamiento = $_POST['txtMovilesFuncionamiento'];
//     $txtMovilesFueraFuncionamiento = $_POST['txtMovilesFueraFuncionamiento'];
//     $txtCantDetenidosCausaFederal = $_POST['txtCantDetenidosCausaFederal'];
//     $txtCantDetenidosJusticiaOrdinaria = $_POST['txtCantDetenidosJusticiaOrdinaria'];
//     $txtArrestadisAveriguacionHecho = $_POST['txtArrestadisAveriguacionHecho'];
//     $txtArrestadosAveriguacionActividades = $_POST['txtArrestadosAveriguacionActividades'];
//     $txtArrestadosInfCodigoFaltas = $_POST['txtArrestadosInfCodigoFaltas'];
//     $txtDemorados = $_POST['txtDemorados'];
//     $txtCantAprehendidos = $_POST['txtCantAprehendidos'];




//     //CONSULTA INSERTAR DATOS
//     $insertar = "INSERT INTO novedades_de_guardia (idUsuario, idComisaria, fecha, turno, superior_de_turno, oficial_servicio, personas_de_guardia, motoristas, mov_funcionamiento, mov_fuera_de_servicio, detenidos_causa_federal, detenidos_justicia_ordinaria, arres_averiguacion_de_hecho, aprehendidos, arres_averiguacion_actividades, arres_info_codigo_de_faltas, demorados) VALUES ('$idUsuario','$txtComisaria','$txtFecha','$txtTurno','$txtSuperiorTurno','$txtOficialServicio','$txtCantPersonalGuardia','$txtMotoristas','$txtMovilesFuncionamiento','$txtMovilesFueraFuncionamiento','$txtCantDetenidosCausaFederal','$txtCantDetenidosJusticiaOrdinaria','$txtArrestadisAveriguacionHecho','$txtCantAprehendidos','$txtArrestadosAveriguacionActividades','$txtArrestadosInfCodigoFaltas','$txtDemorados')";

//     //EJECUTAR CONSULTA INSERTAR DATOS
//     $ejecutarInsertar=mysqli_query($conexion,$insertar);
//     if(!$ejecutarInsertar){
//       echo "<script>alert('ERROR AL INGRESAR DATOS');</script>";
//     }
//     else{
//       header('location:novedades-tabla.php?mensaje=agregado');
//     }
//   }
//   mysqli_close($conexion);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SAE 911</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <br>
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Css Reloj -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="clockpicker.css">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
  <?php include("./template/dashboard.php")?>

<!-- ======= Sidebar ======= -->
<?php  if($_SESSION['rol'] == 1){
    include ("./template/admin.php");
  }else{
    include ("./template/usuario.php");
  }
?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Formulario Registro de Secuestros</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Formulario Registro de Secuestros</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
         



                <!-- FORMULARIO PARA AGREGAR REGISTRO DE SECUESTROS -->

                <form class="row g-3 pt-3 needs-validation" method="POST" action="registrar_log.php">

                    <div class="col-md-6">
                        <label for="inputEmail5" class="form-label">Fecha </label>
                        <div class="col-sm-10">
                            <input required type="date" id="txtFechaReg" name="txtFechaReg" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="inputEmail5" class="form-label">Hora</label>
                        <input type="text" id="txtHora" name="txtHora" class="form-control clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                    </div>



                    <div class="col-md-6">
                        <label for="yourName" class="form-label">Hecho</label>
                        <input type="text" name="hecho" class="form-control" id="hecho" required>
                        <div class="invalid-feedback">¡Por favor, escriba el hecho!
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="yourName" class="form-label">Elemento secuestrado</label>
                        <input type="text" name="elementoSecuestrado" class="form-control" id="elementoSecuestrado" required>
                        <div class="invalid-feedback">¡Por favor, escriba el elemeto secuestrado!
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="BtnAgregar" class="btn btn-primary float-end">Agregar</button>
                    </div>

                </form><!-- End Multi Columns Form -->

            </div>
        </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.min.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

     <!-- Script de reloj -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="clockpicker.js"></script>
  <script type="text/javascript">$('.clockpicker').clockpicker();</script>


</body>

</html>