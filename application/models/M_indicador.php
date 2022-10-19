<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_indicador extends CI_Model {
    function __construct() {
        parent::__construct();
    }
        
    public function operacion($opcion, $data = '',$data_id='') {
        switch ($opcion) {       
                case 'index':
                    $sql="SELECT";
                    $sql.=" I_ID_INDICADOR_MAPA as id, *";
                    $sql.=" FROM ";
                    $sql.=" SITU_INDICADOR_MAPA";
                
                    $qry = $this->db->query($sql);
                    if($qry->num_rows() > 0) {
                        $data = $qry->result_array();
                    }
                    return $data;
                case 'buscar':
                    $sql="SELECT ";
                    $sql.=" I_ID_INDICADOR_MAPA as id, *";
                    $sql.=" FROM ";
                    $sql.=" SITU_INDICADOR_MAPA";
                    $sql.=" WHERE";
                    $sql.=" I_ID_INDICADOR_MAPA=".$data['id'];
    
                    $qry = $this->db->query($sql);
                    if($qry->num_rows() > 0) {
                        $data = $qry->row();
                    }
                    return $data;

                case 'buscar_cantidad':
                    $sql="SELECT ";
                    $sql.=" COUNT(*) AS cantidad";
                    $sql.=" FROM ";
                    $sql.=" SITU_INDICADOR_MAPA";
                    $sql.=" WHERE";
                    $sql.=" V_ORIGEN = 'EXTERNO'";
    
                    $qry = $this->db->query($sql);
                    if($qry->num_rows() > 0) {
                        $data = $qry->row();
                    }
                    return $data;
                        
                case 'nuevo':

                    $sql="EXEC SP_SITU_INDICADOR_MAPA ?,?,?,?,?,?,?";
                    $params = array(
                        $data['Infra_Id'],
                        $data['V_ORIGEN'],
                        $data['V_TIPO'],
                        $data['V_FILTRO'],
                        $data['V_LATITUD'],
                        $data['V_LONGITUD'],
                        $data['V_IP_REG']
                    );

                    $query=$this->db->query($sql,$params);
                    if($query->num_rows() > 0 )
                    $rsp='ERROR';
                    {
                        $rsp=$query->row();
                    }
                    return $rsp;                

        } 
    }
//fin    
}