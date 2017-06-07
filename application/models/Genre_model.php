<?php

class Genre_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private $id;

    public function getGenreName($id)
    {
        $query = $this->db->get('genre')->where('genre.numG = $id');
        return $query->result_array();
    }

}