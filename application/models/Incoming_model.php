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
        
        $this->db->select('ng_incoming.id, ng_incoming.date, ng_incoming.cust_id, ng_incoming.empl_id, ng_incoming.part_no, ng_incoming.no_cipl, ng_incoming.no_awb, master_product.model, lg_customer.name as cust_name');
        $this->db->from('ng_incoming');
        $this->db->join('master_product', 'master_product.part_no=ng_incoming.part_no');
        $this->db->join('lg_customer', 'lg_customer.id = ng_incoming.cust_id');

        if ($start) {
            $this->db->where('date >=', $start);
        }

        if ($end) {
            $this->db->where('date <=', $end);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function hapus($row) {
        $this->db->delete('ng_incoming', $row);
    }

}
