<?php
    require_once("../config/conexion.php");
    require_once("../models/Autoevaluacion.php");
    $autoevaluacion = new Autoevaluacion();
    /* require_once("../models/Email.php");
    $email = new Email(); */

    switch($_GET["opc"]){
        case "guardaryeditar":
            if(empty($_POST["rank_id"])){
                $autoevaluacion->insert_evaluacion($_POST["lug_id"],$_POST["usu_id"],$_POST["rating"]);
            }else{
                $autoevaluacion->update_evaluacion($_POST["rank_id"],$_POST["lug_id"],$_POST["usu_id"],$_POST["rating"]);
            }
            break;
        case "mostrar":
            $datos=$autoevaluacion->get_evaluacionXid($_POST["rank_id"]);
            if(is_array($datos) == true and count($datos)<>0){
                foreach($datos as $row){
                    $output["lug_id"] = $row["lug_id"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["rating"] = $row["rating"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $autoevaluacion->delete_autoevaluacion($_POST["rank_id"]);
            break;
        case "listar_cursos":
            $datos=$usuarios->get_lugares_x_usuario($_POST["rank_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["lug_nom"];
                $sub_array[] = $row["lug_fecini"];
                $sub_array[] = $row["lug_fecfin"];
                $sub_array[] = $row["ext_nom"]." ".$row["ext_ape"];
                
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;
       
    
        case "listar_cursos_usuario":
            $datos=$usuario->get_lugares_usuario_x_id($_POST["lug_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["lug_nom"];
                $sub_array[] = $row["usu_nom"]." ".$row["usu_ape"];
                $sub_array[] = $row["lug_fecini"];
                $sub_array[] = $row["lug_fecfin"];
                $sub_array[] = $row["ext_nom"]." ".$row["ext_ape"];
                $sub_array[] = '<button type="button" onClick="certificado('.$row["lugd_id"].');"  id="'.$row["lugd_id"].'" class="btn btn-outline-primary btn-icon btn-sm"><div><i class="fa fa-id-card-o"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["lugd_id"].');"  id="'.$row["lugd_id"].'" class="btn btn-outline-danger btn-icon btn-sm"><div><i class="fa fa-close"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        }