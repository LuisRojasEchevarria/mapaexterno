<?php
// Home.php
// Controlador para cargar vista Home
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    function __construct(){
        parent::__construct();
        date_default_timezone_set("America/Lima");
    }
    
    // Carga data de Dashboard principal y devuelve el HTML de página
    public function index() {
        // Envia página + data o solo data de tabla
        $homeData = array();
        $primeraCarga = $this->input->get('primera_carga', TRUE) === 'true' ? true : false;
        $data['home_data'] = $primeraCarga ? $this->encodeURIComponent(json_encode($homeData)) : $homeData;
        echo $primeraCarga ? $this->load->view('home/home', $data, true) : json_encode($data);
    }
    
    // Función para codificar objeto JSON convertido a texto y pueda ser almacenado en elemento HTML
    private function encodeURIComponent($str) {
        $revert = array('%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')');
        return strtr(rawurlencode($str), $revert);
    }
}