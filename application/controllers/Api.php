<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();

        //load the login model
        $this->load->model('Get_data');
    }

//  
//
//    public function index() {
//        $this->load->view('header');
//        $this->load->view('index');
//    }
    function getApiData() {
        try {

//            $max_rank = $this->Get_data->getRank();
            $max_rank = 1;
            $start_rank = 1;
            // echo "<h2>max rank: " . $max_rank[0]->max_rank . "</h2><br>";
            for ($i = 0; $i <= 10; $i++) {
                if ($i == 0) {
                    $start_rank = 0;
                } else {
                    $start_rank = $i * 200;
                }

                //echo 'start' . $start_rank . "<br>";
                $response = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/?start=' . $start_rank . '&limit=200'));
                if (!empty($response)) {
                    foreach ($response as $value) {
                        if (!empty($value->id)) {
                            $result = $this->Get_data->getData($value->id);
                            if (empty($result[0]->id)) {
                                $this->inserApiData($value);
//                                echo 'i <pre>';
//                                print_r($result[0]->id);
//                                exit();
                            } else {
//                                 echo 'u <pre>';
//                                print_r($result[0]->id);
//                                exit();
                                $this->updateApiData($value);
                            }
                        }
                    }
                }
            }
//            echo '<pre>';
//            print_r($response);
//            exit();
//            if ($max_rank[0]->max_rank > 0) {
//                $response = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/?start=' . $max_rank[0]->max_rank . '&limit=200'));
//            } else {
//                $response = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/'));
//            }
        } catch (HttpException $ex) {
            echo $ex;
            //exit();
        }
    }

    public function inserApiData($apiData) {

        if (!empty($apiData)) {
            $data = array(
                'id' => $apiData->id,
                'name' => $apiData->name,
                'symbol' => $apiData->symbol,
                'rank' => $apiData->rank,
                'price_usd' => $apiData->price_usd,
                'price_btc' => $apiData->price_btc,
                //'24h_volume_usd' => $apiData->24h_volume_usd,
                'market_cap_usd' => $apiData->market_cap_usd,
                'available_supply' => $apiData->available_supply,
                'total_supply' => $apiData->total_supply,
                'max_supply' => $apiData->max_supply,
                'percent_change_1h' => $apiData->percent_change_1h,
                'percent_change_24h' => $apiData->percent_change_24h,
                'percent_change_7d' => $apiData->percent_change_7d,
                'last_updated' => $apiData->last_updated
            );
            $status = $this->Get_data->InserData($data);
            if ($status == true) {
                //echo "insert done" . $apiData->name . "<br>";
                //$this->session->set_flashdata('success_msg', 'Changes save successfully');
                //redirect("setting");
            } else {
                //echo "error" . $apiData->name . "<br>";
                //$this->session->set_flashdata('error_msg', $status);
                //redirect("setting");
            }
        } else {
            echo 'empty responce';
        }
    }

    public function updateApiData($apiData) {

        if (!empty($apiData)) {
            $data = array(
                'id' => $apiData->id,
                'name' => $apiData->name,
                'symbol' => $apiData->symbol,
                'rank' => $apiData->rank,
                'price_usd' => $apiData->price_usd,
                'price_btc' => $apiData->price_btc,
                //'24h_volume_usd' => $apiData->24h_volume_usd,
                'market_cap_usd' => $apiData->market_cap_usd,
                'available_supply' => $apiData->available_supply,
                'total_supply' => $apiData->total_supply,
                'max_supply' => $apiData->max_supply,
                'percent_change_1h' => $apiData->percent_change_1h,
                'percent_change_24h' => $apiData->percent_change_24h,
                'percent_change_7d' => $apiData->percent_change_7d,
                'last_updated' => $apiData->last_updated
            );
            $status = $this->Get_data->updateData($data);
            if ($status == true) {
                //echo "update done:" . $apiData->name . "<br>";
                //exit();
                //$this->session->set_flashdata('success_msg', 'Changes save successfully');
                //redirect("setting");
            } else {
               // echo "error" . $apiData->name . "<br>";
                //exit();
                //$this->session->set_flashdata('error_msg', $status);
                //redirect("setting");
            }
        } else {
            echo 'empty responce';
        }
    }

}
