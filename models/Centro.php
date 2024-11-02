<?php
    class Centro extends Conectar{
        public function insert_centro($cen_nom){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO centros (cen_id,cen_nom, est) VALUES (NULL,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cen_nom);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_centro($cen_id,$cen_nom){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE centros
                SET
                    cen_nom = ?
                WHERE
                    cen_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cen_nom);
            $sql->bindValue(2, $cen_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_centro($cen_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "DELETE FROM centros WHERE cen_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cen_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function centro(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM centros";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function centro_id($cen_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM centros WHERE est = 1 AND cen_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cen_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoActivo($cen_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE centros SET est=1 WHERE cen_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cen_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($cen_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE centros SET est=0 WHERE cen_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$cen_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>