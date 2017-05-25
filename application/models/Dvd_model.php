<?php

class Dvd_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getLastDvd()
    {
//        $query = $this->db->order_by('dateAchatD','desc')->limit(6)->get('dvd');
//        return $query->result_array();
        $this->db->select('*');
        $this->db->from('dvd');
        $this->db->order_by('dateAchatD','desc');
        $this->db->limit(6);
        $this->db->join('genres', 'genres.numG = dvd.genreD');
        $query = $this->db->get();
        return $query->result_array();
    }

}