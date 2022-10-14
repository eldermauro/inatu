<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Conta extends CI_Controller 
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
        $this->load->view('conta'); 
    } 

    function token() 
    { 
 
        $this->form_validation->set_rules('INTDoc', 'Documento', 'trim|required|callback_validar');
        $this->form_validation->set_rules('INTName', 'Nome', 'trim|required');
        $this->form_validation->set_rules('INTEmail', 'Email', 'trim|required');
        $this->form_validation->set_rules('INTPas',   'Senha', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->form_validation->set_error_delimiters('<small class="alert alert-danger d-block"><strong>', '</strong></small>');
            $this->load->view($this->tela.'conta');
        } else { 
            redirect('conta', 'refresh');
        }
    } 

    function validar($doc)
    { 
	$p = [];
        $p[] = ['campo' => 'ds_login', 'valor' => $this->input->post('INTDoc')]; 
        $p[] = ['campo' => 'fl_ativo', 'valor' => 'S']; 

        $result = $this->pessoa->filtrar($p)->row(); 

        if ($result->cd_pessoa == '') 
        {
           // $this->form_validation->set_message('validar', "<span class='fa fa-remove-circle'></span> Dados inválidos");
            return FALSE;
        }
        else 
        {  
             return FALSE; 
        }
    } 

}
