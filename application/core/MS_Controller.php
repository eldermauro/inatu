<?php 
if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed');

class MS_Controller extends CI_Controller {
        
    function __construct() {
        parent::__construct(); 

        // PUBLIC 
        $this->load->model('cadastro/Produto_model', 'produto', false);
        $this->load->model('cadastro/Insumo_model',  'insumo', false);
        $this->load->model('cadastro/pessoa_model',  'associado', false);
        $this->load->model('usina/Coleta_localidade_model', 'localiza', false);
        $this->load->helper(array('form', 'url', 'html', 'directory'));

        if ($this->session->userdata('WMS_CD_PESSOA') == '') {
            redirect(base_url('login/logout'), 'refresh');
        } 
    
    } 
    
    function listalocal()
    { 
        $param = [];
        $param[] = ['campo' => 'cd_industria','valor' => $this->session->userdata('WMS_CD_PESSOA')]; 
        $param[] = ['campo' => 'fl_ativo',    'valor' => 'S'];
        $param[] = ['campo' => 'fl_excluido', 'valor' => 'N'];
        $ordem = ['campo'=>'nm_localidade', 'ordem'=>'ASC'];
        $res = $this->localiza->filtrar($param,$ordem)->result_object(); 
        return $res;
    }
    
    function listaassociado()
    { 
        $param = [];
        $param[] = ['campo' => 'cd_associacao', 'valor' => $this->session->userdata('WMS_CD_PESSOA')];
        $ordem = ['campo'=>'nm_pessoa', 'ordem'=>'ASC'];
        $res = $this->associado->filtrar($param,$ordem)->result_object(); 
        return $res;
    }
    
    function listaproduto()
    { 
        $param = [
            ['campo' => 'fl_ativo',  'valor' => 'S'],
        ];
        $ordem = ['campo'=>'nm_produto', 'ordem'=>'ASC'];
        $res = $this->produto->filtrar($param,$ordem)->result_object(); 
        return $res;
    }
    
    function listainsumo()
    { 
        $param = [
           // ['campo' => 'fl_coleta',  'valor' => 'S'],
        ];
        $ordem = ['campo'=>'nm_insumo', 'ordem'=>'ASC'];
        $res = $this->insumo->filtrar($param,$ordem)->result_object(); 
        return $res;
    }
    
    function listaferramenta()
    { 
        $param = [
           ['campo' => 'fl_tipo',  'valor' => 'F'],
        ];
        $ordem = ['campo'=>'nm_insumo', 'ordem'=>'ASC'];
        $res = $this->insumo->filtrar($param,$ordem)->result_object(); 
        return $res;
    }
    
    function chartprocess()
    { 
        $param = [
           ['campo' => 'id_usina', 'valor' => $this->session->userdata('WMS_CD_PESSOA')],
           ['campo' => 'nr_ano',   'valor' => (date('Y')-1)],
        ];
        $res = $this->produto->views('usina.vw_dash_processo',$param,[])->result_object(); 
        return $res;
    }

}