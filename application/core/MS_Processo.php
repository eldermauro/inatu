<?php 
if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed');
 
class MS_Processo extends MS_Controller {
        
    function __construct() {
        parent::__construct(); 

        // PUBLIC
        $this->load->model('usina/processo_model', 'processop', false); 
        $this->load->model('usina/Processo_etapa_model', 'etapa', false);
        $this->load->model('usina/Processo_etapa_atividade_model', 'atividade', false);
        $this->load->model('usina/Maquina_tipo_model', 'maquinatipo', false); 
        $this->load->model('usina/Usina_maquina_model', 'maquinausina', false); 
        $this->load->model('usina/ajudante_model', 'ajudante', false);
        $this->load->helper(array('form', 'url', 'html', 'directory')); 
    }
    
    function listaajudante()
    {
        $param = [
            ['campo' => 'id_usina',      'valor' => $this->session->userdata('WMS_CD_PESSOA')],
            ['campo' => 'fl_excluido',   'valor' => 'N']
        ];
        $ordem = ['campo' => 'nm_ajudante','ordem' => 'ASC'];
        $res = $this->ajudante->filtrar($param,$ordem)->result_object(); 
        
        if(count($res) > 0)
            return $res;
        else
            return [];
    }
    
    function listamaquina()
    {
        $param = [
            ['campo' => 'id_usina',      'valor' => $this->session->userdata('WMS_CD_PESSOA')],
            ['campo' => 'fl_excluido',   'valor' => 'N'],
            ['campo' => 'fl_tipo',       'valor' => 'M']
        ];
        $ordem = ['campo' => 'nm_maquina','ordem' => 'ASC'];
        $res = $this->maquinausina->filtrar($param,$ordem)->result_object(); 
        
        if(count($res) > 0)
            return $res;
        else
            return [];
    }
    
    function listaprocesso($processo)
    {
        $param = [ 
            ['campo' => 'id',  'valor' => $processo],
        ];
        $ordem = ['campo'=>'id', 'ordem'=>'ASC'];
        $res = $this->processop->filtrar($param,$ordem)->row(); 
        return $res;
    }
    
    function listaetapa($processo)
    {
        $param = [
            // ['campo' => 'fl_ativo',  'valor' => 'S'],
            ['campo' => 'id_processo',  'valor' => $processo],
        ];
        $ordem = ['campo'=>'id', 'ordem'=>'ASC'];
        $res = $this->etapa->filtrar($param,$ordem)->result_object(); 
        return $res;
    }
    
    function listaatividade($processo)
    {
        $param = [
            ['campo' => 'fl_excluido',  'valor' => 'N'],
            ['campo' => 'id_processo',  'valor' => $processo], 
        ];
        $ordem = ['campo'=>'nm_atividade', 'ordem'=>'ASC'];
        $res = $this->atividade->filtrar($param,$ordem)->result_object(); 
        return $res;
    }
    
    function listamaquinatipo()
    {
        $param = [
             
        ];
        $ordem = ['campo'=>'nm_maquina_tipo', 'ordem'=>'ASC'];
        $res = $this->maquinatipo->filtrar($param,$ordem)->result_object(); 
        return $res;
    }
     
    // LISTA OS PROCESSOS CRIADOS PELO IDESAM
    function listaprocessoidesam()
    {
        $param = [
            ['campo' => 'fl_padrao',     'valor' => 'S'],
            ['campo' => 'fl_excluido',   'valor' => 'N']
        ];
        $ordem = ['campo' => 'nm_processo','ordem' => 'ASC'];
        $res = $this->processop->filtrar($param,$ordem)->result_object();
        
        if(count($res) > 0)
            return $res;
        else
            return [];
    }
    
    function listaprocessousina()
    {
        $param = [
            ['campo' => 'id_usina',      'valor' => $this->session->userdata('WMS_CD_PESSOA')],
            ['campo' => 'fl_excluido',   'valor' => 'N']
        ];
        $ordem = ['campo' => 'nm_processo','ordem' => 'ASC'];
        $res = $this->processop->filtrar($param,$ordem)->result_object(); 
        
        if(count($res) > 0)
            return $res;
        else
            return [];
    } 
    
    function listatodosprocessos()
    { 
        $idesam = $this->listaprocessoidesam();
        $usina = $this->listaprocessousina();
        
        $processos = array_merge($usina, $idesam);
        return $processos;
    } 
    
    function item($processo = null, $atividade = null)
    {
        $data = array(
            'titulo'      => 'Acompanhamento de ' . $this->titulo,
            'tela'        => $this->tela,
            'row'         => $row,
        );
        $this->load->view('producao/atividade/item', $data);
    }
     
    
}