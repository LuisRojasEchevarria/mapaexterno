<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('M_login');
        $this->load->model('M_usuario');
        $this->load->model('M_indicador');
        date_default_timezone_set("America/Lima");
	}

	public function index()
	{
		$this->load->view('login/login');
	}

    public function login()
    {
        $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[3]|max_length[45]');
        $this->form_validation->set_rules('pass', 'pswd', 'trim|required|min_length[3]|max_length[45]');
        $this->form_validation->set_error_delimiters('<div class="input-group-sm alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ','</div>');
                
        // $vusu=$this->input->post('email', TRUE);
        // $vpas=$this->input->post('email', TRUE) . $this->input->post('pass', TRUE);

        
        if ($this->form_validation->run() == FALSE)
            {
                    $this->load->view('login/login');
            }else{
                    $vusu=$this->input->post('email', TRUE);
                    //desarrollo
                    // $vpas=$this->input->post('email', TRUE) . $this->input->post('pass', TRUE);
                    // $vpas=md5($vpas);

                    //producción
                    $vpas=$this->input->post('pass', TRUE);
                    //
                    $rsp=$this->M_login->operacion('buscar',$vusu,$vpas);

                    // var_dump($rsp);
                    // print_r($rsp);
                    // return;

                        if($rsp!="error")
                        {   
                            $this->session->sid_usuario=$rsp->Per_DNI;
                            $this->session->sname=$rsp->Usu_Alias;
                            $this->session->srol=$rsp->Rol_Id;
                            // //
                            $this->load->view('template/header.php');

                            $data = array(
                                'usuario'=> $vusu,
                            );
                            //-- Datos de la Dependencia
                            $rsp_dep =$this->M_usuario->operacion('buscar_dependencia', array('dni' => trim($this->session->sid_usuario) ) );
                            // var_dump($rsp_dep);
                            if($rsp_dep != 'ERROR'){
                                $this->session->sdep_id=$rsp_dep->id;
                                $this->session->sdep_nombre=$rsp_dep->Dep_Nombre;
                                $this->session->sdep_siglas=$rsp_dep->Dep_Sigla;    
                            }else{
                                $this->session->sdep_id='';
                                $this->session->sdep_nombre='';
                                $this->session->sdep_siglas='';
                            }
                            //--

                            $resp=$this->M_usuario->operacion('buscar_por_usuario',$data);
                            
                            if( isset($resp->V_ROL) ){
                                $this->session->srolmenu=$resp->V_ROL;    
                                $this->session->snombresapellidos=$resp->V_NOMAPE;
                                $this->session->spermiso=$resp->V_PERMISO;
                            }
                            // print_r($resp);

                            //-- Guardar registro LOGIN para los indicadores
                            $data = array(
                                'V_DIRECCION' => 'DIGENIPAA',
                                'I_FLAG' => 1,
                                'V_OPCION' => 'LOGIN',
                                'V_NUM_DOC' => $this->session->sid_usuario,
                                'V_NOMBRES_USUARIO' => $this->session->snombresapellidos,
                                'DEP_ID' => $this->session->sdep_id,
                                'V_CODIGO_UNIDAD_FUNCIONAL' => $this->session->sdep_siglas,
                                'V_NOMBRE_UNIDAD_FUNCIONAL' => $this->session->sdep_nombre,
                    
                                'I_ID_SITU_INV' => 0,
                                'Infra_Id' => 0,
                                'V_NOMBRE_IPA' => '',
                    
                                'V_USU_REG' => $this->session->sname,
                                'D_FEC_REG' => date("Y-m-d H:i:s"),
                                'V_IP_REG' => $this->input->ip_address(),
                            );
                    
                            $resp_login = $this->M_indicador->operacion('buscar_indicador_login');
                            // var_dump($resp_login);
                            if($resp_login == 'ERROR'){
                                $x=$this->M_indicador->operacion('nuevo', $data);
                            }
                            //--

                            $this->load->view('template/menu.php');
                            $this->load->view('template/main.php');
                            $this->load->view('template/footer.php');
                            // print_r($rsp);

                        }else{
                            
                        redirect('/login');
                        
                        } 
                           
            }
    }

    public function log_out()
    {
        $this->session->sess_destroy();    
        redirect('/login'); 
    }
}
