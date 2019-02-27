<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Get_data');
    }

    public function index() {
        $rate = $this->input->post("rating");
        $coinName = $this->input->post("coinName");
        $userEmail = $this->input->post("userEmail");
        $userName = $this->input->post("userName");
        if (!empty($rate) && !empty($coinName) && !empty($userEmail)) {
            $userId = $this->Get_data->getUserDataWhereEmail($userEmail);
            $coinId = $this->Get_data->getCoinsDataWhereName($coinName);
     
            if (!empty($userId[0]->id) && !empty($coinId[0]->id)) {
                $data = array(
                    'user_id' => $userId[0]->id,
                    'coin_id' => $coinId[0]->id,
                    'rating' => $rate,
                    'name' => $userName
                );

                $status = $this->Get_data->InserRatingData($data);
                if($status)
                {
                    redirect("welcome");
                }
            }else{
                 redirect("welcome");
            }

        }else{
                 redirect("welcome");
            }
    }

}
