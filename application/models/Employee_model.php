<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Employee
 *
 * @author kurawall
 */
class Employee_model extends CI_Model {

    public $id;
    public $name;
    public $email;
    public $group;
    public $telp;
    public $password;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function newEmployee($data) {

        $this->load->model('sequences');
        $this->db->trans_begin();

        if ($data['id'] == null) {
            $this->id = $this->sequences->getLastId('sqemployee');
        } else {
            $this->id = $data['id'];
        }

        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->group = $data['group'];
        $this->telp = $data['telp'];
        $this->password = md5($data['paswd']);

        $this->db->replace('lg_employee', $this);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        return $this->id;
    }

    public function delete($id) {

        return $this->db->delete('lg_employee', array('id' => $id));
        
    }

    public function getAll() {
        $query = $this->db->get('lg_employee');
        return $query->result_array();
    }
    
    public function getGroup() {
        $query = $this->db->get('master_group');
        return $query->result_array();
    }
    
    public function login($id, $paswd) {
        $paswdHash = md5($paswd);
        
        $query   = $this->db->get_where('lg_employee', array(
                                                    'id'     => $id,
                                                    'password'    => $paswdHash));
        return $query->result_array();
    }
    
    public function getStaff() {
        $query   = $this->db->get_where('lg_employee', array('group'=>'OQA'));
        return $query->result_array();
    }
    
    public function getInspector(){
        $query   = $this->db->get_where('lg_employee', array('group'=>'INS'));
        return $query->result_array();
    }
    
}
