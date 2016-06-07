<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Incoming_model
 *
 * @author kurawall
 */
class Incoming_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function simpan($data) {
        $this->load->model('sequences');
        $this->db->trans_begin();

        if ($data['id'] == null) {
            $data['id'] = $this->sequences->getLastId('sqincoming');
        } else {
            $data['id'] = $data['id'];
        }

        $this->db->replace('ng_incoming', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
    
    public function semua() {
        $query = $this->db->get('ng_incoming');
        return $query->result_array();
    }
    
    public function filter($param) {
        $start = @$param['startdate'];
        $end = @$param['enddate'];
        
        $this->db->select('*');
        $this->db->from('ng_incoming');

        if ($start) {
            $this->db->where('date >=', $start);
        }

        if ($end) {
            $this->db->where('date <=', $end);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }

}
