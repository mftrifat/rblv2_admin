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

    function get_all_payment()
    {
        $this->db->select('*');
        $this->db->from('tbl_user_payment');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
}

?>