<?php 
  $titulo="Información General";
  date_default_timezone_set('America/Bogota');
  $fecha_actual = date("d-m-Y");
  define("URL","/Voluntariado/views/");
  define("BASE_PATH","/Voluntariado");
  require_once("../config/conexion.php");
  require_once("../models/Usuarios.php");
  /* $usuario = new Usuario(); */
  /* $totalP = $usuario->total_programas(); */
 /*  var_dump($totalP);
  $totalC = $usuario->total_centros(); */
  if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestión Voluntariado</title>
  <?php require_once("modulos/head.php"); ?>
  <link rel="stylesheet" href="../public/plugins/chart.js/Chart.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php require_once("modulos/header.php");?>
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="#" class="brand-link">
      <img src="../public/img/logo.png" alt="Logo UDEC" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Voluntariado</span>
    </a>
    <div class="sidebar">
      
      <nav class="mt-2">
        <?php require_once("modulos/menu.php");?>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 bg-white p-4">
          <div class="col-sm-6">
            <h1><?php echo $titulo; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" class="text-green">Inicio</a></li>
              <li class="breadcrumb-item active"><?php echo $titulo; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="far fa-calendar-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Fecha</span>
                <span class="info-box-number">
                  <?php echo $fecha_actual;?>
                </span>
              </div>
            </div>
          </div>
          <?php if($_SESSION["usu_rol"] == "C"): ?>
            <!-- <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-graduation-cap"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Programas</span>
                  <span class="info-box-number">
                    <span id="lbltotalProgramas"></span>
                  </span>
                </div>
              </div>
            </div> -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Solicitudes</span>
                  <span class="info-box-number">
                    <span id="lbltotalRemisiones"></span>
                  </span>
                </div>
              </div>
            </div>
            
          <?php endif; ?>
          <div class="clearfix hidden-md-up"></div>
        </div>
        
      </div>
    </section>
    
  </div>
  
</div>
<?php require_once("modulos/js.php");?>
<script src="../public/js/home.js"></script>


</body>
</html>
<?php
  }else{
    header("Location:".Conectar::ruta()."views/404.php");
  }
?>