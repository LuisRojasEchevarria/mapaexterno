<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard01 extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    public function operacion($opcion, $data = '',$data_id='') {
        switch ($opcion) {       
                case 'index':
                    return '';
                case 'buscarporinfraestructurayproyecto':
    
                    $sql="SELECT ";
                    $sql.=" INF.Infra_Nombre,INF.Infra_Latitud,INF.Infra_Longitud,INF.V_DEPT,INF.V_PROV,INF.V_DIST,INF.I_NUM_PESC,INF.I_NUM_FAM,INF.N_AREA_TOTAL,INF.N_AREA_CONSTRUIDA_TIERRA,INF.N_AREA_CONSTRUIDA_MAR,INF.N_LONG_ESPIGON,";
                    $sql.=" PRY.V_COD_SNIP,PRY.V_COD_UNI_INV,PRY.V_NOM,PRY.I_ID_PERS_COOR,PRY.I_ID_PERS_JEFE,PRY.N_MON_INVERSION,";
                    $sql.=" (SELECT cast( V_NOM AS varchar) + ' ' + cast( V_APE AS varchar) FROM PRY_PERSONAL WHERE I_ID_PERS = PRY.I_ID_PERS_JEFE ) AS JEFE_PROYECTO,";
                    $sql.=" (SELECT V_IMG FROM PRY_PERSONAL WHERE I_ID_PERS = PRY.I_ID_PERS_JEFE ) AS FOTO_JEFE_PROYECTO,";
                    $sql.=" OBRA.*,";
                    $sql.=" (SELECT V_RAZ_SOC FROM OBRA_EMPRESA WHERE I_ID_EMP = OBRA.I_ID_EMP_COT) AS CONTRATISTA,";
                    $sql.=" (SELECT V_RAZ_SOC FROM OBRA_EMPRESA WHERE I_ID_EMP = OBRA.I_ID_EMP_SUP) AS SUPERVISOR";
                    $sql.=" FROM ";
                    $sql.=" PRY";
                    $sql.=" INNER JOIN D_Infraestructura INF ON PRY.I_ID_INF = INF.Infra_Id";
                    $sql.=" INNER JOIN OBRA on PRY.I_ID_PRY = OBRA.I_ID_PRY";
                    $sql.=" WHERE";
                    $sql.=" INF.Infra_Id =" .$data['infraestructura'];
                    $sql.=" AND  PRY.I_ID_PRY =" .$data['proyecto'];

                    $qry = $this->db->query($sql);
                    if($qry->num_rows() > 0) {
                        $data = $qry->row();
                    }
                    return $data;    

                case 'listarSelect':
                    if($data['tabla'] ==='infraestructura01') {
                        $sql =" SELECT"; 
                        $sql.=" Infra_Id,Infra_Nombre";
                        $sql.=" FROM";
                        $sql.=" D_Infraestructura";
                        $sql.=" WHERE";
                        $sql.=" B_FLAG_DEL = 1 and";
                        $sql.=" UPPER(Infra_Nombre) LIKE UPPER('%". $data['columna']."%')" ;
                        $qry = $this->db->query($sql);
                        $lista = array();

                    }else  if($data['tabla'] ==='proyecto01') {
                        $sql =" SELECT"; 
                        $sql.=" I_ID_PRY,V_NOM";
                        $sql.=" FROM";
                        $sql.=" PRY";
                        $sql.=" WHERE";
                        $sql.=" B_FLAG_DEL = 1 and";
                        $sql.=" I_ID_INF = " . $data['parametro'] ." and";
                        $sql.=" UPPER(V_NOM) LIKE UPPER('%". $data['columna']."%')" ;
                        $qry = $this->db->query($sql);
                        $lista = array();
                    }        
                        
                    //
                    if($qry->num_rows() > 0) {
                        $rows = $qry->result_array();
                        foreach($rows as $row) {

                            if($data['tabla'] === 'infraestructura01') {
                                array_push($lista, array(
                                    'id' => $row['Infra_Id'],
                                    'text' => $row['Infra_Nombre']
                                ));
                            }
        
                            if($data['tabla'] === 'proyecto01') {
                                array_push($lista, array(
                                    'id' => $row['I_ID_PRY'],
                                    'text' => $row['V_NOM']
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
