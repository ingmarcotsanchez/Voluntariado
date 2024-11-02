<?php
    /* TODO:Cadena de Conexion */
    require_once("../config/conexion.php");
    /* TODO:Modelo Subcategoria */
    require_once("../models/Facultades.php");
    $facultades = new Facultades();

    /*TODO: opciones del controlador Subcategoria*/
    switch($_GET["opc"]){
        /* TODO: Guardar y editar, guardar si el campo cats_id esta vacio */
        case "guardaryeditar":
            if(empty($_POST["fac_id"])){
                $facultades->insert_facultades($_POST["codigo"],$_POST["fac_nom"],$_POST["cen_id"]);     
            }else {
                $facultades->update_facultades($_POST["fac_id"],$_POST["codigo"],$_POST["fac_nom"],$_POST["cen_id"]);
            }
            break;
        /* TODO: Listado de prioridad segun formato json para el datatable */
        case "listar":
            $datos=$facultades->get_facultades_all();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["codigo"];
                $sub_array[] = $row["fac_nom"];
                $sub_array[] = $row["cen_nom"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["fac_id"].');"  id="'.$row["fac_id"].'" class="btn btn-outline-warning btn-icon btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["fac_id"].');"  id="'.$row["fac_id"].'" class="btn btn-outline-danger btn-icon btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
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
            $facultades->delete_facultades($_POST["fac_id"]);
            break;
        /* TODO: Mostrar en formato JSON segun prio_id */
        case "mostrar";
            $datos=$facultades->get_facultades_x_id($_POST["fac_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["fac_id"] = $row["fac_id"];
                    $output["codigo"] = $row["codigo"];
                    $output["fac_nom"] = $row["fac_nom"];
                    $output["cen_id"] = $row["cen_id"];
                    
                }
                echo json_encode($output);
            }
            break;
        /* TODO: Formato para llenar combo en formato HTML */
        case "combo":
            $datos = $facultades->get_facultades($_POST["cen_id"]);
            $html="";
            $html.="<option label='Seleccionar'></option>";
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['fac_id']."'>".$row['codigo']."-".$row['fac_nom']."</option>";
                }
                echo $html;
            }
            break;
        case "combo2":
            $datos = $facultades->get_facultades2();
            $html="";
            $html.="<option label='Seleccionar'></option>";
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['fac_id']."'>".$row['codigo']."-".$row['fac_nom']."</option>";
                }
                echo $html;
            }
            break;
    }
?>