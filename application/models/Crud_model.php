<?php

class Crud_model extends My_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

}