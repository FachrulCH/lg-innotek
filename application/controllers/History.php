<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class History extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
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

        if (@$data['get_data']['customer'] != null) {
            $data['detail_data'] = $this->ng_model->filterPageNGdata(
                    array(
                        "startdate" => "",
                        "enddate" => "",
                        "customer" => $data['get_data']['customer'])
            );
        } else {
            $data['detail_data'] = array();
        }

        $this->load->view('design/header');
        $this->load->view('contents/pg-his-ng-data', $data);
        $this->load->view('design/footer');
    }

    public function ngcust() {
        $this->load->view('design/header');
        $this->load->view('contents/pg-his-ng-cipl');
        $this->load->view('design/footer');
    }

    public function car() {
        $this->load->view('design/header');
        $this->load->view('contents/pg-his-car');
        $this->load->view('design/footer');
    }

    public function pengiriman() {
        $this->load->view('design/header');
        $this->load->view('contents/pg-his-pengiriman');
        $this->load->view('design/footer');
    }

    public function incoming() {
        $this->load->view('design/header');
        $this->load->view('contents/pg-his-pengiriman');
        $this->load->view('design/footer');
    }

}
