<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Unduh extends CI_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
    }    
    
    public function index() {
        redirect('/');
        exit('No access allowed');
    }
    
    public function file(){
        $nama_file = $this->uri->segment(3);
        $path = file_get_contents(APPPATH . 'uploads/'.$nama_file);
        $this->load->helper('download');
        force_download($nama_file, $path);
    }
    
}
