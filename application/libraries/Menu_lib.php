<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_lib {

    public $unidade;
    public $perfil;
    public $tipo;
    private $sistema = 3;
    private $menu = array();

    private function tratar($string)
    {
        $tr = strtr(
            $string,
            array (
              'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
              'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
              'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
              'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
              'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', '?' => 'R',
              'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
              'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
              'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
              'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
              'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
              'þ' => 'b', 'ÿ' => 'y', '?' => 'r', ';' => ' ', '��' => 'o'
            )
        );
        return($tr);
    }
    
    private function color($string)
    {
        
        switch ($string){
            case 'academico'        : $tr = 'primary';  break;
            case 'financeiro'       : $tr = 'info'; break;
            case 'acesso'           : $tr = 'secondary'; break; 
            case 'avaliacao'        : $tr = 'success'; break;
            case 'instituicao'      : $tr = 'warning'; break;
            case 'secretaria'       : $tr = 'primary'; break;
            case 'rh'               : $tr = 'info'; break;
            case 'gestordiretor'    : $tr = 'info'; break;
            case 'pdv'              : $tr = 'info'; break;
            case 'portalaluno'      : $tr = 'primary';  break;
            case 'portalprofessor'  : $tr = 'primary';  break;
            case 'vestibular'       : $tr = 'primary';  break;
            case 'cobranca'         : $tr = 'primary';  break;
        }
        return($tr);
    }

    private function icone($string)
    {
        
        switch ($string){
            case 'financeiro'       : $tr = 'mdi mdi-office-building-outline';  break; 
            case 'cadastro'         : $tr = 'mdi mdi-view-grid-outline';  break;
            case 'relatorios'       : $tr = 'mdi mdi-file-chart-outline';  break;
            case 'producao'         : $tr = 'mdi mdi-factory';  break;
            case 'coletas'          : $tr = 'mdi mdi-google-maps';  break;
        }
        return($tr);
    }
    
    private function processosidesam()
    {
        $obj = & get_instance();
        $obj->load->helper('url');
        $obj->load->library('session');
        $obj->load->model('usina/processo_model', 'processativo',TRUE); 

        $param = [
            ['campo' => 'fl_padrao',     'valor' => 'S'],
            ['campo' => 'fl_excluido',   'valor' => 'N']
        ];
        $ordem = ['campo' => 'nm_processo','ordem' => 'ASC'];

        $res = $obj->processativo->filtrar($param, $ordem)->result_object();
        return $res;
    }
    
    private function meusprocessos()
    {
        $obj = & get_instance();
        $obj->load->helper('url');
        $obj->load->library('session');
        $obj->load->model('usina/processo_model', 'processativo',TRUE); 
        
        $param = [
            ['campo' => 'id_usina',      'valor' => $obj->session->userdata('WMS_CD_PESSOA')],
            ['campo' => 'fl_excluido',   'valor' => 'N']
        ];
        $ordem = ['campo' => 'nm_processo','ordem' => 'ASC'];

        $res = $obj->processativo->filtrar($param, $ordem)->result_object();
        return $res;
    }
    
    
    public function perfil()
    {
        $obj = & get_instance();
        $obj->load->helper('url');
        $obj->load->library('session');

        $menu = ''; 
        //--------------
        // CRIA O MENU
        $obj->load->model('acesso/Perfil_funcionalidade_model', 'perfilfunc',TRUE);
        $obj->load->model('usina/processo_model', 'processativo',TRUE); 
        
        $params = array( 
            array('campo' => 'cd_pessoa_tipo', 'valor' => $this->perfil ), 
            array('campo' => 'cd_sistema',     'valor' => $this->sistema ), 
        ); 
        $ordem = array('campo'=>'nm_modulo, nm_funcionalidade', 'ordem'=>'ASC'); 
        
        
        $permissao = $obj->perfilfunc->filtrar( $params , $ordem)->result_object();  
        if(count($permissao) > 0)
        {
            // Pega os processos criados pela Usina
            $meusprocessos = $this->meusprocessos();
            // Pega os processos criados pelo IDESAM
            $processo_idesam = $this->processosidesam();
            
            
            
            $i = 0;
            $input = array();
            $topico = array();
                        
            foreach ($permissao as $row) 
            {
                $input[$i] = $row->nm_modulo;
                $i = $i + 1;
            }
            $topico = array_keys(array_flip($input));
            $menu = '';
            foreach ($topico as $row) { 

                $title = str_replace(' ','',strtolower($this->tratar($row)));
                
                $menu .= '<li class="nav-item dropdown">'."\n";
                $menu .= '<a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-'.$title.'" role="button">'."\n";
                $menu .= '<i class="'.$this->icone($title).'"></i>'."\n";
                $menu .= '<span data-key="t-'.$title.'">'.$row.'</span>'."\n";
                $menu .= '<div class="arrow-down"></div>'."\n";
                $menu .= '</a>'."\n";
                $menu .= '<div class="dropdown-menu" aria-labelledby="topnav-'.$title.'">'."\n";
                    foreach ($permissao as $l){
                        if ($row == $l->nm_modulo)
                            $menu .= anchor($l->ds_caminho, ''.$l->nm_funcionalidade, ' class="dropdown-item"')."\n";
                    }
                    if ($title == 'producao'){
                    $menu .= '<div class="dropdown">
                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth" role="button">
                                <span data-key="t-authentication">Meus Processos</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-auth">'; 
                            $menu .= anchor('processo/compor', 'Compor Processo', ' class="dropdown-item"')."\n";
                            if(count($meusprocessos) == 0)
                            {
                                $menu .= '<a href="javascript:void(0)" class="dropdown-item" data-key="t-login">
                                    Sua Usina não possui processos habilitados.
                                </a>';
                            }
                            foreach ($meusprocessos as $r){ 
                                $menu .= anchor('producao/processo/'.$r->id, ''.$r->nm_processo, ' class="dropdown-item"')."\n";
                            }
                            
                        $menu .= ' 
                            </div>
                        </div>'; 
                    
                    $menu .= '<div class="dropdown">
                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth" role="button">
                                <span data-key="t-authentication">Processos Idesam</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-auth">';
                            if(count($processo_idesam) == 0)
                            {
                                $menu .= '<a href="javascript:void(0)" class="dropdown-item" data-key="t-login">
                                    Não há processos habilitados.
                                </a>';
                            }
                            foreach ($processo_idesam as $p){ 
                                $menu .= anchor('producao/processo/'.$p->id, ''.$p->nm_processo, ' class="dropdown-item"')."\n";
                            } 
                         $menu .= '</div>
                        </div>';
                    }
                $menu .= '</div>'."\n";
                $menu .= '</li>'."\n";
            }
        } 
        
        return $menu;
        
    } 
            
    
}