<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Maquina_tipo_model extends MS_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->database = $this->load->database('PostgreSQL', true);
        $this->table = 'usina.maquina_tipo';
        $this->view = 'usina.maquina_tipo';
    }


}
