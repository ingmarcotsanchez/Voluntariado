<?php
    class Usuario extends Conectar{
        public function login(){
            $conectar = parent::Conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $usu_correo = $_POST["usu_correo"];
                $usu_pass = $_POST["usu_pass"];
                $usu_rol = $_POST["usu_rol"];
                $est = 0;

                if(empty($usu_correo) and empty($usu_pass)){
                    header("Location:".Conectar::ruta()."index.php?m=2");
                    exit();
                }else{
                    
                    $sql = "SELECT * FROM usuarios WHERE usu_correo=? and usu_pass=MD5(?) and usu_rol=? and est=1";
                    $stmt = $conectar->prepare($sql);
                    $stmt->bindValue(1,$usu_correo);
                    $stmt->bindValue(2,$usu_pass);
                    $stmt->bindValue(3,$usu_rol);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    
                    if(is_array($resultado) and count($resultado)>0){
                        $_SESSION["usu_id"]=$resultado["usu_id"];
                        $_SESSION["usu_nom"]=$resultado["usu_nom"];
                        $_SESSION["usu_ape"]=$resultado["usu_ape"];
                        $_SESSION["usu_correo"]=$resultado["usu_correo"];
                        $_SESSION["usu_rol"]=$resultado["usu_rol"];
                        //$_SESSION["est"]=$resultado["est"];
                        
                        if(/* $usu_rol == "ES" || */ $usu_rol == "EX" || $usu_rol == "GC" || $usu_rol == "AS"){
                            //if($est == 0){
                                header("Location:".Conectar::ruta()."views/perfil.php");
                                exit();
                            //}else{
                            /*     header("Location:".Conectar::ruta()."views/postulacion.php");
                                exit();
                            } */
                        }else{
                            header("Location:".Conectar::ruta()."views/home.php");
                            exit();
                        }
                        
                    }else{
                        header("Location:".Conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        } 

        public function recuperar(){
            $conectar = parent::Conexion();
            parent::set_names();
            
            if(isset($_POST["enviar"])){
                $usuario = $_POST["usu_correo"];
                
                if(empty($usuario)){
                    header("Location:".Conectar::ruta()."recuperar.php?m=3");
                    exit();
                }elseif(!empty($usuario)){
                    $sql = "SELECT usu_correo FROM usuarios WHERE usu_correo=?";
                    $stmt = $conectar->prepare($sql);
                    $stmt->bindValue(1,$usuario);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    var_dump($resultado);
                    if($resultado == false){
                        header("Location:".Conectar::ruta()."recuperar.php?m=1");
                        exit();
                    }else{
                        $clave = substr( md5(microtime()), 1, 10);
                        $updateClave = "UPDATE usuario SET usu_pass=MD5('$clave') WHERE usu_correo=? ";
                        $stmt = $conectar->prepare($updateClave);
                        $stmt->bindValue(1,$usuario);
                        $stmt->execute();
                        $resultado = $stmt->fetch();
                        header("Location:".Conectar::ruta()."recuperar.php?m=2&nc=".$clave);
                        exit();
                    }
                }else{
                    header("Location:".Conectar::ruta()."recuperar.php");
                    exit();
                }
                

            }

        }

        public function get_usuarios(){
            $usuario = parent::Conexion();
            parent::set_names();
            //$sql="SELECT * FROM usuarios";
            $sql = "SELECT 
                            usuarios.usu_id,
                            usuarios.usu_nom,
                            usuarios.usu_ape,
                            usuarios.usu_correo,
                            usuarios.usu_rol,
                            usuarios.usu_pass,
                            usuarios.est 
                            FROM usuarios 
                            ";
            $sql=$usuario->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_usuariosXid($usu_id){
            $usuario=parent::Conexion();
            parent::set_names();
            //$sql="SELECT * FROM usuarios WHERE usu_id=?";
            $sql="SELECT 
                        usuarios.usu_id,
                        usuarios.usu_tipo,
                        usuarios.usu_dni,
                        usuarios.usu_nom,
                        usuarios.usu_ape,
                        usuarios.usu_correo,
                        usuarios.usu_pass,
                        usuarios.usu_rol, 
                        usuarios.cen_id,
                        centros.cen_nom,
                        usuarios.fac_id,
                        facultades.fac_nom,
                        usuarios.prog_id,
                        programas.descripcion
                FROM usuarios INNER JOIN
                centros ON usuarios.cen_id = centros.cen_id INNER JOIN
                facultades ON usuarios.fac_id = facultades.fac_id INNER JOIN
                programas ON usuarios.prog_id = programas.prog_id
                WHERE usu_id = ?";
            $sql=$usuario->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*ingresar un registro de usuarios*/
        public function get_correo($usu_correo) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql="select * from usuarios where usu_correo=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_correo);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function insert_usuarios($usu_nom,$usu_ape,$usu_correo,$usu_pass){
            $usuario=parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO usuarios(usu_id,usu_nom,usu_ape,usu_correo,usu_pass,fech_crea,estado)
                    VALUES(NULL,?,?,?,MD5(?),now(),1)";
            $sql=$usuario->prepare($sql);
            $sql->bindValue(1,$usu_nom);
            $sql->bindValue(2,$usu_ape);
            $sql->bindValue(3,$usu_correo);
            $sql->bindValue(4,$usu_pass);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function crear_usuarios($usu_nom,$usu_ape,$usu_correo,$usu_pass,$usu_rol){
            $usuario=parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO usuarios(usu_id,usu_nom,usu_ape,usu_correo,usu_pass,usu_rol,fech_crea,est)
                    VALUES(NULL,?,?,?,MD5(?),?,now(),1)";
            $sql=$usuario->prepare($sql);
            $sql->bindValue(1,$usu_nom);
            $sql->bindValue(2,$usu_ape);
            $sql->bindValue(3,$usu_correo);
            $sql->bindValue(4,$usu_pass);
            $sql->bindValue(5,$usu_rol);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
         /* fin de ingresar un registro de usuarios*/
        public function update_perfil($usu_id,$usu_tipo,$usu_dni,$usu_pass,$cen_id,$fac_id,$prog_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuarios
                    SET 
                    usu_tipo = ?,
                    usu_dni = ?,
                    usu_pass = MD5(?),
                    cen_id = ?,
                    fac_id = ?,
                    prog_id = ?
                    WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_tipo);
            $sql->bindValue(2,$usu_dni);
            $sql->bindValue(3,$usu_pass);
            $sql->bindValue(4,$cen_id);
            $sql->bindValue(5,$fac_id);
            $sql->bindValue(6,$prog_id);
            $sql->bindValue(7,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_usuarios($usu_id,$usu_nom,$usu_ape,$usu_correo,$usu_pass,$usu_rol){
            $usuario=parent::Conexion();
            parent::set_names();
            $sql="UPDATE usuarios
                    SET usu_nom=?,
                        usu_ape=?,
                        usu_correo=?,
                        usu_pass=MD5(?),
                        usu_rol=?,
                        fech_mod=now()
                    WHERE usu_id=?";
            $sql=$usuario->prepare($sql);
            $sql->bindValue(1,$usu_nom);
            $sql->bindValue(2,$usu_ape);
            $sql->bindValue(3,$usu_correo);
            $sql->bindValue(4,$usu_pass);
            $sql->bindValue(5,$usu_rol);
            $sql->bindValue(6,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        
        public function delete_usuarios($usu_id){
            $usuario=parent::Conexion();
            parent::set_names();
            $sql="UPDATE usuarios SET est=0 WHERE usu_id=?";
            $sql=$usuario->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function update_estadoActivo($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuarios SET est=1 WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuarios SET est=0 WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

         public function usuario_correo($cedula){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT usu_correo, usu_pass FROM usuarios WHERE est = 1 AND usu_correo=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cedula);
            $sql->execute();
            var_dump($sql);
            return $resultado = $sql->fetchAll();
        } 


        public function get_lugares_x_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                lugares_usuarios.lugd_id,
                lugares.lug_id,
                lugares.lug_nom,
                lugares.lug_descrip,
                lugares.lug_fecini,
                lugares.lug_fecfin,
                usuarios.usu_id,
                usuarios.usu_nom,
                usuarios.usu_ape,
                usuarios.usu_dni,
                externos.ext_id,
                externos.ext_nom,
                externos.ext_ape,
                lugares_usuarios.est
                FROM lugares_usuarios INNER JOIN 
                lugares ON lugares_usuarios.lug_id = lugares.lug_id INNER JOIN
                usuarios ON lugares_usuarios.usu_id = usuarios.usu_id INNER JOIN
                externos ON lugares.ext_id = externos.ext_id
                WHERE 
                lugares_usuarios.usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_lugares_x_usuario_top10($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                lugares_usuarios.lugd_id,
                lugares.lug_id,
                lugares.lug_nom,
                lugares.lug_descrip,
                lugares.lug_fecini,
                lugares.lug_fecfin,
                usuarios.usu_id,
                usuarios.usu_nom,
                usuarios.usu_ape,
                usuarios.usu_dni,
                externos.ext_id,
                externos.ext_nom,
                externos.ext_ape
                FROM lugares_usuarios INNER JOIN 
                lugares ON lugares_usuarios.lug_id = lugares.lug_id INNER JOIN
                usuarios ON lugares_usuarios.usu_id = usuarios.usu_id INNER JOIN
                externos ON lugares.ext_id = externos.ext_id
                WHERE 
                lugares_usuarios.usu_id = ?
                AND lugares_usuarios.est = 1
                LIMIT 10";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_lugares_usuario_x_id($lug_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                lugares_usuarios.lugd_id,
                lugares.lug_id,
                lugares.lug_nom,
                lugares.lug_descrip,
                lugares.lug_fecini,
                lugares.lug_fecfin,
                usuarios.usu_id,
                usuarios.usu_nom,
                usuarios.usu_ape,
                usuarios.usu_dni,
                externos.ext_id,
                externos.ext_nom,
                externos.ext_ape
                FROM lugares_usuarios INNER JOIN 
                lugares ON lugares_usuarios.lug_id = lugares.lug_id INNER JOIN
                usuarios ON lugares_usuarios.usu_id = usuarios.usu_id INNER JOIN
                externos ON lugares.ext_id = externos.ext_id
                WHERE 
                lugares.lug_id = ?
                AND lugares_usuarios.est = 1
                ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $lug_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_lugares_x_id_detalle($lugd_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                lugares_usuarios.lugd_id,
                lugares.lug_id,
                lugares.lug_nom,
                lugares.lug_descrip,
                lugares.lug_fecini,
                lugares.lug_fecfin,
                usuarios.usu_id,
                usuarios.usu_nom,
                usuarios.usu_ape,
                usuarios.usu_dni,
                lugares.lug_img,
                externos.ext_id,
                externos.ext_nom,
                externos.ext_ape
                FROM lugares_usuarios INNER JOIN 
                lugares ON lugares_usuarios.lug_id = lugares.lug_id INNER JOIN
                usuarios ON lugares_usuarios.usu_id = usuarios.usu_id INNER JOIN
                externos ON lugares.ext_id = externos.ext_id
                WHERE 
                lugares_usuarios.lugd_id = ?
                ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $lugd_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Cantidad de Cursos por Usuario */
        public function get_total_lugares_x_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM lugares_usuarios WHERE usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Mostrar los datos del usuario segun el DNI */
        public function get_usuario_x_dni($usu_dni){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM usuarios WHERE est=1 AND usu_dni=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_dni);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }