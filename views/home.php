<?php 
  $titulo="Información General";
  date_default_timezone_set('America/Bogota');
  $fecha_actual = date("d-m-Y");
  define("URL","/MAIE/views/");
  define("BASE_PATH","/MAIE");
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
  <title>Gestión MAIE</title>
  <?php require_once("modulos/head.php"); ?>
  <link rel="stylesheet" href="../public/plugins/chart.js/Chart.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php require_once("modulos/header.php");?>
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="#" class="brand-link">
      <img src="../public/img/logo.png" alt="Logo UMD" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MAIE</span>
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
              <li class="breadcrumb-item"><a href="#" class="text-orange">Inicio</a></li>
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
                  <span class="info-box-text">Programas</span>
                  <span class="info-box-number">
                    <span id="lbltotalProgramas"></span>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Remisiones</span>
                  <span class="info-box-number">
                    <span id="lbltotalRemisiones"></span>
                  </span>
                </div>
              </div>
            </div>
            
          <?php endif; ?>
          <div class="clearfix hidden-md-up"></div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title text-bold text-orange">Resultado Global</h3>
              </div>
              <div class="card-body table-responsive p-4">
              <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Resultados Globales</h3>
              </div>
              <div class="card-body">
                <div class="chart" id="barChart">
                  <!-- <?php if($prog_id != 0 ): ?>
                    <?php for($i=0;$i<sizeof($res);$i++): ?>
                      <div id="chart_div"></div>
                    <?php endfor; ?>
                  <?php else: ?>
                    <?php for($i=0;$i<sizeof($res2);$i++): ?>
                      <div id="chart_div"></div>
                    <?php endfor; ?>
                  <?php endif; ?> -->
                  <!-- <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas> -->
                </div>
              </div>
              <!-- /.card-body -->
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
  </div>
  
</div>
<?php require_once("modulos/js.php");?>
<script src="../public/js/home.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
  google.charts.load('current', {packages: ['corechart', 'bar']});
  google.charts.setOnLoadCallback(drawAnnotations);

  function drawAnnotations() {
    var data = [
        ['Programa', 'Desviación Estandar', {type: 'string', role: 'annotation'}, 'Puntaje', {type: 'string', role: 'annotation'}]
    ];

    <?php foreach($res as $row): ?>
        var puntaje_programa = <?php echo $row["puntaje_programa"]; ?>;
        var puntaje_referencia = <?php echo $row["puntaje_referencia"]; ?>;
        var desviacion_programa = <?php echo $row["desviacion_programa"]; ?>;
        var desviacion_referencia = <?php echo $row["desviacion_referencia"]; ?>;
        var anio = <?php echo $row["anno"]; ?>;

        data.push(['Grupo de Referencia', desviacion_programa, 'Desviación Programa', desviacion_referencia, 'Desviación Referencia']);
        data.push(['Programa', puntaje_programa, 'Puntaje Programa', puntaje_referencia, 'Puntaje Referencia']);
    <?php endforeach; ?>

    // Convert the data array into a DataTable
    var dataTable = google.visualization.arrayToDataTable(data);

    var anno = anio;
    var options = {
        title: 'Resultado Global del programa',
        chartArea: { width: '50%' },
        annotations: {
            alwaysOutside: true,
            textStyle: {
                fontSize: 8,
                auraColor: 'none',
                color: '#555'
            },
            boxStyle: {
                stroke: '#ccc',
                strokeWidth: 1,
                gradient: {
                    color1: '#f3e5f5',
                    color2: '#f3e5f5',
                    x1: '0%', y1: '0%',
                    x2: '100%', y2: '100%'
                }
            }
        },
        hAxis: {
            title: 'Puntaje',
            minValue: 0,
        },
        vAxis: {
            title: anno
        }
    };

    var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
    chart.draw(dataTable, options);
  }
    
</script>

</body>
</html>
<?php
  }else{
    header("Location:".Conectar::ruta()."views/404.php");
  }
?>