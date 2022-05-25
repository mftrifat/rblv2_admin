<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model("ModelCommon");
        $this->load->model("ModelUser");
        $this->load->model("UserCheck");
    }

	function add_user() {
		header("Access-Control-Allow-Origin: *");
		$data = array();
		if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Add New User');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'user/user_add_view_script');
            $this->template->set('page_style', 'user/user_add_view_style');

             if ($this->session->userdata('user_access_level') == 100) {
                if($this->input->post()) {
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('new_user_name','User Name','trim|required|callback_valid_username');
                    $this->form_validation->set_rules('user_type_id','User Type','trim|required');
                 
                    if($this->form_validation->run()==TRUE)
                    {
                        $data['user_name'] = $this->input->post('new_user_name');
                        $data['full_name'] = $this->input->post('new_full_name');
                        $data['authorized_by'] = $this->session->userdata('user_id');
                        $data['account_status'] = 1;
                        $data['password'] = hash('sha512', 'RBLpass@123');
                        $data['user_type_id'] = substr($this->input->post('user_type_id'), 0, strpos($this->input->post('user_type_id'), "_"));
                        $data['user_id'] = $this->ModelUser->get_user_id($data['user_type_id'])+1;
                        if($data['user_id'] == 1) {
                            $data['user_id'] = $data['user_type_id']*100000+1;
                        }

                        if ($this->ModelUser->add_new_user($data)) {
                            $access_data['user_name'] = $data['user_name'];
                            $access_data['user_id'] = $data['user_id'];
                            $access_data['access_level'] = $this->ModelUser->get_user_access_level($data['user_type_id']);

                            if($this->ModelUser->add_user_access($access_data)){
                                $sdata = array();
                                $sdata['msg'] = 'You have Successfully Created New User. Please use default password(RBLpass@123) to login.';
                                $sdata['cls'] = 'Congratulations!!!';
                                $this->session->set_userdata($sdata);
                            } else {
                                $sdata = array();
                                $sdata['msg'] = 'Something Went Wrong Creating Access.';
                                $sdata['cls'] = 'Error!!!';
                                $this->session->set_userdata($sdata);
                            }
                        } else {
                            $sdata = array();
                            $sdata['msg'] = 'Something Went Wrong.';
                            $sdata['cls'] = 'Error!!!';
                            $this->session->set_userdata($sdata);
                        }
                    }
                }
                $data['user_type'] = $this->ModelUser->get_user_type();
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'user/user_add_view', $data);
	}

    function manage_user() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Manage User');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'user/user_manage_view_script');
            $this->template->set('page_style', 'user/user_manage_view_style');

             if ($this->session->userdata('user_access_level') == 100) {
                $data['user_list'] = $this->ModelUser->get_user_list(substr($this->session->userdata('user_id'),0,1));
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'user/user_manage_view', $data);
    }

    function edit_user_() {
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

    function valid_username($user_name = '')
    {
        $ret = TRUE;
        $user_name = trim($user_name);
        $min_char = 5;
        $max_char = 64;        
        $regex_letter = '/[A-Za-z]/';
        $result=$this->UserCheck->reset_user_check($user_name);

        if (empty($user_name))
        {
            $this->form_validation->set_message('valid_username', 'The {field} field is required.');
            $ret = FALSE;
        }
        if($result)
        {
            if($result[0]->user_name == $user_name)
            {
                $this->form_validation->set_message('valid_username', 'Username already Exist!');
                $ret = FALSE;
            }
        }
        if (strlen($user_name) < $min_char)
        {
            $this->form_validation->set_message('valid_username', 'The {field} field must be at least '.$min_char.' characters in length.');
            $ret = FALSE;
        }
        if (strlen($user_name) > $max_char)
        {
            $this->form_validation->set_message('valid_username', 'The {field} field cannot exceed '.$max_char.' characters in length.');
            $ret = FALSE;
        }
        if (strrpos($user_name, ' ') !== false)
        {
            $this->form_validation->set_message('valid_username', 'The {field} field cannot have any space in it.');
            $ret = FALSE;
        }
        if (preg_match_all($regex_letter, $user_name) < 1)
        {
            $this->form_validation->set_message('valid_username', 'The {field} field must be at least one letter.');
            $ret = FALSE;
        }
        return $ret;
    }
}