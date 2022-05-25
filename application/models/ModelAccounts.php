<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class ModelAccounts extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function all_accounts($id)
    {
        $this->db->select('a.*, u.full_name as full_name, c.id as category_id');
        $this->db->from('tbl_new_accounts a');
        $this->db->join('tbl_users u', 'a.id_input_user = u.user_id');
        $this->db->join('tbl_category c', 'a.category = c.id');
        $this->db->where('a.sub_category', $id);
        // $this->db->limit(5);
        $query=$this->db->get();
        $result=$query->result();
        return $result;
    }

    function locked_accounts($id)
    {
        $this->db->select('a.*, u.full_name as full_name, c.id as category_id');
        $this->db->from('tbl_new_accounts a');
        $this->db->join('tbl_users u', 'a.id_input_user = u.user_id');
        $this->db->join('tbl_category c', 'a.category = c.id');
        $this->db->where('a.sub_category', $id);
        $this->db->where('a.flag_locked', 1);
        // $this->db->limit(5);
        $query=$this->db->get();
        $result=$query->result();
        return $result;
    }

    function lock_account($id, $user) {        
        $this->db->set('flag_locked', 1);
        $this->db->set('date_locked', 'NOW()', FALSE);
        $this->db->set('id_locked_user', $user);
        $this->db->where('Id', $id);
        $this->db->update('tbl_new_accounts');
        return ($this->db->affected_rows() > 0);
    }

    function unlock_account($id)
    {
        $this->db->set('flag_locked', 0);
        $this->db->where('Id', $id);
        $this->db->update('tbl_new_accounts');
        return ($this->db->affected_rows() > 0);
    }

    function single_account($id)
    {
        $this->db->select('a.*, u.full_name as full_name, c.id as category_id');
        $this->db->from('tbl_new_accounts a');
        $this->db->join('tbl_users u', 'a.id_input_user = u.user_id');
        $this->db->join('tbl_category c', 'a.category = c.id');
        $this->db->where('a.sub_category', $id);
        $this->db->where('a.flag_checked', 1);
        $this->db->where('a.flag_locked', 0);
        $this->db->where('a.flag_used', 0);
        $this->db->where('a.flag_rejected', 0);
        $this->db->order_by('a.date_check', 'ASC');
        $this->db->limit(1);
        $query=$this->db->get();
        $result=$query->result();
        return $result;
    }

    function used_account($id, $user)
    {
        $this->db->set('flag_locked', 0);
        $this->db->set('flag_used', 1);
        $this->db->set('date_used', 'NOW()', FALSE);
        $this->db->set('id_used_user', $user);
        $this->db->where('Id', $id);
        $this->db->update('tbl_new_accounts');
        return ($this->db->affected_rows() > 0);
    }

    function rejected_account($id, $user)
    {
        $this->db->set('flag_locked', 0);
        $this->db->set('flag_rejected', 1);
        $this->db->set('date_reject', 'NOW()', FALSE);
        $this->db->set('id_reject_user', $user);
        $this->db->where('Id', $id);
        $this->db->update('tbl_new_accounts');
        return ($this->db->affected_rows() > 0);
    }
}

?>