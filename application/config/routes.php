<?php 

if( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = [
    'default_controller' => "login/index",
    'login/token' => "login/token",
    'login/logout' => "login/logout",
    'login/account' => "login/account",  
    '404_override' => 'main/error404',
    '500_override' => 'main/error404',
    'error_override' => 'main/error404',  
];

$cadastro = [
    // CADASTRO AJUDANTE
    'cadastro/ajudante' => "cadastro/ajudante",
    'cadastro/ajudante/cadastro' => "cadastro/ajudante/cadastro",
    'cadastro/ajudante/(:num)' => "cadastro/ajudante/cadastro/$1",
    'cadastro/ajudante/save' => "cadastro/ajudante/SalvarDados",
    
    // CADASTRO ASSOCIADO
    'cadastro/associado' => "cadastro/associado",
    'cadastro/associado/cadastro' => "cadastro/associado/cadastro",
    'cadastro/associado/(:num)' => "cadastro/associado/cadastro/$1",
    'cadastro/associado/save' => "cadastro/associado/SalvarDados", 
    
    // CADASTRO MAQUINA
    'cadastro/maquina' => "cadastro/maquina",
    'cadastro/maquina/cadastro' => "cadastro/maquina/cadastro",
    'cadastro/maquina/(:num)' => "cadastro/maquina/cadastro/$1",
    'cadastro/maquina/save' => "cadastro/maquina/SalvarDados", 
]; 

$processo = [
    // CADASTRO AJUDANTE
    'processo/compor' => "processo/compor",
    'processo/compor/cadastro' => "processo/compor/cadastro",
    'processo/compor/(:num)' => "processo/compor/cadastro/$1",
    'processo/compor/save' => "processo/compor/SalvarDados",
    'processo/compor/etapa/save' => "processo/compor/SalvarEtapa",
    'processo/compor/atividade/save' => "processo/compor/SalvarAtividade",
    
    
    // CADASTRO DE ATIVIDADE  
    'producao/processo/(:num)' => "producao/atividade/index/$1",
    'producao/atividade/save' => "producao/atividade/SalvarDados",
    'producao/atividade/(:num)/(:num)' => "producao/atividade/cadastro/$1/$2",
    'producao/atividade/impressao/(:num)/(:num)' => "producao/atividade/impressao/$1/$2",
    'producao/atividade/item/(:num)/(:num)' => "producao/atividade/item/$1/$2",
    'producao/atividade/item/save' => "producao/atividade/SalvarItem",
    
    // CADASTRO DE LOTE
    'producao/lote' => "producao/lote/index",
    'producao/lote/(:num)' => "producao/lote/cadastro/$1",
];

$coleta = [
    // CADASTRO AJUDANTE
    'coleta/areasemente' => "coleta/areasemente",
    'coleta/areasemente/cadastro' => "coleta/areasemente/cadastro",
    'coleta/areasemente/(:num)' => "coleta/areasemente/cadastro/$1",
    'coleta/areasemente/save' => "coleta/areasemente/SalvarDados",
    
    // CADASTRO LOCALIDADE
    'coleta/local'          => "coleta/local",
    'coleta/local/cadastro' => "coleta/local/cadastro",
    'coleta/local/(:num)'   => "coleta/local/cadastro/$1",
    'coleta/local/save'     => "coleta/local/SalvarDados", 
    
    // COLETA A RECEBER
    'coleta/receber' => "coleta/receber",
    'coleta/receber/cadastro' => "coleta/receber/cadastro",
    'coleta/receber/(:num)' => "coleta/receber/cadastro/$1",
    'coleta/receber/save' => "coleta/receber/SalvarDados",
]; 
 

$route = array_merge($config, $cadastro, $processo, $coleta);
 
/* End of file routes.php */
/* Location: ./application/config/routes.php */