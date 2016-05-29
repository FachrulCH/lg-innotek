<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        if ($this->session->logged_in) {
            redirect('dashboard');
        } else {
            $this->load->view('access/login');
        }
    }

    public function validate() {
        $this->form_validation->set_rules('usermail', 'Email', 'required');
        $this->form_validation->set_rules('userpass', 'Password', 'required');

        $id = $this->input->post('usermail', TRUE);
        $password = $this->input->post('userpass', TRUE);

        $param['status'] = array(
            0 => "Request",
            1 => "Progress 1",
            2 => "Progress 2",
            3 => "Progress 3",
            4 => "Closed"
        );
        $this->session->set_userdata('param', $param);

        if ($this->form_validation->run() == FALSE) {
            $loggedIn = false;
        } else {
            $cobaEmployee = $this->loginEmployee($id, $password);

            if (count($cobaEmployee) > 0) {
                $this->session->set_userdata('logged_in', TRUE);
                $this->session->set_userdata('user_id', $cobaEmployee[0]['id']);
                $this->session->set_userdata('username', $cobaEmployee[0]['name']);
                $this->session->set_userdata('level', $cobaEmployee[0]['group']);
                $loggedIn = true;
            } else {
                // klo di cek di employee ga nemu
                // coba cek di customer
                $cobaCustomer = $this->loginCustomer($id, $password);
                if (count($cobaCustomer) > 0) {
                    $this->session->set_userdata('logged_in', TRUE);
                    $this->session->set_userdata('user_id', $cobaCustomer[0]['id']);
                    $this->session->set_userdata('username', $cobaCustomer[0]['name']);
                    $this->session->set_userdata('level', 'CUS');
                    $loggedIn = true;
                } else {
                    $loggedIn = false;
                    $data['pesan'] = "Email/password salah";
                }
            }
        }

        if ($loggedIn) {
            redirect('dashboard');
        } else {
            $this->load->view('access/login', $data);
        }
    }

    public function loginEmployee($id, $password) {
        $this->load->model('employee_model');

        return $this->employee_model->login($id, $password);
    }

    public function loginCustomer($id, $password) {
        $this->load->model('customer_model');

        return $this->customer_model->login($id, $password);
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->load->view('access/login');
    }

}
