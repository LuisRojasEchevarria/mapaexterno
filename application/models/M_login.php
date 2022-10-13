<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {
	function __construct(){
        parent::__construct();
        $this->db = $this->load->database('general', TRUE);
	}

	public function operacion($opcion,$p1="",$p2="")
	{
        //
    	switch ($opcion)
	    {
        case "buscar":
            // $sql="SELECT ";
            // $sql.=" *";
            // $sql.=" FROM usuario";
            // $sql.=" WHERE estado='ACTIVO' AND username=? and password=?";
            // $query=$this->db->query($sql,array($p1,$p2));

            // $sql="SELECT ";
            // $sql.=" u.Rol_Id,u.Sis_Siglas,u.Per_DNI,u.Usu_Alias,u.Usu_Clave,u.Usu_Cambio_Clave, t.Dep_Id, t.Dep_Id_Tramite, u.Usu_Chat,u.Usu_Tramite,u.Com_Id, t.Dep_Id2, t.Dep_Id2_Tramite";
            // $sql.=" FROM Usuario u LEFT JOIN Trabajador t ON t.Tra_DNI=u.Per_DNI";
            // $sql.=" WHERE";
            // $sql.=" u.Sis_Siglas = 'INTRANET'"; 
            // $sql.=" AND u.Usu_Alias = ? ";
            // $sql.=" AND u.Usu_Clave= ? ";
            // $sql.=" AND u.Usu_Estado='A'";
            // $query=$this->db->query($sql,array($p1,$p2));

            //Cargamos la otra base de datos
            $db_general = $this->load->database('general', TRUE);

            $sql="EXEC validarUsuario ?,?,?";
            $params = array(
                'INTRANET',
                $p1,
                $p2
            );

            $query=$this->db->query($sql,$params);
            //$query=$db_general->query($sql,$params);

            if($query->num_rows() > 0 )
            {
                $rsp=$query->row();
            }
            else{
                $rsp="error";
                }
            return $rsp;                
            break;                                                
	    } 
	}//fin operacion    
}


