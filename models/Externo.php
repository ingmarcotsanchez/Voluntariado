<?php
    class Externo extends Conectar{

        public function insert_externo($ext_nom,$ext_ape,$ext_correo,$ext_telf){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO externos (ext_id, ext_nom, ext_ape, ext_correo, ext_telf, fech_crea, est) VALUES (NULL,?,?,?,?, now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ext_nom);
            $sql->bindValue(2, $ext_ape);
            $sql->bindValue(3, $ext_correo);
            $sql->bindValue(4, $ext_telf);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_externo($ext_id,$ext_nom,$ext_ape,$ext_correo,$ext_telf){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE externos
                SET
                    ext_nom = ?,
                    ext_ape = ?,
                    ext_correo = ?,
                    ext_telf = ?
                WHERE
                    ext_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ext_nom);
            $sql->bindValue(2, $ext_ape);
            $sql->bindValue(3, $ext_correo);
            $sql->bindValue(4, $ext_telf);
            $sql->bindValue(5, $ext_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_externo($ext_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE externos
                SET
                    est = 0
                WHERE
                    ext_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ext_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_externo(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM externos WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_externo_id($ext_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM externos WHERE est = 1 AND ext_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ext_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>