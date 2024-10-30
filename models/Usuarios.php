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
                        $_SESSION["est"]=$resultado["est"];
                        
                        if($usu_rol == "ES" || $usu_rol == "EX" || $usu_rol == "GC"){
                            if($est == 0){
                                header("Location:".Conectar::ruta()."views/perfil.php");
                                exit();
                            }else{
                                header("Location:".Conectar::ruta()."views/postulacion.php");
                                exit();
                            }
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
                    $sql = "SELECT usu_correo FROM usuario WHERE usu_correo=?";
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
                            usuario.usu_id,
                            usuario.usu_nom,
                            usuario.usu_ape,
                            usuario.usu_correo,
                            usuario.usu_rol,
                            usuario.usu_pass,
                            usuario.est 
                            FROM usuario 
                            ";
            $sql=$usuario->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_usuariosXid($usu_id){
            $usuario=parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM usuario WHERE usu_id=?";
            $sql=$usuario->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function insert_usuarios($usu_nom,$usu_ape,$usu_correo,$usu_pass,$usu_rol){
            $usuario=parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO usuario(usu_id,usu_nom,usu_ape,usu_correo,usu_pass,usu_rol,fech_crea,estado)
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
        public function update_perfil($usu_id,$usu_pass){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuario
                    SET 
                    usu_pass = MD5(?)
                    WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_pass);
            $sql->bindValue(2,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_usuarios($usu_id,$usu_nom,$usu_ape,$usu_correo,$usu_pass,$usu_rol){
            $usuario=parent::Conexion();
            parent::set_names();
            $sql="UPDATE usuario
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
            $sql="UPDATE usuario SET est=0 WHERE usu_id=?";
            $sql=$usuario->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function update_estadoActivo($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuario SET est=1 WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuario SET est=0 WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

         public function usuario_correo($cedula){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT usu_correo, usu_pass FROM usuario WHERE est = 1 AND usu_correo=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cedula);
            $sql->execute();
            var_dump($sql);
            return $resultado = $sql->fetchAll();
        } 

        public function total_programas(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM programas";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }