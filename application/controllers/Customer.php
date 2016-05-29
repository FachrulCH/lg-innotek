<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
        $this->load->model('customer_model');
        $data['tabel_data'] = $this->customer_model->semua();
        
        $this->load->view('design/header');
        $this->load->view('contents/pg-customers', $data);
        $this->load->view('design/footer');
    }

    public function service() {
        $this->load->model('product_model');
        $data['product_list'] = $this->product_model->semua();
        
        $this->load->view('design/header');
        $this->load->view('contents/pg-customer-service', $data);
        $this->load->view('design/footer');
    }
    
    public function service_simpan() {
        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        $this->load->model('ng_model');
        $this->ng_model->simpan($data);
        redirect('customer/service');
    }

    public function cetak() {
        $this->load->view('report/header');
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

    public function save() {
        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        $this->load->model('customer_model');
        $this->customer_model->baru($data);
        redirect('customer/');
    }
    
    public function delete() {
        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        $this->load->model('customer_model');
        $this->customer_model->hapus($data['id']);
        redirect('customer/');
    }

}
