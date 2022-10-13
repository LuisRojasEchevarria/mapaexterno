<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard02 extends CI_Controller {
    function __construct(){
        parent::__construct();
        if(!$this->session->sname){redirect("login/log_out");}
        $this->load->model('M_dashboard01');
        $this->load->model('M_obraavancefisico');
        date_default_timezone_set("America/Lima");
    }

    private function encodeURIComponent($str) {
        $revert = array('%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')');
        return strtr(rawurlencode($str), $revert);
    }
    
    public function index() {
        // $dashboard01Data = $this->M_dashboard01->operacion('index', array('exportar' => false));
        // $primeraCarga = $this->input->get('primera_carga', TRUE) === 'true' ? true : false;
        // $data['dashboard01_data'] = $primeraCarga ? $this->encodeURIComponent(json_encode($dashboard01Data)) : $dashboard01Data;
        // echo $primeraCarga ? $this->load->view('dashboard01/dashboard01', $data, true) : json_encode($data);
        echo $this->load->view('dashboard02/dashboard02', '', true);
    }

    public function buscar() {
        $data = array(
            'infraestructura'=>$this->input->post('infraestructura', TRUE),
            'proyecto'=>$this->input->post('proyecto', TRUE),
        );        
        $row = $this->M_dashboard01->operacion('buscarporinfraestructurayproyecto', $data);
        echo json_encode($row);        
    }

    public function buscar_obra() {
        $data = array(
            'id'=>$this->input->post('id_obra', TRUE),
        );        
        $row['fila_detalleavancefisico'] = $this->M_obraavancefisico->operacion('buscarporobra', $data);
        echo json_encode($row);
    }

    public function OpcionesSelect() {
        $data = array(
            'tabla' => $this->input->get('tabla',TRUE),
			'columna' => filter_var ( $this->input->get('columna',TRUE) , FILTER_SANITIZE_STRING),
        );
        echo json_encode($this->M_dashboard01->operacion('listarSelect', $data));
    }

    public function OpcionesSelectP() {

        $data = array(
            'tabla' => $this->input->get('tabla',TRUE),
			'columna' => filter_var ( $this->input->get('columna',TRUE) , FILTER_SANITIZE_STRING),
			'parametro' => filter_var ( $this->input->get('parametro',TRUE) , FILTER_SANITIZE_STRING),
        );
		echo json_encode($this->M_dashboard01->operacion('listarSelect', $data));
    }

}
