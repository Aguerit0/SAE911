<?php 
    include('conexion.php');
    if (isset($_POST['registrarse'])) {
      $usuario=$_POST["usuario"];
      $contraseña=$_POST["contraseña"];
      $nombre=$_POST["nombre"];
      $apellido=$_POST["apellido"];
      $dni=$_POST["dni"];
      $email=$_POST["email"];
      $telefono=$_POST["telefono"];
      $sexo=$_POST["sexo"];
     
      //CONSULTA INSERTAR DATOS
      $insertarPersona="INSERT INTO persona(nombre, apellido, gmail, telefono, dni, sexo) VALUES 
      ('$nombre','$apellido','$gmail','$telefono','$dni','$sexo')";

      $resultado=mysqli_query($conexion,$insertarPersona);
      if (!$resultado) {
        echo "ERROR";
      }else{

        //OBTENCION DE DATOS TABLA COMISARIA
       if ($row = $resultado->fetch_assoc()) {
        $idPerona=$row['idPersona'];
        }
      }

      $insertarUsuario="INSERT INTO usuarios(usuario, contraseña, idPersona) VALUES ('$usuario','$contraseña','$idPersona')";
      $resultado=mysqli_query($conexion,$insertarUsuario);
      

      //VERIFICAR USUARIO
      $verificarUsuario=mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario'");
      if(mysqli_num_rows($verificarUsuario)>0){
        echo '<script>alert("El usuario ya esta registrado");
        window.history.go(-1);
        </script>';
        exit;
      }

      //EJECUTAR CONSULTA
      $ejecutarInsertar=mysqli_query($conexion,$insertar);
      if(!$ejecutarInsertar){
        echo "Error al registrarse";
      }
      else{
        header('location:inicio-dashboard.php');
      }
    }
    mysqli_close($conexion);
 ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Registrarse</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">

                  <span class="d-none d-lg-block">Sae 911</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Crea una cuenta</h5>
                    <p class="text-center small"></p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Usuario</label>
                      <div class="input-group has-validation">
                        <input type="text" name="usuario" class="form-control" id="usuario"  required>
                        <div class="invalid-feedback">¡Por favor, escriba su nombre de usuario</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Contraseña</label>
                      <input type="password" name="contraseña" class="form-control" id="contraseña" required>
                      <div class="invalid-feedback">¡Por favor, escriba una Contraseña!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Repetir Contraseña</label>
                      <input type="password" name="repcontraseña" class="form-control" id="repcontraseña"  required>
                      <div class="invalid-feedback">¡Por favor, escriba una Contraseña!</div>
                    </div>

                    <div class="col-12">

                      <label for="yourName" class="form-label">Nombre</label>
                      <input type="text" name="nombre" class="form-control" id="nombre" required>
                      <div class="invalid-feedback">¡Por favor, escriba su nombre!
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourName" class="form-label">Apellido</label>
                      <input type="text" name="apellido" class="form-control" id="apellido" required>
                      <div class="invalid-feedback">¡Por favor, escriba su Apellido!
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourName" class="form-label">DNI</label>
                      <input type="number" name="dni" class="form-control" id="dni" value="dni" required>
                      <div class="invalid-feedback">¡Por favor, escriba su DNI!
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Correo</label>
                      <input type="email" name="email" class="form-control" id="email"  required>
                      <div class="invalid-feedback">¡Por favor, escriba su Gmail!</div>
                    </div>


                    <div class="col-12">
                      <label for="yourName" class="form-label">Telefono</label>
                      <input type="number" name="telefono" class="form-control" id="telefono"  required>
                      <div class="invalid-feedback">¡Por favor, escriba su Telefono!
                      </div>
                    </div>



                    <div class="col-12">
                      <label for="yourName" class="form-label" >Sexo</label>
                      <br>
                       <input type="radio" class="form-check-input" id="femenino" name="femenino"  checked>
                      <label class="form-check-label" for="radio1">Femenino</label>
                      <input type="radio" class="form-check-input" id="masculino" name="masculino" >
                      <label class="form-check-label" for="radio2">Masculino</label>
                      </div>


                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Acepto todos los <a href="#">terminos y condiciones</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" value="registrase">Registrarse</button>
                    </div>
                  </form>

                </div>
              </div>


            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

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