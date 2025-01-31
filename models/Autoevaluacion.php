<?php
    class Autoevaluacion extends Conectar{
            
        
        public function get_evaluacionXid($rank_id){
            $usuario=parent::Conexion();
            parent::set_names();
            //$sql="SELECT * FROM usuarios WHERE usu_id=?";
            $sql="SELECT 
                        lugar_ranking.rank_id,
                        lugar.lug_id,
                        lugar.lug_nom,
                        usuarios.usu_id,
                        usuarios.usu_nom,
                        usuarios.usu_ape,
                        lugar_ranking.rating
                FROM lugar_ranking INNER JOIN
                lugares ON lugar_ranking.lug_id = lugares.lug_id INNER JOIN
                usuarios ON lugar_ranking.usu_id = usuarios.usu_id
                WHERE rank_id = ?";
            $sql=$usuario->prepare($sql);
            $sql->bindValue(1,$rank_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*ingresar un registro de usuarios*/
        
        public function insert_evaluacion($lug_id,$usu_id,$rating){
            $usuario=parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO lugar_ranking(rank_id,lug_id,usu_id,rating,est)
                    VALUES(NULL,?,?,?,1";
            $sql=$usuario->prepare($sql);
            $sql->bindValue(1,$lug_id);
            $sql->bindValue(2,$usu_id);
            $sql->bindValue(3,$rating);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        
         /* fin de ingresar un registro de usuarios*/
        
        public function update_evaluacion($rank_id,$lug_id,$usu_id,$rating){
            $usuario=parent::Conexion();
            parent::set_names();
            $sql="UPDATE lugar_ranking
                    SET lug_id=?,
                        usu_id=?,
                        rating=?,
                    WHERE rank_id=?";
            $sql=$usuario->prepare($sql);
            $sql->bindValue(1,$lug_id);
            $sql->bindValue(2,$usu_id);
            $sql->bindValue(3,$rating);
            $sql->bindValue(4,$rank_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        
        public function delete_autoevaluacion($rank_id){
            $usuario=parent::Conexion();
            parent::set_names();
            $sql="UPDATE lugar_ranking SET est=0 WHERE rank_id=?";
            $sql=$usuario->prepare($sql);
            $sql->bindValue(1,$rank_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        

         

        public function get_lugares_x_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                lugares_usuarios.lugd_id,
                lugares.lug_id,
                lugares.lug_nom,
                lugares.lug_descrip,
                lugares.lug_fecini,
                lugares.lug_fecfin,
                usuarios.usu_id,
                usuarios.usu_nom,
                usuarios.usu_ape,
                usuarios.usu_dni,
                externos.ext_id,
                externos.ext_nom,
                externos.ext_ape,
                lugares_usuarios.est
                FROM lugares_usuarios INNER JOIN 
                lugares ON lugares_usuarios.lug_id = lugares.lug_id INNER JOIN
                usuarios ON lugares_usuarios.usu_id = usuarios.usu_id INNER JOIN
                externos ON lugares.ext_id = externos.ext_id
                WHERE 
                lugares_usuarios.usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        

        
        
    }