<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Receber extends MS_Controller {

    private $tela = 'coleta/receber/';
    private $titulo = 'Receber Coleta';

    function __construct() 
    {
        parent::__construct();

        $this->load->model('usina/Coleta_item_model', 'registro', false); 
        $this->load->helper(array('form', 'url', 'html', 'directory'));
    }

    function index() 
    {
        $lista = [];
        $post = $this->input->post('Filter'); 

        $data = [
            'titulo' => $this->titulo,
            'tela' => $this->tela,
            'produto' => $this->listaproduto(),
            'produtor' => $this->listaassociado(),
            'local' => $this->listalocal(),
            'rows' => $this->ConsultaRegistro($post),
            
        ];

        $this->template->load('app', $this->tela . 'index', $data);
    }

    function ConsultaRegistro($post) 
    { 
        
        $param = [];
        $like = [];
        
        $param[] = ['campo' => 'cd_industria',    'valor' => $this->session->userdata('WMS_CD_PESSOA')]; 
        $param[] = ['campo' => 'nr_aprovado',     'valor' => '0']; 
        $param[] = ['campo' => 'nr_coletada > 0', 'valor' => '']; 
        $param[] = ['campo' => 'fl_excluido',     'valor' => 'N']; 

        if ($post['cd_produtor'] != '')
            $param[] = ['campo' => 'cd_produtor', 'valor' => $post['cd_produtor']];
        
        if ($post['cd_produto'] != '')
            $param[] = ['campo' => 'cd_produto', 'valor' => $post['cd_produto']];
        
        if ($post['descricao'] != '')
            $like[] = ['campo' => 'nm_produtor', 'valor' => $post['descricao']];

        $ordem = ['campo' => 'dt_sinc','ordem' => 'DESC'];

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
                $param['cd_lote'] = date('dmYhi');
                $param['cd_coleta'] = $this->session->userdata('WMS_CD_PESSOA').date('mYhi');
                foreach ((object) $atr as $t) {
                    if ($t->coluna != 'cd_industria' && $t->coluna != 'id' && $reg[$t->coluna] != '') {
                        $param[$t->coluna] = $this->registro->atrbtype($reg[$t->coluna], $t->tipo);
                    }
                }
                $retorno = $this->registro->inserir($param); 
            break;
            case 'E':
            
                $param = array();
                foreach ((object) $atr as $t) {
                    if ($t->coluna != 'cd_industria' && $t->coluna != 'id' && $reg[$t->coluna] != '') {
                        $param[] = ['campo' => $t->coluna, 'valor' => $this->registro->atrbtype($reg[$t->coluna], $t->tipo)];
                    } 
                }
                $key = array(
                    array('campo' => 'id', 'valor' => $reg['id']),
                    array('campo' => 'cd_industria', 'valor' => $this->session->userdata('WMS_CD_PESSOA')),
                ); 
                $retorno = $this->registro->editar($key, $param); 
            break;
            case 'D':
                $param = [];
                $param[] = ['campo' => 'fl_excluido',   'valor' => 'S'];
                
                $key = array(
                    array('campo' => 'id', 'valor' => $reg['id']),
                    array('campo' => 'cd_industria', 'valor' => $this->session->userdata('WMS_CD_PESSOA')),
                );
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
