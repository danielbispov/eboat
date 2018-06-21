<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eboat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Eboat_model');
    }

    public function index() {
        if(isset($this->session->userdata['name']))
            redirect('dashboard');
        else
            $this->load->view('home');
    }

    public function dashboard() {
        $data['trips'] = $this->Eboat_model->get_trips(0);
        if(isset($this->session->userdata['name']) and $this->session->userdata['permission'] == 't')
            $data['user_trips'] = $this->Eboat_model->get_trips($this->session->userdata['id']);
        $data['b_trips'] = $this->get_trips_from($this->session->userdata['id']);
        $this->load->view('dashboard', $data);
    }

    public function login() {
        if(isset($this->session->userdata['name']))
            redirect('dashboard');
        else
            $this->load->view('login');
    }

    public function signup() {
        $this->load->view('signup');
    }

    public function logout() {
        $this->session->unset_userdata['name'];
        $this->session->unset_userdata['email'];
        $this->session->unset_userdata['balance'];
        $this->session->unset_userdata['permission'];
        $this->session->sess_destroy();
        redirect('index');
    }

    public function process_login() {

        $info = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );
        $result = $this->Eboat_model->validate_user($info);

        if(!$result)
            redirect('login');
        else
            redirect('dashboard');
    }

    public function register_user() {

        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'permission' => $this->input->post('permission'),
            'balance' => '0'
        );

        $result = $this->Eboat_model->insert_user($data);

        if(!$result) {
            $res['message'] = "Username might already exist";
            $this->load->view('signup', $res);
        }else {
            $res['message'] = "Successfully registered, log in";
            $this->load->view('login', $res);
        }
    }

    public function register_trip() {

        $data = array(
            'provider_id' => $this->session->userdata('id'),
            'destination' => $this->input->post('destination'),
            'departure' => $this->input->post('departure'),
            'cost' => $this->input->post('cost'),
            'origin' => $this->input->post('origin')
        );

        $result = $this->Eboat_model->insert_trip($data);

        if(!$result) {
            $res['message'] = "Username might already exist";
            redirect('dashboard');
        }else {
            $res['message'] = "Successfully registered, log in";
            redirect('dashboard');
        }
    }

    public function all_trips() {
        $this->Eboat_model->get_trips();
    }

    public function get_trips_from($id) {
        return $this->Eboat_model->get_bought_trips($id);
    }

    public function get_provider($id) {
        $this->Eboat_model->get_provider($id);
    }

    public function remove_trip($id) {
        $this->Eboat_model->delete_trip($id);
        redirect('dashboard');
    }

    public function update_trip($id) {
        $data = array(
            'destination' => $this->input->post('upd_destination'),
            'departure' => $this->input->post('upd_departure'),
            'cost' => $this->input->post('upd_cost'),
            'origin' => $this->input->post('upd_origin')
        );

        $result = $this->Eboat_model->update_trip($id, $data);

        if(!$result) {
            redirect('dashboard');
        }else {
            redirect('dashboard');
        }
    }

    public function new_schedule($id, $trip) {
        $res = $this->Eboat_model->insert_schedule($id, $trip);
        if(!$res)
            $error['schedule_exists'] = True;
        redirect('dashboard');
    }

    public function delete_schedule($id, $trip) {
        $this->Eboat_model->delete_schedule($id, $trip);
        redirect('dashboard');
    }
}