<?php

class Societe_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getSocietes()
    {
        $query = $this->db->get('societes');
        return $query->result_array();
    }

}