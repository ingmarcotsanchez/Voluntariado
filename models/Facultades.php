<?php
    class Facultades extends Conectar{

        /* TODO: Obtener registros por id de categoria */
        public function get_facultades($cen_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM facultades WHERE cen_id=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cen_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_facultades2(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM facultades";
            $sql=$conectar->prepare($sql);
            //$sql->bindValue(1, $cen_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO: Obtener todos los registros sin filtro */
        public function get_facultades_all(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            facultades.fac_id,
            facultades.codigo,
            facultades.fac_nom,
            facultades.cen_id,
            centros.cen_nom
            FROM facultades INNER JOIN
            centros on facultades.cen_id = centros.cen_id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Insert */
        public function insert_facultades($codigo,$fac_nom,$cen_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO facultades (fac_id,codigo,fac_nom,cen_id) VALUES (NULL,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $codigo);
            $sql->bindValue(2, $fac_nom);
            $sql->bindValue(3, $cen_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update */
        public function update_facultades($fac_id,$codigo,$fac_nom,$cen_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE facultades set
                codigo = ?,
                fac_nom = ?,
                cen_id = ?
                WHERE
                fac_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $codigo);
            $sql->bindValue(2, $fac_nom);
            $sql->bindValue(3, $cen_id);
            $sql->bindValue(4, $fac_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete */
        public function delete_facultades($fac_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="DELETE FROM facultades
                WHERE 
                fac_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $fac_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Registro x id */
        public function get_facultades_x_id($fac_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM facultades WHERE fac_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $fac_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>