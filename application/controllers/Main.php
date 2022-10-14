<?php 
if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed');

include_once(APPPATH.'core/MS_Processo.php');

class Main extends MS_Processo 
{ 

    private $tela = '/';
    private $titulo = 'Sistema CIESA'; 

    function __construct() 
    {
        parent::__construct(); 

        $this->load->helper(array('form', 'url', 'html', 'directory'));  
    }

    function index() 
    {
        
        $p = [];
        $data = [ 
            'titulo'    => $this->titulo, 
            'processos' => $this->listatodosprocessos(),
            'chartpss'  => $this->chartprocess()
        ];
        $this->template->load('app', 'main', $data);
    }
    
    function error404() 
    {   
        $data = [ 
            'titulo' => $this->titulo 
        ]; 
        $this->template->load('app', 'error404', $data);
    } 
 
}