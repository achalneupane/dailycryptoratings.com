<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login1 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        require_once APPPATH . 'third_party/src/Google_Client.php';
        require_once APPPATH . 'third_party/src/contrib/Google_Oauth2Service.php';
        $this->load->library('facebook');
        $this->load->database();
        $this->load->model('Get_data');
    }

    public function index() {

//        $fb_config = array(
//            'appId' => '1560461144257377',
//            'secret' => '7c3a21eef599691b0b2bc5a35bec12f0'
//        );

        $userData = array();
        if ($this->facebook->is_authenticated()) {
           $this->facebook();
        } else {
            $data['authUrl'] = $this->facebook->login_url();
        }


        $this->load->view('header');
        $this->load->view('login_view',$data);
    }

    public function google() {
        $clientId = '87025508273-55kpj0a50lf4bgh99jhabq7bk97fkmjn.apps.googleusercontent.com'; //Google client ID
        $clientSecret = 'ZXdchO0QRLpWq9Z991F8QRd3'; //Google client secret
    $redirectURL = 'http://dailycryptoratings.com/login/google';
        //$redirectURL = 'http://localhost/daily_crypto_ratings/login/google';

//Call Google API
        $gClient = new Google_Client();
        $gClient->setApplicationName('Login');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectURL);
        $google_oauthV2 = new Google_Oauth2Service($gClient);

        if (isset($_GET['code'])) {
            $gClient->authenticate($_GET['code']);
            $_SESSION['token'] = $gClient->getAccessToken();
            header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
        }

        if (isset($_SESSION['token'])) {
            $gClient->setAccessToken($_SESSION['token']);
        }

        if ($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
            if ($userProfile) {

                $this->session->set_userdata('userEmail', $userProfile['email']);
                $this->session->set_userdata('userName', $userProfile['name']);
                $userStatus = $this->Get_data->getUserData($userProfile['email']);
                if (!$userStatus[0]) {
                    $data = array(
                        'email' => $userProfile['email'],
                        'name' => $userProfile['name'],
                        'given_name' => $userProfile['given_name'],
                        'family_name' => $userProfile['family_name'],
                        'google_id' => $userProfile['id'],
                        'link' => $userProfile['link'],
                        'auth_type' => 'google',
                        'picture' => $userProfile['picture']
                    );
                    $status = $this->Get_data->updateUser($data);
                    if ($status) {
                        redirect(base_url());
                    }
                } else {
                    redirect(base_url());
                }
            }
//            echo "<pre>";
//            print_r($userProfile);
//            die;
        } else {
            $url = $gClient->createAuthUrl();
            header("Location: $url");
            exit;
        }
    }

    public function facebook() {
        $userData = array();
        if ($this->facebook->is_authenticated()) {
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
//            echo "<pre>";
//            print_r($userProfile);
//            die;
            $this->session->set_userdata('userEmail', $userProfile['email']);
            $this->session->set_userdata('userName', $userProfile['first_name']." ".$userProfile['last_name']);
            $userStatus = $this->Get_data->getUserData($userProfile['email']);
                if (!$userStatus[0]) {
                    $data = array(
                        'email' => $userProfile['email'],
                        'name' => $userProfile['first_name']." ".$userProfile['last_name'],
                        'given_name' => $userProfile['first_name'],
                        'family_name' => $userProfile['last_name'],
                        'google_id' => $userProfile['id'],
                        'link' => '',
                        'auth_type' => 'facebook',
                        'picture' => $userProfile['picture']['data']['url']
                    );
                    $status = $this->Get_data->updateUser($data);
                    if ($status) {
                        redirect("welcome");
                    }
                } else {
                    redirect("welcome");
                }
        } else {
            $data['authUrl'] = $this->facebook->login_url();
        }
        $this->load->view('login', $data);
    }

    public function logout() {
        $this->facebook->destroy_session();
        redirect('/login');
    }

}
