<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class ModelPayments extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_pending_payment()
    {
        $this->db->select('*');
        $this->db->from('tbl_user_payment');
        $this->db->where("payment_status", 0);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function pending_payment_single_info($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_user_payment');
        $this->db->where("payment_status", 0);
        $this->db->where("id", $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_all_payment()
    {
        $this->db->select('*');
        $this->db->from('tbl_user_payment');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function confirm_payment_action($id, $data)
    {
        $this->db->set('payment_date', 'NOW()', FALSE);
        $this->db->where('id', $id);
        $this->db->update('tbl_user_payment', $data);

        return ($this->db->affected_rows() > 0);
    }

    function update_balance_on_payment($id, $balance)
    {
        $this->db->set('pending_payment', 0);
        $this->db->set('last_cashout', 'NOW()', FALSE);
        $this->db->set('user_balance', 'user_balance-'.$balance, FALSE);
        $this->db->set('user_cashout', 'user_cashout+'.$balance, FALSE);
        $this->db->where('user_id', $id);
        $this->db->update('tbl_user_balance');
        return ($this->db->affected_rows() > 0);
    }

    function update_balance_on_payment_commission($id, $balance)
    {
        $this->db->set('user_balance', 'user_balance+'.$balance, FALSE);
        $this->db->where('user_id', $id);
        $this->db->update('tbl_user_balance');
        return ($this->db->affected_rows() > 0);
    }

    function add_transaction_on_payment_confirm($data)
    {
        $this->db->insert('tbl_transaction_history', $data);
        return ($this->db->insert_id()) ? true : false;
    }

    function get_user_transaction_summary($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaction_history');
        $this->db->where("user_id", $id);
        $this->db->order_by("id", "ASC");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_user_list()
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where("user_type_id < 9");
        $this->db->order_by("id", "ASC");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function total_cashout()
    {
        $this->db->select('sum(payment_amount) as total');
        $this->db->from('tbl_user_payment');
        $query=$this->db->get();
        $row = $query->row();
        if ($query->num_rows() > 0) {
            return round($row->total,2);
        }
    }

    function total_charge()
    {
        $this->db->select('sum(charge_amount) as total');
        $this->db->from('tbl_user_payment');
        $query=$this->db->get();
        $row = $query->row();
        if ($query->num_rows() > 0) {
            return round($row->total,2);
        }
    }

    function total_commission()
    {
        $this->db->select('sum(commision_amount) as total');
        $this->db->from('tbl_user_payment');
        $query=$this->db->get();
        $row = $query->row();
        if ($query->num_rows() > 0) {
            return round($row->total,2);
        }
    }
}

?>
