<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Insumo_model extends MS_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->database = $this->load->database('PostgreSQL', true);
        $this->table = 'cadastro.insumo';
        $this->view = 'cadastro.insumo'; 
    }


}
