<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Perfil_funcionalidade_model extends MS_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->database = $this->load->database('PostgreSQL', true);
        $this->table = 'acesso.perfil_funcionalidade';
        $this->view = 'acesso.vw_perfil_funcionalidade'; 
    }


}
