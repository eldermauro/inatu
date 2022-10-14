<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Processo_etapa_atividade_model extends MS_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->database = $this->load->database('PostgreSQL', true);
        $this->table = 'usina.processo_etapa_atividade';
        $this->view = 'usina.processo_etapa_atividade';
    }


}
