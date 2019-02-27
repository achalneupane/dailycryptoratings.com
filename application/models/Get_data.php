<?php

Class Get_data extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function InserData($data) {
        try {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->symbol = $data['symbol'];
            $this->rank = $data['rank'];
            $this->price_usd = $data['price_usd'];
            $this->price_btc = $data['price_btc'];
            //$this->24h_volume_usd = $data['companyName'];
            $this->market_cap_usd = $data['market_cap_usd'];
            $this->available_supply = $data['available_supply'];
            $this->total_supply = $data['total_supply'];
            $this->max_supply = $data['max_supply'];
            $this->percent_change_1h = $data['percent_change_1h'];
            $this->percent_change_24h = $data['percent_change_24h'];
            $this->percent_change_7d = $data['percent_change_7d'];
            $this->last_updated = $data['last_updated'];

            $result = $this->db->insert('crypto_coins', $this);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateData($data) {
        try {
            $id = $data['id'];
            $this->name = $data['name'];
            $this->symbol = $data['symbol'];
            $this->rank = $data['rank'];
            $this->price_usd = $data['price_usd'];
            $this->price_btc = $data['price_btc'];
            //$this->24h_volume_usd = $data['companyName'];
            $this->market_cap_usd = $data['market_cap_usd'];
            $this->available_supply = $data['available_supply'];
            $this->total_supply = $data['total_supply'];
            $this->max_supply = $data['max_supply'];
            $this->percent_change_1h = $data['percent_change_1h'];
            $this->percent_change_24h = $data['percent_change_24h'];
            $this->percent_change_7d = $data['percent_change_7d'];
            $this->last_updated = $data['last_updated'];

            $result = $this->db->update('crypto_coins', $this, array('id' => $id));
            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getData($id) {
        $condition = "`id` = '$id'";
        $this->db->select('*');
        $this->db->from('crypto_coins');
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function record_count() {
        return $this->db->count_all("crypto_coins");
    }

    public function getCoinsData($limit, $start, $order, $cloume) {
        if ($cloume == 'rating') {
           
           $q = "SELECT c.*, (SELECT AVG(r.rating) FROM rating r WHERE r.coin_id = c.id) as avg_rating"
                   . " FROM crypto_coins c GROUP BY c.id ORDER BY avg_rating $order, c.coin_id "
                   . "LIMIT $start, $limit";
//            echo '<pre>';
//            print_r($q);
//            exit();
            $query = $this->db->query($q);
            if ($query->num_rows() == 0) {
                return 0;
            } else {
                $result = $query->result();
                return $result;
            }
        } else {
            $this->db->limit($limit, $start);
            $this->db->select('*');
            $this->db->from('crypto_coins');
            $this->db->group_by('id');
            $this->db->order_by($cloume, $order);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {
                return 0;
            } else {
                $result = $query->result();
                return $result;
            }
        }
    }

    public function getCoinsDataKeyWord($keyWord) {
        $condition = "`id` = '$id'";
        $this->db->select('*');
        $this->db->from('crypto_coins');
        $this->db->where($condition);
        $this->db->group_by('id');
        $this->db->order_by("rank", "asc");
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function getCoinsDataWhereKeyword($keyword) {
        $where = " (id Like'%$keyword%' OR name Like'%$keyword%' OR symbol Like'%$keyword%') ";
        $this->db->select('*');
        $this->db->from('crypto_coins');
        $this->db->where($where);
        $this->db->group_by('id');
        $this->db->order_by("rank", "asc");
//        $this->db->limit('10');
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function getSearchWhereKeyword($keyword) {
        $where = " (id Like'%$keyword%' OR name Like'%$keyword%' OR symbol Like'%$keyword%') ";
        $this->db->select('name as label');
        $this->db->from('crypto_coins');
        $this->db->where($where);
        $this->db->order_by("rank", "asc");
        $this->db->limit('10');
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function getCoinsDataWhere($id) {

        $where = "id='$id'";
        $this->db->select('*');
        $this->db->from('crypto_coins');
        $this->db->where($where);
        $this->db->group_by('id');
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function getCoinsDataWhereName($name) {

        $where = "name='$name'";
        $this->db->select('*');
        $this->db->from('crypto_coins');
        $this->db->where($where);
        $this->db->group_by('id');
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function InserRatingData($data) {
        try {
            $this->user_id = $data['user_id'];
            $this->coin_id = $data['coin_id'];
            $this->name = $data['name'];
            $this->rating = $data['rating'];

            $result = $this->db->insert('rating', $this);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getUserDataWhereEmail($email) {

        $where = "email='$email' LIMIT 1";
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function getRatingDataWhereId($coinId) {

        $where = "coin_id = '$coinId'";
        $this->db->select('*');
        $this->db->from('rating');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            $result = $query->result();
            return $query->num_rows();
        }
    }

    public function getRating24hrDataWhere($id) {
        $hour = "23:59";
        $today = strtotime("today $hour:00");
        $yesterday = strtotime("yesterday $hour:00");
        $yesterdayTime = date("Y-m-d H:i:s\n", $yesterday);
        $todayTime = date("Y-m-d H:i:s\n", $today);

        $where = "coin_id = '$id' AND  ( `create_at` <= '$todayTime' and `create_at` >= '$yesterdayTime')";
        $this->db->select('*');
        $this->db->from('rating');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function getUserRating24hrDataWhere($id, $coin_id) {
        $hour = "23:59";
        $today = strtotime("today $hour");
        $yesterday = strtotime("yesterday $hour:00");
        $yesterdayTime = date("Y-m-d H:i:s\n", $yesterday);
        $todayTime = date("Y-m-d H:i:s\n", $today);

        $where = "user_id = '$id' AND coin_id = '$coin_id' AND  ( `create_at` <= '$todayTime' and `create_at` >= '$yesterdayTime')";
        $this->db->select('*');
        $this->db->from('rating');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function getRating7DataWhere($id) {
        $hour = "23:59";
        $today = strtotime("today $hour:00");
        $lastWeak = strtotime("-1 week $hour:00");
        $lastWeakTime = date("Y-m-d H:i:s\n", $lastWeak);
        $todayTime = date("Y-m-d H:i:s\n", $today);

        $where = "coin_id = '$id' AND  ( `create_at` <= '$todayTime' and `create_at` >= '$lastWeakTime')";
        $this->db->select('*');
        $this->db->from('rating');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function getRating30DataWhere($id) {
        $hour = "23:59";
        $today = strtotime("today $hour:00");
        $lastWeak = strtotime("-1 month $hour:00");
        $lastWeakTime = date("Y-m-d H:i:s\n", $lastWeak);
        $todayTime = date("Y-m-d H:i:s\n", $today);

        $where = "coin_id = '$id' AND  ( `create_at` <= '$todayTime' and `create_at` >= '$lastWeakTime')";
        $this->db->select('*');
        $this->db->from('rating');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function getRatingOverAllDataWhere($id) {

        $where = "coin_id = '$id'";
        $this->db->select('*');
        $this->db->from('rating');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function getUserData($email) {

        $where = "email='$email'";
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function getRank() {
        $this->db->select('MAX(`rank`) as max_rank');
        $this->db->from('crypto_coins');
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $result = $query->result();
            return $result;
        }
    }

    public function updateUser($data) {
        try {
            $this->email = $data['email'];
            $this->fullname = $data['name'];
            $this->firstname = $data['given_name'];
            $this->lastname = $data['family_name'];
            $this->google_id = $data['google_id'];
            $this->profile_image = $data['picture'];
            $this->gpluslink = $data['link'];
            $this->auth_type = $data['auth_type'];
            $result = $this->db->insert('users', $this);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
