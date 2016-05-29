<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller {
    private $status;
    private $code;
    private $data;
    
    public function __construct() {
        parent::__construct();
    }
    
    private function response(){
        header('Content-type:application/json;charset=utf-8');
        echo json_encode(array(
            "response_code" => $this->code,
            "response_status" => $this->status,
            "response_data" => $this->data,
        ));
    }
    
    public function employee_baru() {
        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        $this->load->model('employee_model');
        $id = $this->employee_model->newEmployee($data);
        
        $this->code = 200;
        $this->status = "Data tersimpan";
        $this->data = array("last_id"=>$id);
        $this->response();
        
    }
    
    public function employee_hapus() {
        $post = $this->input->post();
        $data = $this->security->xss_clean($post);
        $this->load->model('employee_model');
        $delete = $this->employee_model->delete($data['id']);
        
        if ($delete){
            $this->code = 200;
        }else{
            $this->code = 500;
        }
        
        $this->status = "Data terhapus";
        $this->data = array("last_id"=>$delete);
        $this->response();
    }
    
    public function nghistory() {
        $post = $this->input->post();
        $filter = $this->security->xss_clean($post);
        
        $this->load->model('ng_model');
        $data = $this->ng_model->filter($filter);
        
        if (count($data) > 0){
            $this->code = 200;
        }else{
            $this->code = 500;
            $this->status = "Tidak ditemukan";
        }
        
        $this->data = array("ng_data" => $data);
        $this->response();
    }
}
