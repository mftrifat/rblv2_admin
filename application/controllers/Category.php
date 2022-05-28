<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model("ModelCommon");
        $this->load->model("ModelCategory");
    }

	function add_category() {
		header("Access-Control-Allow-Origin: *");
		$data = array();
		if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Add Category');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'category/category_add_view_script');
            $this->template->set('page_style', 'category/category_add_view_style');

             if ($this->session->userdata('user_access_level') == 100) {
                if($this->input->post()) {
                    $this->load->library('form_validation');

                    $this->form_validation->set_rules('category_name','Category Name','trim|required');
                 
                    if($this->form_validation->run()==TRUE)
                    {
                        $data['category_name'] = $this->input->post('category_name');
                        $data['id_user_create'] = $this->session->userdata('user_id');
                        $data['status'] = 1;
                        $data['category_level'] = 0;

                        if ($this->ModelCategory->add_new_category($data)) {
                            $sdata = array();
                            $sdata['msg'] = 'You have Successfully Created New Category.';
                            $sdata['cls'] = 'Congratulations!!!';
                            $this->session->set_userdata($sdata);
                        } else {
                            $sdata = array();
                            $sdata['msg'] = 'Something Went Wrong.';
                            $sdata['cls'] = 'Error!!!';
                            $this->session->set_userdata($sdata);
                        }
                    }
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'category/category_add_view', $data);
	}

    function add_sub_category() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Add Sub-Category');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'category/sub_category_add_view_script');
            $this->template->set('page_style', 'category/sub_category_add_view_style');

             if ($this->session->userdata('user_access_level') == 100) {
                if($this->input->post()) {
                    $data['category_name'] = $this->input->post('sub_category_name');
                    $data['main_category_id'] = $this->input->post('main_category_id');
                    if($this->input->post('template_link_csv')){
                        $data['template_link_csv'] = $this->input->post('template_link_csv');
                    }
                    if($this->input->post('template_link_txt')){
                        $data['template_link_txt'] = $this->input->post('template_link_txt');
                    }
                    $data['id_user_create'] = $this->session->userdata('user_id');
                    $data['status'] = 1;
                    $data['category_level'] = 1;
                    $data['default_rate'] = $this->input->post('default_rate');
                    $data['load_email'] = $this->input->post('load_email');

                    $inserted_id = $this->ModelCategory->add_new_sub_category($data);

                    if($inserted_id){
                        for ($i=1; $i <= $this->input->post('field_count'); $i++) {
                            $seq = "_".$i;
                            $field_name = "field_name_".$i;
                            $field_id = "field_name_".$i;
                            $field_length = "field_length_".$i;
                            $field_type = "field_type_".$i;
                            $field_required = "field_required_".$i;
                            $field_hidden = "field_hidden_".$i;
                            $field_source = "field_source_".$i;

                            $field_array[] = array( 
                                    'category_id'       =>  $inserted_id,
                                    'seq'               =>  $i,
                                    'field_name'        =>  $this->input->post($field_name),
                                    'field_id'          =>  substr($this->input->post($field_id),0,1).substr($this->input->post($field_id),-1),
                                    'field_length'      =>  $this->input->post($field_length),
                                    'field_type'        =>  $this->input->post($field_type),
                                    'field_required'    =>  $this->input->post($field_required),
                                    'field_hidden'      =>  $this->input->post($field_hidden),
                                    'field_source'      =>  $this->input->post($field_source),
                                    'id_user_create'    =>  $this->session->userdata('user_id'),
                                    'date_create'       =>  date('Y-m-d H:i:s',strtotime('now')),
                                    'status'            =>  '1'
                            );
                        }
                        if ($this->ModelCategory->add_sub_category_fields($field_array)) {
                            $sdata = array();
                            $sdata['msg'] = 'You have Successfully Created New Sub-Category.';
                            $sdata['cls'] = 'Congratulations!!!';
                            $this->session->set_userdata($sdata);
                        } else {
                            $sdata = array();
                            $sdata['msg'] = 'Something Went Wrong.';
                            $sdata['cls'] = 'Error!!!';
                            $this->session->set_userdata($sdata);
                        }
                    }
                }
                $data['category_list'] = $this->ModelCommon->get_category();
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'category/sub_category_add_view', $data);
    }

    function manage_category() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Manage Category');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'category/category_manage_view_script');
            $this->template->set('page_style', 'category/category_manage_view_style');

             if ($this->session->userdata('user_access_level') == 100) {
                $data['category_list'] = $this->ModelCommon->get_category();
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'category/category_manage_view', $data);
    }

    function edit_category() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Edit Category');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'category/category_edit_view_script');
            $this->template->set('page_style', 'category/category_edit_view_style');

            if ($this->session->userdata('user_access_level') == 100) {
                if($this->input->post()) {
                    $this->load->library('form_validation');

                    $this->form_validation->set_rules('category_id','Category Id','trim|required');
                    $this->form_validation->set_rules('category_name','Category Name','trim|required');
                    $this->form_validation->set_rules('status','Status','trim|required');
                 
                    if($this->form_validation->run()==FALSE)
                    {
                        header("Access-Control-Allow-Origin: *");
                        $data = array();
                    } else {
                        $data = array();

                        $data['category_name'] = $this->input->post('category_name');
                        $data['status'] = $this->input->post('status');
                        $data['id_user_update'] = $this->session->userdata('user_id');

                        $edit_id = $this->input->post('category_id');

                        if ($this->ModelCategory->edit_category_action($edit_id, $data)) {
                            $sdata = array();
                            $sdata['msg'] = 'You have Successfully Edited Category.';
                            $sdata['cls'] = 'Congratulations!!!';
                            $this->session->set_userdata($sdata);
                        } else {
                            $sdata = array();
                            $sdata['msg'] = 'Something Went Wrong.';
                            $sdata['cls'] = 'Error!!!';
                            $this->session->set_userdata($sdata);
                        }
                        redirect('manage_category');
                    }
                }
                $category_id = $this->input->get('id');
                $data['category_info'] = $this->ModelCommon->get_conditional_data('tbl_category', 'id', $category_id);                
                $data['user_id'] = $this->session->userdata('user_id');
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'category/category_edit_view', $data);
    }

    function manage_sub_category() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Manage Sub-Category');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'category/sub_category_manage_view_script');
            $this->template->set('page_style', 'category/sub_category_manage_view_style');

             if ($this->session->userdata('user_access_level') == 100) {
                if($this->input->post()) {
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('main_category_id','Category','trim|required');                 
                    if($this->form_validation->run()==TRUE)
                    {
                        $data['sub_category_list'] = $this->ModelCommon->get_sub_category($this->input->post('main_category_id'));
                    }
                }
                $data['category_list'] = $this->ModelCommon->get_category();
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'category/sub_category_manage_view', $data);
    }

    function edit_sub_category() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Edit Sub-Category');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'category/sub_category_edit_view_script');
            $this->template->set('page_style', 'category/sub_category_edit_view_style');

            if ($this->session->userdata('user_access_level') == 100) {
                if($this->input->post()) {
                    $data = array();

                    $sdata = array();
                    $sdata['cls'] = 'Congratulations!!!';

                    $data['category_name'] = $this->input->post('category_name');
                    $data['status'] = $this->input->post('status');
                    $data['id_user_update'] = $this->session->userdata('user_id');
                    if($this->input->post('template_link_csv')){
                        $data['template_link_csv'] = $this->input->post('template_link_csv');
                    }
                    if($this->input->post('template_link_txt')){
                        $data['template_link_txt'] = $this->input->post('template_link_txt');
                    }                    
                    $data['default_rate'] = $this->input->post('default_rate');
                    $data['load_email'] = $this->input->post('load_email');
                    
                    $edit_id = $this->input->post('category_id');
                    $this->ModelCategory->edit_category_action($edit_id, $data);

                    if($edit_id){
                        for ($i=1; $i <= $this->input->post('field_count'); $i++) {
                            $field_array = array();
                            $field_id       = "field_id_".$i;
                            $field_name     = "field_name_".$i;
                            $field_length   = "field_length_".$i;
                            $field_type     = "field_type_".$i;
                            $field_required = "field_required_".$i;
                            $field_hidden   = "field_hidden_".$i;
                            $field_source   = "field_source_".$i;

                            $field_array = array(
                                    'field_name'        =>  $this->input->post($field_name),
                                    'field_length'      =>  $this->input->post($field_length),
                                    'field_type'        =>  $this->input->post($field_type),
                                    'field_required'    =>  $this->input->post($field_required),
                                    'field_hidden'      =>  $this->input->post($field_hidden),
                                    'field_source'      =>  $this->input->post($field_source),
                                    'id_user_update'    =>  $this->session->userdata('user_id'),
                                    'date_update'       =>  date('Y-m-d H:i:s',strtotime('now')),
                                    'status'            =>  '1'
                            );
                            $edit_field_id = $this->input->post($field_id);
                            if($this->ModelCategory->edit_sub_category_fields($edit_field_id, $field_array)){
                                $sdata['msg'] = 'You have Successfully Created New Sub-Category.';
                            } else {
                                $sdata['msg'] = 'Something Went Wrong.';
                                $sdata['cls'] = 'Error!!!';
                                $this->session->set_userdata($sdata);
                                redirect('manage_sub_category');
                            }
                        }
                    }
                    $sdata['msg'] = 'You have Successfully Created New Sub-Category.';
                    $this->session->set_userdata($sdata);
                    redirect('manage_sub_category');
                }

                $category_id = $this->input->get('id');
                $data['category_info'] = $this->ModelCommon->get_conditional_data('tbl_category', 'id', $category_id);
                $data['field_info'] = $this->ModelCommon->get_field_info($category_id);
                $data['user_id'] = $this->session->userdata('user_id');
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'category/sub_category_edit_view', $data);
    }
}