<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Report
 *
 * @author kurawall
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
    }

    public function index() {
        echo "hai";
    }

    public function tescetak() {
//        $nama = "test";
        $html2 = '<html><body><h1>Hallow semua lagi</h1></body></html>';

        $html = file_get_contents("http://localhost/PRJ/lg/report/incoming?startdate=2016-06-01&enddate=2016-06-08");
        $this->load->library('dompdf_gen');

        // Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->set_paper('A4', 'landscape');
        $this->dompdf->render();
        //utk menampilkan preview pdf
        //$this->dompdf->stream("report_incoming".  str_replace("-", "", $data['get_data']['startdate'])."_".str_replace("-", "", $data['get_data']['enddate']).".pdf", array('Attachment' => 0));
        $this->dompdf->stream("report_incoming.pdf", array('Attachment' => 0));
    }

    public function cetak() {
        $this->load->view('report/sample');
//        $this->load->view('contents/pg-customer-service');
        //$this->load->view('design/footer');

        $html = $this->output->get_output();
        // Load/panggil library dompdfnya
        $this->load->library('dompdf_gen');

        // Convert to PDF
        $this->dompdf->load_html($html);
//        $this->dompdf->set_base_path(realpath(APPPATH . '/assets/bootstrap/css/bootstrap.min.css'));
        $this->dompdf->set_paper('A4', 'landscape');
        $this->dompdf->render();
        //utk menampilkan preview pdf
        $this->dompdf->stream("ujicoba.pdf", array('Attachment' => 0));
        //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
        //$this->dompdf->stream("welcome.pdf");
    }

    public function incoming() {
        $get = $this->input->get();
        $data['get_data'] = $this->security->xss_clean($get);
        $this->load->model('incoming_model');
        if (@$data['get_data']['startdate'] != null) {
            $data['detail_data'] = $this->incoming_model->filter(
                    array(
                        "startdate" => @$data['get_data']['startdate'],
                        "enddate" => @$data['get_data']['enddate'])
            );
        } else {
            $data['detail_data'] = array();
        }
        $this->load->view('report/incoming', $data);
        $html = $this->output->get_output();
        // Load/panggil library dompdfnya
        $this->load->library('dompdf_gen');

        // Convert to PDF
        $this->dompdf->load_html($html);
//        $this->dompdf->set_base_path(realpath(APPPATH . '/assets/bootstrap/css/bootstrap.min.css'));
        $this->dompdf->set_paper('A4', 'landscape');
        $this->dompdf->render();
        //utk menampilkan preview pdf
        $this->dompdf->stream("report_incoming.pdf", array('Attachment' => 0));
        //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
        //$this->dompdf->stream("welcome.pdf");
    }

    public function historycust() {
        $get = $this->input->get();
        $filter = $this->security->xss_clean($get);

        if (@$filter['startdate'] != null) {
            $this->load->model('ng_model');
            $data['detail_data'] = $this->ng_model->filter($filter);
        } else {
            $data['detail_data'] = array();
        }
        $this->load->view('report/historycust_report', $data);
        $html = $this->output->get_output();
        // Load/panggil library dompdfnya
        $this->load->library('dompdf_gen');

        // Convert to PDF
        $this->dompdf->load_html($html);
//        $this->dompdf->set_base_path(realpath(APPPATH . '/assets/bootstrap/css/bootstrap.min.css'));
        $this->dompdf->set_paper('A4', 'landscape');
        $this->dompdf->render();
        //utk menampilkan preview pdf
        $this->dompdf->stream("report_history.pdf", array('Attachment' => 0));
        //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
        //$this->dompdf->stream("welcome.pdf");
    }

    public function spa() {
        $get = $this->input->get();
        $filter = $this->security->xss_clean($get);

        if (@$filter['spa'] != null) {
            $this->load->model('ng_model');
            $rows = $this->ng_model->filter_report_spa($filter['spa']);
            $data['detail'] = $rows[0];
        } else {
            $data['detail'] = array();
        }
        $this->load->view('report/spa_report', $data);
        $html = $this->output->get_output();
        // Load/panggil library dompdfnya
        $this->load->library('dompdf_gen');

        // Convert to PDF
        $this->dompdf->load_html($html);
//        $this->dompdf->set_base_path(realpath(APPPATH . '/assets/bootstrap/css/bootstrap.min.css'));
        $this->dompdf->set_paper('A4', 'landscape');
        $this->dompdf->render();
        //utk menampilkan preview pdf
        $this->dompdf->stream("report_spa.pdf", array('Attachment' => 0));
        //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
        //$this->dompdf->stream("welcome.pdf");
    }
    public function filterbycust() {
        $get = $this->input->get();
        $filter = $this->security->xss_clean($get);

        if (@$filter['customer'] != null) {
            $this->load->model('ng_model');
            $data['detail_data'] = $this->ng_model->filter_report_bycust($filter);
        } else {
            $data['detail_data'] = array();
        }
        $this->load->view('report/filter_cust_report', $data);
        $html = $this->output->get_output();
        // Load/panggil library dompdfnya
        $this->load->library('dompdf_gen');

        // Convert to PDF
        $this->dompdf->load_html($html);
//        $this->dompdf->set_base_path(realpath(APPPATH . '/assets/bootstrap/css/bootstrap.min.css'));
        $this->dompdf->set_paper('A4', 'landscape');
        $this->dompdf->render();
        //utk menampilkan preview pdf
        $this->dompdf->stream("report_filter_by_customer.pdf", array('Attachment' => 0));
        //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
        //$this->dompdf->stream("welcome.pdf");
    }

    public function bycust() {
        $get = $this->input->get();
        $data['get_data'] = $this->security->xss_clean($get);

        $this->load->model('customer_model');
        $this->load->model('ng_model');

        $data['list_customer'] = $this->customer_model->semua();

        if (@$data['get_data']['customer'] != null) {
            $data['detail_data'] = $this->ng_model->filter_report_bycust(
                    array(
                        "startdate" => @$data['get_data']['startdate'],
                        "enddate" => @$data['get_data']['enddate'],
                        "customer" => @$data['get_data']['customer'])
            );
        } else {
            $data['detail_data'] = array();
        }

        $this->load->view('design/header');
        $this->load->view('contents/pg-rep-cust', $data);
        $this->load->view('design/footer');
    }
    public function bystatus() {
        $get = $this->input->get();
        $data['get_data'] = $this->security->xss_clean($get);
        $this->load->model('ng_model');
        
        $param = $this->session->param;
        $data['list_status'] = $param['status'];

        if (@$data['get_data']['status'] != null) {
            $data['detail_data'] = $this->ng_model->filter_report_bystatus(
                    array(
                        "startdate" => @$data['get_data']['startdate'],
                        "enddate" => @$data['get_data']['enddate'],
                        "status" => @$data['get_data']['status'])
            );
        } else {
            $data['detail_data'] = array();
        }

        $this->load->view('design/header');
        $this->load->view('contents/pg-rep-status', $data);
        $this->load->view('design/footer');
    }
    
    public function filterbystatus() {
        $get = $this->input->get();
        $filter = $this->security->xss_clean($get);

        if (@$filter['status'] != null) {
            $this->load->model('ng_model');
            $data['detail_data'] = $this->ng_model->filter_report_bystatus($filter);
        } else {
            $data['detail_data'] = array();
        }
        $this->load->view('report/filter_status_report', $data);
        $html = $this->output->get_output();
        // Load/panggil library dompdfnya
        $this->load->library('dompdf_gen');

        // Convert to PDF
        $this->dompdf->load_html($html);
//        $this->dompdf->set_base_path(realpath(APPPATH . '/assets/bootstrap/css/bootstrap.min.css'));
        $this->dompdf->set_paper('A4', 'landscape');
        $this->dompdf->render();
        //utk menampilkan preview pdf
        $this->dompdf->stream("report_filter_by_status.pdf", array('Attachment' => 0));
        //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
        //$this->dompdf->stream("welcome.pdf");
    }
    
    public function byemployee() {
        $get = $this->input->get();
        $data['get_data'] = $this->security->xss_clean($get);
        
        $this->load->model('ng_model');
        $this->load->model('employee_model');
        
        $data['list_employee'] = $this->employee_model->getStaff();

        if (@$data['get_data']['employee'] != null) {
            $data['detail_data'] = $this->ng_model->filter_report_byemployee(
                    array(
                        "startdate" => @$data['get_data']['startdate'],
                        "enddate" => @$data['get_data']['enddate'],
                        "employee" => @$data['get_data']['employee'])
            );
        } else {
            $data['detail_data'] = array();
        }

        $this->load->view('design/header');
        $this->load->view('contents/pg-rep-employee', $data);
        $this->load->view('design/footer');
    }
    
    public function filterbyemployee() {
        $get = $this->input->get();
        $filter = $this->security->xss_clean($get);

        if (@$filter['employee'] != null) {
            $this->load->model('ng_model');
            $data['detail_data'] = $this->ng_model->filter_report_byemployee($filter);
        } else {
            $data['detail_data'] = array();
        }
        $this->load->view('report/filter_employee_report', $data);
        $html = $this->output->get_output();
        // Load/panggil library dompdfnya
        $this->load->library('dompdf_gen');

        // Convert to PDF
        $this->dompdf->load_html($html);
//        $this->dompdf->set_base_path(realpath(APPPATH . '/assets/bootstrap/css/bootstrap.min.css'));
        $this->dompdf->set_paper('A4', 'landscape');
        $this->dompdf->render();
        //utk menampilkan preview pdf
        $this->dompdf->stream("report_filter_by_employee.pdf", array('Attachment' => 0));
        //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
        //$this->dompdf->stream("welcome.pdf");
    }
    //
    public function byperiodic() {
        $get = $this->input->get();
        $data['get_data'] = $this->security->xss_clean($get);
        
        $this->load->model('ng_model');

        if (@$data['get_data']['startdate'] != null) {
            $data['detail_data'] = $this->ng_model->filter_report_byperiodic(
                    array(
                        "startdate" => @$data['get_data']['startdate'],
                        "enddate" => @$data['get_data']['enddate'])
            );
        } else {
            $data['detail_data'] = array();
        }

        $this->load->view('design/header');
        $this->load->view('contents/pg-rep-periodic', $data);
        $this->load->view('design/footer');
    }
    
    public function filterbyperiodic() {
        $get = $this->input->get();
        $filter = $this->security->xss_clean($get);

        if (@$filter['startdate'] != null) {
            $this->load->model('ng_model');
            $data['detail_data'] = $this->ng_model->filter_report_byperiodic($filter);
        } else {
            $data['detail_data'] = array();
        }
        $this->load->view('report/filter_periodic_report', $data);
        $html = $this->output->get_output();
        // Load/panggil library dompdfnya
        $this->load->library('dompdf_gen');

        // Convert to PDF
        $this->dompdf->load_html($html);
//        $this->dompdf->set_base_path(realpath(APPPATH . '/assets/bootstrap/css/bootstrap.min.css'));
        $this->dompdf->set_paper('A4', 'landscape');
        $this->dompdf->render();
        //utk menampilkan preview pdf
        $this->dompdf->stream("report_filter_by_periodic.pdf", array('Attachment' => 0));
        //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
        //$this->dompdf->stream("welcome.pdf");
    }
    //
    public function bymodel() {
        $get = $this->input->get();
        $data['get_data'] = $this->security->xss_clean($get);
        
        $this->load->model('ng_model');
        $this->load->model('product_model');
        
        $data['list_produk'] = $this->product_model->semua();

        if (@$data['get_data']['model'] != null) {
            $data['detail_data'] = $this->ng_model->filter_report_bymodel(
                    array(
                        "startdate" => @$data['get_data']['startdate'],
                        "enddate" => @$data['get_data']['enddate'],
                        "model" => @$data['get_data']['model'])
            );
        } else {
            $data['detail_data'] = array();
        }

        $this->load->view('design/header');
        $this->load->view('contents/pg-rep-model', $data);
        $this->load->view('design/footer');
    }
    
    public function filterbymodel() {
        $get = $this->input->get();
        $filter = $this->security->xss_clean($get);

        if (@$filter['model'] != null) {
            $this->load->model('ng_model');
            $data['detail_data'] = $this->ng_model->filter_report_bymodel($filter);
        } else {
            $data['detail_data'] = array();
        }
        $this->load->view('report/filter_model_report', $data);
        $html = $this->output->get_output();
        // Load/panggil library dompdfnya
        $this->load->library('dompdf_gen');

        // Convert to PDF
        $this->dompdf->load_html($html);
//        $this->dompdf->set_base_path(realpath(APPPATH . '/assets/bootstrap/css/bootstrap.min.css'));
        $this->dompdf->set_paper('A4', 'landscape');
        $this->dompdf->render();
        //utk menampilkan preview pdf
        $this->dompdf->stream("report_filter_by_model.pdf", array('Attachment' => 0));
        //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
        //$this->dompdf->stream("welcome.pdf");
    }
}
