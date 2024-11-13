<?php
$titulo="Consultar los seguimientos";
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
                    <div class="row mb-2"></div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detalle Seguimiento: ID- <strong id="id_ticket"></strong> </h3>  <span class="float-right ml-2" id="Estado"></span><span class="btn btn-light btn-sm float-right" id="Fecha_creacion"></span>

                        </div>
                       
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tick_titulo">Título</label>
                                        <input type="text" class="form-control" id="tick_titulo" name="tick_titulo" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <fieldset class="form-group">
                                        <label class="form-label semibold" for="tick_titulo">Documentos Adjuntos</label>
                                        <table id="documentos_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                            <thead>
                                            <tr>
                                                <th style="width: 90%;">Nombre</th>
                                                <th class="text-center" style="width: 10%;"></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <textarea id="tick_descrip_usu" name="tick_descrip_usu"readonly>
                                    
                                    </textarea>
                                </div>
                            </div>
                        </div>
               
                    </div>  
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" id="Detalle_ticket">
                           
                        </div>
                    </div>
                </div>
            </section>
            <section class="content" id="panel_detalle">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Enviar una respuesta</h3>
                        </div>
                        <form method="post" id="ticket_form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <textarea id="dtick_descrip" name="dtick_descrip">
                                        
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" id="btnEnviarTicket" class="btn btn-info float-right">Enviar</button>
                                <button type="button" id="btnCerrarTicket" class="btn btn-danger float-left">Cerrar Ticket</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        
    </div>
    <!-- /.Site warapper -->
    <?php
    include("modulos/js.php");
    ?>
    <script type="text/javascript" src="js/admDtllTicket.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
