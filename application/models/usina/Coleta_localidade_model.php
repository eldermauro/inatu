<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Coleta_localidade_model extends MS_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->database = $this->load->database('PostgreSQL', true);
        $this->table = 'usina.coleta_localidade';
        $this->view = 'usina.coleta_localidade';
    }


}
