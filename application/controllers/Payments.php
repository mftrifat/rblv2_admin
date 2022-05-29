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