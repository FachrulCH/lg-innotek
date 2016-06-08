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
    }

    public function index() {
        echo "hai";
    }

    public function tescetak() {
//        $nama = "test";
        $html2 = '<html>
    <body>
        <h1>Hallow semua lagi</h1>
    </body>
//</html>';

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
                        "enddate" => @$data['get_data']['enddate'],
                        "customer" => @$data['get_data']['customer'])
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
        $this->dompdf->stream("ujicoba.pdf", array('Attachment' => 0));
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
        $this->dompdf->stream("ujicoba.pdf", array('Attachment' => 0));
        //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
        //$this->dompdf->stream("welcome.pdf");
    }

}
