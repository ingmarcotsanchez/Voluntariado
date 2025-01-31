<?php 
  $titulo="Información General";
  date_default_timezone_set('America/Bogota');
  $fecha_actual = date("d-m-Y");
  define("URL","/Voluntariado/views/");
  define("BASE_PATH","/Voluntariado");
  require_once("../config/conexion.php");
  require_once("../models/Usuarios.php");
  $usuario = new Usuario();
  $total = $usuario->total_voluntarios();
  $cnt_estudiantes = $usuario->total_estudiantes();
  (int)$tot_estudiantes = ((int)$cnt_estudiantes[0]["total"]/$total[0]["total"])*100;
  $cnt_gestores = $usuario->total_gestores();
  (int)$tot_gestores = ((int)$cnt_gestores[0]["total"]/$total[0]["total"])*100;
  $cnt_externos = $usuario->total_externos();
  (int)$tot_externos = ((int)$cnt_externos[0]["total"]/$total[0]["total"])*100;
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
  <link rel="icon" href="/Voluntariado/public/img/favicon.png">
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
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-graduation-cap"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Campos</span>
                <span class="info-box-number">
                  <span id="lbltotalCampos"></span>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Voluntarios</span>
                <span class="info-box-number">
                  <span id="lbltotalVoluntarios"></span>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-paper-plane"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Solicitudes</span>
                <span class="info-box-number">
                  <span id="lbltotalRemisiones"></span>
                </span>
              </div>
            </div>
          </div>
            
          <?php endif; ?>
          <?php if($_SESSION["usu_rol"] == "ES"): ?>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-calendar"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total de Voluntariados</span>
                  <span class="info-box-number">
                    <span id="lbltotal"></span>
                  </span>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <div class="clearfix hidden-md-up"></div>
        </div>
        
      </div>
      <?php if($_SESSION["usu_rol"] == "C"): ?>
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <p class="text-center">
                <strong>Detalle de Voluntarios</strong>
              </p>
              <div class="card-body p-4">

                <!-- /.progress-group -->
                <div class="progress-group">
                  <span class="progress-text">Estudiantes</span>
                  <span class="float-right" id="lbltotalEstudiantes"></span>
                  <!--  $porcentaje = (((lbltotalEstudiantes * lbltotalActivos ) / 100) * 100);-->
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-success" style="width:<?php echo $tot_estudiantes; ?>%"></div>
                  </div>
                </div>


                <div class="progress-group">
                  Gestores del conocimiento
                  <span class="float-right" id="lbltotalGestores"></span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: <?php echo $tot_gestores; ?>%"></div>
                  </div>
                </div>

                <div class="progress-group">
                  Sector Externo
                  <span class="float-right" id="lbltotalExternos"></span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-info" style="width: <?php echo $tot_externos; ?>%"></div>
                  </div>
                </div>
                <div class="progress-group">
                  <strong>Total de Voluntarios
                  <span class="float-right"><?php echo $total[0]["total"]; ?></span>
                  </strong>
                </div>
              </div>
            </div>
          </div>
      </div>
      <?php endif; ?>
    </section>
    
  </div>
  
</div>
<?php require_once("modulos/js.php");?>
<!-- <script src="../public/js/home.js"></script> -->
<script src="js/usuhome.js"></script>


</body>
</html>
<?php
  }else{
    header("Location:".Conectar::ruta()."views/404.php");
  }
?>