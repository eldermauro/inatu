<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Associado extends MS_Controller {

    private $tela = 'cadastro/associado/';
    private $titulo = 'Associado';

    function __construct() 
    {
        parent::__construct();

        $this->load->model('cadastro/pessoa_model', 'registro', false);
        $this->load->helper(array('form', 'url', 'html', 'directory'));
    }

    function index() 
    { 
        $post = $this->input->post('Filter'); 

        $data = [ 
            'titulo' => $this->titulo,
            'tela' => $this->tela,
            'rows' => $this->ConsultaRegistro($post)
        ];

        $this->template->load('app', $this->tela . 'index', $data);
    }

    function ConsultaRegistro($post) 
    { 
        
        $param = [];
        $like = [];
        
        $param[] = ['campo' => 'cd_associacao', 'valor' => $this->session->userdata('WMS_CD_PESSOA')];
        
        if ($post['ativo'] == 'N')
            $param[] = ['campo' => 'fl_ativo', 'valor' => 'N'];
        
        if ($post['ativo'] == 'S')
            $param[] = ['campo' => 'fl_ativo', 'valor' => 'S'];

        if ($post['descricao'] != '')
            $like[] = ['campo' => 'nm_pessoa', 'valor' => $post['descricao']];

        $ordem = ['campo' => 'nm_pessoa','ordem' => 'ASC'];

        $res = $this->registro->filtrar_like($param, $like, $ordem)->result_object();
        return($res);
    }

    function cadastro($id = null) 
    {
        if($id != null){
            $param = [];
            $param[] = ['campo' => 'cd_pessoa', 'valor' => $id];
            $param[] = ['campo' => 'cd_associacao', 'valor' => $this->session->userdata('WMS_CD_PESSOA')];
            $row = $this->registro->filtrar($param, null)->row();
        }
        
        $data = array(
            'titulo' => 'Cadastro de ' . $this->titulo,
            'tela' => $this->tela, 
            'row' => $row,
        );
        $this->template->load('app', $this->tela . 'cadastro', $data);
    } 
    
    function SalvarDados()
    {

        $atr = $this->registro->atributo();
        $reg = $this->input->get_post('Register');  

        switch ($this->input->get_post('Op')) {

            case 'I':
                // INSERT 
                $param = array();
                $param['cd_associacao'] = $this->session->userdata('WMS_CD_PESSOA'); 
                $param['ds_login'] = $this->registro->atrbtype($reg['nr_cpf_cnpj'], 'cpf');
                $param['ds_senha'] =  md5(sha1($this->registro->atrbtype($reg['nr_cpf_cnpj'], 'cpf'))); 
                foreach ((object) $atr as $t) {
                    if ($t->coluna != 'cd_pessoa' && $reg[$t->coluna] != '') {
                        $param[$t->coluna] = $this->registro->atrbtype($reg[$t->coluna], $t->tipo);
                    }
                }
                $retorno = $this->registro->inserir($param);
                $label = '<div class="alert alert-'.$retorno['icon'].' alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                    <i class="mdi mdi-'.$retorno['icon-mdi'].' label-icon"></i><strong>'.$retorno['heading'].'</strong> - '.$retorno['text'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
        
                $this->session->set_flashdata('register', $label);
                redirect($this->tela, 'refresh');
            break;
            case 'E':
            
                $param = array();
                foreach ((object) $atr as $t) {
                    if ($t->coluna != 'cd_associacao' && $t->coluna != 'cd_pessoa' && $reg[$t->coluna] != '') {
                        $param[] = ['campo' => $t->coluna, 'valor' => $this->registro->atrbtype($reg[$t->coluna], $t->tipo)];
                    } 
                }
                $key = array(
                    array('campo' => 'cd_pessoa',     'valor' => $reg['cd_pessoa']),
                    array('campo' => 'cd_associacao', 'valor' => $this->session->userdata('WMS_CD_PESSOA')),
                );                
                
                $retorno = $this->registro->editar($key, $param);
                
                $label = '<div class="alert alert-'.$retorno['icon'].' alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                    <i class="mdi mdi-'.$retorno['icon-mdi'].' label-icon"></i><strong>'.$retorno['heading'].'</strong> - '.$retorno['text'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
        
                $this->session->set_flashdata('register', $label);
                redirect($this->tela.'/'.$reg['cd_pessoa'], 'refresh');
            break;
            case 'D':
                $param = [];
                $param[] = ['campo' => 'fl_ativo',   'valor' => 'S'];
                
                $key = array(
                    array('campo' => 'cd_pessoa',     'valor' => $this->input->get_post('ID')),
                    array('campo' => 'cd_associacao', 'valor' => $this->session->userdata('WMS_CD_PESSOA')),
                );
                $retorno = $this->registro->editar($key, $param); 
                $label = '<div class="alert alert-'.$retorno['icon'].' alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                    <i class="mdi mdi-'.$retorno['icon-mdi'].' label-icon"></i><strong>'.$retorno['heading'].'</strong> - '.$retorno['text'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
        
                $this->session->set_flashdata('register', $label);
                redirect($this->tela, 'refresh');
            break;
        } 
    }

}
