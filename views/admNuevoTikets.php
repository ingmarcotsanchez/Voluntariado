<?php
$titulo="Crear un seguimiento";
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
                            <h3 class="card-title">Iniciar un seguimiento</h3>
                        </div>
                        <form method="post" id="ticket_form">
                            <input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tick_titulo">Título</label>
                                            <input type="text" class="form-control" id="tick_titulo" name="tick_titulo" placeholder="titulo">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fileElem">Documento de Soporte</label>
                                            <input type="file" class="form-control" id="fileElem" name="fileElem" multiple>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <textarea id="tick_descrip" name="tick_descrip">
                                        
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="action" value="add" class="btn btn-info float-right">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /.Site warapper -->
    <?php include("modulos/js.php"); ?>
    
    <script type="text/javascript" src="js/admNuevoTiket.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
