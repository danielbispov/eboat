<?php

class Eboat_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function validate_user($info) {
        $this->db->where('email', $info['email']);
        $this->db->where('password', $info['password']);
        $query = $this->db->get('eboat.users');

        if($query->num_rows() == 1) {
            $row = $query->row();
            $info = array(
                    'name' => $row->name,
                    'permission' => $row->permission,
                    'email' => $row->email,
                    'balance' => $row->balance,
            );
            $this->session->set_userdata($info);
            return true;
        } else {
            return false;
        }
    }

    public function insert_user($data) {
        try {
            $query = $this->db->insert('eboat.users', $data);
            if($query == 1)
                return true;
            else
                return false;
        }catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function get_trips() {
        $query = $this->db->get('eboat.trip');
        //print_r($query->result_array());
        return $query->result_array();
    }

    public function get_provider($id) {
        $this->db->select('name');
        $this->db->where('user_id', $id);
        $query = $this->db->get('eboat.users');

        if($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

}