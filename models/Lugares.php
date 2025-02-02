<?php
    class Lugares extends Conectar{

        public function insert_lugares($area_id,$lug_nom,$lug_descrip,$lug_fecini,$lug_fecfin,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO lugares (lug_id, area_id, lug_nom, lug_descrip, lug_fecini, lug_fecfin, usu_id, fech_crea, est) VALUES (NULL,?,?,?,?,?,?, now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $area_id);
            $sql->bindValue(2, $lug_nom);
            $sql->bindValue(3, $lug_descrip);
            $sql->bindValue(5, $lug_fecfin);
            $sql->bindValue(4, $lug_fecini);
            $sql->bindValue(6, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_Mislugares($area_id,$lug_nom,$lug_descrip,$lug_fecini,$lug_fecfin,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO lugares (lug_id, area_id, lug_nom, lug_descrip, lug_fecini, lug_fecfin, usu_id, fech_crea, est) 
                                 VALUES (NULL,?,?,?,?,?,?, now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $area_id);
            $sql->bindValue(2, $lug_nom);
            $sql->bindValue(3, $lug_descrip);
            $sql->bindValue(5, $lug_fecfin);
            $sql->bindValue(4, $lug_fecini);
            $sql->bindValue(6, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_lugares($lug_id,$area_id,$lug_nom,$lug_descrip,$lug_fecini,$lug_fecfin,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE lugares
                SET
                    area_id =?,
                    lug_nom = ?,
                    lug_descrip = ?,
                    lug_fecini = ?,
                    lug_fecfin = ?,
                    usu_id = ?
                WHERE
                    lug_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $area_id);
            $sql->bindValue(2, $lug_nom);
            $sql->bindValue(3, $lug_descrip);
            $sql->bindValue(5, $lug_fecfin);
            $sql->bindValue(4, $lug_fecini);
            $sql->bindValue(6, $usu_id);
            $sql->bindValue(7, $lug_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function update_Mislugares($lug_id,$area_id,$lug_nom,$lug_descrip,$lug_fecini,$lug_fecfin){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE lugares
                SET
                    area_id =?,
                    lug_nom = ?,
                    lug_descrip = ?,
                    lug_fecini = ?,
                    lug_fecfin = ?
                    
                WHERE
                    lug_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $area_id);
            $sql->bindValue(2, $lug_nom);
            $sql->bindValue(3, $lug_descrip);
            $sql->bindValue(5, $lug_fecfin);
            $sql->bindValue(4, $lug_fecini);
            $sql->bindValue(6, $lug_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_lugares($lug_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE lugares
                SET
                    est = 0
                WHERE
                    lug_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $lug_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_lugares(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                lugares.lug_id,
                lugares.lug_nom,
                lugares.lug_descrip,
                lugares.lug_fecini,
                lugares.lug_fecfin,
                lugares.area_id,
                areas.area_nom,
                lugares.usu_id,
                usuarios.usu_nom,
                usuarios.usu_ape,
                usuarios.usu_correo,
               /*  usuarios.usu_telf, */
                lugares.est
                FROM lugares
                LEFT JOIN areas on lugares.area_id = areas.area_id
                LEFT JOIN usuarios on lugares.usu_id = usuarios.usu_id
                /* WHERE lugares.est = 1 */";
            $sql=$conectar->prepare($sql);
            
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_lugaresxRol($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                lugares.lug_id,
                lugares.lug_nom,
                lugares.lug_descrip,
                lugares.lug_fecini,
                lugares.lug_fecfin,
                lugares.area_id,
                areas.area_nom,
                lugares.usu_id,
                lugares.est
                FROM lugares
                INNER JOIN areas on lugares.area_id = areas.area_id
                WHERE lugares.est = 1 AND lugares.usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_lugares_id($lug_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM lugares WHERE est = 1 AND lug_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $lug_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_lugares_usuario($lugd_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE lugares_usuario
                SET
                    est = 0
                WHERE
                    lugd_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $lugd_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Insert Curso por Usuario */
        public function insert_lugares_usuario($lug_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO lugares_usuarios (lugd_id,lug_id,usu_id,fech_crea,est) VALUES (NULL,?,?,now(),1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $lug_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
            
        }

        public function get_lugares_usuario($lug_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM lugares_usuarios WHERE lug_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $lug_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_lugares_usuario_join($lug_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            lugares_usuarios.lugd_id,
            lugares_usuarios.lug_id,
            lugares_usuarios.usu_id,
            usuarios.usu_nom,
            usuarios.usu_ape,
            lugares_usuarios.fech_crea,
            lugares_usuarios.est
            FROM lugares_usuarios 
            INNER JOIN usuarios on lugares_usuarios.usu_id = usuarios.usu_id
            WHERE lug_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $lug_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_estadoTerminado($lug_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE lugares_usuarios SET est=1 WHERE lug_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$lug_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoProceso($lug_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE lugares_usuarios SET est=0 WHERE lug_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$lug_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>