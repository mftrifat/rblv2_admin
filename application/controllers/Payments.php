<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model("ModelCommon");
        $this->load->model("ModelPayments");
    }

    function pending_payment() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        $data['post_act'] = 0;
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Pending Payments');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'payment/payment_pending_view_script');
            $this->template->set('page_style', 'payment/payment_pending_view_style');

            if($this->session->userdata('user_access_level') == 100) {
                $data['pending_payment'] = $this->ModelPayments->get_pending_payment();
            } else {
                echo "Unauthorized Action!";
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'payment/payment_pending_view', $data);
    }

    function confirm_payment() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Confirm Payment');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'payment/payment_action_view_script');
            $this->template->set('page_style', 'payment/payment_action_view_style');

            $payment_id = $this->input->get('id');

            if($this->session->userdata('user_access_level') == 100) {
                if($this->input->post('submit')) {
                    $payment_id = $this->input->post('payment_id');
                    if($this->input->post('submit') == 'approve') {
                        $data['payment_status'] = 1;
                    } else if($this->input->post('submit') == 'rejecet') {
                        $data['payment_status'] = -1;
                    }

                    $data['commision_amount'] = $this->input->post('commision_amount');
                    $data['payment_user_id'] = $this->session->userdata('user_id');
                    $data['payment_remarks'] = $this->input->post('payment_remarks');

                    if ($this->ModelPayments->confirm_payment_action($payment_id, $data)) {
                        if($data['payment_status'] == 1) {
                            $t_data = array();
                            $t_data['user_id'] = $this->input->post('pay_user_id');
                            $t_data['transaction_type'] = 'Payment';
                            $t_data['total_amount'] = $this->input->post('request_amount');
                            $t_data['balance_before'] = $this->ModelCommon->single_result('tbl_user_balance','user_balance','user_id', $t_data['user_id']);

                            $t_data['balance_new'] = $t_data['balance_before']-$t_data['total_amount'];
                            $t_data['id_user_approve'] = $this->session->userdata('user_id');
                            $t_data['remarks'] = 'Payment Confirm';

                            if($this->ModelPayments->add_transaction_on_payment_confirm($t_data)) {
                                $this->ModelPayments->update_balance_on_payment($t_data['user_id'], $t_data['total_amount']);
                            }

                            if($this->input->post('commision_amount')) {
                                $t_data = array();
                                $t_data['user_id'] = $this->input->post('commision_user_id');
                                $t_data['transaction_type'] = 'Commission';
                                $t_data['total_amount'] = $this->input->post('commision_amount');
                                $t_data['balance_before'] = $this->ModelCommon->single_result('tbl_user_balance','user_balance','user_id', $t_data['user_id']);

                                $t_data['balance_new'] = $t_data['balance_before']+$t_data['total_amount'];
                                $t_data['id_user_approve'] = $this->session->userdata('user_id');
                                $t_data['remarks'] = 'Commission from '.$this->input->post('user_name');

                                if($this->ModelPayments->add_transaction_on_payment_confirm($t_data)) {
                                    $this->ModelPayments->update_balance_on_payment_commission($t_data['user_id'], $t_data['total_amount']);
                                }
                            }
                        } else if ($data['payment_status'] == -1) {
                            $this->ModelPayments->update_balance_on_payment($this->input->post('pay_user_id'), 0);
                        }

                        $sdata = array();
                        $sdata['msg'] = 'Payment Operation Complete.';
                        $sdata['cls'] = 'Congratulations!!!';
                        $this->session->set_userdata($sdata);
                    } else {
                        $sdata = array();
                        $sdata['msg'] = 'Something Went Wrong.';
                        $sdata['cls'] = 'Error!!!';
                        $this->session->set_userdata($sdata);
                    }
                    redirect('pending_payment');
                } else if($payment_id) {
                    $data['pending_payment'] = $this->ModelPayments->pending_payment_single_info($payment_id);
                }
            } else {
                echo "Unauthorized Action!";
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'payment/payment_action_view', $data);
    }

    function all_payment() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        $data['post_act'] = 0;
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Payment Status');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'payment/payment_all_view_script');
            $this->template->set('page_style', 'payment/payment_all_view_style');

            if($this->session->userdata('user_access_level') == 100) {
                $data['all_payments'] = $this->ModelPayments->get_all_payment();
            } else {
                echo "Unauthorized Action!";
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'payment/payment_all_view', $data);
    }
}