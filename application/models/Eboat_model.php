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
                    'id' => $row->user_id,
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

    public function insert_trip($data) {
        $query = $this->db->insert('eboat.trip', $data);
        if($query == 1)
            return true;
        else
            return false;
    }

    public function insert_schedule($id, $trip) {
        $data = array(
            'passenger_id' => $id,
            'trip_id' => $trip
        );

        $this->db->where('passenger_id', $id);
        $this->db->where('trip_id', $trip);
        $validate = $this->db->get('eboat.schedule');

        if($validate->num_rows() == 1) {
            return false;
        } else {
            $this->db->insert('eboat.schedule', $data);
            return true;
        }
    }

    public function get_trips($id) {

        if($id != 0) {
            $this->db->where('provider_id', $id);
            $query = $this->db->get('eboat.trip');

            return $query->result_array();
        } else {
            $query = $this->db->get('eboat.trip');
            $res = $query->result_array();

            for($i=0;$i<sizeof($res);$i++) {
                $res[$i]['provider_name'] = $this->get_provider($res[$i]['provider_id']);
            }

            return $res;
        }
    }

    public function get_provider($id) {
        $this->db->select('name');
        $this->db->where('user_id', $id);
        $query = $this->db->get('eboat.users');
        $res = $query->row();

        if($query->num_rows() == 1) {
            return $res->name;
        } else {
            return false;
        }
    }

    public function delete_trip($id) {
        $this->db->where('trip_id', $id);
        $this->db->delete('eboat.trip');
    }

    public function delete_schedule($id, $trip) {
        $this->db->where('trip_id', $trip);
        $this->db->where('passenger_id', $id);
        $this->db->delete('eboat.schedule');
    }

    public function update_trip($id, $data) {
        $this->db->where('trip_id', $id);
        $this->db->update('eboat.trip', $data);
    }

    public function get_bought_trips($id) {
        $sql = "SELECT * FROM eboat.trip t 
      INNER JOIN (SELECT s.* FROM eboat.schedule s INNER JOIN eboat.users u ON s.passenger_id = u.user_id WHERE
      s.passenger_id = " . $id . ") AS p
       ON p.trip_id = t.trip_id;";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        for($i=0;$i<sizeof($res);$i++) {
            $res[$i]['provider_name'] = $this->get_provider($res[$i]['provider_id']);
        }

        return $res;
    }

}