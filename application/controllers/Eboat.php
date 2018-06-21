<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eboat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Eboat_model');
    }

    public function index() {
        $this->load->view('home');
    }

    public function logged_home() {
        $this->load->view('logged_home');
    }

    public function login() {
        $this->load->view('login');
    }

    public function signup() {
        $this->load->view('signup');
    }

    public function process_login() {

        $info = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );
        $result = $this->Eboat_model->validate_user($info);

        $trips['trips'] = $this->Eboat_model->get_trips();
        for($i=0; $i<sizeof($trips['trips']); $i++) {
            //$trips['trips'][$i]['provider_name'] = $this->get_provider($trips['trips'][$i]['provider_id']);
            echo $trips['trips'][$i]['provider_id'];
            echo $this->get_provider(2);
        }

        //print_r($data['trips']['provider_id']);
        if(!$result)
            $this->load->view('login');
        else
            $this->load->view('logged_home' );//$data);

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

    public function all_trips() {
        $this->Eboat_model->get_trips();
    }

    public function get_provider($id) {
        $this->Eboat_model->get_provider($id);
    }
}