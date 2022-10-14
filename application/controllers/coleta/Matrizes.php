<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Matrizes extends MS_Controller {

    private $tela = 'coleta/matrizes/';
    private $titulo = 'Matrizes';

    function __construct() 
    {
        parent::__construct();
        
        $this->load->model('usina/Coleta_localidade_model', 'local', false);
        $this->load->model('usina/Matriz_model', 'registro', false);
        $this->load->helper(array('form', 'url', 'html', 'directory'));
    }

    function index() 
    {
        $lista = [];
        $post = $this->input->post('Filter'); 
        
        
        $param = [
            ['campo' => 'fl_ativo',  'valor' => 'S'],
            ['campo' => 'fl_excluido', 'valor' => 'N'],
            ['campo' => 'cd_industria','valor' => $this->session->userdata('WMS_CD_PESSOA')]
        ];
        $ordem = ['campo'=>'nm_localidade', 'ordem'=>'ASC'];
        $local = $this->local->filtrar($param,$ordem)->result_object();

        $data = [ 
            'titulo' => $this->titulo,
            'tela' => $this->tela,
            'rows' => $this->ConsultaRegistro($post),
            'localidade' => $local
        ];

        $this->template->load('app', $this->tela . 'index', $data);
    }

    function ConsultaRegistro($get) 
    { 
        
        $param = [];
        $like = [];
        
        $param[] = ['campo' => 'cd_industria','valor' => $this->session->userdata('WMS_CD_PESSOA')];
        $param[] = ['campo' => 'fl_excluido', 'valor' => 'N'];
        // 

        if ($get['descricao'] != '')
            $like[] = ['campo' => 'nm_localidade', 'valor' => $post['descricao']];

        $ordem = ['campo' => 'nm_localidade','ordem' => 'ASC'];

        $res = $this->registro->filtrar_like($param, $like, $ordem)->result_object();
        return($res);
    } 
    
    function SalvarDados()
    {

        $atr = $this->registro->atributo();
        $reg = $this->input->get_post('Register');  

        switch ($this->input->get_post('Op')) {

            case 'I':
                // INSERT 
                $param = array();
                $param['cd_industria'] = $this->session->userdata('WMS_CD_PESSOA'); 
                foreach ((object) $atr as $t) { // 
                    if ($t->coluna != 'cd_industria' && $t->coluna != 'cd_localidade' && $reg[$t->coluna] != '') {
                        $param[$t->coluna] = $this->registro->atrbtype($reg[$t->coluna], $t->tipo);
                    }
                }
                $retorno = $this->registro->inserir($param); 
            
            break;
            case 'E':
            
                $param = array();
                foreach ((object) $atr as $t) {
                    if ($t->coluna != 'cd_industria' && $t->coluna != 'cd_localidade' && $reg[$t->coluna] != '') {
                        $param[] = ['campo' => $t->coluna, 'valor' => $this->registro->atrbtype($reg[$t->coluna], $t->tipo)];
                    } 
                }
                $key =[
                    ['campo' => 'cd_localidade', 'valor' => $reg['cd_localidade']],
                    ['campo' => 'cd_industria',  'valor' => $this->session->userdata('WMS_CD_PESSOA')]
                ];
                $retorno = $this->registro->editar($key, $param); 
        
            break;
            case 'D':
                $param = [
                    ['campo' => 'fl_excluido','valor' => 'S'], 
                ];

                $key =[
                    ['campo' => 'cd_localidade', 'valor' => $reg['cd_localidade']],
                    ['campo' => 'cd_industria',  'valor' => $this->session->userdata('WMS_CD_PESSOA')]
                ];
                $retorno = $this->registro->editar($key, $param);
                
            break;
        } 
        
        $label = '<div class="alert alert-'.$retorno['icon'].' alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                    <i class="mdi mdi-'.$retorno['icon-mdi'].' label-icon"></i><strong>'.$retorno['heading'].'</strong> - '.$retorno['text'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>'; 
        $this->session->set_flashdata('register', $label);
        redirect($this->tela, 'refresh');
    }

}
