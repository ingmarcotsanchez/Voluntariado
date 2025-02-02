<?php
    /*TODO: Llamando a cadena de Conexion */
    require_once("../config/conexion.php");
    /*TODO: Llamando a la clase */
    require_once("../models/Lugares.php");
    /*TODO: Inicializando Clase */
    $lugares = new Lugares();
    $usu_rol = $_SESSION["usu_rol"];
    $ext_id = $_SESSION["usu_id"];
    /*TODO: Opcion de solicitud de controller */
    switch($_GET["opc"]){
        /*TODO: Guardar y editar cuando se tenga el ID */
        case "guardaryeditar":
            if(empty($_POST["lug_id"])){
                $lugares->insert_lugares($_POST["area_id"],$_POST["lug_nom"],$_POST["lug_descrip"],$_POST["lug_fecini"],$_POST["lug_fecfin"],$_POST["usu_id"]);
            }else{
                $lugares->update_lugares($_POST["lug_id"],$_POST["area_id"],$_POST["lug_nom"],$_POST["lug_descrip"],$_POST["lug_fecini"],$_POST["lug_fecfin"],$_POST["usu_id"]);
            }
            break;
        case "guardaryeditar2":
            if(empty($_POST["lug_id"])){
                $lugares->insert_Mislugares($_POST["area_id"],$_POST["lug_nom"],$_POST["lug_descrip"],$_POST["lug_fecini"],$_POST["lug_fecfin"],$ext_id);
            }else{
                $lugares->update_Mislugares($_POST["lug_id"],$_POST["area_id"],$_POST["lug_nom"],$_POST["lug_descrip"],$_POST["lug_fecini"],$_POST["lug_fecfin"]);
            }
            break;
        /*TODO: Creando Json segun el ID */
        case "mostrar":
            $datos = $lugares->get_lugares_id($_POST["lug_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["lug_id"] = $row["lug_id"];
                    $output["area_id"] = $row["area_id"];
                    $output["lug_nom"] = $row["lug_nom"];
                    $output["lug_descrip"] = $row["lug_descrip"];
                    $output["lug_fecini"] = $row["lug_fecini"];
                    $output["lug_fecfin"] = $row["lug_fecfin"];
                    $output["usu_id"] = $row["usu_id"];
                }
                echo json_encode($output);
            }
            break;
            
        /*TODO: Eliminar segun ID */
        case "eliminar":
            $lugares->delete_lugares($_POST["lug_id"]);
            break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
        case "listar":
            $datos=$lugares->get_lugares();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["area_nom"];
                $sub_array[] = $row["lug_nom"];
                $sub_array[] = $row["lug_fecini"];
                $sub_array[] = $row["lug_fecfin"];
                //$sub_array[] = $row["ext_nom"] ." ". $row["ext_ape"];
                if($row["est"] == '1'){
                    $sub_array[] = "<button type='button' onClick='est_ina(".$row["lug_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                }else{
                    $sub_array[] = "<button type='button' onClick='est_act(".$row["lug_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                }
                if($usu_rol == 'C'){
                    $sub_array[] = '<button type="button" onClick="editar('.$row["lug_id"].');"  id="'.$row["lug_id"].'" class="btn btn-outline-warning btn-icon btn-sm"><div><i class="fa fa-edit"></i></div></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["lug_id"].');"  id="'.$row["lug_id"].'" class="btn btn-outline-danger btn-icon btn-sm"><div><i class="fa fa-trash"></i></div></button>';                
                    $sub_array[] = '<button disabled type="button" onClick="inscribir('.$row["lug_id"].');"  id="'.$row["lug_id"].'" class="btn btn-outline-success btn-icon btn-sm"><div><i class="fa fa-users"></i></div></button>';
                }else{
                    $sub_array[] = '<button disabled type="button" onClick="editar('.$row["lug_id"].');"  id="'.$row["lug_id"].'" class="btn btn-outline-warning btn-icon btn-sm"><div><i class="fa fa-edit"></i></div></button>';
                    $sub_array[] = '<button type="button" onClick="info('.$row["lug_id"].');"  id="'.$row["lug_id"].'" class="btn btn-outline-dark btn-icon btn-sm"><div><i class="fa fa-eye"></i></div></button>';
                    $sub_array[] = '<button type="button" onClick="inscribir('.$row["lug_id"].');"  id="'.$row["lug_id"].'" class="btn btn-outline-success btn-icon btn-sm"><div><i class="fa fa-user"></i></div></button>';
                }
                
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        case "listarxRol":
            $usu_id=$_SESSION["usu_id"];
            $datos=$lugares->get_lugaresxRol($usu_id);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["area_nom"];
                $sub_array[] = $row["lug_nom"];
                $sub_array[] = $row["lug_fecini"];
                $sub_array[] = $row["lug_fecfin"];
                if($row["est"] == '1'){
                    $sub_array[] = "<button type='button' onClick='est_ina(".$row["lug_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                }else{
                    $sub_array[] = "<button type='button' onClick='est_act(".$row["lug_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                }
                
                $sub_array[] = '<button type="button" onClick="editar('.$row["lug_id"].');"  id="'.$row["lug_id"].'" class="btn btn-outline-warning btn-icon btn-sm"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button disabled type="button" onClick="eliminar('.$row["lug_id"].');"  id="'.$row["lug_id"].'" class="btn btn-outline-danger btn-icon btn-sm"><div><i class="fa fa-trash"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="inscritos('.$row["lug_id"].');"  id="'.$row["lug_id"].'" class="btn btn-outline-success btn-icon btn-sm"><div><i class="fa fa-users"></i></div></button>';
                
                
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
            $datos=$lugares->get_lugares();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['lug_id']."'>".$row['lug_nom']."</option>";
                }
                echo $html;
            }
            break;

        /*TODO: Insetar detalle de curso usuario */
        case "insert_lugares_usuario":
            /*TODO: Array de usuario separado por comas */
            $usu_id = $_SESSION['usu_id'];
            /*TODO: Registrar tantos usuarios vengan de la vista */
            $lugares->insert_lugares_usuario($_POST["lug_id"],$usu_id);
            break;
        case "mostrar_lugares_usuario":
            $datos=$lugares->get_lugares_usuario($_POST["lug_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["usu_nom"] ." ". $row["usu_ape"];
                $sub_array[] = $row["fech_crea"];
                 if($row["est"] == '1'){
                    $sub_array[] = "<button type='button' onClick='est_ina(".$row["lug_id"].");' class='btn btn-success btn-sm'>Activo</button>";
                }else{
                    $sub_array[] = "<button type='button' onClick='est_act(".$row["lug_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                }
              
                
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "generar_qr":
            require 'phpqrcode/qrlib.php';
            //Primer Parametro - Text del QR
            //Segundo Parametro - Ruta donde se guardara el archivo
            QRcode::png(conectar::ruta()."views/certificado.php?lugd_id=".$_POST["lugd_id"],"../public/qr/".$_POST["lugd_id"].".png",'L',32,5);
            break;

        case "terminado":
            $lugares->update_estadoTerminado($_POST["lug_id"]);
            break;
        case "proceso":
            $lugares->update_estadoProceso($_POST["lug_id"]);
            break; 

    }
?>