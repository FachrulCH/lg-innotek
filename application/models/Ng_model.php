<?php

class Ng_model extends CI_Model {

    public $id;
    public $cust_id;
    public $req_date;
    public $part_no;
    public $quantity;
    public $awb;
    public $remark;
    public $empl_id;

    public function __construct() {
        parent::__construct();
    }

    public function simpan($data) {
        $this->cust_id = $data['cust-id'];
        $this->req_date = date("Y-m-d");
        $this->part_no = $data['part_no'];
        $this->quantity = $data['quantity'];
        $this->awb = $data['awb'];
        $this->remark = $data['remark'];
        $this->empl_id = null;

        $this->load->model('sequences');
        $this->db->trans_begin();

        if ($data['id'] == null) {
            $this->id = $this->sequences->getLastId('sqngitem');
        } else {
            $this->id = $data['id'];
        }

        $this->db->replace('ng_items', $this);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function semua() {
        $query = $this->db->get('ng_items');
        return $query->result_array();
    }

    public function filter($param) {
        $start = @$param['startdate'];
        $end = @$param['enddate'];
        $status = @$param['status'];
        $model = @$param['model'];

        $this->db->select('*');
        $this->db->from('ng_items');
        
        if($start){
            $this->db->where('req_date >=',$start);
        }
        
        if($end){
            $this->db->where('req_date <=',$end);
        }
        
        if($status !== '*'){
            $this->db->where('status',$status);
        }
        
        if($model !== '*'){
            $this->db->where('part_no',$model);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }

}
