<?php
    class Area extends Conectar{
        public function insert_area($area_nom){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO areas (area_id,area_nom, est) VALUES (NULL,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $area_nom);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_area($area_id,$area_nom){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE areas
                SET
                    area_nom = ?
                WHERE
                    area_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $area_nom);
            $sql->bindValue(2, $area_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_area($area_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "DELETE FROM areas WHERE area_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$area_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function area(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM areas";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function area_id($area_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM areas WHERE est = 1 AND area_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$area_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoActivo($area_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE areas SET est=1 WHERE area_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$area_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($area_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE areas SET est=0 WHERE area_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$area_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>