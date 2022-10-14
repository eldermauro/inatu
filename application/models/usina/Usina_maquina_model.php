<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Usina_maquina_model extends MS_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->database = $this->load->database('PostgreSQL', true);
        $this->table = 'usina.usina_maquina';
        $this->view = 'usina.vw_usina_maquina';
    }


}
