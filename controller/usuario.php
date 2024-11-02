<?php
    require_once("../config/conexion.php");
    require_once("../models/Usuarios.php");
    $usuarios = new Usuario();
    /* require_once("../models/Email.php");
    $email = new Email(); */

    switch($_GET["opc"]){
        case "guardaryeditar":
            if(empty($_POST["usu_id"])){
                $usuarios->insert_usuarios($_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_rol"]);
            }else{
                $usuarios->update_usuarios($_POST["usu_id"],$_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_rol"]);
            }
            break;
        case "crear":
            $datos = $usuarios->get_correo($_POST["usu_correo"]);
            if(is_array($datos)==true and count($datos)==0){
                $usuarios->insert_usuarios($_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],"AS");
                echo 1;
            }else{
                echo 2;
            }
            break;
            /* $usuarios->insert_usuarios($_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],"AS");
            break; */
        /* case "emailBienvenida":
            $email->email_bienvenida($_POST["usu_correo"]);
            break; */
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
                    $sub_array[] = '<strong class="text-primary">Administrador</strong>';
                }elseif($row["usu_rol"] == 'ES'){
                    $sub_array[] = '<strong class="text-primary">Estudiante</strong>';
                }elseif($row["usu_rol"] == 'GC'){
                    $sub_array[] = '<strong class="text-primary">Gestor Conocimiento</strong>';
                }elseif($row["usu_rol"] == 'EX'){
                    $sub_array[] = '<strong class="text-primary">Externo</strong>';
                }else{
                    $sub_array[] = '<strong class="text-primary">Aspirante</strong>';
                }
                if($row["est"] == '1'){
                    $sub_array[] = "<button type='button' onClick='est_ina(".$row["usu_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                }else{
                    $sub_array[] = "<button type='button' onClick='est_act(".$row["usu_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                }
                $sub_array[] = '<button type="button" class="btn btn-outline-warning btn-icon btn-sm" onClick="editar('.$row["usu_id"].')" id="'.$row["usu_id"].'"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" class="btn btn-outline-danger btn-icon btn-sm" onClick="eliminar('.$row["usu_id"].')" id="'.$row["usu_id"].'"><div><i class="fa fa-trash"></i></div></button>';
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
        case "guardar_desde_excel":
            $usuarios->insert_usuarios($_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_rol"]);
            break;
        case "activo":
            $usuarios->update_estadoActivo($_POST["usu_id"]);
            break;
        case "inactivo":
            $usuarios->update_estadoInactivo($_POST["usu_id"]);
            break; 
    }