<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
 
    private $tela = '';

    function __construct()
    {
        parent::__construct();
 
        $this->load->model('cadastro/Pessoa_model', 'pessoa', TRUE);  
        $this->load->helper(array('form', 'url', 'html', 'directory')); 
        $this->load->library('form_validation');
    }
  
    public function index() 
    {
        //remove as sessoes
        $this->session->sess_destroy();
        $this->load->view('login'); 
    } 

    function token() 
    { 
 
        $this->form_validation->set_rules('MSLoginAP', 'Login', 'trim|required');
        $this->form_validation->set_rules('MSSenhaAP', 'Senha', 'trim|required|callback_validar');

        if ($this->form_validation->run() == FALSE) {
            $this->form_validation->set_error_delimiters('<small class="alert alert-danger d-block"><strong>', '</strong></small>');
            $this->load->view($this->tela.'login');
        } else { 
            redirect('main', 'refresh');
        }
    } 

    function validar($ps)
    { 
	$p = [];
        $p[] = ['campo' => 'ds_login', 'valor' => $this->input->post('MSLoginAP')]; 
        $p[] = ['campo' => 'fl_ativo', 'valor' => 'S'];
        $p[] = ['campo' => 'cd_pessoa_tipo IN(3,4)', 'valor' => '']; 
       // $p[] = ['campo' => 'ds_senha', 'valor' => md5(sha1($ps))]; 

        $result = $this->pessoa->filtrar($p)->row(); 

        if ($result->cd_pessoa == '') 
        {
            $this->form_validation->set_message('validar', "<span class='fa fa-remove-circle'></span> Dados inválidos");
            return FALSE;
        }
        else 
        {  
            $sess_array = array();        
            $this->session->set_userdata('WMS_CD_PERFIL',   $result->cd_perfil);
            $this->session->set_userdata('WMS_NM_PERFIL',   $result->nm_perfil);
            $this->session->set_userdata('WMS_NM_FANTASIA', $result->nm_fantasia);
            $this->session->set_userdata('WMS_DS_EMAIL',    $result->ds_email);
            $this->session->set_userdata('WMS_DS_FOTO',     $result->ds_foto);
            $this->session->set_userdata('WMS_CD_PESSOA',   $result->cd_pessoa);
            $this->session->set_userdata('WMS_NM_PESSOA',   $result->nm_fantasia);
            $this->session->set_userdata('WMS_CD_TIPO',     $result->cd_pessoa_tipo);
            $this->session->set_userdata('WMS_NM_TIPO',     $result->nm_pessoa_tipo);
            $this->session->set_userdata('WMS_NR_CELULAR',  $result->nr_celular);
            return TRUE; 
            
        }
    }
      
    function recuperar()
    {
        $p = array(
            array('campo' => 'EMAIL', 'valor' => $this->input->get_post('Login')),
            array('campo' => 'ATIVO', 'valor' => 'S'),
        );
        $r = $this->pessoa->filtro_login($p);

        $data = array(
            'row' => $r,
            'senha' => $this->pessoa->geraSenha(),
        );
        $this->load->view($this->tela.'email_recuperar',$data);
    }

    function logout()
    {
        //remove as sessoes  
        $this->session->sess_destroy();
        redirect(base_url('login'), 'refresh');
    } 

}
