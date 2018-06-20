<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eboat extends CI_Controller {

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
        $this->load->model('Eboat_model');
        $result = $this->Eboat_model->validate_user();
        $this->Eboat_model->insert_user();

        if(!$result)
            $this->login();
        else
            $this->logged_home();

    }
}