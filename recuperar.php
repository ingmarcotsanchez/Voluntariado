
<?php
  /*TODO: Llamando Cadena de Conexion */
  require_once("config/conexion.php");

  if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
    require_once("models/Usuario.php");
    /*TODO: Inicializando Clase */
    
    /* var_dump($usu_cor['usu_pass']); */
    $usuario = new Usuario();
    $usuario->recuperar();
    $usu_cor = $usuario->usuario_correo($_POST['correo']);
   
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UDEC-Voluntariado</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="hold-transition login-page">
<div class="container">
  <!-- /.login-logo -->
  <div class="container-form">
      <form method="post">
        <h2>Recuperar su Contraseña</h2>
        <span>Ingrese el correo electrónico registrado para adquirir una nueva contraseña</span>
    
        <?php
          if(isset($_GET["m"])){
            switch($_GET["m"]){
                case "1";
                    ?>
                    <div class="alert alert-danger" role="alert">
                    El correo ingresado NO Existe!
                    </div>
                    <?php
                    break;
                case "2";
                    ?>
                    
                    <div class="alert alert-success" role="alert" id="pass">
                    Su clave temporal es <strong id="usu_pass"><?php echo $_GET["nc"]; ?></strong> <!-- 756342908 -->
                    </div>
                    
                    <?php
                    break;
                case "3";
                    ?>
                    <div class="alert alert-warning" role="alert">
                    No ha ingresado un correo!
                    </div>
                    <?php
                    break;
            }
          }
        ?>
        <div class="container-input">
            <i class='bx bx-envelope'></i>
            <input type="text" placeholder="ingrese su correo electrónico">
        </div>
        <input type="hidden" name="enviar" class="form-control" value="si">
        <button type="submit" class="btn btn-primary btn-block miBtn" id="btnRecuperar">Recuperar clave</button>
        <a href="index.php" style="color: #fff;">Ingresar al sistema</a>
      </form>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="html/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="html/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="html/dist/js/adminlte.min.js"></script>

 <script src="views/js/reset.js"></script>
</body>
</html>
