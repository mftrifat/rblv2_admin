<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model("ModelCommon");
        $this->load->model("ModelAccounts");
    }

    function all_account() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'All Accounts');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'account/account_all_view_script');
            $this->template->set('page_style', 'account/account_all_view_style');

            if ($this->session->userdata('user_access_level') == 100) {
                if($this->input->post()){
                    $data['all_accounts'] = $this->ModelAccounts->all_accounts($_POST['sub_category_id']);
                    $data['field_info'] = $this->ModelCommon->get_field_info($_POST['sub_category_id']);
                    $data['selected_category_id'] = $_POST['category_id'];
                    $data['selected_sub_category_id'] = $_POST['sub_category_id'];
                }
                $data['category_list'] = $this->ModelCommon->get_category();
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'account/account_all_view', $data);
    }

    function locked_account() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Locked Accounts');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'account/account_locked_view_script');
            $this->template->set('page_style', 'account/account_locked_view_style');

            if ($this->session->userdata('user_access_level') == 100) {
                if($this->input->post()){
                    $data['locked_accounts'] = $this->ModelAccounts->locked_accounts($_POST['sub_category_id']);
                    $data['field_info'] = $this->ModelCommon->get_field_info($_POST['sub_category_id']);
                    $data['selected_category_id'] = $_POST['category_id'];
                    $data['selected_sub_category_id'] = $_POST['sub_category_id'];
                }
                $data['category_list'] = $this->ModelCommon->get_category();
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'account/account_locked_view', $data);
    }

    function unlock_account() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Locked Accounts');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'account/account_locked_view_script');
            $this->template->set('page_style', 'account/account_locked_view_style');

            if ($this->session->userdata('user_access_level') == 100) {
                $unlock_id = $this->input->get('id');
                $result = $this->ModelAccounts->unlock_account($unlock_id);

                if ($result == true) {
                    $sdata = array();
                    $sdata['msg'] = 'You have Successfully Unlocked Account.';
                    $sdata['cls'] = 'Congratulations!!!';
                    $this->session->set_userdata($sdata);
                } else {
                    $sdata = array();
                    $sdata['msg'] = 'Something Went Wrong.';
                    $sdata['cls'] = 'Error!!!';
                    $this->session->set_userdata($sdata);
                }

                if($this->input->post()){
                    $data['locked_accounts'] = $this->ModelAccounts->locked_accounts($_POST['sub_category_id']);
                    $data['field_info'] = $this->ModelCommon->get_field_info($_POST['sub_category_id']);
                    $data['selected_category_id'] = $_POST['category_id'];
                    $data['selected_sub_category_id'] = $_POST['sub_category_id'];
                }
                $data['category_list'] = $this->ModelCommon->get_category();
                $data['locked_accounts'] = $this->ModelAccounts->locked_accounts("tbl_new_accounts");
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'account/account_locked_view', $data);
    }

    function single_account() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Single Account');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'account/account_single_view_script');
            $this->template->set('page_style', 'account/account_single_view_style');

            if ($this->session->userdata('user_access_level') == 100) {
                if($this->input->post()){
                    $data['single_account'] = $this->ModelAccounts->single_account($_POST['sub_category_id']);
                    $data['field_info'] = $this->ModelCommon->get_field_info($_POST['sub_category_id']);
                    $data['selected_category_id'] = $_POST['category_id'];
                    $data['selected_sub_category_id'] = $_POST['sub_category_id'];
                }
                $data['category_list'] = $this->ModelCommon->get_category();
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'account/account_single_view', $data);
    }

    function used_account() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Single Accounts');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'account/account_single_view_script');
            $this->template->set('page_style', 'account/account_single_view_style');

            if ($this->session->userdata('user_access_level') == 100) {
                $used_id = $this->input->get('id');
                $user_id = $this->session->userdata('user_id');
                if ($this->ModelAccounts->used_account($used_id, $user_id)) {
                    $sdata = array();
                    $sdata['msg'] = 'You have Successfully Used the Account.';
                    $sdata['cls'] = 'Congratulations!!!';
                    $this->session->set_userdata($sdata);
                } else {
                    $sdata = array();
                    $sdata['msg'] = 'Something Went Wrong.';
                    $sdata['cls'] = 'Error!!!';
                    $this->session->set_userdata($sdata);
                }
                $data['category_list'] = $this->ModelCommon->get_category();
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        redirect('single_account');
    }

    function rejected_account() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Single Accounts');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'account/account_single_view_script');
            $this->template->set('page_style', 'account/account_single_view_style');

            if ($this->session->userdata('user_access_level') == 100) {
                $rejected_id = $this->input->get('id');
                $user_id = $this->session->userdata('user_id');
                if ($this->ModelAccounts->rejected_account($rejected_id, $user_id)) {
                    $sdata = array();
                    $sdata['msg'] = 'You have Successfully Rejected the Account.';
                    $sdata['cls'] = 'Congratulations!!!';
                    $this->session->set_userdata($sdata);
                } else {
                    $sdata = array();
                    $sdata['msg'] = 'Something Went Wrong.';
                    $sdata['cls'] = 'Error!!!';
                    $this->session->set_userdata($sdata);
                }
                $data['category_list'] = $this->ModelCommon->get_category();
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        redirect('single_account');
    }
}