<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Lote_item_model extends MS_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->database = $this->load->database('PostgreSQL', true);
        $this->table = 'usina.lote_item';
        $this->view = 'usina.vw_lote_item';
    }


}
