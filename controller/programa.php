<?php
    /* TODO:Cadena de Conexion */
    require_once("../config/conexion.php");
    /* TODO:Modelo Subcategoria */
    require_once("../models/Programas.php");
    $programas = new Programas();

    /*TODO: opciones del controlador Subcategoria*/
    switch($_GET["opc"]){
        /* TODO: Guardar y editar, guardar si el campo cats_id esta vacio */
        case "guardaryeditar":
            if(empty($_POST["prog_id"])){
                $programas->insert_programas($_POST["fac_id"],$_POST["cen_id"],$_POST["codigo"],$_POST["descripcion"]);     
            }else {
                $programas->update_programas($_POST["prog_id"],$_POST["fac_id"],$_POST["cen_id"],$_POST["codigo"],$_POST["descripcion"]);
            }
            break;
        /* TODO: Listado de prioridad segun formato json para el datatable */
        case "listar":
           
                $datos=$programas->get_programas_all();
                $data= Array();
                
                foreach($datos as $row){
                    $sub_array = array();
                    
                    $sub_array[] = $row["cen_nom"];
                    $sub_array[] = $row["fac_nom"];
                    $sub_array[] = $row["codigo"];
                    $sub_array[] = $row["descripcion"];
                    
                    $sub_array[] = '<button type="button" onClick="editar('.$row["prog_id"].');"  id="'.$row["prog_id"].'" class="btn btn-outline-warning btn-icon btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                        $sub_array[] = '<button type="button" onClick="eliminar('.$row["prog_id"].');"  id="'.$row["prog_id"].'" class="btn btn-outline-danger btn-icon btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                    
                    $data[] = $sub_array; 
                }
    
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
                break;
            
            
        /* TODO: Actualizar estado a 0 segun id de prioridad */
        case "eliminar":
            $programas->delete_programas($_POST["prog_id"]);
            break;
        /* TODO: Mostrar en formato JSON segun prio_id */
        case "mostrar";
            $datos=$programas->get_programas_x_id($_POST["prog_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["prog_id"] = $row["prog_id"];
                    
                    
                    $output["cen_id"] = $row["cen_id"];
                    $output["fac_id"] = $row["fac_id"];
                    $output["codigo"] = $row["codigo"];
                    $output["descripcion"] = $row["descripcion"];
                    
                }
                echo json_encode($output);
            }
            break;
        
        /* TODO: Formato para llenar combo en formato HTML */
        case "combo":
            $datos = $programas->get_programas($_POST["fac_id"]);
            $html="";
            $html.="<option label='Seleccionar'></option>";
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['prog_id']."'>".$row['descripcion']."</option>";
                }
                echo $html;
            }
            break;
    }
?>