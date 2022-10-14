<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

include_once(APPPATH.'core/MS_Processo.php');

class Compor extends MS_Processo {

    private $tela = 'processo/compor/';
    private $titulo = 'Compor Processo';

    function __construct() 
    {
        parent::__construct();

        $this->load->model('usina/processo_model', 'registro', false); 
        $this->load->helper(array('form', 'url', 'html', 'directory'));
    }

    function index() 
    {
        $lista = [];
        $post = $this->input->post('Filter'); 

        $data = [ 
            'titulo' => $this->titulo,
            'tela' => $this->tela,
            'rows' => $this->ConsultaRegistro($post),
            'produtos' => $this->listaproduto()
        ];

        $this->template->load('app', $this->tela . 'index', $data);
    }

    function ConsultaRegistro($post) 
    { 
        
        $param = [
            ['campo' => 'id_usina', 'valor' => $this->session->userdata('WMS_CD_PESSOA')],
            ['campo' => 'fl_excluido',   'valor' => 'N']
        ];
        $ordem = ['campo' => 'nm_processo','ordem' => 'ASC'];

        $res = $this->registro->filtrar($param, $ordem)->result_object();
        return($res);
    }

    function cadastro($processo = null) 
    {
        // Caso não tenha recebido um ID
        if($processo == null) redirect($this->tela, 'refresh');

        $param = [];
        $param[] = ['campo' => 'id', 'valor' => $processo];
        $param[] = ['campo' => 'fl_padrao', 'valor' => 'N'];
        $param[] = ['campo' => 'id_usina', 'valor' => $this->session->userdata('WMS_CD_PESSOA')];
        $row = $this->registro->filtrar($param, null)->row();
        
        // Caso não tenha um retorno
        if(count($row) == 0) redirect($this->tela, 'refresh');

        $data = array(
            'titulo'      => 'Cadastro de ' . $this->titulo,
            'tela'        => $this->tela,
            'row'         => $row,
            'produtos'    => $this->listaproduto(),
            'etapas'      => $this->listaetapa($processo),
            'atividades'  => $this->listaatividade($processo),
            'maquinatipo' => $this->listamaquinatipo()
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
                $param['id'] = date('Yhis'); 
                $param['id_usina'] = $this->session->userdata('WMS_CD_PESSOA');
                $param['id_usuario'] = $this->session->userdata('WMS_CD_PESSOA'); 
                foreach ((object) $atr as $t) {
                    if ($t->coluna != 'id' && $reg[$t->coluna] != '') {
                        $param[$t->coluna] = $this->registro->atrbtype($reg[$t->coluna], $t->tipo);
                    }
                }
                $retorno = $this->registro->inserir($param);
                $label = '<div class="alert alert-'.$retorno['icon'].' alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                    <i class="mdi mdi-'.$retorno['icon-mdi'].' label-icon"></i><strong>'.$retorno['heading'].'</strong> - '.$retorno['text'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
        
                $this->session->set_flashdata('register', $label);
                redirect($this->tela.'cadastro/'.$param['id'], 'refresh');
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
                $label = '<div class="alert alert-'.$retorno['icon'].' alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                    <i class="mdi mdi-'.$retorno['icon-mdi'].' label-icon"></i><strong>'.$retorno['heading'].'</strong> - '.$retorno['text'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
        
                $this->session->set_flashdata('register', $label);
                redirect($this->tela.'/'.$reg['id'], 'refresh');
            break;
            case 'D':
                $param = [];
                $param[] = ['campo' => 'fl_excluido',   'valor' => 'S'];
                
                $key = array(
                    array('campo' => 'id', 'valor' => $this->input->get_post('ID')),
                    array('campo' => 'id_usina', 'valor' => $this->session->userdata('WMS_CD_PESSOA')),
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
    
    function SalvarEtapa()
    {

        $atr = $this->etapa->atributo();
        $reg = $this->input->get_post('Register');  

        switch ($this->input->get_post('Op')) {

            case 'I':
                // INSERT 
                $param = array();
                $param['id'] = date('Yhis'); 
                $param['id_usina'] = $this->session->userdata('WMS_CD_PESSOA');
                // $param['id_usuario'] = $this->session->userdata('WMS_CD_PESSOA'); 
                foreach ((object) $atr as $t) {
                    if ($t->coluna != 'id' && $reg[$t->coluna] != '') {
                        $param[$t->coluna] = $this->etapa->atrbtype($reg[$t->coluna], $t->tipo);
                    }
                }
                $retorno = $this->etapa->inserir($param); 
            break;
            case 'E':
            
                $param = array();
                foreach ((object) $atr as $t) {
                    if ($t->coluna != 'id_unidade' && $t->coluna != 'id' && $reg[$t->coluna] != '') {
                        $param[] = ['campo' => $t->coluna, 'valor' => $this->etapa->atrbtype($reg[$t->coluna], $t->tipo)];
                    } 
                }
                $key = [
                    ['campo' => 'id', 'valor' => $reg['id'] ],
                    ['campo' => 'id_processo', 'valor' => $reg['id_processo'] ],
                    ['campo' => 'id_usina', 'valor' => $this->session->userdata('WMS_CD_PESSOA')]
                ];
                $retorno = $this->etapa->editar($key, $param); 
            break;
            case 'D':
                $param = [];
                $param[] = ['campo' => 'fl_excluido',   'valor' => 'S'];
                
                $key = [
                    ['campo' => 'id', 'valor' => $reg['id'] ],
                    ['campo' => 'id_processo', 'valor' => $reg['id_processo'] ],
                    ['campo' => 'id_usina', 'valor' => $this->session->userdata('WMS_CD_PESSOA')]
                ]; 
                $retorno = $this->etapa->editar($key, $param);  
            break;
        } 
        $label = '<div class="alert alert-'.$retorno['icon'].' alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                    <i class="mdi mdi-'.$retorno['icon-mdi'].' label-icon"></i><strong>'.$retorno['heading'].'</strong> - '.$retorno['text'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
        
        $this->session->set_flashdata('RegisterEtapa', $label);
        redirect($this->tela.$reg['id_processo'], 'refresh');
    }
    
    function SalvarAtividade()
    {

        $atr = $this->atividade->atributo();
        $reg = $this->input->get_post('Register');  

        switch ($this->input->get_post('Op')) {

            case 'I':
                // INSERT 
                $param = array();
                $param['id'] = date('Yhis'); 
                $param['id_usina'] = $this->session->userdata('WMS_CD_PESSOA'); 
                foreach ((object) $atr as $t) {
                    if ($t->coluna != 'id' && $reg[$t->coluna] != '') {
                        $param[$t->coluna] = $this->atividade->atrbtype($reg[$t->coluna], $t->tipo);
                    }
                }
                $retorno = $this->atividade->inserir($param); 
            break;
            case 'E':
            
                $param = array();
                foreach ((object) $atr as $t) {
                    if ($t->coluna != 'id' && $t->coluna != 'id' && $reg[$t->coluna] != '') {
                        $param[] = ['campo' => $t->coluna, 'valor' => $this->atividade->atrbtype($reg[$t->coluna], $t->tipo)];
                    } 
                }
                $key = [
                    ['campo' => 'id', 'valor' => $reg['id'] ], 
                    ['campo' => 'id_usina', 'valor' => $this->session->userdata('WMS_CD_PESSOA')]
                ];
                $retorno = $this->atividade->editar($key, $param); 
            break;
            case 'D':
                $param = [];
                $param[] = ['campo' => 'fl_excluido',   'valor' => 'S'];
                
                $key = [
                    ['campo' => 'id', 'valor' => $reg['id'] ], 
                    ['campo' => 'id_usina', 'valor' => $this->session->userdata('WMS_CD_PESSOA')]
                ]; 
                $retorno = $this->atividade->editar($key, $param);  
            break;
        } 
        $label = '<div class="alert alert-'.$retorno['icon'].' alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                    <i class="mdi mdi-'.$retorno['icon-mdi'].' label-icon"></i><strong>'.$retorno['heading'].'</strong> - '.$retorno['text'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
        
        $this->session->set_flashdata('RegisterEtapa', $label);
        redirect($this->tela.$reg['id_processo'], 'refresh');
    }

}
