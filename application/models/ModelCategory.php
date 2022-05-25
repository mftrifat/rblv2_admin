<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class ModelCategory extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function add_new_category($data)
    {
        $this->db->set('date_create', 'NOW()', FALSE);
        $this->db->insert('tbl_category', $data);
        return ($this->db->insert_id()) ? true : false;
    }

    function add_new_sub_category($data)
    {
        $this->db->set('date_create', 'NOW()', FALSE);
        $this->db->insert('tbl_category', $data);
        return $this->db->insert_id();
    }

    function add_sub_category_fields($data)
    {
        $this->db->insert_batch('tbl_field_list', $data);
        return $this->db->affected_rows();
    }

    function edit_category_action($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_category', $data);

        return ($this->db->affected_rows() > 0);
    }

    function edit_sub_category_fields($id, $data)
    {
        $this->db->where('Id', $id);
        $this->db->update('tbl_field_list', $data);

        return ($this->db->affected_rows() > 0);
    }
}
?>