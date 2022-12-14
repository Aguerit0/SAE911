<?php 
  include 'conexion.php';
  session_start();
  // PREGUNTA SI HAY UN USUARIO REGISTRADO
  if(!isset($_SESSION['usuario'])){
    header('Location: index.php');
  }

    //SI APRETA EL BOTON AGREGAR
    if (isset($_POST['agregarComisaria'])) {
      $nombreComisaria=$_POST['nombreComisaria'];
      $direccionComisaria=$_POST['direccionComisaria'];
      $provinciaComisaria=$_POST['provinciaComisaria'];
      $departamentoComisaria=$_POST['departamentoComisaria'];
      $localidadComisaria=$_POST['localidadComisaria'];
      $telefonoComisaria=$_POST['telefonoComisaria'];
      $latitudComisaria=$_POST['latitudComisaria'];
      $longitudComisaria=$_POST['longitudComisaria'];
      $habilitadoComisaria=$_POST['habilitadoComisaria'];


      //CONSULTA INSERTAR EN SQL
      $insertarComisaria = "INSERT INTO comisarias (nombre, direccion, provincia, departamento, localidad, telefono, latitud, longitud, habilitado) VALUES ('$nombreComisaria','$direccionComisaria','$provinciaComisaria','$departamentoComisaria','$localidadComisaria','$telefonoComisaria','$latitudComisaria','$longitudComisaria','$habilitadoComisaria')";

      //EJECUTAR CONSULTA DE INSERTAR
      $ejecutarInsertarComisaria=mysqli_query($conexion,$insertarComisaria);
      if (!$ejecutarInsertarComisaria) {
        header('location:comisarias-tabla.php?mensaje=error');
      }else{
        header('location:comisarias-tabla.php?mensaje=agregado');
      }
    }




    //CONSULTA TABLAS PARA MOSTRAR DATOS DE COMISARIA
    $consultaDatosComisaria="SELECT * FROM comisarias WHERE (eliminado < 1)";
    //RESULTAOD DE LA CONSULTA
    $resultado=mysqli_query($conexion,$consultaDatosComisaria);
    if (!$resultado) {
      echo "<script>alert('ERROR AL CONSULTAR INFORMACIÓN');</script>";
      }else{
        
      }
    //CERRAMOS CONEXIÓN BD
    mysqli_close($conexion);
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
        <h1>Tabla Comisarias</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Comisarias</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- CODIGO DE ALERTAS -->
    <?php
      if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'agregado')
      {
    ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Exito!</strong> Se agregó correctamente una nueva comisaria.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
        }
    ?>
    <?php
      if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'error')
      {
    ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong> Error</strong> No se pudo agregar la nueva comisaria.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
        }
    ?>
    <?php
      if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado')
      {
    ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Eliminado!</strong> Se eliminó correctamente la comisaria.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
        }
    ?>

    <!--INPUT BUSCAR EN TABLAS-->
    <div class="search">
      <form method="post"><input type="text" name="campo" id="campo" placeholder="Buscar" class="rounded">
        <button type="button" class="btn btn-success float-end mb-2"data-bs-toggle="modal" data-bs-target="#staticBackdrop">
      <i class="bi bi-plus-circle-fill"></i>
      Agregar
      </button>
      </form>  
    </div><!--FIN INPUT BUSCAR EN TABLAS-->
    
    <!-- Modal AGREGAR COMISARIA -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Comisaria</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="card">
              <div class="card-body">
                <!-- FORMULARIO PARA AGREGAR COMISARIA -->
                <form class="row g-3" method="post">
                  <div class="col-md-12">
                    <label for="inputName5" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombreComisaria" name="nombreComisaria">
                  </div>
                  <div class="col-md-12">
                    <label for="inputEmail5" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccionComisaria" name="direccionComisaria">
                  </div>
                  <div class="col-md-6">
                    <label for="inputtext5" class="form-label">Provincia</label>
                    <input type="text" class="form-control" id="provinciaComisaria" name="provinciaComisaria">
                  </div>
                  <div class="col-md-6">
                    <label for="inputtext5" class="form-label">Departamento</label>
                    <input type="text" class="form-control" id="departamentoComisaria" name="departamentoComisaria">
                  </div>
                  <div class="col-md-12">
                    <label for="inputtext5" class="form-label">Localidad</label>
                    <input type="text" class="form-control" id="localidadComisaria" name="localidadComisaria">
                  </div>
                  <div class="col-12">
                    <label for="inputAddress5" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefonoComisaria" name="telefonoComisaria">
                  </div>
                  <div class="col-md-6">
                    <label for="inputtext5" class="form-label">Latitud</label>
                    <input type="text" class="form-control" id="latitudComisaria" name="latitudComisaria">
                  </div>
                  <div class="col-md-6">
                    <label for="inputtext5" class="form-label">Longitud</label>
                    <input type="text" class="form-control" id="longitudComisaria" name="longitudComisaria">
                  </div>
                  <div class="col-md-6">
                    <label for="inputState" class="form-label">Habilitado</label>
                    <select id="habilitadoComisaria" name="habilitadoComisaria" class="form-select">
                      <option value="1" selected>Habilitado</option>
                      <option value="0">Deshabilitado</option>
                    </select>
                  </div>
                  
                  <div class="text-center">
                    <button type="submit" id="agregarComisaria" name="agregarComisaria" value="agregarComisaria" class="btn btn-primary">Agregar</button>
                  </div>
                </form><!-- End Multi Columns Form -->
  
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <!-- <button type="button" class="btn btn-primary">Understood</button> -->
          </div>
        </div>
      </div>
    </div><!--FIN MODAL AGREGEAR-->


    <!-- SEGUNDA OPCION -->
    <table class="table table-sm table-hover table-bordered text-center">
      <thead class="table-dark">
        <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Dirección</th>
        <th scope="col">Provincia</th>
        <th scope="col">Departamento</th>
        <th scope="col">Localidad</th>
        <th scope="col">. . .</th>
        </tr>    
      </thead>

    <tbody id="content">
        
      </tbody>
    </table>
    <div class="row">
        <div class="col-6">
            <label id="ldl-total"></label>
        </div>
        <div class="col-6" id="nav-paginacion">

        </div>
    </div>
  </main><!-- End #main -->

    <script>
        let paginaActual = 1
        /* Llamando a la función getData() */
        getData(paginaActual)

        /* Escuchar un evento keyup en el campo de entrada y luego llamar a la función getData. */
        document.getElementById("campo").addEventListener("keyup", function(){
            getData(1)
        }, false)

        /* Peticion AJAX */
        function getData(pagina) {
            let input = document.getElementById("campo").value
            let content = document.getElementById("content")

            if(pagina != null){
                paginaActual = pagina
            }

            let url = "search-comisarias.php"
            let formaData = new FormData()
            formaData.append('campo', input)
            formaData.append('pagina', pagina)

            fetch(url, {
            method: "POST",
            body: formaData
            }).then(response => response.json())
            .then(data => {
                content.innerHTML = data.data
                document.getElementById("ldl-total").innerHTML = 'Mostrando ' +  data.totalFiltro +
                ' de ' + data.totalRegistros + ' registros'
                document.getElementById("nav-paginacion").innerHTML = data.paginacion
            }).catch(err => console.log(err))
        }
</script>
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

</body>

</html>