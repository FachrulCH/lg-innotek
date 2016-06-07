<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class History extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
//        $this->load->helper('format_tgl');
    }

    public function index() {
        $this->load->view('design/header');
        $this->load->view('contents/pg-his-ng-cust');
        $this->load->view('design/footer');
    }

    public function ngdata() {
        $get = $this->input->get();
        $data['get_data'] = $this->security->xss_clean($get);

        $this->load->model('customer_model');
        $this->load->model('ng_model');

        $data['list_customer'] = $this->customer_model->semua();

        
        
        $data['tgl_tes'] = @$data['get_data']['startdate'];
        
        if (@$data['get_data']['customer'] != null) {
            $data['detail_data'] = $this->ng_model->filterPageNGdata(
                    array(
                        "startdate" => @$data['get_data']['startdate'],
                        "enddate" => @$data['get_data']['enddate'],
                        "customer" => @$data['get_data']['customer'])
            );
        } else {
            $data['detail_data'] = array();
        }

        $this->load->view('design/header');
        $this->load->view('contents/pg-his-ng-data', $data);
        $this->load->view('design/footer');
    }

    public function ngcust() {
        $get = $this->input->get();
        $data['get_data'] = $this->security->xss_clean($get);
        
        $this->load->model('customer_model');
        $this->load->model('ng_model');
        $data['list_customer'] = $this->customer_model->semua();
        
        if (@$data['get_data']['customer'] != null) {
            $data['detail_data'] = $this->ng_model->filter_page_ngcust(
                    array(
                        "startdate" => @$data['get_data']['startdate'],
                        "enddate" => @$data['get_data']['enddate'],
                        "customer" => @$data['get_data']['customer'])
            );
        } else {
            $data['detail_data'] = array();
        }
        
        $this->load->view('design/header');
        $this->load->view('contents/pg-his-ng-cipl', $data);
        $this->load->view('design/footer');
    }

    public function ngcar() {
        $get = $this->input->get();
        $data['get_data'] = $this->security->xss_clean($get);
        
        $this->load->model('customer_model');
        $this->load->model('ng_model');
        $data['list_customer'] = $this->customer_model->semua();
        
        if (@$data['get_data']['customer'] != null) {
            $data['detail_data'] = $this->ng_model->filter_page_ngcar(
                    array(
                        "startdate" => @$data['get_data']['startdate'],
                        "enddate" => @$data['get_data']['enddate'],
                        "customer" => @$data['get_data']['customer'])
            );
        } else {
            $data['detail_data'] = array();
        }
        
        $this->load->view('design/header');
        $this->load->view('contents/pg-his-car', $data);
        $this->load->view('design/footer');
    }

    public function pengiriman() {
        $get = $this->input->get();
        $data['get_data'] = $this->security->xss_clean($get);
        
        $this->load->model('customer_model');
        $this->load->model('ng_model');
        $data['list_customer'] = $this->customer_model->semua();
        
        if (@$data['get_data']['customer'] != null) {
            $data['detail_data'] = $this->ng_model->filter_page_pengiriman(
                    array(
                        "startdate" => @$data['get_data']['startdate'],
                        "enddate" => @$data['get_data']['enddate'],
                        "customer" => @$data['get_data']['customer'])
            );
        } else {
            $data['detail_data'] = array();
        }
        
        $this->load->view('design/header');
        $this->load->view('contents/pg-his-pengiriman', $data);
        $this->load->view('design/footer');
    }

    public function incoming() {
        
        $this->load->model('customer_model');
        $data['list_customer'] = $this->customer_model->semua();
        
        $this->load->model('product_model');
        $data['product_list'] = $this->product_model->semua();
        
        $this->load->model('incoming_model');
        $data['detail_data'] = $this->incoming_model->semua();
        
        $get = $this->input->get();
        $data['get_data'] = $this->security->xss_clean($get);
        
        if (@$data['get_data']['startdate'] != null) {
            $data['detail_data'] = $this->incoming_model->filter(
                    array(
                        "startdate" => @$data['get_data']['startdate'],
                        "enddate" => @$data['get_data']['enddate'],
                        "customer" => @$data['get_data']['customer'])
            );
        } else {
            $data['detail_data'] = array();
        }
        
        
        $this->load->view('design/header');
        $this->load->view('contents/pg-his-ng-incoming', $data);
        $this->load->view('design/footer');
    }

    public function simpanngdetail() {
        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        $row = array(
            "ng_sub_date" => date("Y-m-d"),
            "ng_result" => $data['mdl-desc'],
            "ng_item_id" => $data['mdl-ng-id']
        );
        
        if (!empty($_FILES['fileupload']['name'])) {
            // handling upload
            $config['upload_path'] = APPPATH . 'uploads/';
            $config['allowed_types'] = 'xls|xlsx|pdf|ppt';
            $config['file_name'] = '01_detail_kedatangan_' . strtolower($data['mdl-ng-id']);
            $config['overwrite'] = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('fileupload')) {
                $error = $this->upload->display_errors();
            } else {
                $error = $this->upload->data();
            }
            $ext = $this->upload->data('file_ext');
            
            $row['ng_file_name'] = $config['file_name'] . $ext;
        }
        
        $this->load->model('ng_model');
        $this->ng_model->updateDetail($row);

        redirect('history/ngdata?customer=' . $data['mdl-cust-name']);
    }
    
    public function simpanngcust() {
        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        $row = array(
            "ca_sub_date" => date("Y-m-d"),
            "ca_description" => $data['mdl-desc'],
            "ng_item_id" => $data['mdl-ng-id']
        );
        
        if (!empty($_FILES['fileupload']['name'])) {
            // handling upload
            $config['upload_path'] = APPPATH . 'uploads/';
            $config['allowed_types'] = 'xls|xlsx|pdf|ppt';
            $config['file_name'] = '02_cipl_cust_' . strtolower($data['mdl-ng-id']);
            $config['overwrite'] = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('fileupload')) {
                $error = $this->upload->display_errors();
            } else {
                $error = $this->upload->data();
            }
            $ext = $this->upload->data('file_ext');
            
            $row['ca_file_name'] = $config['file_name'] . $ext;
        }
        
        $this->load->model('ng_model');
        $this->ng_model->update_ngCust($row);

        redirect('history/ngcust?customer=' . $data['mdl-cust-name']);
    }
    
    public function simpanngcar() {
        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        $row = array(
            "car_sub_date" => date("Y-m-d"),
            "car_description" => $data['mdl-desc'],
            "ng_item_id" => $data['mdl-ng-id']
        );
        
        if (!empty($_FILES['fileupload']['name'])) {
            // handling upload
            $config['upload_path'] = APPPATH . 'uploads/';
            $config['allowed_types'] = 'xls|xlsx|pdf|ppt';
            $config['file_name'] = '03_car_' . strtolower($data['mdl-ng-id']);
            $config['overwrite'] = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('fileupload')) {
                $error = $this->upload->display_errors();
            } else {
                $error = $this->upload->data();
            }
            $ext = $this->upload->data('file_ext');
            
            $row['car_file_name'] = $config['file_name'] . $ext;
        }
        
        $this->load->model('ng_model');
        $this->ng_model->update_ngCar($row);

        redirect('history/ngcar?customer=' . $data['mdl-cust-name']);
    }
    
    public function simpanpengiriman() {
        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        $row = array(
            "out_sub_date" => date("Y-m-d"),
            "out_description" => $data['mdl-desc'],
            "ng_item_id" => $data['mdl-ng-id']
        );
        
        if (!empty($_FILES['fileupload']['name'])) {
            // handling upload
            $config['upload_path'] = APPPATH . 'uploads/';
            $config['allowed_types'] = 'xls|xlsx|pdf|ppt';
            $config['file_name'] = '04_pengiriman_' . strtolower($data['mdl-ng-id']);
            $config['overwrite'] = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('fileupload')) {
                $error = $this->upload->display_errors();
            } else {
                $error = $this->upload->data();
            }
            $ext = $this->upload->data('file_ext');
            
            $row['out_file_name'] = $config['file_name'] . $ext;
        }
        
        $this->load->model('ng_model');
        $this->ng_model->update_pengiriman($row);

        redirect('history/pengiriman?customer=' . $data['mdl-cust-name']);
    }

    public function hapusngdetail() {

        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        //print_r($data);

        $row = array(
            "ng_sub_date" => null,
            "ng_result" => null,
            "ng_file_name" => null,
            "ng_item_id" => $data['delete-ng']
        );
        $this->load->model('ng_model');
        $this->ng_model->updateDetail($row);
        
        $path = file_get_contents(APPPATH . 'uploads/'.$data['delete-file']);
        unlink($path); 

        redirect('history/ngdata?customer=' . $data['delete-user']);
    }
    
    public function hapusngcust() {

        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        //print_r($data);

        $row = array(
            "ca_sub_date" => null,
            "ca_description" => null,
            "ca_file_name" => null,
            "ng_item_id" => $data['delete-ng']
        );
        $this->load->model('ng_model');
        $this->ng_model->update_ngCust($row);
        
        $path = file_get_contents(APPPATH . 'uploads/'.$data['delete-file']);
        unlink($path); 

        redirect('history/ngcust?customer=' . $data['delete-user']);
    }
    
    public function hapusngcar() {

        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        //print_r($data);

        $row = array(
            "car_sub_date" => null,
            "car_description" => null,
            "car_file_name" => null,
            "ng_item_id" => $data['delete-ng']
        );
        $this->load->model('ng_model');
        $this->ng_model->update_ngCar($row);
        
        $path = file_get_contents(APPPATH . 'uploads/'.$data['delete-file']);
        unlink($path); 

        redirect('history/ngcar?customer=' . $data['delete-user']);
    }
    
    public function hapuspengiriman() {

        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        $row = array(
            "out_sub_date" => null,
            "out_description" => null,
            "out_file_name" => null,
            "ng_item_id" => $data['delete-ng']
        );
        $this->load->model('ng_model');
        $this->ng_model->update_pengiriman($row);
        
        $path = file_get_contents(APPPATH . 'uploads/'.$data['delete-file']);
        unlink($path); 

        redirect('history/pengiriman?customer=' . $data['delete-user']);
    }
    
    public function simpanngincoming() {
        $post = $this->input->post();
        $data = $this->security->xss_clean($post);
        
        $row = array(
            "id" => $data['mdl-ng-id'],
            "date" => date("Y-m-d"),
            "cust_id" => $data['customer'],
            "empl_id" => $this->session->user_id,
            "part_no" => $data['part_no'],
            "no_cipl" => $data['mdl-cipl'],
            "no_awb" => $data['mdl-awb']
        );
        
        $this->load->model('incoming_model');
        $this->incoming_model->simpan($row);
        redirect('history/incoming');
//        echo "<pre>";
//        print_r($data);
//        die();
    }

}
