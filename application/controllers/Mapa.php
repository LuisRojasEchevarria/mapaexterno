<?php

class Mapa extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('M_mapainteractivo');
        $this->load->model('M_indicador');
        date_default_timezone_set("America/Lima");
    }

    private function encodeURIComponent($str) {
        $revert = array('%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')');
        return strtr(rawurlencode($str), $revert);
    }

    //Funciones Iniciales************************************************************************************
    public function index(){
        $contador = $this->M_indicador->operacion('buscar_cantidad','');
        $data['fila'] = $contador;
        $ipaData = $this->M_mapainteractivo->operacion('todoipashabilitados','','');
        $data['ipa_data'] = $this->encodeURIComponent(json_encode($ipaData));
        echo $this->load->view('mapa/mapa', $data, true);
	}

    public function indexdos(){
        $contador = $this->M_indicador->operacion('buscar_cantidad','');
        $data['fila'] = $contador;
        $ipaData = $this->M_mapainteractivo->operacion('todoipashabilitados','','');
        $data['ipa_data'] = $this->encodeURIComponent(json_encode($ipaData));
        echo $this->load->view('mapa/mapa2', $data, true);
	}

    public function ipas() {
        $data = $this->M_mapainteractivo->operacion('todoipas','','');
        echo json_encode($data);    
    }

    //Funcion general para listar departamentos***************************************
    public function listadepartamentos() {
        $data = $this->M_mapainteractivo->operacion('listadepartamentos','','');
        echo json_encode($data);    
    }
    
    //Funcion general para listar ipas por departamento***************************************
    public function listadeipa() {
        $datab = array(
            'depa'=>$this->input->post('depa', TRUE),
        ); 
        $data = $this->M_mapainteractivo->operacion('listadeipa',$datab,'');
        echo json_encode($data);    
    }
    //Funcion general para listar fases de proyectos***************************************
    public function listafases() {
        $data = $this->M_mapainteractivo->operacion('','','');
        echo json_encode($data);    
    }
    //Funcion general para listar tipos de ipa***************************************
    public function tiposipa() {
        $data = $this->M_mapainteractivo->operacion('tiposipa','','');
        echo json_encode($data);    
    }

    public function buscarxid() {
        $data = array(
            'id'=>$this->input->post('id', TRUE),
        );
        //--- INDICADOR
        $data_indicador = array(
            'Infra_Id' => intval($this->input->post('id', TRUE)),
            'V_ORIGEN' => 'EXTERNO',
            'V_TIPO' => 'IPA',
            'V_FILTRO' => 'ID',
            'V_LATITUD' => $this->input->post('latitud', TRUE),
            'V_LONGITUD' => $this->input->post('longitud', TRUE),
            'V_IP_REG' => $this->input->ip_address(),
        );

        $this->M_indicador->operacion('nuevo', $data_indicador);
        //---        
        $dataipa = $this->M_mapainteractivo->operacion('buscarxid',$data,'');
        echo json_encode($dataipa);    
    }
   
    public function ipasxfiltro() {

        $data = array(
            'depa'=>$this->input->post('depa', TRUE),
            'tipo'=>$this->input->post('tipo', TRUE),
            'nombre'=>$this->input->post('nombre', TRUE),
        );   

        $dataipa = $this->M_mapainteractivo->operacion('ipasxfiltro',$data,'');
        echo json_encode($dataipa);    
    }
    
    public function obtenercoordenadas() {
        $data = array(
            'id'=>$this->input->post('id', TRUE),
        );                
        $dataipa = $this->M_mapainteractivo->operacion('obtenercoordenadas',$data,'');
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

    //Funciones para Proyectos************************************************************************************
    public function indexproyectos() {
        $proData = $this->M_mapainteractivo->operacion('todoproyectos','','');
        $primeraCarga = $this->input->get('primera_carga', TRUE) === 'true' ? true : false;
        $data['pro_data'] = $primeraCarga ? $this->encodeURIComponent(json_encode($proData)) : $proData;
        echo $primeraCarga ? $this->load->view('mapa/mapaInversiones', $data, true) : json_encode($data);
    }

    public function proyectos() {
        $data = $this->M_mapainteractivo->operacion('todoproyectos','','');
        echo json_encode($data);    
    }

    public function buscarxidpro() {
        $data = array(
            'id'=>$this->input->post('id', TRUE),
        );                
        $dataipa = $this->M_mapainteractivo->operacion('buscarxidpro',$data,'');
        echo json_encode($dataipa);    
    }
   
    public function proxfiltro() {
        $data = array(
            'depa'=>$this->input->post('depa', TRUE),
            'fase'=>$this->input->post('fase', TRUE),
            'monto1'=>$this->input->post('monto1', TRUE),
            'monto2'=>$this->input->post('monto2', TRUE),
            'porc1'=>$this->input->post('porc1', TRUE),
            'porc2'=>$this->input->post('porc2', TRUE),
        );                
        $dataipa = $this->M_mapainteractivo->operacion('proxfiltro',$data,'');
        echo json_encode($dataipa);    
    }

    public function proxfiltromas() {
        $data = array(
            'depa'=>$this->input->post('depa', TRUE),
            'fase'=>$this->input->post('fase', TRUE),
            'monto1'=>$this->input->post('monto1', TRUE),
            'monto2'=>$this->input->post('monto2', TRUE),
            'porc1'=>$this->input->post('porc1', TRUE),
            'porc2'=>$this->input->post('porc2', TRUE),
            'habi'=>$this->input->post('habi', TRUE),
            'tra'=>$this->input->post('tra', TRUE),
            'ope'=>$this->input->post('ope', TRUE),
        );                
        $dataipa = $this->M_mapainteractivo->operacion('proxfiltromas',$data,'');
        echo json_encode($dataipa);    
    }
}