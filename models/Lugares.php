<?php
    class Lugares extends Conectar{

        public function insert_lugares($area_id,$lug_nom,$lug_descrip,$lug_fecini,$lug_fecfin,$ext_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO lugares (lug_id, area_id, lug_nom, lug_descrip, lug_fecini, lug_fecfin, ext_id,lug_img, fech_crea, est) VALUES (NULL,?,?,?,?,?,?,'../../public/1.png', now(),'1');";
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
                lugares.lug_img,
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
            $sql="INSERT INTO lugares_usuario (lugd_id,lug_id,usu_id,fech_crea,est) VALUES (NULL,?,?,now(),1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $lug_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();

            $sql1="select last_insert_id() as 'lugd_id'";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetch(pdo::FETCH_ASSOC);
        }

        public function update_imagen_lugares($lug_id,$lug_img){
            $conectar= parent::conexion();
            parent::set_names();

            require_once("Lugares.php");
            $curx = new Lugares();
            $lug_img = '';
            if ($_FILES["lug_img"]["name"]!=''){
                $lug_img = $curx->upload_file();
            }

            $sql="UPDATE lugares
                SET
                    lug_img = ?
                WHERE
                    lug_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $lug_img);
            $sql->bindValue(2, $lug_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function upload_file(){
            if(isset($_FILES["lug_img"])){
                $extension = explode('.', $_FILES['lug_img']['name']);
                $new_name = rand() . '.' . $extension[1];
                $destination = '/Voluntariado/public/' . $new_name;
                move_uploaded_file($_FILES['lug_img']['tmp_name'], $destination);
                return "/Voluntariado/public/".$new_name;
            }
        }
    }
?>