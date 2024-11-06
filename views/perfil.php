<?php 
  $titulo="Perfil del Usuario";
  define("URL","/Voluntariado/views/");
  require_once("../config/conexion.php");
  if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Voluntariado</title>
  <?php require_once("modulos/head.php"); ?>
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
        <div class="card card-green">
          <div class="card-header">
              <h3 class="card-title text-white">Mis datos</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                  <div class="form-group">
                      <label for="usu_tipo">Tipo de documento</label>
                      <select class="form-control select2" name="usu_tipo" id="usu_tipo" data-placeholder="Seleccione">
                          <option label="Seleccione"></option>
                          <option value="CC">Cédula de Ciudadania</option>
                          <option value="TI">Tarjeta de identidad</option>
                          <option value="CE">Cédula de Extrangeria</option>
                      </select>
                  </div>
              </div>
              <div class="col-6">
                  <div class="form-group">
                      <label for="usu_dni">Número de identificación</label>
                      <input type="text" class="form-control" name="usu_dni" id="usu_dni" placeholder="Ingrese su número de identificación">
                  </div>
              </div>
              <div class="col-6">
                  <div class="form-group">
                      <label for="usu_nom">Nombres</label>
                      <input type="text" class="form-control" name="usu_nom" id="usu_nom" placeholder="Ingrese su nombre" disabled>
                  </div>
              </div>
              <div class="col-6">
                  <div class="form-group">
                      <label for="usu_ape">Apellidos</label>
                      <input type="text" class="form-control" name="usu_ape" id="usu_ape" placeholder="Ingrese su apellido" disabled>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-4">
                  <div class="form-group">
                      <label for="usu_correo">Correo Electrónico</label>
                      <input type="email" class="form-control" name="usu_correo" id="usu_correo" placeholder="Ingrese su email" disabled>
                  </div>
              </div>
              <div class="col-4">
                  <div class="form-group">
                      <label for="usu_rol">Rol</label>
                      <select class="form-control select2" name="usu_rol" id="usu_rol" data-placeholder="Seleccione" disabled>
                          <option label="Seleccione"></option>
                          <?php if($_SESSION["usu_rol"] == "C"): ?>
                          <option value="C">Administrador</option>
                          <?php else: ?>
                          <option value="GC">Gestor Conocimiento</option>
                          <option value="ES">Estudiante</option>
                          <option value="EX">Sector Externo</option>
                          <option value="AS">Aspirante</option>
                          <?php endif; ?>
                      </select>
                      
                  </div>
              </div>
              <div class="col-4">
                  <div class="form-group">
                      <label for="usu_pass">Contraseña Actual</label>
                      <input type="text" class="form-control" name="usu_pass" id="usu_pass" placeholder="Ingrese su email" disabled>
                  </div>
              </div>
          </div> 
          <div class="row">
              <div class="col-6">
                  <div class="form-group">
                      <label for="usu_pass">Nueva Contraseña</label>
                      <input type="password" class="form-control" id="txtpass" name="txtpass" placeholder="Ingrese su nueva contraseña">
                  </div>
              </div>
              <div class="col-6">
                  <div class="form-group">
                      <label for="usu_pass">Confirmar Contraseña</label>
                      <input type="password" class="form-control" id="txtpassnew" name="txtpassnew" placeholder="Ingrese su nueva contraseña">
                  </div>
              </div>
              <div class="col-4">
                  <div class="form-group">
                      <label for="cen_id">Sedes</label>
                      <select class="form-control select2" style="width:100%" name="cen_id" id="cen_id" data-placeholder="Seleccione">
                      
                          <option label="Seleccione"></option>

                      </select>
                  </div>
              </div>
              <div class="col-4">
                  <div class="form-group">
                      <label for="fac_id">Facultad</label>
                      <select class="form-control select2" style="width:100%" name="fac_id" id="fac_id" data-placeholder="Seleccione">
                      
                          <option label="Seleccione"></option>

                      </select>
                  </div>
              </div>
              <div class="col-4">
                  <div class="form-group">
                      <label for="prog_id">Programa</label>
                      <select class="form-control select2" style="width:100%" name="prog_id" id="prog_id" data-placeholder="Seleccione">
                      
                          <option label="Seleccione"></option>

                      </select>
                  </div>
              </div>
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-outline-secondary" id="btnactualizar">Actualizar información</button>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<?php require_once("modulos/js.php");?>
<script type="text/javascript" src="js/miPerfil.js"></script>
</body>
</html>
<?php
  }else{
    header("Location:".Conectar::ruta()."views/404.php");
  }
?>