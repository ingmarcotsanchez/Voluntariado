<?php
    class Lugares extends Conectar{

        public function insert_lugares($area_id,$lug_nom,$lug_descrip,$lug_fecini,$lug_fecfin,$ext_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO lugares (lug_id, area_id, lug_nom, lug_descrip, lug_fecini, lug_fecfin, ext_id, fech_crea, est) VALUES (NULL,?,?,?,?,?,?, now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $area_id);
            $sql->bindValue(2, $lug_nom);
            $sql->bindValue(3, $lug_descrip);
            $sql->bindValue(5, $lug_fecfin);
            $sql->bindValue(4, $lug_fecini);
            $sql->bindValue(6, $ext_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_lugares($lug_id,$area_id,$lug_nom,$lug_descrip,$lug_fecini,$lug_fecfin,$ext_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE lugares
                SET
                    area_id =?,
                    lug_nom = ?,
                    lug_descrip = ?,
                    lug_fecini = ?,
                    lug_fecfin = ?,
                    ext_id = ?
                WHERE
                    lug_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $area_id);
            $sql->bindValue(2, $lug_nom);
            $sql->bindValue(3, $lug_descrip);
            $sql->bindValue(5, $lug_fecfin);
            $sql->bindValue(4, $lug_fecini);
            $sql->bindValue(6, $ext_id);
            $sql->bindValue(7, $lug_id);
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
                lugares.ext_id,
                externos.ext_nom,
                externos.ext_ape,
                externos.ext_correo,
                externos.ext_telf,
                lugares.est
                FROM lugares
                INNER JOIN areas on lugares.area_id = areas.area_id
                INNER JOIN externos on lugares.ext_id = externos.ext_id
                WHERE lugares.est = 1";
            $sql=$conectar->prepare($sql);
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

        

        
    }
?>