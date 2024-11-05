<?php
    require_once("../config/conexion.php");
    require_once("../models/Usuarios.php");
    $usuarios = new Usuario();
    /* require_once("../models/Email.php");
    $email = new Email(); */

    switch($_GET["opc"]){
        case "guardaryeditar":
            if(empty($_POST["usu_id"])){
                $usuarios->insert_usuarios($_POST["usu_tipo"],$_POST["usu_dni"],$_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_rol"],$_POST["cen_id"],$_POST["fac_id"],$_POST["prog_id"]);
            }else{
                $usuarios->update_usuarios($_POST["usu_id"],$_POST["usu_tipo"],$_POST["usu_dni"],$_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_rol"],$_POST["cen_id"],$_POST["fac_id"],$_POST["prog_id"]);
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
        case "mostrar":
            $datos=$usuarios->get_usuariosXid($_POST["usu_id"]);
            if(is_array($datos) == true and count($datos)<>0){
                foreach($datos as $row){
                    $output["usu_tipo"] = $row["usu_tipo"];
                    $output["usu_dni"] = $row["usu_dni"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_ape"] = $row["usu_ape"];
                    $output["usu_correo"] = $row["usu_correo"];
                    $output["usu_rol"] = $row["usu_rol"];
                    $output["usu_pass"] = $row["usu_pass"];
                    $output["cen_id"] = $row["cen_id"];
                    $output["fac_id"] = $row["fac_id"];
                    $output["prog_id"] = $row["prog_id"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $usuarios->delete_usuarios($_POST["usu_id"]);
            break;
        case "editPerfil":
            $usuarios->update_perfil($_POST["usu_id"],$_POST["usu_tipo"],$_POST["usu_dni"],$_POST["usu_pass"],$_POST["cen_id"],$_POST["fac_id"],$_POST["prog_id"]);
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
            $usuarios->insert_usuarios($_POST["usu_tipo"],$_POST["usu_dni"],$_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_rol"],$_POST["cen_id"],$_POST["fac_id"],$_POST["prog_id"]);
            break;
        case "activo":
            $usuarios->update_estadoActivo($_POST["usu_id"]);
            break;
        case "inactivo":
            $usuarios->update_estadoInactivo($_POST["usu_id"]);
            break; 
        case "listar_cursos":
            $datos=$usuarios->get_lugares_x_usuario($_POST["usu_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["lug_nom"];
                $sub_array[] = $row["lug_fecini"];
                $sub_array[] = $row["lug_fecfin"];
                $sub_array[] = $row["ext_nom"]." ".$row["ext_ape"];
                $sub_array[] = '<button type="button" onClick="certificado('.$row["lugd_id"].');"  id="'.$row["lugd_id"].'" class="btn btn-outline-primary btn-icon btn-sm"><div><i class="fa fa-eye"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;
        case "listar_cursos_top10":
            $datos=$usuario->get_lugaress_x_usuario_top10($_POST["usu_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["lug_nom"];
                $sub_array[] = $row["lug_fecini"];
                $sub_array[] = $row["lug_fecfin"];
                $sub_array[] = $row["ext_nom"]." ".$row["ext_ape"];
                $sub_array[] = '<button type="button" onClick="certificado('.$row["lugd_id"].');"  id="'.$row["lugd_id"].'" class="btn btn-outline-primary btn-icon btn-sm"><div><i class="fa fa-id-card-o"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;
    
        case "mostrar_curso_detalle":
            $datos = $usuarios->get_lugares_x_id_detalle($_POST["lugd_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["lugd_id"] = $row["lugd_id"];
                    $output["lug_id"] = $row["lug_id"];
                    $output["lug_nom"] = $row["lug_nom"];
                    $output["lug_descrip"] = $row["lug_descrip"];
                    $output["lug_fecini"] = $row["lug_fecini"];
                    $output["lug_fecfin"] = $row["lug_fecfin"];
                    $output["lug_img"] = $row["lug_img"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_ape"] = $row["usu_ape"];
                    $output["ext_id"] = $row["ext_id"];
                    $output["ext_nom"] = $row["ext_nom"];
                    $output["ext_ape"] = $row["ext_ape"];
                }

                echo json_encode($output);
            }
            break;
        case "total":
            $datos=$usuarios->get_total_lugares_x_usuario($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "consulta_dni":
            $datos = $usuarios->get_usuario_x_dni($_POST["usu_dni"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_ape"] = $row["usu_ape"];
                    $output["usu_correo"] = $row["usu_correo"];
                    $output["usu_pass"] = $row["usu_pass"];
                    $output["usu_telf"] = $row["usu_telf"];
                    $output["rol_id"] = $row["rol_id"];
                    $output["usu_dni"] = $row["usu_dni"];
                }
                echo json_encode($output);
            }
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