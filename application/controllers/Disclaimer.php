<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disclaimer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Get_data');
    }

    public function index() {

        $this->load->view('header');
        $this->load->view('disclaimer_view');
    }

    
}
