<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sequences
 *
 * @author kurawall
 */
class Sequences extends CI_Model {

    public $id;
    public $seq_name;
    public $prefix;
    public $year;
    public $value;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->year = $this->year = date('Y');
    }

    public function getSequences() {
        $query = $this->db->get_where('sequences', array('seq_name' => $this->seq_name, 'year' => $this->year), 0, 1);
        $hasil = $query->result();

        if (!$hasil) {
            // notfound
            $query = $this->db->get_where('sequences', array('seq_name' => $this->seq_name, 'year' => $this->year-1), 0, 1);
            $hasil = $query->result();
            // create new
            $hasil[0]->id = null;
            $hasil[0]->value = 0;
        }

        $this->id = $hasil[0]->id;
        $this->prefix = $hasil[0]->prefix;
        $this->value = $hasil[0]->value;
        return $this;
    }

    private function increment() {
        $this->value = $this->value + 1;
    }

    public function getLastId($sequence) {
        $this->seq_name = $sequence;
        $this->getSequences();

        $this->increment();

        $this->db->replace('sequences', $this);
        return $this->prefix . date('y') . '0' . $this->value;
    }

}
