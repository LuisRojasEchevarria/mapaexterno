<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
    function __construct(){
        parent::__construct();
        if(!$this->session->sname){redirect("login/log_out");}
        $this->load->model('M_usuario');
        date_default_timezone_set("America/Lima");
    }

    private function encodeURIComponent($str) {
        $revert = array('%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')');
        return strtr(rawurlencode($str), $revert);
    }
    
    public function index() {
        $usuarioData = $this->M_usuario->operacion('index', array('exportar' => false));
        $primeraCarga = $this->input->get('primera_carga', TRUE) === 'true' ? true : false;
        $data['usuario_data'] = $primeraCarga ? $this->encodeURIComponent(json_encode($usuarioData)) : $usuarioData;
        echo $primeraCarga ? $this->load->view('usuario/usuario', $data, true) : json_encode($data);
    }

    public function nuevo() {
        echo $this->load->view('usuario/usuarioNuevo', '' , true);
    }

    public function modificar() {
        $data = array(
            'id'=>$this->input->post('id', TRUE),
        );                
        $row['fila'] = $this->M_usuario->operacion('buscar', $data);
        //permiso
        if( $row['fila']->id != ''){
            $data = array('id'=> $row['fila']->id );
            $row['fila_detallePermiso'] = $this->encodeURIComponent(json_encode($this->M_usuario->operacion('buscar_usuario_permiso', $data)));
        }else{
            $row['fila_detallePermiso'] = $this->encodeURIComponent(json_encode(''));
        }

        echo $this->load->view('usuario/usuarioModificar', $row, true);
    }

    public function consultar() {
        $data = array(
            'id'=>$this->input->post('id', TRUE),
        );        
		$row['fila'] = $this->M_usuario->operacion('buscar', $data);
        //permiso
        if( $row['fila']->id != ''){
            $data = array('id'=> $row['fila']->id );
            $row['fila_detallePermiso'] = $this->encodeURIComponent(json_encode($this->M_usuario->operacion('buscar_usuario_permiso', $data)));
        }else{
            $row['fila_detallePermiso'] = $this->encodeURIComponent(json_encode(''));
        }


        echo $this->load->view('usuario/usuarioConsultar', $row, true);
    }

    public function agregar() {
        $data = array(
            'V_NUM_DOC' => $this->input->post('numdoc', TRUE),
            'V_NOMAPE' => strtoupper($this->input->post('nomape', TRUE)),
            'V_USUARIO' => $this->input->post('usuario', TRUE),
            'V_ROL' => $this->input->post('rol', TRUE),
            'I_EST' => $this->input->post('estado', TRUE),
            'V_CARGO' => $this->input->post('cargo', TRUE),
            'V_PERMISO' => $this->input->post('permiso', TRUE),

            'V_USU_REG' => $this->session->sname,
            'D_FEC_REG' => date("Y-m-d H:i:s"),
            'V_IP_REG' => $this->input->ip_address(),
        );
        // echo $this->M_usuario->operacion('nuevo', $data);

        $resp = $this->M_usuario->operacion('nuevo', $data);
        
        if($resp > 0){
            $permiso = $this->input->post('infraestructura', TRUE);

            if(count($permiso) > 0 ){
                for ($i=0; $i < count($permiso); $i++) {
                    $data_permiso = array(
                        'I_ID_PRYUSUARIO' => $resp,
                        'I_ID_INF' => intval($permiso[$i])
                    );
                    echo $this->M_usuario->operacion('nuevo_usuario_permiso', $data_permiso);
                    // echo var_dump($data_permiso);
                }
            }
        }
         
    }

    public function agregar1() {
        $data_id = array('id'=>$this->input->post('id', TRUE));
        $data = array(
            'V_NUM_DOC' => $this->input->post('numdoc', TRUE),
            'V_NOMAPE' => strtoupper($this->input->post('nomape', TRUE)),
            'V_USUARIO' => $this->input->post('usuario', TRUE),
            'V_ROL' => $this->input->post('rol', TRUE),
            'I_EST' => $this->input->post('estado', TRUE),
            'V_CARGO' => $this->input->post('cargo', TRUE),
            'V_PERMISO' => $this->input->post('permiso', TRUE),

            'V_USU_MOD' => $this->session->sname,
            'D_FEC_MOD' => date("Y-m-d H:i:s"),
            'V_IP_MOD' => $this->input->ip_address(),
        );

		// echo $this->M_usuario->operacion('modificar', $data,$data_id);
        //  echo var_dump($horariosid);

        $resp = $this->M_usuario->operacion('modificar', $data,$data_id);

        if(substr($resp,0,3) == 'ERR' ){
            echo $resp;    
            return;
        }else{

            $permiso = $this->input->post('infraestructura', TRUE);
            $data_id = array('id'=> $this->input->post('id', TRUE) );
            $this->M_usuario->operacion('borrar_usuario_permiso','',$data_id);

            if(count($permiso) > 0 ){
                for ($i=0; $i < count($permiso); $i++) {
                    $data_permiso = array(
                        'I_ID_PRYUSUARIO' => $this->input->post('id', TRUE),
                        'I_ID_INF' => intval($permiso[$i])
                    );
                    echo $this->M_usuario->operacion('nuevo_usuario_permiso', $data_permiso);
                }
            }

        }

    }

    public function OpcionesSelect() {

        $data = array(
            'tabla' => $this->input->get('tabla',TRUE),
			'columna' => filter_var ( $this->input->get('columna',TRUE) , FILTER_SANITIZE_STRING),
        );
        echo json_encode($this->M_usuario->operacion('listarSelect', $data));
    }

    public function exportarExcel() {

        require_once 'assets/plugins/phpexcel/classes/PHPExcel.php';
        require_once 'assets/plugins/phpexcel/classes/PHPExcel/IOFactory.php';

        $objReader = new PHPExcel_Reader_Excel2007();
        $objPHPExcel = $objReader->load("assets/plantillas/template_usuarios.xlsx");
        $objPHPExcel->setActiveSheetIndex(0);

        $id=$this->input->post('id');
        $data = array(
            'id' => $id,
        );

        $usuarioData = $this->M_usuario->operacion('index', $data );

        // Filas de tabla
        $filaNum = 7;
        $n=1;
        foreach($usuarioData as $row) {            
            

            $objPHPExcel->getActiveSheet()->setCellValue('A' . $filaNum, $n);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $filaNum, $row['V_NUM_DOC']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $filaNum, $row['V_NOMAPE']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $filaNum, $row['V_USUARIO']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $filaNum, $row['V_ROL']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $filaNum, $row['V_CARGO']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $filaNum, $row['V_PERMISO']);

            if( $row['I_EST'] == 0){
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $filaNum, 'BLOQUEADO');
            }else{
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $filaNum, 'ACTIVO');
            }
            

            $infraestructuraData = $this->M_usuario->operacion('buscar_permiso_infraestructura', array('id' => $row['I_ID_PRYUSUARIO'] ) );

            $listaInfraestructuras = '';
            if($infraestructuraData != 'ERROR'){
                foreach($infraestructuraData as $fila ) {
                    if($fila['Infra_Nombre'] != ''){
                        $listaInfraestructuras .= $fila['Infra_Nombre'] . ',';
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $filaNum, substr($listaInfraestructuras,0,-1) );
                }
            }

            $filaNum++;    
            $n++;
        }
        
        // Devolviendo data de archivo generado para descargarlo en JS
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        ob_start();
        $objWriter->save('php://output');
        $xlsData = ob_get_contents();
        ob_end_clean();
        echo 'data:application/vnd.ms-excel;base64,' . base64_encode($xlsData);
                
    }

}