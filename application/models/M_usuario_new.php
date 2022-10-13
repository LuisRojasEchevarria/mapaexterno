<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_usuario extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->dbgeneral = $this->load->database('general', TRUE);
    }
        
    public function operacion($opcion, $data = '',$data_id='') {
        switch ($opcion) {       
                case 'index':
                    $sql="SELECT";
                    $sql.=" I_ID_PRYUSUARIO as id, *";
                    $sql.=" FROM ";
                    $sql.=" PRY_USUARIO";
                
                    $qry = $this->db->query($sql);
                    if($qry->num_rows() > 0) {
                        $data = $qry->result_array();
                    }
                    return $data;
                case 'buscar':
                    $sql="SELECT ";
                    $sql.=" I_ID_PRYUSUARIO as id, *";
                    $sql.=" FROM ";
                    $sql.=" PRY_USUARIO";
                    $sql.=" WHERE";
                    $sql.=" I_ID_PRYUSUARIO=".$data['id'];
    
                    $qry = $this->db->query($sql);
                    if($qry->num_rows() > 0) {
                        $data = $qry->row();
                    }
                    return $data;

                case 'buscar_por_usuario':
                    $sql="SELECT ";
                    $sql.=" I_ID_PRYUSUARIO as id, *";
                    $sql.=" FROM ";
                    $sql.=" PRY_USUARIO";
                    $sql.=" WHERE";
                    $sql.=" I_EST = 1 AND";
                    $sql.=" V_USUARIO='". $data['usuario'] . "'";
    
                    $qry = $this->db->query($sql);
                    if($qry->num_rows() > 0) {
                        $data = $qry->row();
                    }
                    return $data;

                case 'buscar_usuario_permiso':

                    $sql="SELECT";
                    $sql.=" I_ID_USUARIOPERMISO as id, *";
                    $sql.=" FROM ";
                    $sql.=" PRY_USUARIO_PERMISO";
                    $sql.=" WHERE";
                    $sql.=" I_ID_PRYUSUARIO=". $data['id'];
                
                    $qry = $this->db->query($sql);
                    if($qry->num_rows() > 0) {
                        $data = $qry->result_array();
                    }
                    return $data;

                case 'buscar_permiso_infraestructura':

                    $sql="SELECT"; 
                    $sql.=" I_ID_USUARIOPERMISO,I_ID_PRYUSUARIO,Infra_Nombre";
                    $sql.=" FROM"; 
                    $sql.=" PRY_USUARIO_PERMISO PERM INNER JOIN D_Infraestructura INFRA";
                    $sql.=" ON PERM.I_ID_INF = INFRA.Infra_Id";
                    $sql.=" WHERE";
                    $sql.=" I_ID_PRYUSUARIO = ". $data['id'];

                    $qry = $this->db->query($sql);
                    if($qry->num_rows() > 0) {
                        $data = $qry->result_array();
                    }else{
                        $data = "ERROR";
                    }
                    return $data;

                case 'buscar_dependencia':

                    $sql="SELECT ";
                    $sql.=" Dep_id as id, *";
                    $sql.=" FROM ";
                    $sql.=" Dependencia";
                    $sql.=" WHERE";
                    $sql.=" Dep_Id = (SELECT TOP 1 PerC_DepId FROM [dbo].[Personal_Contrato] WHERE PerC_DNI = '" . $data['dni'] . "' ORDER BY PerC_FReg DESC)";
    
                    $qry = $this->dbgeneral->query($sql);

                    $data = "ERROR";
                    if($qry->num_rows() > 0) {
                        $data = $qry->row();
                    }
                    return $data;
                        
                case 'nuevo':
                    $this->db->insert("PRY_USUARIO",$data);
                    $result = $this->db->insert_id();          
                    return $result;
                case 'modificar':                    
                    $this->db->where('I_ID_PRYUSUARIO', $data_id['id']);
                    $result  = $this->db->update('PRY_USUARIO', $data ); 
                    return $result ? 'Se modificó el registro satisfactoriamente' : 'ERR-No se modificó el registro';

                case 'nuevo_usuario_permiso':
                    $this->db->insert("PRY_USUARIO_PERMISO",$data);
                    $result = $this->db->insert_id();          
                    return $result ? 'Se agregó el registro satisfactoriamente' : 'ERR-No se agregó el registro';

                case 'borrar_usuario_permiso':
                    $this->db->where('I_ID_PRYUSUARIO', $data_id['id']);
                    $result  = $this->db->delete('PRY_USUARIO_PERMISO'); 
                    return $result ? $result : 'ERR-No se pudo borrar el registro';
    
                case 'listarSelect':    
                    if($data['tabla'] ==='infraestructura01') {
                        $sql =" SELECT"; 
                        $sql.=" Infra_Id,Infra_Nombre";
                        $sql.=" FROM";
                        $sql.=" D_Infraestructura";
                        $sql.=" WHERE";
                        $sql.=" B_FLAG_DEL = 1 and";
                        // $sql.=" Infra_Id in ( Select DISTINCT I_ID_INF from PRY ) and";
                        $sql.=" UPPER(Infra_Nombre) LIKE UPPER('%". $data['columna']."%')" ;
                        $qry = $this->db->query($sql);
                        $lista = array();

                    }else if($data['tabla'] ==='infraestructura02') {
                        $sql =" SELECT"; 
                        $sql.=" Infra_Id,Infra_Nombre";
                        $sql.=" FROM";
                        $sql.=" D_Infraestructura";
                        $sql.=" WHERE";
                        $sql.=" B_FLAG_DEL = 1 and";
                        // $sql.=" Infra_Id in ( Select DISTINCT I_ID_INF from PRY ) and";
                        $sql.=" Infra_Id=". $data['columna'];
                        $qry = $this->db->query($sql);
                        $lista = array();    
                    }
                    //
                    if($qry->num_rows() > 0) {
                        $rows = $qry->result_array();
                        foreach($rows as $row) {

                            if($data['tabla'] === 'infraestructura01' || $data['tabla'] === 'infraestructura02' ) {
                                array_push($lista, array(
                                    'id' => $row['Infra_Id'],
                                    'text' => $row['Infra_Nombre']
                                ));
                            }

                        }
                    }
                    //
                    return $lista;
        } 
    }
//fin    
}