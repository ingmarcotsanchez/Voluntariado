<?php
define("URL","/Voluntariado/views/");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");
if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include("modulos/head.php");
  ?>
  <title>Voluntariado | Certificado</title>
</head>
<body class="hold-transition sidebar-mini">
  <section class="content">
    <div class="container">
      <!-- COLOR PALETTE -->
      <div class="card card-default color-palette-box">
        <div class="card-body">
        
            <!--<img src="../html/public/1.png" alt="certificado" class="img-fluid" height="650px" width="900px">-->
            <canvas id="canvas" height="650px" width="900px" class="img-fluid" alt="Responsive image"></canvas>
            <p class="text-center m-2" id="lug_descrip">
            
            </p>
    
        </div>
        <div class="card-footer">
          <button class="btn btn-outline-info" id="btnpng"><i class="fa fa-send mg-r-10"></i> PNG</button>
          <button class="btn btn-outline-success" id="btnpdf"><i class="fa fa-send mg-r-10"></i> PDF</button>
        </div>
      </div>
    </div>
  </section>
    <?php
    include("modulos/js.php");
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script> <!-- libreria que permite crear pdf con js-->
    <script type="text/javascript" src="js/certificado.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
