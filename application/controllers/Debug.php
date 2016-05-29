<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Debug extends CI_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
    }    
    
    public function index() {        
        echo "haii";
    }
    
    public function seq(){
        $this->load->model('sequences');
//        $data = $this->sequences->getSequences();
        $data = $this->sequences->getLastId('sqemployee');
        
        var_dump($data);
    }
    
    public function seq2() {
        $this->load->model('employee');
        $this->employee->newEmployee();
    }
    
    public function seqcust() {
        $this->load->model('sequences');
        $data = $this->sequences->getLastId('sqcustomer');
        var_dump($data);
    }
    
    public function dataprod() {
         $this->load->model('product_model');
        $data = $this->product_model->semua();
        var_dump($data);
    }
    
    public function loginempl() {
        $this->load->model('employee_model');
        $log = $this->employee_model->login('EMP16036', 'asoy');
        var_dump($log);
    }
    
}
