<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function index() {

        
//        $data['tabel_data'] = array(
//            [
//                "id" => 1,
//                "name" => "Kasogi",
//                "email" => "kasogi@gmail.com",
//                "group" => "2",
//                "telp" => "09090909090",
//            ],
//            [
//                "id" => 2,
//                "name" => "New Era",
//                "email" => "kasogi@gmail.com",
//                "group" => "2",
//                "telp" => "09090909090",
//            ]
//        );
        
        $this->load->model('employee_model');
        $data['tabel_data'] = $this->employee_model->getAll();
        $data['group_list'] = $this->employee_model->getGroup();

        $this->load->view('design/header');
        $this->load->view('contents/pg-employees', $data);
        $this->load->view('design/footer');
    }

    public function baru() {
        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        $this->load->model('employee_model');
        $this->employee_model->newEmployee($data);

        header('Content-type:application/json;charset=utf-8');
        echo json_encode(['status' => $data]);
//        redirect('employee/');
    }

}
