<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Analisa extends CI_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
    }    
    
    public function index() {        
        $this->load->view('design/header');
        $this->load->view('contents/pg-analisa-sp');
        $this->load->view('design/footer');
    }
    
    public function sp() {        
        $this->load->view('design/header');
        $this->load->view('contents/pg-analisa-sp');
        $this->load->view('design/footer');
    }
   
    public function result() {        
        $this->load->view('design/header');
        $this->load->view('contents/pg-analisa-result');
        $this->load->view('design/footer');
    }
}
