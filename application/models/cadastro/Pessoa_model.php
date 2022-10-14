<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pessoa_model extends MS_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->database = $this->load->database('PostgreSQL', true);
        $this->table = 'cadastro.pessoa';
        $this->view = 'cadastro.pessoa'; 
    }


}
