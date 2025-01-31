<?php 
  $titulo="Evaluación del voluntario";
  date_default_timezone_set('America/Bogota');
  $fecha_actual = date("d-m-Y");
  define("URL","/Voluntariado/views/");
  define("BASE_PATH","/Voluntariado");
  require_once("../config/conexion.php");
  require_once("../models/Autoevaluacion.php");
  
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
  <style>
    .stars {
      display: flex;
      direction: row;
      justify-content: center;
      align-items: center;
      font-size: 2rem;
      cursor: pointer;
      position: relative;
    }
    .star {
      color: lightgray;
      position: relative;
    }
    .star::before {
      content: '\2605'; /* Star character */
      color: gold;
      position: absolute;
      top: 0;
      left: 0;
      width: 0%;
      overflow: hidden;
      white-space: nowrap;
    }
    .star.filled::before {
      width: 100%;
    }
    .star.partial::before {
      width: var(--partial-fill, 0%);
    }
  </style>
  
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
              <li class="breadcrumb-item"><a href="#" class="text-green">Autoevaluación</a></li>
              <li class="breadcrumb-item active"><?php echo $titulo; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="card">
          <div class="card-header">
              <h3 class="card-title">Evaluación del espacio donde se realizó el voluntariado</h3>
          </div>
          <div class="card-body">
            <form method="post" id="autoevaluacion_form">
              <div class="form-group">
                <input type="hidden" name="rank_id" id="rank_id">
                <div class="row">
                  <div class="col-6">
                      <div class="form-group">
                          <label for="usu_nom">Nombres</label>
                          <input type="text" class="form-control" name="usu_nom" id="usu_nom" placeholder="Ingrese sus Nombres">
                      </div>
                  </div>
                  <div class="col-6">
                      <div class="form-group">
                          <label for="usu_ape">Apellidos</label>
                          <input type="text" class="form-control" name="usu_ape" id="usu_ape" placeholder="Ingrese sus Apellidos">
                      </div>
                  </div>
                  
          
                  <div class="col-12">
                      <div class="form-group">
                          <label for="lug_nom">Espacio del voluntariado</label>
                          <input type="text" class="form-control" name="lug_nom" id="lug_nom" placeholder="Ingrese el código del programa">
                      </div>
                  </div>
                </div>
              </div>
              <h3 class="normalFont">Indique el nivel de satisfacción:</h3>
              <div class="stars" id="starContainer">
                <span class="star" data-value="1">&#9733;</span>
                <span class="star" data-value="2">&#9733;</span>
                <span class="star" data-value="3">&#9733;</span>
                <span class="star" data-value="4">&#9733;</span>
                <span class="star" data-value="5">&#9733;</span>
              </div>
              <p id="ratingText">Your rating: 0</p>
            </form> 
          </div>
      </div>
    </section>
    
  </div>
  
</div>
<?php require_once("modulos/js.php");?>
<!-- <script src="../public/js/home.js"></script> -->
<script>
    const stars = document.querySelectorAll('.star');
    const ratingText = document.getElementById('ratingText');

    let selectedRating = 0;

    stars.forEach(star => {
      star.addEventListener('mousemove', function(event) {
        const rect = this.getBoundingClientRect();
        const mouseX = event.clientX - rect.left;
        const width = rect.width;
        const partial = (mouseX / width) * 100;
        resetStars();
        highlightStars(this.dataset.value - 1, partial);
      });

      star.addEventListener('mouseout', function() {
        resetStars();
        highlightSelected();
      });

      star.addEventListener('click', function(event) {
        const rect = this.getBoundingClientRect();
        const mouseX = event.clientX - rect.left;
        const width = rect.width;
        const partial = (mouseX / width).toFixed(1);
        selectedRating = parseFloat(this.dataset.value) - 1 + parseFloat(partial);
        ratingText.textContent = `Your rating: ${selectedRating.toFixed(1)}`;
        highlightSelected();
      });
    });

    function resetStars() {
      stars.forEach(star => {
        star.classList.remove('filled', 'partial');
        star.style.setProperty('--partial-fill', '0%');
      });
    }

    function highlightStars(index, partial = 100) {
      for (let i = 0; i <= index; i++) {
        stars[i].classList.add('filled');
      }
      if (index < stars.length) {
        stars[index].classList.add('partial');
        stars[index].style.setProperty('--partial-fill', `${partial}%`);
      }
    }

    function highlightSelected() {
      const whole = Math.floor(selectedRating);
      const fraction = (selectedRating - whole) * 100;
      for (let i = 0; i < whole; i++) {
        stars[i].classList.add('filled');
      }
      if (whole < stars.length) {
        stars[whole].classList.add('partial');
        stars[whole].style.setProperty('--partial-fill', `${fraction}%`);
      }
    }
  </script>



</body>
</html>
<?php
  }else{
    header("Location:".Conectar::ruta()."views/404.php");
  }
?>