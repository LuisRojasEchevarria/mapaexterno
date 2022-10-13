<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion extends CI_Controller {
    function __construct(){
        parent::__construct();
        if(!$this->session->sname){redirect("login/log_out");}
        $this->load->model('M_configuracion');
        date_default_timezone_set("America/Lima");
    }

    private function encodeURIComponent($str) {
        $revert = array('%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')');
        return strtr(rawurlencode($str), $revert);
    }
    
    public function index() {
        $configuracionData = $this->M_configuracion->operacion('index', array('exportar' => false));
        $primeraCarga = $this->input->get('primera_carga', TRUE) === 'true' ? true : false;
        $data['configuracion_data'] = $primeraCarga ? $this->encodeURIComponent(json_encode($configuracionData)) : $configuracionData;
        echo $primeraCarga ? $this->load->view('configuracion/configuracion', $data, true) : json_encode($data);
    }
    
    public function nuevo() {
        echo $this->load->view('configuracion/configuracionNuevo', '' , true);
    }

    public function modificar() {
        $data = array(
            'id'=>$this->input->post('id', TRUE),
        );                
        $row['fila'] = $this->M_configuracion->operacion('buscar', $data);
        echo $this->load->view('configuracion/configuracionModificar', $row, true);
    }

    public function consultar() {
        $data = array(
            'id'=>$this->input->post('id', TRUE),
        );        
        $row['fila'] = $this->M_configuracion->operacion('buscar', $data);
        echo $this->load->view('configuracion/configuracionConsultar', $row, true);
    }

    public function agregar() {
        $data = array(
            'I_COD' => $this->input->post('codigo', TRUE),
            'V_NOM' => $this->input->post('nombre', TRUE),
            'V_DESC' => $this->input->post('descripcion', TRUE),
            'I_FLAG' => $this->input->post('flag', TRUE),
            'V_TIPO' => $this->input->post('tipo', TRUE),
            'B_FLAG_DEL' => $this->input->post('estado', TRUE),
        );

        echo $this->M_configuracion->operacion('nuevo', $data);
    }

    public function agregar1() {
        $data_id = array('id'=>$this->input->post('id', TRUE));
        $data = array(
            'I_COD' => $this->input->post('codigo', TRUE),
            'V_NOM' => $this->input->post('nombre', TRUE),
            'V_DESC' => $this->input->post('descripcion', TRUE),
            'I_FLAG' => $this->input->post('flag', TRUE),
            'V_TIPO' => $this->input->post('tipo', TRUE),
            'B_FLAG_DEL' => $this->input->post('estado', TRUE),
        );

        // echo $this->M_configuracion->operacion('nuevo', $data);
        echo $this->M_configuracion->operacion('modificar', $data,$data_id);
    }


}
