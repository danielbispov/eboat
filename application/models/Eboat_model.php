<?php

class Eboat_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function validate_user() {
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('password', $this->input->post('password'));

        $query = $this->db->get('users');

        if($query->num_rows() == 1) {
            $row = $query->row();
            $data = array(
                    'name' => $row->name,
                    'email' => $row->name
            );
            $this->session->set_userdata($data);
        }
    }

    public function insert_user() {
        try {
            $query = $this->db->query("SELECT * FROM users LIMIT 1;");
            $row = $query->row();
            print_r ($row->email);
        }catch (Exception $e) {
            echo "tamae";
            echo $e->getMessage();
        }


    }


}