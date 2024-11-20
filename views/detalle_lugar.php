<?php
$titulo="Consultar los voluntarios inscritos";
define("URL","/Voluntariado/views/");
require_once("../config/conexion.php");
require_once("../models/Lugares.php");
$voluntario = new Lugares();
$vol = $voluntario->get_lugares_usuario_join($_GET['ID']);
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
                            <h3 class="card-title">Listado de voluntarios inscritos </h3> 
                        </div>
                       
                        <div class="card-body">
                            <table id="inscritos_data" class="table display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Voluntario</th>
                                        <th>Fecha de postulación</th>
                                        <th>Estado</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php for($i=0;$i<sizeof($vol);$i++): ?>
                                    <tr>
                                        <td><?php echo $vol[$i]["usu_nom"]." ".$vol[$i]["usu_ape"]; ?></td>
                                        <td><?php echo $vol[$i]["fech_crea"]; ?></td>
                                        <td>
                                            <?php 
                                             if($vol[$i]["est"] == 1){
                                                echo "<button type='button' onClick='est_pro(".$vol[$i]["lug_id"].");' class='btn btn-success btn-sm'>Terminado</button>";
                                             }else{
                                                echo "<button type='button' onClick='est_ter(".$vol[$i]["lug_id"].");' class='btn btn-dark btn-sm'>En proceso</button>";
                                             }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>
            </section>
            
        </div>
        
    </div>
    <!-- /.Site warapper -->
    <?php
    include("modulos/js.php");
    ?>
    <script type="text/javascript" src="js/admMisLugares.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
