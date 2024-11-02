<?php
    class Modalidad extends Conectar{
        public function insert_modalidad($mod_nombre){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO modalidad (mod_id,mod_nombre, est) VALUES (NULL,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $mod_nombre);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_modalidad($mod_id,$mod_nombre){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE modalidad
                SET
                    mod_nombre = ?
                WHERE
                    mod_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $mod_nombre);
            $sql->bindValue(2, $mod_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_modalidad($mod_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "DELETE FROM modalidad WHERE mod_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$mod_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function modalidad(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM modalidad";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function modalidad_id($mod_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM modalidad WHERE est = 1 AND mod_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$mod_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoActivo($mod_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE modalidad SET est=1 WHERE mod_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$mod_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($mod_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE modalidad SET est=0 WHERE mod_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$mod_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>