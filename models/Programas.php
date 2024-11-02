<?php
    class Programas extends Conectar{

        /* TODO: Obtener registros por id de categoria */
        public function get_programas($cen_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM programas WHERE cen_id=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cen_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        /* TODO: Obtener todos los registros sin filtro */
        public function get_programas_all(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            programas.prog_id,
            programas.fac_id,
            facultades.fac_nom,
            programas.cen_id,
            centros.cen_nom,
            programas.codigo,
            programas.descripcion
            FROM programas 
            INNER JOIN centros on programas.cen_id = centros.cen_id
            INNER JOIN facultades on programas.fac_id = facultades.fac_id
            ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Insert */
        public function insert_programas($fac_id,$cen_id,$codigo,$descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO programas(prog_id,fac_id,cen_id,codigo,descripcion) VALUES (NULL,?,?,?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $fac_id);
            $sql->bindValue(2, $cen_id);
            $sql->bindValue(3, $codigo);
            $sql->bindValue(4, $descripcion);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update */
        public function update_programas($prog_id,$fac_id,$cen_id,$codigo,$descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE programas SET
                fac_id = ?,
                cen_id = ?,
                codigo = ?,
                descripcion = ?
                WHERE
                prog_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $fac_id);
            $sql->bindValue(2, $cen_id);
            $sql->bindValue(3, $codigo);
            $sql->bindValue(4, $descripcion);
            $sql->bindValue(5, $prog_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete */
        public function delete_programas($prog_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="DELETE FROM programas
                WHERE 
                prog_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prog_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Registro x id */
        public function get_programas_x_id($prog_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM centros WHERE prog_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prog_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        

    }
?>