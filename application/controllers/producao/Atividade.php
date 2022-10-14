<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

include_once(APPPATH.'core/MS_Processo.php');

class Atividade extends MS_Processo
{
    private $tela = 'producao/atividade/'; 
    private $titulo = 'Atividades';

    function __construct() 
    {
        parent::__construct();

        $this->load->model('usina/usina_atividade_model', 'registro', false); 
        $this->load->model('usina/usina_atividade_custo_model', 'registrocst', false);
        $this->load->helper(array('form', 'url', 'html', 'directory'));
    }

    function index($processo)
    { 
        $data = [ 
            'titulo'      => $this->titulo,
            'tela'        => $this->tela, 
            'row'         => $this->listaprocesso($processo),
            'produto'     => $this->listaproduto(),
            'atividades'  => $this->listaatividade($processo),
            'maquina'     => $this->listamaquina(),
            'rows'        => $this->ConsultaRegistro($processo)
        ];

        $this->template->load('app', $this->tela . 'index', $data);
    }

    function ConsultaRegistro($processo) 
    { 
        
        $param = [
            ['campo' => 'id_usina',     'valor' => $this->session->userdata('WMS_CD_PESSOA')],
            ['campo' => 'id_processo',  'valor' => $processo],
            ['campo' => 'fl_excluido',  'valor' => 'N']
        ];
        $ordem = ['campo' => 'id','ordem' => 'ASC'];

        $res = $this->registro->filtrar($param, $ordem)->result_object();
        return($res);
    }

    function cadastro($processo = null, $atividade = null)
    {
        // Caso não tenha recebido um ID
        if($processo == null && $atividade == null) redirect('producao/processo/'.$processo, 'refresh');

        $param = [
            ['campo' => 'id',          'valor' => $atividade],
            ['campo' => 'id_processo', 'valor' => $processo],
            ['campo' => 'id_usina',    'valor' => $this->session->userdata('WMS_CD_PESSOA')]
        ];
        $row = $this->registro->filtrar($param, null)->row();
        
        $parami = [
            ['campo' => 'id_atividade','valor' => $atividade],
            ['campo' => 'id_processo', 'valor' => $processo],
            ['campo' => 'fl_excluido', 'valor' => 'N'],
            ['campo' => 'id_usina',    'valor' => $this->session->userdata('WMS_CD_PESSOA')]
        ];
        $itens = $this->registrocst->filtrar($parami, null)->result_object();

        // Caso não tenha um retorno
        if(count($row) == 0) redirect('dashboard', 'refresh');

        $data = array(
            'titulo'      => 'Acompanhamento de ' . $this->titulo,
            'tela'        => $this->tela,
            'row'         => $row,
            'itens'       => $itens,
            'produto'     => $this->listaproduto(),
            'atividades'  => $this->listaatividade($processo),
            'maquina'     => $this->listamaquina(),
            'ajudante'    => $this->listaajudante(),
            'insumo'      => $this->listainsumo()
        );
        $this->template->load('app', $this->tela . 'cadastro', $data);
    }

    function SalvarDados()
    {
        $atr = $this->registro->atributo();
        $reg = $this->input->get_post('Register');  

        switch ($this->input->get_post('Op')) 
        {

            case 'I':
                // INSERT 
                $param = array();
                $param['id'] = date('Yhis'); 
                $param['id_usina'] = $this->session->userdata('WMS_CD_PESSOA');
                foreach ((object) $atr as $t)
                {
                    if ($t->coluna != 'id' && $reg[$t->coluna] != '')
                    {
                        $param[$t->coluna] = $this->registro->atrbtype($reg[$t->coluna], $t->tipo);
                    }
                }
                $retorno = $this->registro->inserir($param); 
                
                $label = '<div class="alert alert-'.$retorno['icon'].' alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                    <i class="mdi mdi-'.$retorno['icon-mdi'].' label-icon"></i><strong>'.$retorno['heading'].'</strong> - '.$retorno['text'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>'; 
                $this->session->set_flashdata('register', $label); 
                $url = $this->tela.$reg['id_processo'].'/'.$param['id']; 
                redirect($url, 'refresh');
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
                redirect($this->tela.'/'.$reg['id_processo'].'/'.$reg['id'], 'refresh');
            break;
            case 'D':
                $param = [];
                $param[] = ['campo' => 'fl_excluido',   'valor' => 'S'];
                
                $key = [
                    ['campo' => 'id',          'valor' => $this->input->get_post('id')],
                    ['campo' => 'id_processo', 'valor' => $this->input->get_post('processo')],
                    ['campo' => 'id_usina',    'valor' => $this->session->userdata('WMS_CD_PESSOA')]
                ];
                $retorno = $this->registro->editar($key, $param); 
                $label = '<div class="alert alert-'.$retorno['icon'].' alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                    <i class="mdi mdi-'.$retorno['icon-mdi'].' label-icon"></i><strong>'.$retorno['heading'].'</strong> - '.$retorno['text'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
        
                $this->session->set_flashdata('register', $label);
                redirect($this->tela.'/'.$reg['processo'].'/'.$reg['id'], 'refresh');
            break;
        } 
    }

    function SalvarItem()
    {
        $atr = $this->registrocst->atributo();
        $reg = $this->input->get_post('Register');  

        switch ($this->input->get_post('Op')) 
        {

            case 'I':
                // INSERT 
                $param = array();
                $param['id'] = date('Ydmhis'); 
                $param['id_usina'] = $this->session->userdata('WMS_CD_PESSOA');
                foreach ((object) $atr as $t)
                {
                    if ($t->coluna != 'id' && $t->coluna != 'id_usina' && $reg[$t->coluna] != '')
                    {
                        $param[$t->coluna] = $this->registrocst->atrbtype($reg[$t->coluna], $t->tipo);
                    }
                }
                $retorno = $this->registrocst->inserir($param);
                $label = '<div class="alert alert-'.$retorno['icon'].' alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                    <i class="mdi mdi-'.$retorno['icon-mdi'].' label-icon"></i><strong>'.$retorno['heading'].'</strong> - '.$retorno['text'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>'; 
            break;
            case 'E':
            
                $param = array();
                foreach ((object) $atr as $t) {
                    if ($t->coluna != 'id' && $t->coluna != 'id_atividade' && $t->coluna != 'id_processo' && $t->coluna != 'id_usina' && $reg[$t->coluna] != '') {
                        $param[] = ['campo' => $t->coluna, 'valor' => $this->registrocst->atrbtype($reg[$t->coluna], $t->tipo)];
                    } 
                }

                $key = [
                    ['campo' => 'id',           'valor' => $reg['id']],
                    ['campo' => 'id_processo',  'valor' => $reg['id_processo']],
                    ['campo' => 'id_atividade', 'valor' => $reg['id_atividade']],
                    ['campo' => 'id_usina',     'valor' => $this->session->userdata('WMS_CD_PESSOA')]
                ];
                $retorno = $this->registrocst->editar($key, $param);
                $label = '<div class="alert alert-'.$retorno['icon'].' alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                    <i class="mdi mdi-'.$retorno['icon-mdi'].' label-icon"></i><strong>'.$retorno['heading'].'</strong> - '.$retorno['text'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>'; 
            break;
            case 'D':
                $param = [];
                $param[] = ['campo' => 'fl_excluido',   'valor' => 'S'];
                
                $key = [
                    ['campo' => 'id',          'valor' => $this->input->get_post('id')],
                    ['campo' => 'id_processo', 'valor' => $this->input->get_post('processo')],
                    ['campo' => 'id_atividade', 'valor' => $this->input->get_post('atividade')],
                    ['campo' => 'id_usina',    'valor' => $this->session->userdata('WMS_CD_PESSOA')]
                ];
                $retorno = $this->registrocst->editar($key, $param); 
                $label = '<div class="alert alert-'.$retorno['icon'].' alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                    <i class="mdi mdi-'.$retorno['icon-mdi'].' label-icon"></i><strong>'.$retorno['heading'].'</strong> - '.$retorno['text'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
                $this->session->set_flashdata('register_person', $label);
                redirect($this->tela.$this->input->get_post('processo').'/'.$this->input->get_post('atividade'), 'refresh');
            break;
        } 
        
        $this->session->set_flashdata('register_person', $label);
        redirect($this->tela.$reg['id_processo'].'/'.$reg['id_atividade'], 'refresh');
    }
    
    
    
    function impressao($processo = null, $atividade = null)
    {
        // Caso não tenha recebido um ID
        if($processo == null && $atividade == null) redirect('producao/processo/'.$processo, 'refresh');

        $param = [
            ['campo' => 'id',          'valor' => $atividade],
            ['campo' => 'id_processo', 'valor' => $processo],
            ['campo' => 'id_usina',    'valor' => $this->session->userdata('WMS_CD_PESSOA')]
        ];
        $row = $this->registro->filtrar($param, null)->row();
        
        $parami = [
            ['campo' => 'id_atividade','valor' => $atividade],
            ['campo' => 'id_processo', 'valor' => $processo],
            ['campo' => 'fl_excluido', 'valor' => 'N'],
            ['campo' => 'id_usina',    'valor' => $this->session->userdata('WMS_CD_PESSOA')]
        ];
        $itens = $this->registrocst->filtrar($parami, null)->result_object();

        // Caso não tenha um retorno
        if(count($row) == 0) redirect('dashboard', 'refresh');

        $data = array(
            'titulo'      => 'Acompanhamento de ' . $this->titulo,
            'tela'        => $this->tela,
            'row'         => $row,
            'itens'       => $itens, 
        );
        $body = $this->load->view($this->tela . 'impressao', $data, true);
        
         include_once APPPATH . '/third_party/mpdf/mpdf.php';
        $mpdf = new mPDF('', 'A4');
        $mpdf->showImageErrors = false;    
        $mpdf->AddPage('P', // L - landscape, P - portrait
                '', '', '', '', 
                10, // margin_left
                10, // margin right
                10, // margin top
                10, // margin bottom
                0, // margin header
                0); // margin footer
        $mpdf->SetDisplayMode('fullpage');
        
        $mpdf->WriteHTML($body);

        $mpdf->Output('Acompanhamento de Atividade.pdf', 'I');
    }

}
