<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ModelCommon extends CI_Model {

    function __construct() {
        parent::__construct();
        $CI = & get_instance();
    }

    function get_category()
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where("category_level", 0);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_sub_category($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where("main_category_id", $id);
        $this->db->where("category_level", 1);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_template_info($id)
    {
        $this->db->select('template_link_csv, template_link_txt');
        $this->db->from('tbl_category');
        $this->db->where("id", $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_field_info($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_field_list');
        $this->db->where("category_id", $id);
        $this->db->where("status", 1);
        $this->db->order_by("seq", "ASC");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function single_result($table, $field, $search_on, $search_value) {
        $query = $this->db->query("select $field as total from $table where $search_on='$search_value' LIMIT 1");
        $row = $query->row();
        if ($query->num_rows() > 0) {
            return $row->total;
        }
    }

    function get_single_field_info($id,$field)
    {
        $this->db->select('*');
        $this->db->from('tbl_field_list');
        $this->db->where("category_id", $id);
        $this->db->where("field_id", $field);
        $this->db->where("status", 1);
        $this->db->limit(1);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function update_data_single_cond($table, $con_field, $con_value, $up_field, $up_value) {
        $data=array(
            $up_field=>$up_value
        );
        $where_cond=array(
            $con_field=>$con_value
        );

        $this->db->where($where_cond);
        $this->db->update($table, $data);
        return ($this->db->affected_rows() > 0);
    }

    function get_conditional_data($table, $con_field, $con_value) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($con_field, $con_value);
        $query = $this->db->get();
        return $query->result();
    }

    function get_field_by_cond($table, $field, $cond) {
        $query = $this->db->query("select $field from $table where $cond LIMIT 1");
        $row = $query->row();
        if ($query->num_rows() > 0) {
            return $row->$field;
        }
    }

    function get_max_by_cond($table, $field, $cond) {
        $query = $this->db->query("select MAX($field) as max_val from $table where $cond ");
        $row = $query->row();
        if ($query->num_rows() > 0) {
            return $row->max_val;
        }
    }

    function get_list_by_cond($table, $field, $cond) {
        $query = $this->db->query("select $field from $table where $cond ");
        $result = $query->result();
        if ($query->num_rows() > 0) {
            return $result;
        }
    }

    function get_row_by_cond($table, $field, $cond) {
        $query = $this->db->query("select $field from $table where $cond LIMIT 1");
        $row = $query->row();
        if ($query->num_rows() > 0) {
            return $row;
        }
    }

    function get_count_user_submitted($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_new_accounts');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_count_user_cond($id,$cond)
    {
        $cond = "flag_".$cond;
        $this->db->select('*');
        $this->db->from('tbl_new_accounts');
        $this->db->where($cond, 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_count_by_cond($table, $field, $cond) 
    {
        $query = $this->db->query("select $field from $table where $cond ");
        $result = $query->result();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
    }

    function get_row_by_sql($sql) 
    {
        $query = $this->db->query($sql . " LIMIT 1");
        $row = $query->row();
        if ($query->num_rows() > 0) {
            return $row;
        }
    }

    function get_list_by_sql($sql) 
    {
        $query = $this->db->query($sql);
        $list = $query->result();
        if ($query->num_rows() > 0) {
            return $list;
        }
    }

    function get_admin_list()
    {
        $query = $this->db->query("select master_account.userpin,master_account.full_name from master_account,user_access where master_account.userpin =user_access.userpin and user_access.access_level = 6 and master_account.active = 1 order by master_account.full_name desc");
        $result = $query->result();
        return $result;
    }

    function get_list($table, $select) 
    {
        $this->db->select($select);
        $this->db->from($table);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function insert_table_row($table, $data) 
    {
        $this->db->insert($table, $data);
    }

    function get_list_order_by($table, $select, $order_f, $order) 
    {
        $this->db->select($select);
        $this->db->order_by($order_f, $order);
        $this->db->from($table);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_list_by_wh_order_by($table, $select, $search_field1, $value1, $order_f, $order) 
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($search_field1, $value1);
        $this->db->order_by($order_f, $order);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_list_by_wh_wh_order_by($table, $select, $search_field1, $value1, $search_field2, $value2, $order_f, $order) 
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($search_field1, $value1);
        $this->db->where($search_field2, $value2);
        $this->db->order_by($order_f, $order);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_list_by_wh_wh_wh_order_by($table, $select, $search_field1, $value1, $search_field2, $value2, $search_field3, $value3, $order_f, $order)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($search_field1, $value1);
        $this->db->where($search_field2, $value2);
        $this->db->where($search_field3, $value3);
        $this->db->order_by($order_f, $order);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_list_by_wh_wh_wh_wh_order_by($table, $select, $search_field1, $value1, $search_field2, $value2, $search_field3, $value3, $search_field4, $value4, $order_f, $order) 
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($search_field1, $value1);
        $this->db->where($search_field2, $value2);
        $this->db->where($search_field3, $value3);
        $this->db->where($search_field4, $value4);
        $this->db->order_by($order_f, $order);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_list_by_wh($table, $select, $search_field1, $value1) 
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($search_field1, $value1);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_row_by_wh($table, $select, $search_field1, $value1) {

        //echo $search_field1; 
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($search_field1, $value1);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    function get_list_by_wh_wh($table, $select, $search_field1, $value1, $search_field2, $value2) {

        //echo $search_field1; 
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($search_field1, $value1);
        $this->db->where($search_field2, $value2);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_list_by_wh_wh_wh($table, $select, $search_field1, $value1, $search_field2, $value2, $search_field3, $value3) {

        //echo $search_field1; 
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($search_field1, $value1);
        $this->db->where($search_field2, $value2);
        $this->db->where($search_field3, $value3);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function get_row_by_wh_wh($table, $select, $search_field1, $value1, $search_field2, $value2) {

        //echo $search_field1; 
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($search_field1, $value1);
        $this->db->where($search_field2, $value2);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    function get_count($table, $select) {

        //echo $search_field1; 
        $this->db->select($select);
        $this->db->from($table);
        $query_result = $this->db->get();
        $count = $query_result->num_rows();
        return $count;
    }

    function get_count_by_wh($table, $select, $search_field1, $value1) {
        //echo $search_field1; 
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($search_field1, $value1);
        $query_result = $this->db->get();
        $count = $query_result->num_rows();
        return $count;
    }

    function get_count_by_wh_wh($table, $select, $search_field1, $value1, $search_field2, $value2) {
        //echo $search_field1; 
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($search_field1, $value1);
        $this->db->where($search_field2, $value2);
        $query_result = $this->db->get();
        $count = $query_result->num_rows();
        return $count;
    }

    function get_count_by_wh_wh_wh($table, $select, $search_field1, $value1, $search_field2, $value2, $search_field3, $value3) {
        //echo $search_field1; 
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($search_field1, $value1);
        $this->db->where($search_field2, $value2);
        $this->db->where($search_field3, $value3);
        $query_result = $this->db->get();
        $count = $query_result->num_rows();
        return $count;
    }

    function update_file_path($table, $problem_token_no, $data) {
        $this->db->where('problem_token_no', $problem_token_no);
        $this->db->update($table, $data);
    }

    function update_by_wh($table, $search_field1, $value1, $data) {
        $this->db->where($search_field1, $value1);
        $this->db->update($table, $data);
    }


    function update_notification_status($token_number, $msg_from) {
        //exit();
        //echo 204;
        $data = array(
            'read_status' => 1
        );
        $this->db->where('token_number', $token_number);
        $this->db->where('msg_from', $msg_from);
        $this->db->update('tbl_problem_msg_doc_log', $data);
    }

    function get_notification_list($token_no, $msg_from) {
        
    }

    function notification_count_model($userpin, $msg_from) {
        $count = 0;
        $user_token_list = $this->model_common_52->get_list_by_wh('tbl_support_details', 'problem_token_no', 'problem_created_by', $userpin);
        foreach ($user_token_list as $v_row) {
            $count = $count + $this->get_count_by_wh_wh_wh('tbl_problem_msg_doc_log', 'id', 'token_number', $v_row->problem_token_no, 'msg_from', 1, 'read_status', 0);
        }
        return $count;
    }

    function notification_count_model_ad($userpin, $msg_from) {
        $count = 0;
        $user_token_list = $this->model_common_52->get_list_by_wh('tbl_support_details', 'problem_token_no', 'problem_solver_pin', $userpin);
        foreach ($user_token_list as $v_row) {
            $count = $count + $this->get_count_by_wh_wh_wh('tbl_problem_msg_doc_log', 'id', 'token_number', $v_row->problem_token_no, 'msg_from', $msg_from, 'read_status', 0);
        }
        return $count;
    }

    function con_time($init) {

        $hours = floor($init / 3600);
        $minutes = floor(($init / 60) % 60);
        $seconds = $init % 60;

        if ($hours == 0) {
            if ($minutes == 0) {
                return $seconds . 's ago';
            } else {
                return $minutes . 'm_' . $seconds . 's ago';
            }
        } else {
            return $hours . 'h_' . $minutes . 'm_' . $seconds . 's ago';
        }
    }
}
?>