<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model("ModelCommon");
        $this->load->model("ModelAccounts");
        $this->load->model("ModelDownload");
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
                $data['category_list'] = $this->ModelCommon->get_category();
                if($this->input->post()){
                    $data['all_accounts'] = $this->ModelAccounts->all_accounts($_POST['sub_category_id']);
                    $data['field_info'] = $this->ModelCommon->get_field_info($_POST['sub_category_id']);
                    $data['selected_category_id'] = $_POST['category_id'];
                    $data['selected_sub_category_id'] = $_POST['sub_category_id'];
                }
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
                $data['category_list'] = $this->ModelCommon->get_category();
                $data['locked_accounts'] = $this->ModelAccounts->locked_accounts("tbl_new_accounts");
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
                $data['category_list'] = $this->ModelCommon->get_category();
                if($this->input->post()){
                    $data['single_account'] = $this->ModelAccounts->single_account($_POST['sub_category_id']);
                    $data['field_info'] = $this->ModelCommon->get_field_info($_POST['sub_category_id']);
                    $data['selected_category_id'] = $_POST['category_id'];
                    $data['selected_sub_category_id'] = $_POST['sub_category_id'];
                }
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
        $this->template->load('default_layout', 'contents' , 'account/account_single_view', $data);
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
        $this->template->load('default_layout', 'contents' , 'account/account_single_view', $data);
    }

    function download_account() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Download Accounts');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'dl_ul/download_all_view_script');
            $this->template->set('page_style', 'dl_ul/download_all_view_style');

            if ($this->session->userdata('user_access_level') == 100) {
                if($this->input->post('submit') === 'download'){
                    $category_id     = $this->input->post('category_id');
                    $sub_category_id = $this->input->post('sub_category_id');
                    $download_size   = $this->input->post('download_size');

                    $data['download_accounts'] = $this->ModelDownload->get_data_to_download($category_id, $sub_category_id, $download_size);
                    $data['field_info'] = $this->ModelCommon->get_field_info($sub_category_id);
                    $data['selected_category_id'] = $category_id;
                    $data['selected_sub_category_id'] = $sub_category_id;
                    $data['selected_size'] = $download_size;
                }
                $data['category_list'] = $this->ModelCommon->get_category();
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'dl_ul/download_all_view', $data);
    }

    function upload_account() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Upload Accounts');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'dl_ul/upload_all_view_script');
            $this->template->set('page_style', 'dl_ul/upload_all_view_style');

            if ($this->session->userdata('user_access_level') == 100) {
                if($this->input->post('submit') === 'upload'){
                    $data['upload_accounts'] = $this->import();

                    $category_id     = $this->input->post('category_id');
                    $sub_category_id = $this->input->post('sub_category_id');
                    $download_size   = $this->input->post('download_size');
                    $data['field_info'] = $this->ModelCommon->get_field_info($sub_category_id);
                    $data['selected_category_id'] = $category_id;
                    $data['selected_sub_category_id'] = $sub_category_id;
                    $data['selected_size'] = $download_size;
                }
                $data['category_list'] = $this->ModelCommon->get_category();
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        // $this->load->view('dl_ul/upload_all_view', $data);
        $this->template->load('default_layout', 'contents' , 'dl_ul/upload_all_view', $data);
    }

    function export(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $writer = new Xlsx($spreadsheet);
        $filename = 'name-of-the-generated-file';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output'); // download file
    }

    function import(){
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if(isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['upload_file']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
            return $sheetData = $spreadsheet->getActiveSheet()->toArray();
        }
    }
}