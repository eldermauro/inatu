<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Coleta_item_model extends MS_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->database = $this->load->database('PostgreSQL', true);
        $this->table = 'idesam.coleta_item';
        $this->view = 'idesam.vw_coleta_item'; 
    }


}
