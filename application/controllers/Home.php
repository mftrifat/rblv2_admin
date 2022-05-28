<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model("ModelCommon");
    }

	function index()
	{
		header("Access-Control-Allow-Origin: *");
		$data = array();
		if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->dashboard();
        } else {
			$this->login();
		}
	}

	function custom_404()
	{
		header("Access-Control-Allow-Origin: *");
		$this->output->set_status_header('404'); 
    	$this->load->view('errors/error404');
	}

	function dashboard()
	{
		header("Access-Control-Allow-Origin: *");
		$data = array();
		if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Dashboard');
            if($this->session->userdata('user_access_level') == 100) {
            	$this->template->set('nav', '_layouts/nav/navigation_layout_super');
            } else {
            	redirect('logout');
            }
            $this->template->set('page_script', 'dashboard/dashboard_admin_script');
			$this->template->load('default_layout', 'contents' , 'dashboard/dashboard_admin', $data);
        } else {
			$this->index();
		}
	}

	function login()
	{
		header("Access-Control-Allow-Origin: *");
		$this->template->set('title', 'Login');
		$this->template->load('login_layout', 'contents' , 'login/login_view');
	}
}