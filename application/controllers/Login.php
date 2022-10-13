<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('M_login');
        $this->load->model('M_usuario');
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
                    $vpas=$this->input->post('email', TRUE) . $this->input->post('pass', TRUE);
                    $vpas=md5($vpas);
                    //producción
                    // $vpas=$this->input->post('pass', TRUE);

                    $rsp=$this->M_login->operacion('buscar',$vusu,$vpas);    

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
                            $resp=$this->M_usuario->operacion('buscar_por_usuario',$data); 
                            if( isset($resp->V_ROL) ){
                                $this->session->srolmenu=$resp->V_ROL;    
                                $this->session->snombresapellidos=$resp->V_NOMAPE;
                                $this->session->spermiso=$resp->V_PERMISO;
                            }
                            // print_r($resp);

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
