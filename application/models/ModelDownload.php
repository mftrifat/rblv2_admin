<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ModelDownload extends CI_Model {

    function __construct() {
        parent::__construct();
        $CI = & get_instance();
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
    function mark_download($id, $user)
    {
        $this->db->set('flag_download', 1);
        $this->db->set('date_download', 'NOW()', FALSE);
        $this->db->set('id_download_user', $user);
        $this->db->where('Id', $id);
        $this->db->update('tbl_new_accounts');
        return ($this->db->affected_rows() > 0);
    }
}
?>