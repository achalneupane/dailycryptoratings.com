<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        require_once APPPATH . 'third_party/src/Google_Client.php';
        require_once APPPATH . 'third_party/src/contrib/Google_Oauth2Service.php';
        $this->load->database();
        $this->load->library("pagination");
        $this->load->library('session');
        $this->load->helper("url");
        //load the login model
        $this->load->model('Get_data');
        $per_page = 50;
    }

    public function index() {
        //$getDepartments = $this->dbData->getAllDepartment();

        $keyword = $this->input->get('search');
        $order = '';
        $cloume = '';

        $asc = $this->input->get('asc');
        $desc = $this->input->get('desc');
        if (!empty($asc)) {
            $order = 'asc';
            $cloume = $asc;
        } else if (!empty($desc)) {
            $order = 'desc';
            $cloume = $desc;
        } else {
            $order = 'asc';
            $cloume = 'rank';
        }
        if (!empty($keyword)) {
            $data["results"] = $this->Get_data->getCoinsDataWhereKeyword($keyword);
            if ($data) {
                $data["ratings"] = $this->getUserRatingWithKeyword($keyword);
            } else {
                $data["results"] = false;
                $this->load->view('header');
                $this->load->view('index', $data);
            }
        } else {
            $num_rows = $this->Get_data->record_count();
            $page = 0;
            $per_page = 50;
            $data["results"] = $this->Get_data->getCoinsData($per_page, $page, $order, $cloume);
            $data["ratings"] = $this->getUserRating($per_page, $page, $order, $cloume);
        }
//        echo '<pre>';
//        print_r($data["ratings"]);
//        exit();
        $this->load->view('header');
        $this->load->view('index', $data);
    }

    function autocomplete() {
        $keyword = $this->input->get('term');
        $data = $this->Get_data->getSearchWhereKeyword($keyword);
        echo json_encode($data);
    }

    public function getAjaxData() {

        $order = '';
        $cloume = '';

        $col = $this->input->post('col');
        $ord = $this->input->post('ord');
        if (empty($col)) {
            $col = 'rank';
        }
        if (empty($ord)) {
            $ord = 'asc';
        }

        $page_num = $this->input->post('page');
        $per_page = 50;
        $start = 0;
        if (!empty($page_num)) {
            $start = $page_num * $per_page + 1;
        }
        $data = $this->Get_data->getCoinsData($per_page, $start, $ord, $col);
        $ratings = $this->getUserRating($per_page, $start, $ord, $col);
//        echo '<pre>';
//        print_r($ratings);
//        exit();
        foreach ($data as $value) {
            
            $rating24 = '0';
            $rating7 = '0';
            $ratingMonth = '0';
            $ratingOverAll = '0';
            
            if (!empty($ratings[$value->id]['avg24'])) {
                $rating24 = $ratings[$value->id]['avg24'];
            } else {
                $rating24 = '0';
            };
            if (!empty($ratings[$value->id]['avg7'])) {
                $rating7 = $ratings[$value->id]['avg7'];
            } else {
                $rating7 = '0';
            };
            if (!empty($ratings[$value->id]['avgMonth'])) {
                $ratingMonth = $ratings[$value->id]['avgMonth'];
            } else {
                $ratingMonth = '0';
            };
            if (!empty($ratings[$value->id]['avgOverAll'])) {
                $ratingOverAll = $ratings[$value->id]['avgOverAll'];
            } else {
                $ratingOverAll = '0';
            };
            ?>
            <tr>
                <td class="column1"><?= $value->rank ?></td>
                <td class="column2">
                    <img src="https://files.coinmarketcap.com/static/img/coins/16x16/<?= $value->id ?>.png" alt="">
            <?= " " . $value->name ?></td>
                <td class="column3"><span class="color-blue">$</span><?= number_format($value->market_cap_usd) ?></td>
                <td class="column4"><span class="color-blue">$</span><?= number_format($value->price_usd, 6, '.', ',') ?></td>
                <td class="column5"><?= number_format($value->total_supply) ?></td>
                <td class="column6 <?php
            if ($value->percent_change_24h < 0) {
                echo "down_value";
            }else{
                                            echo 'color-green';
                                        }
            ?>"><?= $value->percent_change_24h ?>%</td>
                <td class="column7">
                    
                    <div class="ratings_wrapper">
                        <div class="Rating24">
                            <span>24 hour</span>
                            <div class="ratingValue">
                                <div class="stars-outer" >
                                    <div class="stars-inner" style=" width:<?= $rating24 * 10?>%;"></div>
                                </div>
            <!--                                <strong><span class="ratingValue"><? $ratings[$value->id]['avg24'] ?></span></strong>
                                <span class="grey">/</span>
                                <span class="grey" itemprop="bestRating">10</span>              -->
                            </div>
                           <span class="medium ratingCount color-blue"><i class="fa fa-user"></i> <?= $ratings[$value->id]['totalReview24'] ?></span>
                        </div>
                        <div class="Rating7">
                            <span>7 Days</span>
                            <div class="ratingValue">
                                <div class="stars-outer">
                                    <div class="stars-inner" style=" width:<?= $rating7* 10?>%;"></div>
                                </div>
            <!--                                <strong><span class="ratingValue"><? $ratings[$value->id]['avg7'] ?></span></strong>
                                <span class="grey">/</span>
                                <span class="grey" itemprop="bestRating">10</span>       -->
                            </div>
                          <span class="medium ratingCount color-blue"><i class="fa fa-user"></i> <?= $ratings[$value->id]['TotalReview7'] ?></span>
                        </div>
                        <div class="Rating30">
                            <span>Monthly</span>
                            <div class="ratingValue">
                                <div class="stars-outer" >
                                    <div class="stars-inner" style=" width:<?= $ratingMonth * 10?>%;"></div>
                                </div>
            <!--                                <strong><span class="ratingValue"><? $ratings[$value->id]['avgMonth'] ?></span></strong>
                                <span class="grey">/</span><span class="grey" itemprop="bestRating">10</span>          -->
                            </div>
                           <span class="medium ratingCount color-blue"><i class="fa fa-user"></i> <?= $ratings[$value->id]['totalReviewMonthly'] ?></span>
                        </div>
                        <div class="RatingOverAll">
                            <span>Over All</span>
                            <div class="ratingValue">
                                <div class="stars-outer" >
                                    <div class="stars-inner" style=" width:<?= $ratingOverAll * 10 ?>%;"></div>
                                </div>
            <!--                                <strong> <span class="ratingValue"><? $ratings[$value->id]['avgOverAll'] ?></span></strong>
                                <span class="grey">/</span>
                                <span class="grey" itemprop="bestRating">10</span>    -->
                            </div>
                           <span class="medium ratingCount color-blue"><i class="fa fa-user"></i> <?= $ratings[$value->id]['totalReviewOverAll'] ?></span>
                        </div>
                        <div class="star-rating">
                            <button id="id_<?= $value->coin_id ?>" type="button" data-name='<?= $value->name ?>' <?php if ($this->session->userdata('userEmail') != '' && $ratings[$value->id]['rating_allow'] == 0) { ?> onclick="setModelTitle(this.id)" <?php } elseif ($this->session->userdata('userEmail') == '') { ?> onclick="document.location.href = '<?= base_url() . "login" ?>'" <?php } else { ?> onclick = 'alertMessage(this.id);' <?php } ?> >
                                            <span class ="star-rating-star no-rating"> </span>
                                <span class="star-rating-text">Rate This</span>
                            </button>
                        </div>
                    </div>
                </td>
                <td class="column9">
                    <a href="<?= base_url() . "discussions?coin=" . $value->id ?>">Comment</a>
                </td>
            </tr>    
            <?php
        
        }
    }

    public function getUserRating($per_page, $page, $order, $cloume) {
        $rating24 = array();
        $rating7 = array();
        $ratingMonth = array();
        $ratingoverAll = array();

        $CoinArray = array();
        $finalArray = array();
        $getData = $this->Get_data->getCoinsData($per_page, $page, $order, $cloume);

        foreach ($getData as $value) {
            $userRatingStatus = '';

            $getRating24Data = $this->Get_data->getRating24hrDataWhere($value->id);
            if (!empty($getRating24Data)) {
                foreach ($getRating24Data as $Rating24value) {
                    array_push($rating24, $Rating24value->rating);
                }
            }

            $getRating7Data = $this->Get_data->getRating7DataWhere($value->id);
            if (!empty($getRating7Data)) {
                foreach ($getRating7Data as $Rating7value) {
                    array_push($rating7, $Rating7value->rating);
                }
            }

            $getRatingMonthlyData = $this->Get_data->getRating30DataWhere($value->id);
            if (!empty($getRatingMonthlyData)) {
                foreach ($getRatingMonthlyData as $RatingMonthvalue) {
                    array_push($ratingMonth, $RatingMonthvalue->rating);
                }
            }

            $getRatingOverAllData = $this->Get_data->getRatingOverAllDataWhere($value->id);
            if (!empty($getRatingOverAllData)) {
                foreach ($getRatingOverAllData as $RatingOverAllvalue) {
                    array_push($ratingoverAll, $RatingOverAllvalue->rating);
                }
            }
            $totalParticipants = $this->Get_data->getRatingDataWhereId($value->id);
            if ($this->session->userdata('userEmail') != '') {
                $useremail = $this->session->userdata('userEmail');
                $userId = $this->Get_data->getUserData($useremail);
                if (!empty($userId[0]->id)) {
                    $userRatingStatus = $this->Get_data->getUserRating24hrDataWhere($userId[0]->id, $value->id);
                }
            }

            if (!empty($userRatingStatus[0]->rating)) {
                $CoinArray["rating_allow"] = $userRatingStatus[0]->rating;
            } else {
                $CoinArray["rating_allow"] = '0';
            }

            $CoinArray["avg24"] = $this->calculateAverage($rating24);
            $CoinArray["totalReview24"] = $this->getCount($rating24);
            $CoinArray["avg7"] = $this->calculateAverage($rating7);
            $CoinArray["TotalReview7"] = $this->getCount($rating7);
            $CoinArray["avgMonth"] = $this->calculateAverage($ratingMonth);
            $CoinArray["totalReviewMonthly"] = $this->getCount($ratingMonth);
            $CoinArray["totalReviewOverAll"] = $this->getCount($ratingoverAll);
            $CoinArray["avgOverAll"] = $this->calculateAverage($ratingoverAll);
            $CoinArray["totalParticipants"] = $totalParticipants;
            $finalArray[$value->id] = $CoinArray;

            $rating24 = [];
            $rating7 = [];
            $ratingMonth = [];
            $ratingoverAll = [];
        }

        return $finalArray;
    }

    public function getUserRatingWithKeyword($keyWord) {
        $rating24 = array();
        $rating7 = array();
        $ratingMonth = array();
        $ratingoverAll = array();

        $CoinArray = array();
        $finalArray = array();
        $getData = $this->Get_data->getCoinsDataWhereKeyword($keyWord);

        foreach ($getData as $value) {
            $userRatingStatus = '';

            $getRating24Data = $this->Get_data->getRating24hrDataWhere($value->id);
            if (!empty($getRating24Data)) {
                foreach ($getRating24Data as $Rating24value) {
                    array_push($rating24, $Rating24value->rating);
                }
            }

            $getRating7Data = $this->Get_data->getRating7DataWhere($value->id);
            if (!empty($getRating7Data)) {
                foreach ($getRating7Data as $Rating7value) {
                    array_push($rating7, $Rating7value->rating);
                }
            }

            $getRatingMonthlyData = $this->Get_data->getRating30DataWhere($value->id);
            if (!empty($getRatingMonthlyData)) {
                foreach ($getRatingMonthlyData as $RatingMonthvalue) {
                    array_push($ratingMonth, $RatingMonthvalue->rating);
                }
            }

            $getRatingOverAllData = $this->Get_data->getRatingOverAllDataWhere($value->id);
            if (!empty($getRatingOverAllData)) {
                foreach ($getRatingOverAllData as $RatingOverAllvalue) {
                    array_push($ratingoverAll, $RatingOverAllvalue->rating);
                }
            }
            $totalParticipants = $this->Get_data->getRatingDataWhereId($value->id);
            if ($this->session->userdata('userEmail') != '') {
                $useremail = $this->session->userdata('userEmail');
                $userId = $this->Get_data->getUserData($useremail);
                if (!empty($userId[0]->id)) {
                    $userRatingStatus = $this->Get_data->getUserRating24hrDataWhere($userId[0]->id, $value->id);
                }
            }

            if (!empty($userRatingStatus[0]->rating)) {
                $CoinArray["rating_allow"] = $userRatingStatus[0]->rating;
            } else {
                $CoinArray["rating_allow"] = '0';
            }

            $CoinArray["avg24"] = $this->calculateAverage($rating24);
            $CoinArray["totalReview24"] = $this->getCount($rating24);
            $CoinArray["avg7"] = $this->calculateAverage($rating7);
            $CoinArray["TotalReview7"] = $this->getCount($rating7);
            $CoinArray["avgMonth"] = $this->calculateAverage($ratingMonth);
            $CoinArray["totalReviewMonthly"] = $this->getCount($ratingMonth);
            $CoinArray["totalReviewOverAll"] = $this->getCount($ratingoverAll);
            $CoinArray["avgOverAll"] = $this->calculateAverage($ratingoverAll);
            $CoinArray["totalParticipants"] = $totalParticipants;
            $finalArray[$value->id] = $CoinArray;

            $rating24 = [];
            $rating7 = [];
            $ratingMonth = [];
            $ratingoverAll = [];
        }

        return $finalArray;
    }

    public function calculateAverage($ratings) {
        $total = array_sum($ratings);
        $avg = $total / count($ratings);

        if ($avg > 0) {
            return round($avg);
        } else {
            return 0;
        }
    }

    public function getCount($ratings) {
        $total = count($ratings);
        if ($total > 0) {
            return $this->numberFormattter($total);
        } else {
            return 0;
        }
    }

    public function numberFormattter($digit) {
        if ($digit >= 1000000000) {
            return round($digit / 1000000000, 1) . 'G';
        }
        if ($digit >= 1000000) {
            return round($digit / 1000000, 1) . 'M';
        }
        if ($digit >= 1000) {
            return round($digit / 1000, 1) . 'K';
        }
        return $digit;
    }

}
