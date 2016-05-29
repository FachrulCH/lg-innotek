<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
    }    
    
    public function index() {        
        $this->load->model('product_model');
        $data['tabel_data'] = $this->product_model->semua();
        
        $this->load->view('design/header');
        $this->load->view('contents/pg-products', $data);
        $this->load->view('design/footer');
    }
    
    public function simpan(){
        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        $this->load->model('product_model');
        $this->product_model->baru($data);
        redirect('product/');
    }
    
    public function hapus() {
        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        $this->load->model('product_model');
        $this->product_model->hapus($data['id']);
        redirect('product/');
    }
}
