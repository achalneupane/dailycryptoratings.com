<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discussions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Get_data');
    }

    public function index() {

        $id = $this->input->GET('coin');
        $data["results"] = $this->Get_data->getCoinsDataWhere($id);
        $this->load->view('header');
        $this->load->view('discussions_view',$data);
    }

    
}
