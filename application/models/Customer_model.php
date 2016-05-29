<?php

class Customer_model extends CI_Model {

    public $id;
    public $name;
    public $address;
    public $email;
    public $telp;
    public $contact_person;
    public $password;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function baru($data) {
        $this->load->model('sequences');
        $this->db->trans_begin();

        if ($data['id'] == null) {
            $this->id = $this->sequences->getLastId('sqcustomer');
        } else {
            $this->id = $data['id'];
        }

        $this->name = $data['name'];
        $this->address = $data['address'];
        $this->email = $data['email'];
        $this->telp = $data['telp'];
        $this->contact_person = $data['contact_person'];
        $this->password = md5($data['password']);

        $this->db->replace('lg_customer', $this);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        return $this->id;
    }

    public function semua() {
        $query = $this->db->get('lg_customer');
        return $query->result_array();
    }

    public function hapus($id) {

        return $this->db->delete('lg_customer', array('id' => $id));
    }

    public function login($id, $paswd) {
        $paswdHash = md5($paswd);

        $query = $this->db->get_where('lg_customer', array(
            'id' => $id,
            'password' => $paswdHash));
        return $query->result_array();
    }

}
