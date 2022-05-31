<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DownUp extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model("ModelCommon");
        $this->load->model("ModelDownload");
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

    function manage_downloads() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Manage Downloads');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'dl_ul/download_manage_view_script');
            $this->template->set('page_style', 'dl_ul/download_manage_view_style');

            if ($this->session->userdata('user_access_level') == 100) {                
                $data['downloads_list'] = $this->ModelDownload->get_list();
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'dl_ul/download_manage_view', $data);
    }

    function create_download_batch() {
        if ($this->session->userdata('logged_in_admin_rbl')) {
            if ($this->session->userdata('user_access_level') == 100) {
                $data = array();
                $data['batch_name']         = $this->input->get('batch_name');
                $data['id_user_download']   = $this->session->userdata('user_id');
                $data['batch_category']     = $this->input->get('batch_category');
                $data['batch_sub_category']     = $this->input->get('batch_sub_category');
                $data['batch_size']         = $this->input->get('batch_size');
                $data['date_download']      = date('Y-m-d H:i:s');
                $data['batch_status']       = 1;

                if($this->ModelDownload->create_download_batch($data)){
                    echo json_encode($data['batch_name']);
                } else {
                    echo json_encode("Error creating batch");
                }
            } else {
                echo json_encode("Unauthorised Attempt");
            }
        } else {
            echo json_encode("Unauthorised Attempt");
        }
    }

    function mark_download() {
        if ($this->session->userdata('logged_in_admin_rbl')) {
            if ($this->session->userdata('user_access_level') == 100) {
                $id_user_download = $this->session->userdata('user_id');
                $mark_id = $this->input->get('mark_id');
                $download_batch_sl = $this->input->get('batch_sl');
                $download_batch_name = $this->input->get('download_batch_name');
                $data = $this->ModelDownload->mark_download($mark_id, $id_user_download, $download_batch_name, $download_batch_sl);
                echo json_encode($data);
            } else {
                echo json_encode("Unauthorised Attempt");
            }
        } else {
            echo json_encode("Unauthorised Attempt");
        }
    }

    function download_mark_complete() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            if ($this->session->userdata('user_access_level') == 100) {
                $batch_name = $this->input->get('id');
                $id_user_upload = $this->session->userdata('user_id');
                if ($this->ModelDownload->download_mark_complete($batch_name, $id_user_upload)) {
                    if($this->calculate_balance($batch_name)) {
                        $sdata = array();
                        $sdata['msg'] = 'Operation Complete.';
                        $sdata['cls'] = 'Congratulations!!!';
                        $this->session->set_userdata($sdata);
                    } else {
                        $sdata = array();
                        $sdata['msg'] = 'Something Went Wrong Updating Balance.';
                        $sdata['cls'] = 'Error!!!';
                        $this->session->set_userdata($sdata);
                    }
                } else {
                    $sdata = array();
                    $sdata['msg'] = 'Something Went Wrong.';
                    $sdata['cls'] = 'Error!!!';
                    $this->session->set_userdata($sdata);
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        redirect('manage_downloads');
    }

    function calculate_balance($batch_name)
    {
        $ret = false;
        $category_in_q = $this->ModelCommon->single_result('tbl_download','batch_sub_category','batch_name', $batch_name);
        $default_rate_in_q = $this->ModelCommon->single_result('tbl_category','default_rate','id', $category_in_q);
        $account_count_in_q = $this->ModelDownload->account_count_for_checked($batch_name);
        $rate_in_effect = $default_rate_in_q;

        foreach($account_count_in_q as $row)
        {
            $custom_rate = $this->ModelDownload->get_custom_rate($row->id_input_user, $category_in_q);
            if($custom_rate){
                $rate_in_effect = $custom_rate;
            } else {
                $rate_in_effect = $default_rate_in_q;
            }
            $balance_add = $rate_in_effect*$row->acc_count;

            $t_data = array();
            $t_data['user_id'] = $row->id_input_user;
            $t_data['transaction_type'] = 'Accepted Accounts';
            $t_data['batch_name'] = $batch_name;
            $t_data['batch_category'] = $category_in_q;
            $t_data['total_input'] = $this->ModelDownload->count_input_reject($row->id_input_user, $batch_name, 'flag_download');
            $t_data['total_checked'] = $row->acc_count;
            $t_data['total_rejected'] = $this->ModelDownload->count_input_reject($row->id_input_user, $batch_name, 'flag_rejected');
            $t_data['rate'] = $rate_in_effect;
            $t_data['total_amount'] = $balance_add;

            $t_data['balance_before'] = $this->ModelCommon->single_result('tbl_user_balance','user_balance','user_id', $row->id_input_user);

            $t_data['balance_new'] = $t_data['balance_before']+$t_data['total_amount'];
            $t_data['id_user_approve'] = $this->session->userdata('user_id');
            $t_data['remarks'] = 'Balance Added';

            if($this->ModelDownload->add_transaction_on_batch_complete($t_data)) {
                if($this->ModelDownload->update_balance_on_mark_complete($row->id_input_user, $balance_add)) {
                    $ret = true;
                } else {
                    $ret = false;
                }                
            }
        }
        return $ret;
    }

    function reset_reject() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            if ($this->session->userdata('user_access_level') == 100) {
                $batch_name = $this->input->get('id');
                if ($this->ModelDownload->reset_reject_account($batch_name)) {
                    $this->ModelDownload->reset_reject_count($batch_name);
                    $sdata = array();
                    $sdata['msg'] = 'Operation Complete.';
                    $sdata['cls'] = 'Congratulations!!!';
                    $this->session->set_userdata($sdata);
                } else {
                    $sdata = array();
                    $sdata['msg'] = 'Something Went Wrong.';
                    $sdata['cls'] = 'Error!!!';
                    $this->session->set_userdata($sdata);
                }
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        redirect('manage_downloads');
    }

    function upload_account() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Upload Rejected Accounts');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'dl_ul/upload_all_view_script');
            $this->template->set('page_style', 'dl_ul/upload_all_view_style');

            if ($this->session->userdata('user_access_level') == 100) {
                if($this->input->post('submit') === 'upload_reject'){
                    $file_name = pathinfo($_FILES['upload_file']['name'], PATHINFO_FILENAME);
                    $batch_name = $this->input->post('batch_name');
                    if(strcmp($file_name, $batch_name) == 0){
                        $data['upload_rejected_accounts'] = $this->import();
                        $id_reject_user = $this->session->userdata('user_id');
                        $rej_count=0;
                        foreach ($data['upload_rejected_accounts'] as $row) {
                            if(is_numeric($row[0])){
                                $rej_count = $rej_count + 1;
                                $res_rej = $this->ModelDownload->mark_reject($batch_name, $row[0], $id_reject_user);
                            }                            
                        }
                        if ($res_rej) {
                            $this->ModelDownload->reject_count($rej_count, $batch_name);
                            $sdata = array();
                            $sdata['msg'] = 'Upload Successful.';
                            $sdata['cls'] = 'Congratulations!!!';
                            $this->session->set_userdata($sdata);
                        } else {
                            $sdata = array();
                            $sdata['msg'] = 'Something Went Wrong.';
                            $sdata['cls'] = 'Error!!!';
                            $this->session->set_userdata($sdata);
                        }
                    } else {
                        $sdata = array();
                        $sdata['msg'] = 'File name does not match with batch name.';
                        $sdata['cls'] = 'Error!!!';
                        $this->session->set_userdata($sdata);
                    }
                }
                $data['downloads_list'] = $this->ModelDownload->get_list_upload();
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'dl_ul/upload_all_view', $data);
    }

    function upload_email() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Upload Accounts');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'dl_ul/upload_email_view_script');
            $this->template->set('page_style', 'dl_ul/upload_email_view_style');

            if ($this->session->userdata('user_access_level') == 100) {
                if($this->input->post('submit') === 'upload'){
                    $data['upload_accounts'] = $this->import();
                    $field_array = array();
                    $field_count = $this->input->post('option_select');
                    if($field_count == 3){
                        foreach ($data['upload_accounts'] as $row) {
                            $field_array[] = array( 
                                'field_data_0'      =>  $row[0],
                                'field_data_1'      =>  $row[1],
                                'field_data_2'      =>  $row[2],
                                'id_entry_user'     =>  $this->session->userdata('user_id'),
                                'date_entry'        =>  date('Y-m-d H:i:s',strtotime('now')),
                                'status'            =>  '1'
                            );
                        }
                    } else if($field_count == 2) {
                        foreach ($data['upload_accounts'] as $row) {
                            $field_array[] = array( 
                                'field_data_0'      =>  $row[0],
                                'field_data_1'      =>  $row[1],
                                'id_entry_user'     =>  $this->session->userdata('user_id'),
                                'date_entry'        =>  date('Y-m-d H:i:s',strtotime('now')),
                                'status'            =>  '1'
                            );
                        }
                    }
                    if ($this->ModelDownload->insert_email($field_array)) {
                        $sdata = array();
                        $sdata['msg'] = 'Upload Successful.';
                        $sdata['cls'] = 'Congratulations!!!';
                        $this->session->set_userdata($sdata);
                    } else {
                        $sdata = array();
                        $sdata['msg'] = 'Something Went Wrong.';
                        $sdata['cls'] = 'Error!!!';
                        $this->session->set_userdata($sdata);
                    }
                }
                $data['category_list'] = $this->ModelCommon->get_category();
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'dl_ul/upload_email_view', $data);
    }

    function locked_email() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Locked Emails');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'dl_ul/email_locked_view_script');
            $this->template->set('page_style', 'dl_ul/email_locked_view_style');

            if ($this->session->userdata('user_access_level') == 100) {
                $data['locked_emails'] = $this->ModelDownload->locked_emails();
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'dl_ul/email_locked_view', $data);
    }

    function unlock_email() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            if ($this->session->userdata('user_access_level') == 100) {
                $unlock_id = $this->input->get('id');
                $result = $this->ModelDownload->unlock_email($unlock_id);

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
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        redirect('locked_email');
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
            } else if('xls' == $extension) {     
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
            return $sheetData = $spreadsheet->getActiveSheet()->toArray();
        }
    }
}