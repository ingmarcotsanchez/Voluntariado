<?php
$titulo="Lugares de voluntariado";
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
<!-- Site wrapper -->
    <div class="wrapper">
    <?php require_once("modulos/header.php");?>
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="#" class="brand-link">
      <img src="../public/img/logo.png" alt="Logo UDEC" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Voluntariado</span>
    </a>
    <div class="sidebar">
      <input type="hidden" id="usu_idx" value="<?php echo $_SESSION["usu_id"]; ?>">
      <input type="hidden" id="rol_idx" value="<?php echo $_SESSION["usu_rol"]; ?>"> 
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


    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lugares disponibles</h3>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-outline-primary mb-2" onclick="nuevo()">Crear Lugar</button>
                    <button type="button" class="btn btn-outline-secondary mb-2" id="btnplantilla">Cargar Planilla</button>
                    
                    <table id="lugares_data" class="table display responsive wrap">
                        <thead>
                            <tr>
                                <th>Área</th>
                                <th>Lugar</th>
                                <th>Fecha de inicio</th>
                                <th>Fecha de terminación</th>
                                <th>Estado</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

    </div>
    
    <!-- /.Site warapper -->
    <?php require_once("admLugaresModal.php"); ?>
    <?php require_once("admLugaresInfoModal.php"); ?>
 
    <?php include("modulos/js.php"); ?>
    <script type="text/javascript" src="js/admLugares.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
