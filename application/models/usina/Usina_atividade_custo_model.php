<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Usina_atividade_custo_model extends MS_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->database = $this->load->database('PostgreSQL', true);
        $this->table = 'usina.usina_atividade_custo';
        $this->view = 'usina.vw_usina_atividade_custo';
    }


}
