<?php
    class Ticket extends Conectar{
        //insert

        public function insert_ticket($usu_id, $tick_titulo, $tick_descrip){
            $conectar= parent::conexion();
            parent::set_names();
            
            $sql="INSERT INTO ticket (tick_id, usu_id, tick_titulo, tick_descrip, tick_estado, fech_crea, est) 
                                VALUES (NULL, ?, ?, ?, 'Abierto', now(), 1)";
                    
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->bindValue(2, $tick_titulo);
            $sql->bindValue(3, $tick_descrip);
            $sql->execute();
            $sql1="SELECT last_insert_id() AS 'tick_id';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
            //return $resultado=$sql->fetchAll();
        }

        public function insert_ticketdetalle($tick_id,$usu_id,$dtick_descrip){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO detalle_ticket (dtick_id,tick_id,usu_id,dtick_descrip,fech_crea,est) VALUES (NULL,?,?,?,now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->bindValue(3, $dtick_descrip);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_ticketdetalle_cerrar($tick_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="call sp_i_ticketdetalle_01(?,?)";
            $sql="INSERT INTO detalle_ticket (dtick_id,tick_id,usu_id,dtick_descrip,fech_crea,est) VALUES (NULL,?,?,'Ticket Cerrado',now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        //update

        public function update_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            
            $sql="UPDATE ticket
                    SET
                        tick_estado = 'Cerrado',
                        fech_cierre = now()
                    WHERE
                        tick_id = ?";
                    
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE ticket
                    SET
                        est = ?
                    WHERE
                        tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        //select

        public function listar_ticket_x_usu($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                ticket.tick_id,
                ticket.usu_id,
                ticket.tick_titulo,
                ticket.tick_descrip,
                ticket.fech_crea,
                ticket.tick_estado,
                ticket.fech_cierre,
                usuarios.usu_id,
                usuarios.usu_nom,
                usuarios.usu_ape,
                usuarios.usu_correo
                FROM 
                ticket
                INNER JOIN usuarios ON ticket.usu_id = usuarios.usu_id
                WHERE
                ticket.est = 1
                AND usuarios.usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticket(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                ticket.tick_id,
                ticket.usu_id,
                ticket.tick_titulo,
                ticket.tick_descrip,
                ticket.tick_estado,
                ticket.fech_crea,
                ticket.fech_cierre,
                usuarios.usu_nom,
                usuarios.usu_ape
                FROM 
                ticket
                INNER JOIN usuarios ON ticket.usu_id = usuarios.usu_id
                WHERE
                ticket.est = 1
                ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticket_x_id($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                ticket.tick_id,
                ticket.usu_id,
                ticket.tick_titulo,
                ticket.tick_descrip,
                ticket.tick_estado,
                ticket.fech_crea,
                ticket.fech_cierre,
                usuarios.usu_nom,
                usuarios.usu_ape,
                usuarios.usu_correo
                FROM 
                ticket
                INNER JOIN usuarios ON ticket.usu_id = usuarios.usu_id
                WHERE
                ticket.est = 1
                AND ticket.tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticketdetalle_x_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                detalle_ticket.dtick_id,
                detalle_ticket.dtick_descrip,
                detalle_ticket.fech_crea,
                usuarios.usu_nom,
                usuarios.usu_ape,
                usuarios.usu_rol
                FROM detalle_ticket
                INNER JOIN usuarios ON detalle_ticket.usu_id = usuarios.usu_id
                WHERE 
                tick_id =?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_total(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) AS TOTAL FROM ticket";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalabierto(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) AS TOTAL FROM ticket WHERE tick_estado='Abierto'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalcerrado(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) AS TOTAL FROM ticket WHERE tick_estado='Cerrado'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_encuesta($tick_id,$tick_estre,$tick_coment){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE ticket 
                SET	
                    tick_estre = ?,
                    tick_coment = ?
                WHERE
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_estre);
            $sql->bindValue(2, $tick_coment);
            $sql->bindValue(3, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        
        
    }
?>