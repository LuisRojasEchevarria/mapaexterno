<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT');

class ServicioMapaexterno extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('M_serviciomapaexterno');
        date_default_timezone_set("America/Lima");
    }

    private function encodeURIComponent($str) {
        $revert = array('%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')');
        return strtr(rawurlencode($str), $revert);
    }
    //Funcion general para listar departamentos***************************************
    public function listadepartamentos() {
        $data = $this->M_serviciomapaexterno->operacion('listadepartamentos','','');
        echo json_encode($data);    
    }
    //Funcion general para listar ipas por departamento***************************************
    public function listadeipa() {
        $datab = array(
            'depa'=>$this->input->post('depa', TRUE),
        ); 
        $data = $this->M_serviciomapaexterno->operacion('listadeipa',$datab,'');
        echo json_encode($data);    
    }


    public function ipas() {
        $data = $this->M_serviciomapaexterno->operacion('todoipas','','');
        echo json_encode($data);    
    }

    public function buscarxid() {
        $data = array(
            'id'=>$this->input->post('id', TRUE),
        );                
        $dataipa = $this->M_serviciomapaexterno->operacion('buscarxid',$data,'');
        echo json_encode($dataipa);    
    }
   
    public function ipasxfiltro() {
        $data = array(
            'depa'=>$this->input->post('depa', TRUE),
            'tipo'=>$this->input->post('tipo', TRUE),
            'nombre'=>$this->input->post('nombre', TRUE),
        );                
        $dataipa = $this->M_serviciomapaexterno->operacion('ipasxfiltro',$data,'');
        echo json_encode($dataipa);    
    }
    
    public function obtenercoordenadas() {
        $data = array(
            'id'=>$this->input->post('id', TRUE),
        );                
        $dataipa = $this->M_serviciomapaexterno->operacion('obtenercoordenadas',$data,'');
        echo json_encode($dataipa);    
    }

    public function obtenercantidadfotos() {
        $data = array(
            'carpeta'=>$this->input->post('carpeta', TRUE),
        );   
        $directory = "../DOCUMENTO/SIMON/Mapas_Imagenes_Externos/".$data['carpeta']."/dpa/";
        $filecount = 0;
        $files2 = glob( $directory ."*" );
        if( $files2 ) {
            $filecount = count($files2);
        } else {
            $filecount = "ERROR";
        }
        echo json_encode($filecount);
    }

    public function obtenercantidadaudio() {
        $data = array(
            'carpeta'=>$this->input->post('carpeta', TRUE),
        );   
        $directory = "../DOCUMENTO/SIMON/Mapas_Audios_Externos/".$data['carpeta']."/audio/";
        $filecount = 0;
        $files2 = glob( $directory ."*" );
        if( $files2 ) {
            $filecount = count($files2);
        } else {
            $filecount = "ERROR";
        }
        echo json_encode($filecount);
    }

    
}