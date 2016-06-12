<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('ng_model');
        $data_c = $this->ng_model->getDashboardC();

        foreach ($data_c as $i => $v) {
            $data_c[$i]['jum'] = (int) $v['jum'];
        }

        $data['data_a'] = $this->ng_model->getDashboard();
        $data['data_b'] = $this->ng_model->getDashboardB();
        $data['data_c'] = $data_c;

        if ($this->session->logged_in) {
            if ($this->session->level == 'CUS') {
                redirect('/dashboard/customer');
            }
            $this->load->view('design/header');
            $this->load->view('dashboard/admin', $data);
            $this->load->view('design/footer');
        } else {
            redirect('/');
        }
    }

    public function admin() {
        $this->load->model('ng_model');
        $data_c = $this->ng_model->getDashboardC();

        foreach ($data_c as $i => $v) {
            $data_c[$i]['jum'] = (int) $v['jum'];
        }

        $data['data_a'] = $this->ng_model->getDashboard();
        $data['data_b'] = $this->ng_model->getDashboardB();
        $data['data_c'] = $data_c;

        if ($this->session->logged_in) {
            $this->load->view('design/header');
            $this->load->view('dashboard/admin', $data);
            $this->load->view('design/footer');
        } else {
            redirect('/');
        }
    }

    public function customer() {
        $this->load->model('ng_model');
        $data_c = $this->ng_model->getDashboardC_cust();

        foreach ($data_c as $i => $v) {
            $data_c[$i]['jum'] = (int) $v['jum'];
        }

        $data['data_a'] = $this->ng_model->getDashboard_cust();
        $data['data_b'] = $this->ng_model->getDashboardB_cust();
        $data['data_c'] = $data_c;

        if ($this->session->logged_in) {
            $this->load->view('design/header');
            $this->load->view('dashboard/admin', $data);
            $this->load->view('design/footer');
        } else {
            redirect('/');
        }
    }

}
