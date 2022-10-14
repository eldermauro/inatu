<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Produto_model extends MS_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->database = $this->load->database('PostgreSQL', true);
        $this->table = 'cadastro.produto';
        $this->view = 'cadastro.produto'; 
    }


}
