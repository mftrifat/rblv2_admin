<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BasicController extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model("ModelCommon");
    }

    function ajaxRequestGetSubCategory($id)
    {
        $data = $this->ModelCommon->get_sub_category($id);
        echo json_encode($data);
    }

    function ajaxRequestGetTemplateInfo($id)
    {
        $data = $this->ModelCommon->get_template_info($id);
        echo json_encode($data);
    }

    function ajaxRequestGetFieldInfo($id)
    {
        $data = $this->ModelCommon->get_field_info($id);
        echo json_encode($data);
    }
    
    function ajaxRequestGetAccountAll($id)
    {
        $data = $this->ModelAccounts->get_account_all($id);
        echo json_encode($data);
    }
}