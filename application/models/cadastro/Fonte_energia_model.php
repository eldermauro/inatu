<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Fonte_energia_model extends MS_Model
{ 
    public function __construct()
    {
        parent::__construct();
        $this->database = $this->load->database('PostgreSQL', true);
        $this->table = 'cadastro.fonte_energia';
        $this->view = 'cadastro.fonte_energia';
    }


}
