<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mapainteractivo extends CI_Model {
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

            case 'listafases':
                $sql="select PRY_MAESTRO.I_ID_MAE, PRY_MAESTRO.V_DESC01 AS FASEPROY, PRY_MAESTRO.V_COD FROM PRY_MAESTRO WHERE I_FLAG_GRUPO = 2 ORDER BY I_ID_MAE ASC";
                
                $qry = $this->db->query($sql);
                $data = 'ERROR';
                if($qry->num_rows() > 0) {
                    $data = $qry->result_array();
                }
                return $data;

            case 'tiposipa':
                $sql="SELECT DISTINCT";
                $sql.=" inf.Infra_Tipo";
                $sql.=" FROM ";
                $sql.=" D_Infraestructura inf";
                $sql.=" WHERE";
                $sql.=" inf.B_FLAG_DEL = 1";
                $sql.=" and inf.Infra_Latitud is not null";
                $sql.=" and inf.Infra_Longitud is not null";
                $sql.=" and (inf.Infra_Latitud !='' or inf.Infra_Longitud !='')";
                $sql.=" ORDER BY inf.Infra_Tipo asc";
                
                $qry = $this->db->query($sql);
                $data = 'ERROR';
                if($qry->num_rows() > 0) {
                    $data = $qry->result_array();
                }
                return $data;
            
            //Consultas para Infraestructura************************************************************************************
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

            //Consultas para Proyectos**********************************************************************************************
            case 'todoproyectos':
                $sql="SELECT ";
                $sql.=" I_ID_SITU_INV as id, inf.Infra_Id as id_ipa ,inf.*,";
                $sql.=" (select Dpto_Nombre from [GENERAL].[dbo].[Departamento] WHERE Dpto_Id = inf.V_DEPT ) as Departamento,";
                $sql.=" (select Pro_Nombre from [GENERAL].[dbo].[Provincia] WHERE Pro_Id = inf.V_PROV ) as Provincia,";
                $sql.=" (select Dis_Nombre from [GENERAL].[dbo].[Distrito] WHERE Dis_Id = inf.V_DIST ) as Distrito,";
                $sql.=" situ_inv.*";
                $sql.=" FROM ";
                $sql.=" D_Infraestructura inf";
                $sql.=" LEFT JOIN SITU_INVERSION situ_inv ON inf.Infra_Id = situ_inv.Infra_Id";
                $sql.=" WHERE";
                $sql.=" inf.B_FLAG_DEL = 1 and";
                $sql.=" inf.Infra_Id in (2,73,53,24,31,32,46,20,67,34,23,26,66,38,10,54,48,59,28,30,8,13,64,3,25,33,35,36,41,17,18,19,21,68)";
                $sql.=" and situ_inv.I_ID_SITU_INV is not null";
                $sql.=" and inf.Infra_Latitud is not null";
                $sql.=" and inf.Infra_Longitud is not null";
                $sql.=" and (inf.Infra_Latitud !=''";
                $sql.=" or inf.Infra_Longitud !='')";

                $qry = $this->db->query($sql);
                $data = 'ERROR';
                if($qry->num_rows() > 0) {
                    $data = $qry->result_array();
                }
                return $data;

            case 'proxfiltro':
                $sql="SELECT";
                $sql.=" I_ID_SITU_INV as id, inf.Infra_Id as id_ipa ,inf.*,";
                $sql.=" (select Dpto_Nombre from [GENERAL].[dbo].[Departamento] WHERE Dpto_Id = inf.V_DEPT ) as Departamento,";
                $sql.=" (select Pro_Nombre from [GENERAL].[dbo].[Provincia] WHERE Pro_Id = inf.V_PROV ) as Provincia,";
                $sql.=" (select Dis_Nombre from [GENERAL].[dbo].[Distrito] WHERE Dis_Id = inf.V_DIST ) as Distrito,";
                $sql.=" situ_inv.*";
                $sql.=" FROM ";
                $sql.=" D_Infraestructura inf";
                $sql.=" LEFT JOIN SITU_INVERSION situ_inv ON inf.Infra_Id = situ_inv.Infra_Id";
                $sql.=" WHERE";
                if($data['depa'] != 'TODOS'){
                    $sql.=" inf.V_DEPT=".$data['depa']." and";
                }
                if($data['fase'] != 'TODOS'){
                    $sql.=" situ_inv.V_FASE='".$data['fase']."' and";
                }
                if($data['porc1'] != '' || $data['porc2'] != ''){
                    if($data['porc1']==''){$data['porc1']=0;}
                    if($data['porc2']==''){$data['porc2']=100;}
                    $sql.=" (situ_inv.N_PORCT_REAL BETWEEN '".$data['porc1']."' and '".$data['porc2']."') and";
                }
                $sql.=" inf.B_FLAG_DEL = 1";
                $sql.=" and inf.Infra_Latitud is not null";
                $sql.=" and inf.Infra_Longitud is not null";
                $sql.=" and (inf.Infra_Latitud !='' or inf.Infra_Longitud !='')";
                $sql.=" and inf.Infra_Id in (2,73,53,24,31,32,46,20,67,34,23,26,66,38,10,54,48,59,28,30,8,13,64,3,25,33,35,36,41,17,18,19,21,68)";
                $sql.=" and situ_inv.I_ID_SITU_INV is not null";
                if($data['monto1'] != '' || $data['monto2'] != ''){
                    if($data['monto1'] != '' && $data['monto2'] == ''){
                        $sql.=" and (select infog.V_DETALLE FROM [WEB2].[dbo].[SITU_INFORMACION_GENERAL] infog WHERE infog.I_ID_SITU_INV = situ_inv.I_ID_SITU_INV and infog.I_ORDEN = 3) >= '".$data['monto1']."'";
                    } else if($data['monto1'] == '' && $data['monto2'] != ''){
                        $sql.=" and (select infog.V_DETALLE FROM [WEB2].[dbo].[SITU_INFORMACION_GENERAL] infog WHERE infog.I_ID_SITU_INV = situ_inv.I_ID_SITU_INV and infog.I_ORDEN = 3) <= '".$data['monto2']."'";
                    } else if($data['monto1'] != '' && $data['monto2'] != ''){
                        $sql.=" and (select infog.V_DETALLE FROM [WEB2].[dbo].[SITU_INFORMACION_GENERAL] infog WHERE infog.I_ID_SITU_INV = situ_inv.I_ID_SITU_INV and infog.I_ORDEN = 3) BETWEEN '".$data['monto1']."' and '".$data['monto2']."'";
                    }
                }

                $qry = $this->db->query($sql);
                $data = 'ERROR';
                if($qry->num_rows() > 0) {
                    $data = $qry->result_array();
                }
                return $data;
    
            case 'buscarxidpro':
                $sql="SELECT ";
                $sql.=" I_ID_SITU_INV as id, inf.Infra_Id as id_ipa, inf.*,";
                $sql.=" (select Dpto_Nombre from [GENERAL].[dbo].[Departamento] WHERE Dpto_Id = inf.V_DEPT ) as Departamento,";
                $sql.=" (select Pro_Nombre from [GENERAL].[dbo].[Provincia] WHERE Pro_Id = inf.V_PROV ) as Provincia,";
                $sql.=" (select Dis_Nombre from [GENERAL].[dbo].[Distrito] WHERE Dis_Id = inf.V_DIST ) as Distrito,";
                $sql.=" situ_inv.*,";
                $sql.=" (select distinct infog.V_DETALLE FROM [WEB2].[dbo].[SITU_INFORMACION_GENERAL] infog WHERE infog.I_ID_SITU_INV = situ_inv.I_ID_SITU_INV and infog.I_ORDEN = 1) as Nombre_Pro,";
                $sql.=" (select distinct infog.V_DETALLE FROM [WEB2].[dbo].[SITU_INFORMACION_GENERAL] infog WHERE infog.I_ID_SITU_INV = situ_inv.I_ID_SITU_INV and infog.I_ORDEN = 3) as Monto_Inv,";
                $sql.=" (select distinct infog.V_DETALLE FROM [WEB2].[dbo].[SITU_INFORMACION_GENERAL] infog WHERE infog.I_ID_SITU_INV = situ_inv.I_ID_SITU_INV and infog.I_ORDEN = 9) as Costo_Apro,";
                $sql.=" (select distinct infog.V_DETALLE FROM [WEB2].[dbo].[SITU_INFORMACION_GENERAL] infog WHERE infog.I_ID_SITU_INV = situ_inv.I_ID_SITU_INV and infog.I_ORDEN = 10) as Dev_Acum";
                $sql.=" FROM ";
                $sql.=" D_Infraestructura inf";
                $sql.=" LEFT JOIN SITU_INVERSION situ_inv ON inf.Infra_Id = situ_inv.Infra_Id";
                $sql.=" WHERE";
                $sql.=" inf.B_FLAG_DEL = 1 and";
                $sql.=" situ_inv.I_ID_SITU_INV=".$data['id'];
                $sql.=" and inf.Infra_Id in (2,73,53,24,31,32,46,20,67,34,23,26,66,38,10,54,48,59,28,30,8,13,64,3,25,33,35,36,41,17,18,19,21,68)";
                $sql.=" and situ_inv.I_ID_SITU_INV is not null";
                $sql.=" and inf.Infra_Latitud is not null";
                $sql.=" and inf.Infra_Longitud is not null";
                $sql.=" and (inf.Infra_Latitud !=''";
                $sql.=" or inf.Infra_Longitud !='')";

                $qry = $this->db->query($sql);
                $data = 'ERROR';
                if($qry->num_rows() > 0) {
                    $data = $qry->result_array();
                }
                return $data;

            case 'proxfiltromas':
                $sql="SELECT";
                $sql.=" I_ID_SITU_INV as id, inf.Infra_Id as id_ipa ,inf.*,";
                $sql.=" (select Dpto_Nombre from [GENERAL].[dbo].[Departamento] WHERE Dpto_Id = inf.V_DEPT ) as Departamento,";
                $sql.=" (select Pro_Nombre from [GENERAL].[dbo].[Provincia] WHERE Pro_Id = inf.V_PROV ) as Provincia,";
                $sql.=" (select Dis_Nombre from [GENERAL].[dbo].[Distrito] WHERE Dis_Id = inf.V_DIST ) as Distrito,";
                $sql.=" situ_inv.*";
                $sql.=" FROM ";
                $sql.=" D_Infraestructura inf";
                $sql.=" LEFT JOIN SITU_INVERSION situ_inv ON inf.Infra_Id = situ_inv.Infra_Id";
                $sql.=" WHERE";
                if($data['depa'] != 'TODOS'){
                    $sql.=" inf.V_DEPT=".$data['depa']." and";
                }
                if($data['fase'] != 'TODOS'){
                    $sql.=" situ_inv.V_FASE='".$data['fase']."' and";
                }
                if($data['habi'] == '1'){
                    $sql.=" inf.B_HAB='1' and";
                }
                if($data['tra'] == '1'){
                    $sql.=" inf.B_TRANS='1' and";
                }
                if($data['ope'] == '1'){
                    $sql.=" inf.I_EST='1' and";
                }
                if($data['porc1'] != '' || $data['porc2'] != ''){
                    if($data['porc1']==''){$data['porc1']=0;}
                    if($data['porc2']==''){$data['porc2']=100;}
                    $sql.=" (situ_inv.N_PORCT_REAL BETWEEN '".$data['porc1']."' and '".$data['porc2']."') and";
                }
                $sql.=" inf.B_FLAG_DEL = 1";
                $sql.=" and inf.Infra_Latitud is not null";
                $sql.=" and inf.Infra_Longitud is not null";
                $sql.=" and (inf.Infra_Latitud !='' or inf.Infra_Longitud !='')";
                $sql.=" and inf.Infra_Id in (2,73,53,24,31,32,46,20,67,34,23,26,66,38,10,54,48,59,28,30,8,13,64,3,25,33,35,36,41,17,18,19,21,68)";
                $sql.=" and situ_inv.I_ID_SITU_INV is not null";
                if($data['monto1'] != '' || $data['monto2'] != ''){
                    if($data['monto1'] != '' && $data['monto2'] == ''){
                        $sql.=" and (select infog.V_DETALLE FROM [WEB2].[dbo].[SITU_INFORMACION_GENERAL] infog WHERE infog.I_ID_SITU_INV = situ_inv.I_ID_SITU_INV and infog.I_ORDEN = 3) >= '".$data['monto1']."'";
                    } else if($data['monto1'] == '' && $data['monto2'] != ''){
                        $sql.=" and (select infog.V_DETALLE FROM [WEB2].[dbo].[SITU_INFORMACION_GENERAL] infog WHERE infog.I_ID_SITU_INV = situ_inv.I_ID_SITU_INV and infog.I_ORDEN = 3) <= '".$data['monto2']."'";
                    } else if($data['monto1'] != '' && $data['monto2'] != ''){
                        $sql.=" and (select infog.V_DETALLE FROM [WEB2].[dbo].[SITU_INFORMACION_GENERAL] infog WHERE infog.I_ID_SITU_INV = situ_inv.I_ID_SITU_INV and infog.I_ORDEN = 3) BETWEEN '".$data['monto1']."' and '".$data['monto2']."'";
                    }
                }

                $qry = $this->db->query($sql);
                $data = 'ERROR';
                if($qry->num_rows() > 0) {
                    $data = $qry->result_array();
                }
                return $data;
        }
    }
}
