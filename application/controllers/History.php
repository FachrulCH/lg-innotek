<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class History extends CI_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
    }    
    
    public function index() {        
        $this->load->view('design/header');
        $this->load->view('contents/pg-his-ng-cust');
        $this->load->view('design/footer');
    }
    public function ngdata() {        
        $this->load->view('design/header');
        $this->load->view('contents/pg-his-ng-cust');
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
}
