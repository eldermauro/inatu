<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Matriz_model extends MS_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->database = $this->load->database('PostgreSQL', true);
        $this->table = 'usina.matriz';
        $this->view = 'usina.matriz';
    }
}
