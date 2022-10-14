<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Processo_model extends MS_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->database = $this->load->database('PostgreSQL', true);
        $this->table = 'usina.processo';
        $this->view = 'usina.vw_processo';
    }


}
