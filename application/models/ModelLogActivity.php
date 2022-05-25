<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class ModelLogActivity extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function add_log($param)
    {
        $this->db->insert('tbl_log_activity', $param);
        $id = $this->db->insert_id();
        $db_error = $this->db->error();
        if(!empty($db_error['code'])) {
            echo "Database Error: Error Code-". $db_error['code'] . ", Message-". $db_error['message'];
        }
        return $id;
    }
}

?>