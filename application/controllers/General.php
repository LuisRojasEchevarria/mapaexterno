<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {
    function __construct(){
        parent::__construct();
        if(!$this->session->sname){redirect("login/log_out");}
        $this->load->model('M_general');
        date_default_timezone_set("America/Lima");
    }

    private function encodeURIComponent($str) {
        $revert = array('%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')');
        return strtr(rawurlencode($str), $revert);
    }
    
    public function index() {
        $generalData = $this->M_general->operacion('index', array('exportar' => false));
        $primeraCarga = $this->input->get('primera_carga', TRUE) === 'true' ? true : false;
        $data['general_data'] = $primeraCarga ? $this->encodeURIComponent(json_encode($generalData)) : $generalData;
        echo $primeraCarga ? $this->load->view('general/general', $data, true) : json_encode($data);
    }
    
    public function OpcionesSelect() {

        $data = array(
            'tabla' => $this->input->get('tabla',TRUE),
			'columna' => filter_var ( $this->input->get('columna',TRUE) , FILTER_SANITIZE_STRING),
        );
        echo json_encode($this->M_general->operacion('listarSelect', $data));
    }

    public function OpcionesSelectP() {

        $data = array(
            'tabla' => $this->input->get('tabla',TRUE),
			'columna' => filter_var ( $this->input->get('columna',TRUE) , FILTER_SANITIZE_STRING),
			'parametro' => filter_var ( $this->input->get('parametro',TRUE) , FILTER_SANITIZE_STRING),
        );
		echo json_encode($this->M_general->operacion('listarSelect', $data));
    }

}
