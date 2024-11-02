<?php
    require_once("../config/conexion.php");
    require_once("../models/Modalidad.php");
    $modalidad = new Modalidad();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["mod_id"])){
                    //$curso es la variable que tenemos inicializada, los metodos son los que creamos en el archivo de models
                    $modalidad->insert_modalidad($_POST["mod_nombre"]);
                }else{
                    $modalidad->update_modalidad($_POST["mod_id"], $_POST["mod_nombre"]);
                }
                break;
        case "mostrar":
                $datos = $modalidad->modalidad_id($_POST["mod_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["mod_id"] = $row["mod_id"];
                        $output["mod_nombre"] = $row["mod_nombre"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $modalidad->delete_modalidad($_POST["mod_id"]);
                break;
        case "listar":
                $datos=$modalidad->modalidad();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["mod_nombre"];
                    if($row["est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='est_ina(".$row["mod_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='est_act(".$row["mod_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" class="btn btn-outline-warning btn-sm btn-icon" onClick="editar('.$row["mod_id"].')" id="'.$row["mod_id"].'"><div><i class="fa fa-edit"></i></div></button>';
                    $sub_array[] = '<button type="button" class="btn btn-outline-danger btn-sm btn-icon" onClick="eliminar('.$row["mod_id"].')" id="'.$row["mod_id"].'"><div><i class="fa fa-trash"></i></div></button>';
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
            $datos=$modalidad->modalidad();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['mod_id']."'>".$row['mod_nombre']."</option>";
                }
                echo $html;
            }
            break;
            case "activo":
                $modalidad->update_estadoActivo($_POST["mod_id"]);
                break;
            case "inactivo":
                $modalidad->update_estadoInactivo($_POST["mod_id"]);
                break; 
            
     
    }
?>