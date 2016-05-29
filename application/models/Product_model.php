<?php

class Product_model extends CI_Model {

    public $part_no;
    public $model;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function baru($data) {
        $this->part_no = strtoupper($data['part_no']);
        $this->model = strtoupper($data['model']);
        $this->db->replace('master_product', $this);
    }
    
    public function semua() {
        $query = $this->db->get('master_product');
        return $query->result_array();
    }
    
    public function hapus($id) {
        return $this->db->delete('master_product', array('part_no' => $id));
    }

}
