<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Maquina extends MS_Controller {

    private $tela = 'cadastro/maquina/';
    private $titulo = 'Máquinas & Equipamentos';

    function __construct() 
    {
        parent::__construct();

        $this->load->model('cadastro/Fonte_energia_model',  'fontes', false);
        $this->load->model('usina/Maquina_tipo_model',      'tipo', false);
        $this->load->model('usina/Usina_maquina_model',     'registro', false);
        $this->load->helper(array('form', 'url', 'html',    'directory'));
    }

    function index() 
    {
        $lista = [];
        $post = $this->input->post('Filter'); 
        
        $ordem = ['campo'=>'nm_maquina_tipo', 'ordem'=>'ASC'];
        $tipo = $this->tipo->filtrar([],$ordem)->result_object(); 
        
        $ordems = ['campo'=>'nm_fonte_energia', 'ordem'=>'ASC'];
        $fonte = $this->fontes->filtrar([],$ordems)->result_object();
        
        $data = [ 
            'titulo' => $this->titulo,
            'tela' => $this->tela,
            'rows' => $this->ConsultaRegistro($post),
            'ferramenta' => $this->listaferramenta(),
            'tipo' => $tipo,
            'fonte' => $fonte,
        ];

        $this->template->load('app', $this->tela . 'index', $data);
    }

    function ConsultaRegistro($get) 
    { 
        
        $param = [];
        $like = [];
        
        $param[] = ['campo' => 'id_usina', 'valor' => $this->session->userdata('WMS_CD_PESSOA')]; 
        $param[] = ['campo' => 'fl_excluido',   'valor' => 'N'];

        if ($get['descricao'] != '')
            $like[] = ['campo' => 'nm_maquina', 'valor' => $post['descricao']];

        $ordem = ['campo' => 'nm_maquina','ordem' => 'ASC'];

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
                $param['id_usina'] = $this->session->userdata('WMS_CD_PESSOA'); 
                foreach ((object) $atr as $t) {
                    if ($t->coluna != 'id' && $reg[$t->coluna] != '') {
                        $param[$t->coluna] = $this->registro->atrbtype($reg[$t->coluna], $t->tipo);
                    }
                }
                $retorno = $this->registro->inserir($param);
            break;
            case 'E':
            
                $param = array();
                foreach ((object) $atr as $t) {
                    if ($t->coluna != 'id_unidade' && $t->coluna != 'id' && $reg[$t->coluna] != '') {
                        $param[] = ['campo' => $t->coluna, 'valor' => $this->registro->atrbtype($reg[$t->coluna], $t->tipo)];
                    } 
                }
                $key = array(
                    array('campo' => 'id', 'valor' => $reg['id']),
                    array('campo' => 'id_usina', 'valor' => $this->session->userdata('WMS_CD_PESSOA')),
                ); 
                $retorno = $this->registro->editar($key, $param);
            break;
            case 'D':
                $param = [];
                $param[] = ['campo' => 'fl_excluido',   'valor' => 'S'];
                
                $key = array(
                    array('campo' => 'id', 'valor' => $reg['id']),
                    array('campo' => 'id_usina', 'valor' => $this->session->userdata('WMS_CD_PESSOA')),
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
