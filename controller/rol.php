<?php
    require_once("../config/conexion.php");
    require_once("../models/Rol.php");
    $rol = new Rol();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["rol_id"])){
                    $rol->insert_rol($_POST["rol_nombre"]);
                }else{
                    $rol->update_rol($_POST["rol_id"], $_POST["rol_nombre"]);
                }
                break;
        case "mostrar":
                $datos = $rol->roles_id($_POST["rol_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["rol_id"] = $row["rol_id"];
                        $output["rol_nombre"] = $row["rol_nombre"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $rol->delete_rol($_POST["rol_id"]);
                break;
        case "listar":
                $datos=$rol->roles_all();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["rol_nombre"];
                    if($row["est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='est_ina(".$row["rol_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='est_act(".$row["rol_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["rol_id"].');"  id="'.$row["rol_id"].'" class="btn btn-outline-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["rol_id"].');"  id="'.$row["rol_id"].'" class="btn btn-outline-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                    
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
                $datos=$rol->roles();
                if(is_array($datos)==true and count($datos)>0){
                    $html= " <option label='Seleccione'></option>";
                    foreach($datos as $row){
                        $html.= "<option value='".$row['rol_id']."'>".$row['rol_nombre']."</option>";
                    }
                    echo $html;
                }
                break;
        case "activo":
            $rol->update_estadoActivo($_POST["rol_id"]);
            break;
        case "inactivo":
            $rol->update_estadoInactivo($_POST["rol_id"]);
            break; 
            
     
    }
?>