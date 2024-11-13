<?php
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");
    $ticket = new Ticket();
    require_once("../models/Usuario.php");
    $usuario = new Usuario();
    require_once("../models/Documento.php");
    $documento = new Documento();
 
    switch($_GET["opc"]){
        
        case "insert":
            $datos=$ticket->insert_ticket($_POST["usu_id"],$_POST["tick_titulo"],$_POST["tick_descrip"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach ($datos as $row){
                    $output["tick_id"] = $row["tick_id"];
                    if (empty($_FILES['files']['name'])){

                    }else{
                        $countfiles = count($_FILES['files']['name']);
                        $ruta = "../document/ticket/".$output["tick_id"]."/";
                        $files_arr = array();

                        if (!file_exists($ruta)) {
                            mkdir($ruta, 0777, true);
                        }

                        for ($index = 0; $index < $countfiles; $index++) {
                            $doc1 = $_FILES['files']['tmp_name'][$index];
                            $destino = $ruta.$_FILES['files']['name'][$index];
                            $documento->insert_documento( $output["tick_id"],$_FILES['files']['name'][$index]);
                            move_uploaded_file($doc1,$destino);
                        }
                    }
                }
            }
            echo json_encode($datos);
            break;
        case "insertdetalle":
            $ticket->insert_ticketdetalle($_POST["tick_id"],$_POST["usu_id"],$_POST["dtick_descrip"]);
            break;
        case "listar_x_usu":
            $datos=$ticket->listar_ticket_x_usu($_POST["usu_id"]);
            //var_dump($datos);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tick_id"];
                $sub_array[] = $row["tick_titulo"];
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                
                if ($row["tick_estado"]=="Abierto"){
                    $sub_array[] = '<strong class="text-success">Abierto</strong>';
                }else{
                    $sub_array[] = '<a class="btn btn-sm btn-danger" onClick="CambiarEstado('.$row["tick_id"].')">Cerrado</a>';
                }
                
                if($row["fech_cierre"]==null){
                    $sub_array[] = '<strong class="text-dark">Sin Cerrar</strong>';
                }else{
                    $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_cierre"]));
                }

                
                $sub_array[] = '<button type="button" onClick="ver('.$row["tick_id"].');"  id="'.$row["tick_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        case "mostrar";
            $datos=$ticket->listar_ticket_x_id($_POST["tick_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["tick_id"] = $row["tick_id"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["tick_titulo"] = $row["tick_titulo"];
                    $output["tick_descrip"] = $row["tick_descrip"];

                    if ($row["tick_estado"]=="Abierto"){
                        $output["tick_estado"] = '<span class="btn btn-sm btn-success">Abierto</span>';
                    }else{
                        $output["tick_estado"] = '<span class="btn btn-sm btn-danger">Cerrado</span>';
                    }

                    $output["tick_estado_texto"] = $row["tick_estado"];

                    $output["fech_crea"] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                    if ($row["fech_cierre"]==NULL){
                        $output["fech_cierre"] = "Sin cerrar";
                    }else{
                        $output["fech_cierre"] = date("d/m/Y H:i:s", strtotime($row["fech_cierre"]));
                    }
                    //
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_ape"] = $row["usu_ape"];
                }
                echo json_encode($output);
            }   
            break;
        case "listar":
            $datos=$ticket->listar_ticket();
            //var_dump($datos);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tick_id"];
                $sub_array[] = $row["tick_titulo"];
                
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                
                if ($row["tick_estado"]=="Abierto"){
                    $sub_array[] = '<span class="btn btn-success btn-sm">Abierto</span>';
                }else{
                    $sub_array[] = '<span class="btn btn-danger btn-sm" onClick="CambiarEstado('.$row["tick_id"].')">Cerrado</span>';
                }
                
                if($row["fech_cierre"]==null){
                    $sub_array[] = '<strong class="text-dark">Sin Cerrar</strong>';
                }else{
                    $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_cierre"]));
                }

                
                $sub_array[] = '<button type="button" onClick="ver('.$row["tick_id"].');"  id="'.$row["tick_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        case "listardetalle":
            $datos=$ticket->listar_ticketdetalle_x_ticket($_POST["tick_id"]);
            ?>
                <?php foreach($datos as $row): ?>
                    <div class="timeline" id="DtlleTicket">
            
                        <div class="time-label">
                            <span class="bg-dark"><?php echo date("d/m/Y", strtotime($row["fech_crea"]));?></span>
                        </div>
        
                        <div>
                            <?php if ($row['usu_rol']=="ASPI"): ?>
                            <i class="fas fa-user bg-blue"></i>
                            <?php else: ?>
                            <i class="fas fa-user bg-info"></i>
                            <?php endif; ?>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> <?php echo date("H:i:s", strtotime($row["fech_crea"]));?></span>
                                <h3 class="timeline-header"><a href="#"><?php 
                                            if ($row['usu_rol']=="ASPI"){
                                            echo 'Aspirante';
                                        }else{
                                            echo 'Gestión Humana';
                                        } 
                                    ?>:</a> <?php echo $row['usu_nom'].' '.$row['usu_ape'];?></h3>

                                <div class="timeline-body">
                                    <?php echo $row["dtick_descrip"];?>
                                </div>

                            </div>
                        </div>
                    
                    <div>     
                <?php endforeach;?>
            <?php
            break;
        case "update":
            $ticket->update_ticket($_POST["tick_id"]);
            $ticket->insert_ticketdetalle_cerrar($_POST["tick_id"],$_POST["usu_id"]);
            break;
        case "total";
            $datos=$ticket->get_ticket_total();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
            break;

        case "totalabierto";
            $datos=$ticket->get_ticket_totalabierto();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
            break;

        case "totalcerrado";
            $datos=$ticket->get_ticket_totalcerrado();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
            break;
    }
?>