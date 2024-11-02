<?php
    require_once("../config/conexion.php");
    require_once("../models/Centro.php");
    $centro = new Centro();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["cen_id"])){
                    //$curso es la variable que tenemos inicializada, los metodos son los que creamos en el archivo de models
                    $centro->insert_centro($_POST["cen_nom"]);
                }else{
                    $centro->update_centro($_POST["cen_id"], $_POST["cen_nom"]);
                }
                break;
        case "mostrar":
                $datos = $centro->centro_id($_POST["cen_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["cen_id"] = $row["cen_id"];
                        $output["cen_nom"] = $row["cen_nom"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $centro->delete_centro($_POST["cen_id"]);
                break;
        case "listar":
                $datos=$centro->centro();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["cen_id"];
                    $sub_array[] = $row["cen_nom"];
                    if($row["est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='est_ina(".$row["cen_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='est_act(".$row["cen_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" class="btn btn-outline-warning btn-icon btn-sm" onClick="editar('.$row["cen_id"].')" id="'.$row["cen_id"].'"><div><i class="fa fa-edit"></i></div></button>';
                    $sub_array[] = '<button type="button" class="btn btn-outline-danger btn-icon btn-sm" onClick="eliminar('.$row["cen_id"].')" id="'.$row["cen_id"].'"><div><i class="fa fa-trash"></i></div></button>';
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
            $datos=$centro->centro();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['cen_id']."'>".$row['cen_nom']."</option>";
                }
                echo $html;
            }
            break;
            case "activo":
                $centro->update_estadoActivo($_POST["cen_id"]);
                break;
            case "inactivo":
                $centro->update_estadoInactivo($_POST["cen_id"]);
                break; 
            
     
    }
?>