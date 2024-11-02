<?php
    require_once("../config/conexion.php");
    require_once("../models/Areas.php");
    $area = new Area();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["area_id"])){
                    //$curso es la variable que tenemos inicializada, los metodos son los que creamos en el archivo de models
                    $area->insert_area($_POST["area_nom"]);
                }else{
                    $area->update_area($_POST["area_id"], $_POST["area_nom"]);
                }
                break;
        case "mostrar":
                $datos = $area->area_id($_POST["area_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["area_id"] = $row["area_id"];
                        $output["area_nom"] = $row["area_nom"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $area->delete_area($_POST["area_id"]);
                break;
        case "listar":
                $datos=$area->area();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["area_id"];
                    $sub_array[] = $row["area_nom"];
                    if($row["est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='est_ina(".$row["area_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='est_act(".$row["area_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" class="btn btn-outline-warning btn-icon btn-sm" onClick="editar('.$row["area_id"].')" id="'.$row["area_id"].'"><div><i class="fa fa-edit"></i></div></button>';
                    $sub_array[] = '<button type="button" class="btn btn-outline-danger btn-icon btn-sm" onClick="eliminar('.$row["area_id"].')" id="'.$row["area_id"].'"><div><i class="fa fa-trash"></i></div></button>';
                    $data[] = $sub_array;
                }
                /*Formato del datatable, se usa siempre*/
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
                break;
        case "combo":
            $datos=$area->area();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['area_id']."'>".$row['area_nom']."</option>";
                }
                echo $html;
            }
            break;
            case "activo":
                $area->update_estadoActivo($_POST["area_id"]);
                break;
            case "inactivo":
                $area->update_estadoInactivo($_POST["area_id"]);
                break; 
            
     
    }
?>