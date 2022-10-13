<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT');

class Mapa_externo extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('M_mapainteractivo');
        date_default_timezone_set("America/Lima");
    }

    private function encodeURIComponent($str) {
        $revert = array('%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')');
        return strtr(rawurlencode($str), $revert);
    }

    public function index(){
        $ipaData = $this->M_mapainteractivo->operacion('todoipashabilitados','','');
        $data['ipa_data'] = $this->encodeURIComponent(json_encode($ipaData));
        echo $this->load->view('mapa/mapa_externo', $data, true);
	}

    //Funcion general para listar departamentos***************************************
    public function listadepartamentos() {
        $data = $this->M_mapainteractivo->operacion('listadepartamentos','','');
        echo json_encode($data);    
    }

}