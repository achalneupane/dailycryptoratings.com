<?php

Class dbData extends CI_Model {

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

    public function getCoinsData($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('crypto_coins');
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return 0;
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

}
