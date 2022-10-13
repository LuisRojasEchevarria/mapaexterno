<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_serviciomapaexterno extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    public function operacion($opcion, $data = '',$data_id='') {
        switch ($opcion) {    
            case 'listadepartamentos':
                $sql="select Dpto_Id, Dpto_Nombre from [GENERAL].[dbo].[Departamento] order by Dpto_Nombre asc";
                
                $qry = $this->db->query($sql);
                $data = 'ERROR';
                if($qry->num_rows() > 0) {
                    $data = $qry->result_array();
                }
                return $data;

            case 'listadeipa':
                $sql="SELECT";
                $sql.=" inf.Infra_Id, LTRIM(inf.V_NOM) AS NOM";
                $sql.=" FROM ";
                $sql.=" D_Infraestructura inf";
                $sql.=" WHERE";
                $sql.=" inf.B_FLAG_DEL = 1";
                $sql.=" and inf.Infra_Latitud is not null";
                $sql.=" and inf.Infra_Longitud is not null";
                $sql.=" and (inf.Infra_Latitud !='' or inf.Infra_Longitud !='')";
                $sql.=" and inf.Infra_Tipo='DPA'";
                $sql.=" and inf.V_DEPT='".$data['depa']."'";
                $sql.=" ORDER BY NOM asc";
                
                $qry = $this->db->query($sql);
                $data = 'ERROR';
                if($qry->num_rows() > 0) {
                    $data = $qry->result_array();
                }
                return $data;
            
            case 'todoipas':
                $sql="SELECT";
                $sql.=" inf.*,";
                $sql.=" (select Dpto_Nombre from [GENERAL].[dbo].[Departamento] WHERE Dpto_Id = inf.V_DEPT ) as Departamento,";
                $sql.=" (select Pro_Nombre from [GENERAL].[dbo].[Provincia] WHERE Pro_Id = inf.V_PROV ) as Provincia,";
                $sql.=" (select Dis_Nombre from [GENERAL].[dbo].[Distrito] WHERE Dis_Id = inf.V_DIST ) as Distrito";
                $sql.=" FROM ";
                $sql.=" D_Infraestructura inf";
                $sql.=" WHERE";
                $sql.=" inf.B_FLAG_DEL = 1";
                $sql.=" and inf.Infra_Latitud is not null";
                $sql.=" and inf.Infra_Longitud is not null";
                $sql.=" and (inf.Infra_Latitud !='' or inf.Infra_Longitud !='')";
                $sql.=" and inf.Infra_Tipo='DPA'";
                
                $qry = $this->db->query($sql);
                $data = 'ERROR';
                if($qry->num_rows() > 0) {
                    $data = $qry->result_array();
                }
                return $data;
            
            case 'buscarxid':
                $sql="SELECT ";
                $sql.=" inf.Infra_Id as id, inf.*, LOWER(LTRIM(inf.V_NOM)) as nombredpa,";
                $sql.=" (select infNor.Infra_Nombre from [WEB2].[dbo].[D_Infraestructura] infNor WHERE infNor.Infra_Id = inf.I_INF_NOR ) as NomInfNor,";
                $sql.=" (select infSur.Infra_Nombre from [WEB2].[dbo].[D_Infraestructura] infSur WHERE infSur.Infra_Id = inf.I_INF_SUR ) as NomInfSur,";
                $sql.=" (select Dpto_Nombre from [GENERAL].[dbo].[Departamento] WHERE Dpto_Id = inf.V_DEPT ) as Departamento,";
                $sql.=" (select Pro_Nombre from [GENERAL].[dbo].[Provincia] WHERE Pro_Id = inf.V_PROV ) as Provincia,";
                $sql.=" (select Dis_Nombre from [GENERAL].[dbo].[Distrito] WHERE Dis_Id = inf.V_DIST ) as Distrito,";
                $sql.=" situ_inv.V_TIPO, situ_inv.V_COD_UNI_INV, situ_inv.N_PORCT_REAL";
                $sql.=" FROM ";
                $sql.=" D_Infraestructura inf";
                $sql.=" LEFT JOIN SITU_INVERSION situ_inv ON inf.Infra_Id = situ_inv.Infra_Id";
                $sql.=" WHERE";
                $sql.=" inf.B_FLAG_DEL = 1 and";
                $sql.=" inf.Infra_Id=".$data['id'];
                $sql.=" and inf.Infra_Tipo='DPA'";

                $qry = $this->db->query($sql);
                $data = 'ERROR';
                if($qry->num_rows() > 0) {
                    $data = $qry->result_array();
                }
                return $data;

            case 'ipasxfiltro':
                $sql="SELECT";
                $sql.=" inf.*,";
                $sql.=" (select Dpto_Nombre from [GENERAL].[dbo].[Departamento] WHERE Dpto_Id = inf.V_DEPT ) as Departamento,";
                $sql.=" (select Pro_Nombre from [GENERAL].[dbo].[Provincia] WHERE Pro_Id = inf.V_PROV ) as Provincia,";
                $sql.=" (select Dis_Nombre from [GENERAL].[dbo].[Distrito] WHERE Dis_Id = inf.V_DIST ) as Distrito";
                $sql.=" FROM ";
                $sql.=" D_Infraestructura inf";
                $sql.=" WHERE";
                if($data['depa'] != 'TODOS'){
                    $sql.=" inf.V_DEPT='".$data['depa']."' and";
                }
                if($data['tipo'] != 'TODOS'){
                    $sql.=" inf.Infra_Id='".$data['tipo']."' and";
                }
                if($data['nombre'] != ''){
                    $sql.=" inf.Infra_Nombre LIKE '%".$data['nombre']."%' and";
                }
                $sql.=" inf.B_FLAG_DEL = 1";
                $sql.=" and inf.Infra_Latitud is not null";
                $sql.=" and inf.Infra_Longitud is not null";
                $sql.=" and (inf.Infra_Latitud !='' or inf.Infra_Longitud !='')";
                $sql.=" and inf.Infra_Tipo='DPA'";

                $qry = $this->db->query($sql);
                $data = 'ERROR';
                if($qry->num_rows() > 0) {
                    $data = $qry->result_array();
                }
                return $data;

            case 'obtenercoordenadas':
                $sql="SELECT";
                $sql.=" inf.*,";
                $sql.=" (select Dpto_Nombre from [GENERAL].[dbo].[Departamento] WHERE Dpto_Id = inf.V_DEPT ) as Departamento,";
                $sql.=" (select Pro_Nombre from [GENERAL].[dbo].[Provincia] WHERE Pro_Id = inf.V_PROV ) as Provincia,";
                $sql.=" (select Dis_Nombre from [GENERAL].[dbo].[Distrito] WHERE Dis_Id = inf.V_DIST ) as Distrito";
                $sql.=" FROM ";
                $sql.=" D_Infraestructura inf";
                $sql.=" WHERE";
                if($data['id'] != 'TODOS'){
                    $sql.=" inf.Infra_Id='".$data['id']."' and";
                }
                $sql.=" inf.B_FLAG_DEL = 1";
                $sql.=" and inf.Infra_Latitud is not null";
                $sql.=" and inf.Infra_Longitud is not null";
                $sql.=" and (inf.Infra_Latitud !='' or inf.Infra_Longitud !='')";
                $sql.=" and inf.Infra_Tipo='DPA'";

                $qry = $this->db->query($sql);
                $data = 'ERROR';
                if($qry->num_rows() > 0) {
                    $data = $qry->result_array();
                }
                return $data;
        }
    }
}
