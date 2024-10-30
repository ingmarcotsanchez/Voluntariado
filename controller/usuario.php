<?php
    require_once("../config/conexion.php");
    require_once("../models/Usuarios.php");
    $usuarios = new Usuario();

    switch($_GET["opc"]){
        case "guardaryeditar":
            if(empty($_POST["usu_id"])){
                $usuarios->insert_usuarios($_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_rol"]);
            }else{
                $usuarios->update_usuarios($_POST["usu_id"],$_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_rol"]);
            }
            break;
        case "crear":
            $usuarios->insert_usuarios($_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_rol"]);
            break;
        case "mostrar":
            $datos=$usuarios->get_usuariosXid($_POST["usu_id"]);
            if(is_array($datos) == true and count($datos)<>0){
                foreach($datos as $row){
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_ape"] = $row["usu_ape"];
                    $output["usu_correo"] = $row["usu_correo"];
                    $output["usu_rol"] = $row["usu_rol"];
                    $output["usu_pass"] = $row["usu_pass"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $usuarios->delete_usuarios($_POST["usu_id"]);
            break;
        case "editPerfil":
            $usuarios->update_perfil($_POST["usu_id"],$_POST["passwd"]);
            break;
        case "listar":
            $datos=$usuarios->get_usuarios();
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["usu_nom"]." ".$row["usu_ape"] ;
                $sub_array[] = $row["usu_correo"];
                if($row["usu_rol"] == 'C'){
                    $sub_array[] = '<strong class="text-primary">Coordinador</strong>';
                }elseif($row["usu_rol"] == 'GM'){
                    $sub_array[] = '<strong class="text-primary">Gestor MAIE</strong>';
                }else{
                    $sub_array[] = '<strong class="text-primary">Invitador</strong>';
                }
                if($row["est"] == '1'){
                    $sub_array[] = "<button type='button' onClick='est_ina(".$row["usu_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                }else{
                    $sub_array[] = "<button type='button' onClick='est_act(".$row["usu_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                }
                $sub_array[] = '<button type="button" class="btn btn-outline-warning btn-icon" onClick="editar('.$row["usu_id"].')" id="'.$row["usu_id"].'"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" class="btn btn-outline-danger btn-icon" onClick="eliminar('.$row["usu_id"].')" id="'.$row["usu_id"].'"><div><i class="fa fa-minus"></i></div></button>';
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data
            );
            echo json_encode($results);
            break;
        
        case "activo":
            $usuarios->update_estadoActivo($_POST["usu_id"]);
            break;
        case "inactivo":
            $usuarios->update_estadoInactivo($_POST["usu_id"]);
            break; 
        case "total_Programas":
            $datos=$usuarios->total_programas();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        
    }