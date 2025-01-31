<?php
define( "BASE_URL", "/ISUM/views/");
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.0.7/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
 
<!-- optionally if you need to use a theme, then include the theme file as mentioned below -->
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.0.7/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
  <!-- <link rel="stylesheet" href="../html/plugins/rating/css/star-rating.min.css"> -->
  <!-- <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.0.7/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
   -->
   <title>ISUM | Encuestas</title>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
    <div class="wrapper">
        <!-- Header -->
        <?php
            include("modulos/header.php");
        ?>
        <!-- /.Header -->

        <!-- Menú -->
        <?php
            include("modulos/menu.php");
        ?>
        <!-- /.Menú -->

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
                            <h3 class="card-title">Encuesta de Satisfacción</h3>
                        </div>
                        <div class="card-body">
                            <section class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombreCompleto">Nro de Ticket</label>
                                        <input type="text" class="form-control" id="lblnomidticket" name="lblnomidticket" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombreCompleto">Fecha de Cierre</label>
                                        <input type="text" class="form-control" id="lblfechcierre" name="lblfechcierre" readonly>
                                    </div>
                                </div>
                            </section>
                            <section class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombreCompleto">Título</label>
                                        <input type="text" class="form-control" id="tick_titulo" name="tick_titulo" readonly>
                                    </div>
                                </div>
                            </section>
                            <section class="row">
                                <div class="col-md-4">
                                    <label for="tipoAtencion">Categoría</label>
                                    <input type="text" class="form-control" id="cat_nom" name="cat_nom" readonly>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fechaActual">Sub Categoría</label>
                                        <input type="text" class="form-control" id="cats_nom" name="cats_nom" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fechaActual">Prioridad</label>
                                        <input type="text" class="form-control" id="prio_nom" name="prio_nom" readonly>
                                    </div>
                                </div>
                            </section>
                            <section class="row">
                                <div class="col-md-4">
                                    <label for="tipoAtencion">Usuario</label>
                                    <input type="text" class="form-control" id="lblnomusuario" name="lblnomusuario" readonly>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fechaActual">Estado</label>
                                        <input type="text" class="form-control" id="lblestado" name="lblestado" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fechaActual">Fecha Creación</label>
                                        <input type="text" class="form-control" id="lblfechcrea" name="lblfechcrea" readonly>
                                    </div>
                                </div>
                            </section>
                            <hr />

                            <div id="panel1">

                                <section class="row">
                                    <div class="col-md-12 text-center">
                                        <label for="input-2" class="control-label" for="input-2" class="control-label">Calificación</label>
                                        <input id="tick_estre" name="tick_estre" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1">
                                    </div>
                                </section>

                                <section class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="comment">Comentarios:</label>
                                            <textarea id="tick_coment" name="tick_coment" class="form-control" rows="6" id="comentarios"></textarea>
                                        </div>
                                    </div>
                                </section>

                                <section class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-info" id="btnguardar">Guardar Encuesta</button>
                                    </div>
                                </section>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
  
        <?php
            include("modulos/footer.php");
        ?>
    </div>
    <!-- /.Site warapper -->
    <?php include("modulos/js.php"); ?>
   <!--  <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.0.7/js/star-rating.js" type="text/javascript"></script>
    --> 
   <script src="../html/plugins/rating/js/star-rating.min.js"></script>
    <script>
    $('#tick_estre').rating({ 
        showCaption: false
    });
    /* $("#tick_estre").rating(); */
</script>
<script type="text/javascript" src="js/admEncuesta.js"></script>
<script type="text/javascript" src="notificacion.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
