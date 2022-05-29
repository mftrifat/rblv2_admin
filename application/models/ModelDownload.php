<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ModelDownload extends CI_Model {

    function __construct() {
        parent::__construct();
        $CI = & get_instance();
    }

    function get_list()
    {
        $this->db->select('*');
        $this->db->from('tbl_download');
        $this->db->order_by('id', 'ASC');
        $query=$this->db->get();
        return $query->result();
    }

    function get_list_upload()
    {
        $this->db->select('*');
        $this->db->from('tbl_download');
        $this->db->where('batch_status', 1);
        $this->db->order_by('id', 'ASC');
        $query=$this->db->get();
        return $query->result();
    }

    function insert_email($data)
    {
        $this->db->insert_batch('tbl_email_accounts', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    function get_data_to_download($category, $subcategory, $size)
    {
        $this->db->select('a.*, u.full_name as full_name, c.id as category_id');
        $this->db->from('tbl_new_accounts a');
        $this->db->join('tbl_users u', 'a.id_input_user = u.user_id');
        $this->db->join('tbl_category c', 'a.category = c.id');
        $this->db->where('a.category', $category);
        $this->db->where('a.sub_category', $subcategory);
        $this->db->where('a.flag_checked', 0);
        $this->db->where('a.flag_locked', 0);
        $this->db->where('a.flag_used', 0);
        $this->db->where('a.flag_rejected', 0);
        $this->db->where('a.flag_download', 0);
        if($size > 1){
            $this->db->limit($size);
        }
        $this->db->order_by('Id', 'ASC');

        $query=$this->db->get();
        $result=$query->result();
        return $result;
    }

    function create_download_batch($data)
    {
        $this->db->insert('tbl_download', $data);
        return ($this->db->insert_id()) ? true : false;
    }

    function mark_download($id, $user, $batch_name, $batch_sl)
    {
        $this->db->set('flag_download', 1);
        $this->db->set('date_download', 'NOW()', FALSE);
        $this->db->set('id_download_user', $user);
        $this->db->set('download_batch_name', $batch_name);
        $this->db->set('download_batch_sl', $batch_sl);
        $this->db->where('Id', $id);
        $this->db->update('tbl_new_accounts');
        return ($this->db->affected_rows() > 0);
    }

    function download_mark_complete($id, $user)
    {
        $this->mark_individual_dl_complete($id, $user);
        $this->db->set('date_upload', 'NOW()', FALSE);
        $this->db->set('id_user_upload', $user);
        $this->db->set('batch_status', 2);
        $this->db->where('batch_name', $id);
        $this->db->update('tbl_download');
        return ($this->db->affected_rows() > 0);
    }

    function mark_individual_dl_complete($id, $user)
    {
        $this->db->set('id_check_user', $user);
        $this->db->set('flag_checked', 1);
        $this->db->set('date_check', 'NOW()', FALSE);
        $this->db->where('download_batch_name', $id);
        $this->db->where('flag_rejected', 0);
        $this->db->update('tbl_new_accounts');
        return ($this->db->affected_rows() > 0);
    }

    function mark_reject($batch_name, $batch_sl, $user)
    {
        $this->db->set('flag_upload', 1);
        $this->db->set('date_upload', 'NOW()', FALSE);
        $this->db->set('id_upload_user', $user);
        $this->db->set('flag_rejected', 1);
        $this->db->set('date_reject', 'NOW()', FALSE);
        $this->db->set('id_reject_user', $user);
        $this->db->where('download_batch_name', $batch_name);
        $this->db->where('download_batch_sl', $batch_sl);
        $this->db->update('tbl_new_accounts');
        return ($this->db->affected_rows() > 0);
    }

    function locked_emails()
    {
        $this->db->select('*');
        $this->db->from('tbl_email_accounts');
        $this->db->where('flag_locked', 1);
        $this->db->where('flag_used', 0);
        $query=$this->db->get();
        $result=$query->result();
        return $result;
    }

    function unlock_email($id)
    {
        $this->db->set('id_locked_user', null);
        $this->db->set('date_locked', null);
        $this->db->set('flag_locked', 0);
        $this->db->where('id', $id);
        $this->db->update('tbl_email_accounts');
        return ($this->db->affected_rows() > 0);
    }
}
?>