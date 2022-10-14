<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Lote extends MS_Controller {

    private $tela = 'producao/lote/';
    private $titulo = 'Estoque';

    function __construct() 
    {
        parent::__construct();

        $this->load->model('usina/Lote_item_model', 'item', false);
        $this->load->model('usina/Lote_model', 'registro', false); 
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
            'rows' => $this->ConsultaRegistro($post)
        ];

        $this->template->load('app', $this->tela . 'index', $data);
    }

    function ConsultaRegistro($post) 
    { 
        
        $param = [];
        $like = [];
        
        $param[] = ['campo' => 'cd_industria', 'valor' => $this->session->userdata('WMS_CD_PESSOA')];
        if ($post['cd_produto'] != '')
            $param[] = ['campo' => 'cd_produto', 'valor' => $post['cd_produto']];

        if ($get['descricao'] != '')
            $like[] = ['campo' => 'nm_produto', 'valor' => $post['descricao']];

        $ordem = ['campo' => 'dt_cadastro','ordem' => 'ASC'];

        $res = $this->registro->filtrar_like($param, $like, $ordem)->result_object();
        return($res);
    }

    function cadastro($id = null) 
    {
        if($id == null)
            redirect($this->tela, 'refresh');
        
        $param = [
            ['campo' => 'cd_industria', 'valor' => $this->session->userdata('WMS_CD_PESSOA')],
            ['campo' => 'cd_lote', 'valor' => $id]
        ];
        $row = $this->registro->filtrar($param, null)->row();
        $itens = $this->item->filtrar($param,null)->result_object(); 
            
        $data = array(
            'titulo' => 'Acompanhamento de ' . $this->titulo,
            'tela' => $this->tela, 
            'row' => $row,
            'itens' => $itens
        );
        $this->template->load('app', $this->tela . 'cadastro', $data);
    }

}
