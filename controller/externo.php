<?php
    /*TODO: Llamando a cadena de Conexion */
    require_once("../config/conexion.php");
    /*TODO: Llamando a la clase */
    require_once("../models/Externo.php");
    /*TODO: Inicializando Clase */
    $externo = new Externo();

    /*TODO: Opcion de solicitud de controller */
    switch($_GET["opc"]){
        /*TODO: Guardar y editar cuando se tenga el ID */
        case "guardaryeditar":
            if(empty($_POST["ext_id"])){
                $externo->insert_externo($_POST["ext_nom"],$_POST["ext_ape"],$_POST["ext_correo"],$_POST["ext_telf"]);
            }else{
                $externo->update_externo($_POST["ext_id"],$_POST["ext_nom"],$_POST["ext_ape"],$_POST["ext_correo"],$_POST["ext_telf"]);
            }
            break;
        /*TODO: Creando Json segun el ID */
        case "mostrar":
            $datos = $externo->get_externo_id($_POST["ext_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["ext_id"] = $row["ext_id"];
                    $output["ext_nom"] = $row["ext_nom"];
                    $output["ext_ape"] = $row["ext_ape"];
                    $output["ext_correo"] = $row["ext_correo"];
                    $output["ext_telf"] = $row["ext_telf"];
                }
                echo json_encode($output);
            }
            break;
        /*TODO: Eliminar segun ID */
        case "eliminar":
            $externo->delete_externo($_POST["ext_id"]);
            break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
        case "listar":
            $datos=$externo->get_externo();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["ext_nom"];
                $sub_array[] = $row["ext_ape"];
                $sub_array[] = $row["ext_correo"];
                $sub_array[] = $row["ext_telf"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["ext_id"].');"  id="'.$row["ext_id"].'" class="btn btn-outline-warning btn-icon btn-sm"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["ext_id"].');"  id="'.$row["ext_id"].'" class="btn btn-outline-danger btn-icon btn-sm"><div><i class="fa fa-trash"></i></div></button>';                
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
        case "combo":
            $datos=$externo->get_externo();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['ext_id']."'>".$row['ext_nom']." ".$row['ext_ape']."</option>";
                }
                echo $html;
            }
            break;
    }
?>