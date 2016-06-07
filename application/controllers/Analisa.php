<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Analisa extends CI_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
    }    
    
    public function index() {        
        $this->load->view('design/header');
        $this->load->view('contents/pg-analisa-sp');
        $this->load->view('design/footer');
    }
    
    public function sp() {
        $get = $this->input->get();
        $data['get_data'] = $this->security->xss_clean($get);
        
        $this->load->model('customer_model');
        $this->load->model('ng_model');
        $this->load->model('employee_model');
        
        $data['list_customer'] = $this->customer_model->semua();
        $data['list_staff'] = $this->employee_model->getStaff();
        $data['list_inspector'] = $this->employee_model->getInspector();
        
        if (@$data['get_data']['customer'] != null) {
            $data['detail_data'] = $this->ng_model->filter_page_sp(
                    array(
                        "startdate" => @$data['get_data']['startdate'],
                        "enddate" => @$data['get_data']['enddate'],
                        "customer" => @$data['get_data']['customer'])
            );
        } else {
            $data['detail_data'] = array();
        }
        
        $this->load->view('design/header');
        $this->load->view('contents/pg-analisa-sp', $data);
        $this->load->view('design/footer');
    }
   
    public function result() {        
        $this->load->view('design/header');
        $this->load->view('contents/pg-analisa-result');
        $this->load->view('design/footer');
    }
    
    public function simpansp() {
        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        $row = array(
            "sp_sub_date" => date("Y-m-d"),
            "sp_employee_id" => $data['mdl_staff_id'],
            "sp_inspector_id" => $data['mdl_ins_id'],
            "ng_item_id" => $data['mdl-ng-id']
        );
        
        $this->load->model('ng_model');
        $this->ng_model->update_sp($row);

        redirect('analisa/sp?customer=' . $data['mdl-cust-name']);
    }
}
