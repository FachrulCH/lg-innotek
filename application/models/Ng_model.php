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
        $this->simpanDetail();

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

        $this->db->select('ng_detail.ng_item_id as id, ng_detail.ng_item_id, ng_detail.ng_sub_date, ng_detail.ng_result, ng_detail.ng_file_name, ng_items.cust_id, ng_items.req_date, lg_customer.name AS cust_name, ng_items.part_no, master_product.model, ng_items.quantity, ng_items.remark, ng_items.empl_id, ng_items.status, ng_detail.ca_file_name, ng_detail.car_file_name,ng_detail.sp_file_name, ng_detail.out_file_name');
        $this->db->from('ng_detail');
        $this->db->join('ng_items', 'ng_items.id=ng_detail.ng_item_id');
        $this->db->join('lg_customer', 'ng_items.cust_id = lg_customer.id');
        $this->db->join('master_product', 'ng_items.part_no = master_product.part_no');

        if ($start) {
            $this->db->where('req_date >=', $start);
        }

        if ($end) {
            $this->db->where('req_date <=', $end);
        }

        if ($status !== 'all') {
            $this->db->where('status', $status);
        }

        if ($model !== 'all') {
            $this->db->where('part_no', $model);
        }

        if ($this->session->level == 'CUS') {
            $this->db->where('ng_items.cust_id', $this->session->user_id);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function filterPageNGdata($param) {
        $start = @$param['startdate'];
        $end = @$param['enddate'];
        $customer = @$param['customer'];

        $this->db->select('ng_detail.ng_item_id as id, ng_detail.ng_item_id, ng_detail.ng_sub_date, ng_detail.ng_result, ng_detail.ng_file_name, ng_items.cust_id, ng_items.req_date, lg_customer.name as cust_name');
        $this->db->from('ng_detail');
        $this->db->join('ng_items', 'ng_items.id=ng_detail.ng_item_id');
        $this->db->join('lg_customer', 'ng_items.cust_id = lg_customer.id');

        if ($start) {
            $this->db->where('ng_items.req_date >=', $start);
        }

        if ($end) {
            $this->db->where('ng_items.req_date <=', $end);
        }

        if ($customer != '') {
            $this->db->where('ng_items.cust_id', $customer);
        }

        $this->db->where_in('status', array(0, 1));

        $query = $this->db->get();
        return $query->result_array();
    }

    public function filter_page_ngcust($param) {
        $start = @$param['startdate'];
        $end = @$param['enddate'];
        $customer = @$param['customer'];

        $this->db->select('ng_detail.ng_item_id as id, ng_detail.ng_item_id, ng_detail.ca_sub_date, ng_detail.ca_description, ng_detail.ca_file_name, ng_items.cust_id, ng_items.req_date');
        $this->db->from('ng_detail');
        $this->db->join('ng_items', 'ng_items.id=ng_detail.ng_item_id');

        if ($start) {
            $this->db->where('ng_items.req_date >=', $start);
        }

        if ($end) {
            $this->db->where('ng_items.req_date <=', $end);
        }

        if ($customer != '') {
            $this->db->where('ng_items.cust_id', $customer);
        }

        $this->db->where_in('ng_items.status', array(1, 2));

        $query = $this->db->get();
        return $query->result_array();
    }

    public function filter_page_ngcar($param) {
        $start = @$param['startdate'];
        $end = @$param['enddate'];
        $customer = @$param['customer'];

        $this->db->select('ng_detail.ng_item_id as id, ng_detail.ng_item_id, ng_detail.car_sub_date, ng_detail.car_description, ng_detail.car_file_name, ng_items.cust_id, ng_items.req_date');
        $this->db->from('ng_detail');
        $this->db->join('ng_items', 'ng_items.id=ng_detail.ng_item_id');

        if ($start) {
            $this->db->where('ng_items.req_date >=', $start);
        }

        if ($end) {
            $this->db->where('ng_items.req_date <=', $end);
        }

        if ($customer != '') {
            $this->db->where('ng_items.cust_id', $customer);
        }

        $this->db->where_in('status', array(2, 3));

        $query = $this->db->get();
        return $query->result_array();
    }

    public function filter_page_pengiriman($param) {
        $start = @$param['startdate'];
        $end = @$param['enddate'];
        $customer = @$param['customer'];

        $this->db->select('ng_detail.ng_item_id as id, ng_detail.ng_item_id, ng_detail.out_sub_date, ng_detail.out_description, ng_detail.out_file_name, ng_items.cust_id, ng_items.req_date');
        $this->db->from('ng_detail');
        $this->db->join('ng_items', 'ng_items.id=ng_detail.ng_item_id');

        if ($start) {
            $this->db->where('ng_items.req_date >=', $start);
        }

        if ($end) {
            $this->db->where('ng_items.req_date <=', $end);
        }

        if ($customer != '') {
            $this->db->where('ng_items.cust_id', $customer);
        }

        $this->db->where_in('status', array(3, 4));

        $query = $this->db->get();
        return $query->result_array();
    }

    public function filter_page_analisasp($param) {
        $start = @$param['startdate'];
        $end = @$param['enddate'];
        $customer = @$param['customer'];

        $this->db->select('ng_detail.ng_item_id,ng_items.req_date,ng_items.cust_id, lg_customer.name AS cust_name, ng_items.part_no, master_product.model AS model,ng_items.quantity, ng_detail.spr_result, ng_detail.spr_sub_date, ng_detail.sp_file_name');
        $this->db->from('ng_detail');
        $this->db->join('ng_items', 'ng_items.id=ng_detail.ng_item_id');
        $this->db->join('master_product', 'master_product.part_no = ng_items.part_no');
        $this->db->join('lg_customer', 'ng_items.cust_id = lg_customer.id');

        if ($start) {
            $this->db->where('ng_items.req_date >=', $start);
        }

        if ($end) {
            $this->db->where('ng_items.req_date <=', $end);
        }

        if ($customer != '') {
            $this->db->where('ng_items.cust_id', $customer);
        }

        //$this->db->where_in('status', array(3,4));

        $query = $this->db->get();
        return $query->result_array();
    }

    public function filter_page_sp($param) {
        $start = @$param['startdate'];
        $end = @$param['enddate'];
        $customer = @$param['customer'];

        $this->db->select('ng_detail.ng_item_id,ng_items.req_date,ng_items.cust_id, lg_customer.name AS cust_name, ng_items.part_no, master_product.model AS model,ng_items.quantity, ng_detail.sp_employee_id, ng_detail.sp_inspector_id, ng_detail.sp_sub_date, ng_detail.sp_file_name');
        $this->db->from('ng_detail');
        $this->db->join('ng_items', 'ng_items.id=ng_detail.ng_item_id');
        $this->db->join('master_product', 'master_product.part_no = ng_items.part_no');
        $this->db->join('lg_customer', 'ng_items.cust_id = lg_customer.id');

        if ($start) {
            $this->db->where('ng_items.req_date >=', $start);
        }

        if ($end) {
            $this->db->where('ng_items.req_date <=', $end);
        }

        if ($customer != '') {
            $this->db->where('ng_items.cust_id', $customer);
        }

        //$this->db->where_in('status', array(3,4));

        $query = $this->db->get();
        return $query->result_array();
    }

    public function filter_report_spa($id) {

        $this->db->select('a.ng_item_id,b.req_date,b.cust_id, d.name AS cust_name, b.part_no, c.model AS model,b.quantity, a.sp_employee_id, a.sp_inspector_id, a.sp_sub_date, a.sp_file_name, (select name from lg_employee x where x.id = a.sp_employee_id) as empl_name,  (select name from lg_employee y where y.id = a.sp_inspector_id) as inspector_name');
        $this->db->from('ng_detail a');
        $this->db->join('ng_items b', 'b.id=a.ng_item_id');
        $this->db->join('master_product c', 'c.part_no = b.part_no');
        $this->db->join('lg_customer d', 'b.cust_id = d.id');
        $this->db->where('a.ng_item_id', $id);
        $this->db->where('b.id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function filter_report_bycust($param) {
        $start = @$param['startdate'];
        $end = @$param['enddate'];
        $customer = @$param['customer'];

        $this->db->select('ng_detail.ng_item_id as id, ng_detail.ng_item_id, ng_detail.ng_sub_date, master_product.model AS model, ng_detail.ng_result, ng_detail.ng_file_name, ng_items.cust_id, ng_items.req_date, lg_customer.name as cust_name, ng_items.quantity, ng_items.remark, ng_items.status, ng_items.empl_id as employee_id, ng_items.part_no');
        $this->db->from('ng_detail');
        $this->db->join('ng_items', 'ng_items.id=ng_detail.ng_item_id');
        $this->db->join('lg_customer', 'ng_items.cust_id = lg_customer.id');
        $this->db->join('master_product', 'master_product.part_no = ng_items.part_no');

        if ($start) {
            $this->db->where('ng_items.req_date >=', $start);
        }

        if ($end) {
            $this->db->where('ng_items.req_date <=', $end);
        }

        if ($customer != '') {
            $this->db->where('ng_items.cust_id', $customer);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function filter_report_bystatus($param) {
        $start = @$param['startdate'];
        $end = @$param['enddate'];
        $status = @$param['status'];

        $this->db->select('ng_detail.ng_item_id as id, ng_detail.ng_item_id, ng_detail.ng_sub_date, master_product.model AS model, ng_detail.ng_result, ng_detail.ng_file_name, ng_items.cust_id, ng_items.req_date, lg_customer.name as cust_name, ng_items.quantity, ng_items.remark, ng_items.status, ng_items.empl_id as employee_id, ng_items.part_no');
        $this->db->from('ng_detail');
        $this->db->join('ng_items', 'ng_items.id=ng_detail.ng_item_id');
        $this->db->join('lg_customer', 'ng_items.cust_id = lg_customer.id');
        $this->db->join('master_product', 'master_product.part_no = ng_items.part_no');

        if ($start) {
            $this->db->where('ng_items.req_date >=', $start);
        }

        if ($end) {
            $this->db->where('ng_items.req_date <=', $end);
        }

        if ($status != '') {
            $this->db->where('ng_items.status', $status);
        }
        $query = $this->db->get();
        return $query->result_array();
        //return $this->db->last_query();
    }
    
    public function filter_report_byemployee($param) {
        $start = @$param['startdate'];
        $end = @$param['enddate'];
        $filter = @$param['employee'];

        $this->db->select('ng_detail.ng_item_id as id, ng_detail.ng_item_id, ng_detail.ng_sub_date, master_product.model AS model, ng_detail.ng_result, ng_detail.ng_file_name, ng_items.cust_id, ng_items.req_date, lg_customer.name as cust_name, ng_items.quantity, ng_items.remark, ng_items.status, ng_items.empl_id as employee_id, ng_items.part_no');
        $this->db->from('ng_detail');
        $this->db->join('ng_items', 'ng_items.id=ng_detail.ng_item_id');
        $this->db->join('lg_customer', 'ng_items.cust_id = lg_customer.id');
        $this->db->join('master_product', 'master_product.part_no = ng_items.part_no');

        if ($start) {
            $this->db->where('ng_items.req_date >=', $start);
        }

        if ($end) {
            $this->db->where('ng_items.req_date <=', $end);
        }

        if ($filter != '') {
            $this->db->where('ng_items.empl_id', $filter);
        }
        $query = $this->db->get();
        return $query->result_array();
        //return $this->db->last_query();
    }
    
    public function filter_report_bymodel($param) {
        $start = @$param['startdate'];
        $end = @$param['enddate'];
        $filter = @$param['model'];

        $this->db->select('ng_detail.ng_item_id as id, ng_detail.ng_item_id, ng_detail.ng_sub_date, master_product.model AS model, ng_detail.ng_result, ng_detail.ng_file_name, ng_items.cust_id, ng_items.req_date, lg_customer.name as cust_name, ng_items.quantity, ng_items.remark, ng_items.status, ng_items.empl_id as employee_id, ng_items.part_no');
        $this->db->from('ng_detail');
        $this->db->join('ng_items', 'ng_items.id=ng_detail.ng_item_id');
        $this->db->join('lg_customer', 'ng_items.cust_id = lg_customer.id');
        $this->db->join('master_product', 'master_product.part_no = ng_items.part_no');

        if ($start) {
            $this->db->where('ng_items.req_date >=', $start);
        }

        if ($end) {
            $this->db->where('ng_items.req_date <=', $end);
        }

        if ($filter != '') {
            $this->db->where('ng_items.part_no', $filter);
        }
        $query = $this->db->get();
        return $query->result_array();
        //return $this->db->last_query();
    }
    
    public function filter_report_byperiodic($param) {
        $start = @$param['startdate'];
        $end = @$param['enddate'];

        $this->db->select('ng_detail.ng_item_id as id, ng_detail.ng_item_id, ng_detail.ng_sub_date, master_product.model AS model, ng_detail.ng_result, ng_detail.ng_file_name, ng_items.cust_id, ng_items.req_date, lg_customer.name as cust_name, ng_items.quantity, ng_items.remark, ng_items.status, ng_items.empl_id as employee_id, ng_items.part_no');
        $this->db->from('ng_detail');
        $this->db->join('ng_items', 'ng_items.id=ng_detail.ng_item_id');
        $this->db->join('lg_customer', 'ng_items.cust_id = lg_customer.id');
        $this->db->join('master_product', 'master_product.part_no = ng_items.part_no');

        if ($start) {
            $this->db->where('ng_items.req_date >=', $start);
        }

        if ($end) {
            $this->db->where('ng_items.req_date <=', $end);
        }

        $query = $this->db->get();
        return $query->result_array();
        //return $this->db->last_query();
    }

    public function updateDetail($data) {
        $this->db->set('ng_sub_date', @$data['ng_sub_date']);
        $this->db->set('ng_result', @$data['ng_result']);
        $this->db->set('ng_file_name', @$data['ng_file_name']);

        $this->db->where('ng_item_id', $data['ng_item_id']);
        $this->db->update('ng_detail');

        // kalo delete turun status
        if (empty(@$data['ng_sub_date'])) {
            $this->update_satus($data['ng_item_id'], 0);
            $this->update_empl($data['ng_item_id'], null);
        } else {
            // kalo upload naek status
            $this->update_empl($data['ng_item_id'], $this->session->user_id);
            $this->update_satus($data['ng_item_id'], 1);
        }
    }

    public function update_ngCust($data) {
        $this->db->set('ca_sub_date', @$data['ca_sub_date']);
        $this->db->set('ca_description', @$data['ca_description']);
        $this->db->set('ca_file_name', @$data['ca_file_name']);

        $this->db->where('ng_item_id', $data['ng_item_id']);
        $this->db->update('ng_detail');


        // kalo delete turun status
        if (empty(@$data['ca_sub_date'])) {
            $this->update_satus($data['ng_item_id'], 1);
        } else {
            // kalo upload naek status
            $this->update_satus($data['ng_item_id'], 2);
        }
    }

    public function update_ngCar($data) {
        $this->db->set('car_sub_date', @$data['car_sub_date']);
        $this->db->set('car_description', @$data['car_description']);
        $this->db->set('car_file_name', @$data['car_file_name']);

        $this->db->where('ng_item_id', $data['ng_item_id']);
        $this->db->update('ng_detail');


        // kalo delete turun status
        if (empty(@$data['car_sub_date'])) {
            $this->update_satus($data['ng_item_id'], 2);
        } else {
            // kalo upload naek status
            $this->update_satus($data['ng_item_id'], 3);
        }
    }

    public function update_pengiriman($data) {
        $this->db->set('out_sub_date', @$data['out_sub_date']);
        $this->db->set('out_description', @$data['out_description']);
        $this->db->set('out_file_name', @$data['out_file_name']);

        $this->db->where('ng_item_id', $data['ng_item_id']);
        $this->db->update('ng_detail');


        // kalo delete turun status
        if (empty(@$data['out_sub_date'])) {
            $this->update_satus($data['ng_item_id'], 3);
        } else {
            // kalo upload naek status
            $this->update_satus($data['ng_item_id'], 4);
        }
    }

    public function update_sp($data) {
        $this->db->set('sp_sub_date', @$data['sp_sub_date']);
        $this->db->set('sp_employee_id', @$data['sp_employee_id']);
        $this->db->set('sp_inspector_id', @$data['sp_inspector_id']);

        $this->db->where('ng_item_id', $data['ng_item_id']);
        $this->db->update('ng_detail');
    }

    public function update_resultsp($data) {
        $this->db->set('spr_sub_date', @$data['spr_sub_date']);
        $this->db->set('spr_result', @$data['spr_result']);
        $this->db->set('sp_file_name', @$data['sp_file_name']);

        $this->db->where('ng_item_id', $data['ng_item_id']);
        $this->db->update('ng_detail');
    }

    public function simpanDetail() {
//        $row['id'] = $this->sequences->getLastId('sqngdetail');
        $row['ng_item_id'] = $this->id;

        return $this->db->insert('ng_detail', $row);
    }

    public function update_satus($cust_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $cust_id);
        $this->db->update('ng_items');
    }
    
    public function update_empl($cust_id, $empl_id) {
        $this->db->set('empl_id', $empl_id);
        $this->db->where('id', $cust_id);
        $this->db->update('ng_items');
    }
    
    public function getDashboard() {
        $query = $this->db->query("select count(1) as jum, status from ng_items group by status;");
        return $query->result_array();
        
    }
    
    public function getDashboardB() {
        $query = $this->db->query("select * from ng_items order by req_date desc limit 5");
        return $query->result_array();
        
    }
    
    public function getDashboardC() {
        $query = $this->db->query("select count(1) jum, DATE_FORMAT(req_date,'%Y-%m') periode from ng_items WHERE YEAR(req_date) = YEAR(now()) group by MONTH(req_date)");
        return $query->result_array();
        
    }

}
