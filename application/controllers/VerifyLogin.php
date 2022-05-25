<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class VerifyLogin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('UserCheck');
        $this->load->model('ModelCommon');
        $this->load->model('ModelLogActivity');
    }
    
    function index()
    {
        if (!$this->session->userdata('logged_in_admin_rbl')) {
            if($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('user_name','Username','trim|required');
                $this->form_validation->set_rules('password','Password','trim|required|callback_check_database');
                if($this->form_validation->run()===FALSE)
                {
                    $this->login_index();
                } else {
                    redirect('Home');
                }
            } else {
                $this->login_index();
            }
        } else {
            redirect('Home');
        }
    }

    function login_index(){
        header("Access-Control-Allow-Origin: *");
        $data = array();
        $this->template->set('title', 'Login');
        $this->template->load('login_layout', 'contents' , 'login/login_view', $data);
    }

    function reset_password()
    {
        if (!$this->session->userdata('logged_in_admin_rbl')) {
            if($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('user_name','Username','trim|required|callback_check_database_user_email');
                $this->form_validation->run();
            }
        }
        header("Access-Control-Allow-Origin: *");
        $data = array();
        $this->template->set('title', 'Password Reset');
        $this->template->load('login_layout', 'contents' , 'login/login_reset_view');
    }

    function check_database_user_email()
    {
        if (!$this->session->userdata('logged_in_admin_rbl')) {
            if($this->input->post()) {
                $username=$this->input->post('user_name');
                $result=$this->UserCheck->reset_user_check($username);

                if($result)
                {
                    if($result[0]->user_email == null)
                    {
                        $this->session->set_flashdata('msg_reset', 'No E-mail Address Set to This User!');
                        return FALSE;
                    }
                    $key = $this->UserCheck->send_reset_mail($result[0]->user_email);
                    if($key != false)
                    {
                        $this->ModelCommon->update_data_single_cond('tbl_users', 'user_name', $username, 'reset_key', $key);
                        $this->session->set_flashdata('msg_reset', 'Reset Mail Sent!');
                        return TRUE;
                    }
                }
                else
                {
                    $this->session->set_flashdata('msg_reset', 'Username Not Found');
                    return FALSE;
                }
            }
        }
        return FALSE;
    }


    function new_user()
    {
        if (!$this->session->userdata('logged_in_admin_rbl')) {
            if ($this->input->post())
            {
                $this->load->library('form_validation');
                $rules = array(
                    [
                        'field' => 'user_name',
                        'label' => 'User Name',
                        'rules' => 'required|callback_valid_username',
                    ],
                    [
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'callback_valid_password',
                    ],
                    [
                        'field' => 'confirm_password',
                        'label' => 'Confirm Password',
                        'rules' => 'matches[password]',
                    ],
                    [
                        'field' => 'user_email',
                        'label' => 'User Email',
                        'rules' => 'required',
                    ],
                );
                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run())
                {
                    $this->session->set_flashdata('msg_new_user', 'Request Sent!! Please Check Email For Confimation.');
                }
            }
        }
        // Load your views
        header("Access-Control-Allow-Origin: *");
        $data = array();
        $this->template->set('title', 'New User');
        $this->template->load('login_layout', 'contents' , 'login/login_new_user_view', $data);
    }

    function valid_username($user_name = '')
    {
        $ret = TRUE;
        $user_name = trim($user_name);
        $min_char = 5;
        $max_char = 32;        
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
        return $ret;
    }

    function valid_password($password = '')
    {
        $ret = TRUE;
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
        $min_char = 8;
        $max_char = 32;

        if (empty($password))
        {
            $this->form_validation->set_message('valid_password', 'The {field} field is required.');
            $ret = FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');
            $ret = FALSE;
        }
        if (strlen($password) < $min_char)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least '.$min_char.' characters in length.');
            $ret = FALSE;
        }
        if (strlen($password) > $max_char)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');
            $ret = FALSE;
        }
        if (preg_match_all($regex_lowercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');
            $ret = FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
            $ret = FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
            $ret = FALSE;
        }
        return $ret;
    }

    function check_database($password)
    {
        $user_name=$this->input->post('user_name');
        $result=$this->UserCheck->login($user_name, $password, $this->getClientIP());

        if($result)
        {
            $user_name = $result[0]->user_name;
            $a_data_ms =$this->ModelCommon->get_row_by_cond("tbl_users", "account_status", " user_name = '$user_name'");
            if($a_data_ms->account_status == 0){
                $this->form_validation->set_message('check_database','This User is not active. Please Contact Administrator.');
                return FALSE;
            } else if($a_data_ms->account_status == -1){
                $this->form_validation->set_message('check_database','This User is Locked due to too many wrong password attempt. Please Contact Administrator.');
                return FALSE;
            }
            $this->ModelCommon->update_data_single_cond('tbl_users', 'user_name', $user_name, 'password_attempt', 0);


            $sess_array=array();
            foreach($result as $row)
            {
                if(!empty($row->photo)){$pro_pic = $row->photo;}else {$pro_pic = "assets/img/user1.jpg";}
                $sess_array=array(
                    'user_id'               => $row->user_id,
                    'user_name'             => $row->user_name,
                    'client_ip'             => $this->getClientIP(),
                    'unique_sess_id'        => $row->user_name.$this->udate().$row->access_level,
                    'user_access_level'     => $row->access_level,
                    'user_full_name'        => $row->full_name,
                    'password'              => $row->password,
                    'photo'                 => $pro_pic,
                    'logged_in_admin_rbl'   => TRUE
                );
                $this->session->set_userdata($sess_array);
            }

            $log_param = array(
                'user_name'         => $this->session->userdata('user_name'),
                'user_ip'           => $this->session->userdata('client_ip'),
                'User_session_id'   => $this->session->userdata('unique_sess_id'),
                'user_access_level' => $this->session->userdata('user_access_level'),
                'log_type'          => "login",
                'activity'          => "Logged In"
            );
            $this->ModelLogActivity->add_log($log_param);

            $sdata['show_msg'] = '1';
            $this->session->set_userdata($sdata);
            
            $data = array();
            $data['user_access_level'] =$row->access_level;
            $data['user_name'] =$user_name;
            $data['session_id'] =$this->session->userdata('session_id');
            $data['unique_sess_id'] =$this->session->userdata('unique_sess_id');
            if(empty($_SERVER['HTTP_X_FORWARDED_FOR'])){                
                $data['client_ip'] =$_SERVER['REMOTE_ADDR'];
            }else{
                $data['client_ip'] =$_SERVER['HTTP_X_FORWARDED_FOR'];                
            }
            $data['client_ip']=$this->getClientIP();
            $data['last_activity'] =$this->session->userdata('last_activity');
            $data['user_agent'] =$this->session->userdata('user_agent');

            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_database','Invalid Username or Password');
            return FALSE;
        }
    }

    function logout() {
        $log_param = array(
            'user_name'         => $this->session->userdata('user_name'),
            'user_ip'           => $this->session->userdata('client_ip'),
            'User_session_id'   => $this->session->userdata('unique_sess_id'),
            'user_access_level' => $this->session->userdata('user_access_level'),
            'log_type'          => "login",
            'activity'          => "Logged Out"
        );
        $this->ModelLogActivity->add_log($log_param);

        $newdata = array(
            'user_id'               => '',
            'user_name'             => '',
            'client_ip'             => '',
            'unique_sess_id'        => '',
            'user_access_level'     => '',
            'user_full_name'        => '',
            'password'              => '',
            'photo'                 => '',
            'logged_in_admin_rbl'   => FALSE
        );

        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();
        $this->index();
    }

    function valid_old_pass($old_pass = '')
    {
        $ret = TRUE;
        $old_pass = hash('sha512', $old_pass);

        if (empty($old_pass))
        {
            $this->form_validation->set_message('valid_old_pass', 'The {field} field is required.');
            $ret = FALSE;
        }
        if(strcmp($this->session->userdata('password'), $old_pass) != 0)
        {
            $this->form_validation->set_message('valid_old_pass', '{field} does not match.');
            $ret = FALSE;
        }
        return $ret;
    }

    function change_password() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Chnage Password');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'profile/password_change_view_script');
            $this->template->set('page_style', 'profile/password_change_view_style');

            if($this->session->userdata('user_access_level') == 100) {
                if($this->input->post()) {
                    $old_pass = $this->input->post('old_pass');
                    $new_pass = $this->input->post('new_pass');
                    $confirm_pass = $this->input->post('confirm_pass');
                    $user_name = $this->session->userdata('user_name');

                    $this->load->library('form_validation');
                    $rules = array(
                        [
                            'field' => 'old_pass',
                            'label' => 'Old Password',
                            'rules' => 'required|callback_valid_old_pass',
                        ],
                        [
                            'field' => 'new_pass',
                            'label' => 'New Password',
                            'rules' => 'callback_valid_password',
                        ],
                        [
                            'field' => 'confirm_pass',
                            'label' => 'Confirm Password',
                            'rules' => 'matches[new_pass]',
                        ]
                    );
                    $this->form_validation->set_rules($rules);                    
                 
                    if($this->form_validation->run())
                    {
                        $new_pass_enc = $this->encryption->encrypt($new_pass);

                        if ($this->UserCheck->change_password_user($user_name, $new_pass_enc)) {
                            $sdata = array();
                            $sdata['msg'] = 'Password Successfully Changed.';
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
        $this->template->load('default_layout', 'contents' , 'profile/password_change_view', $data);
    }

    function user_profile_update() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'User Profile');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'profile/user_profile_view_script');
            $this->template->set('page_style', 'profile/user_profile_view_style');

            $user_name = $this->session->userdata('user_name');

            if($this->session->userdata('user_access_level') == 100) {
                if($this->input->post()) {
                    $data_param = array(
                        'full_name'     => $this->input->post('full_name'),
                        'user_email'    => $this->input->post('user_email'),
                        'phone'         => $this->input->post('phone'),
                        'skype'         => $this->input->post('skype'),
                        'fblink'        => $this->input->post('fblink'),
                        'nid'           => $this->input->post('nid'),
                        'dob'           => $this->input->post('dob')
                    );

                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('full_name','Full Name','trim|required');
                    $this->form_validation->set_rules('user_email','Email','trim|required');
                    $this->form_validation->set_rules('phone','Phone','trim|required');
                    $this->form_validation->set_rules('skype','Skype','trim|required');
                    $this->form_validation->set_rules('fblink','Facebook Link','trim|required');
                    $this->form_validation->set_rules('nid','National ID','trim|required');
                    $this->form_validation->set_rules('dob','Date of Birth','trim|required');

                    if($this->form_validation->run())
                    {
                        $user_name_enc = $this->encryption->encrypt($user_name);

                        if ($this->UserCheck->profile_update_user($user_name_enc, $data_param)) {
                            $this->session->set_userdata('user_full_name', $data_param['full_name']);
                            $sdata = array();
                            $sdata['msg'] = 'Changes Successfully Saved.';
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
                $data['profile_data'] = $this->UserCheck->reset_user_check($user_name);
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'profile/user_profile_view', $data);
    }

    function user_profile_picture_update() {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        if ($this->session->userdata('logged_in_admin_rbl')) {
            $this->template->set('title', 'Profile Picture');
            $this->template->set('nav', '_layouts/nav/navigation_layout_super');
            $this->template->set('page_script', 'profile/user_profile_photo_view_script');
            $this->template->set('page_style', 'profile/user_profile_photo_view_style');

            $user_name = $this->session->userdata('user_name');

            if($this->session->userdata('user_access_level') == 100) {
                if($this->input->post()) {
                    $config = array(
                        'upload_path'   => "./uploads/user_profile/",
                        'allowed_types' => "gif|jpg|png|jpeg|pdf",
                        'overwrite'     => TRUE,
                        'max_size'      => "512000",
                        'max_height'    => "768",
                        'max_width'     => "1024"
                    );
                    $this->load->library('upload', $config);

                    if($this->upload->do_upload('photo')) {
                        $data = array('upload_data' => $this->upload->data());
                        $photo = "uploads/user_profile/".$data['upload_data']['file_name'];
                        $data_param = array(
                            'photo'     => $photo
                        );

                        $user_name_enc = $this->encryption->encrypt($user_name);
                        $this->UserCheck->profile_update_user($user_name_enc, $data_param);
                        $this->session->set_userdata('photo', $photo);                            
                        $sdata = array();
                        $sdata['msg'] = 'Changes Successfully Saved.';
                        $sdata['cls'] = 'Congratulations!!!';
                        $this->session->set_userdata($sdata);
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        $sdata = array();
                        $sdata['msg'] = $this->upload->display_errors();
                        $sdata['cls'] = 'Error!!!';
                        $this->session->set_userdata($sdata);
                    }
                }
                $data['profile_data'] = $this->UserCheck->reset_user_check($user_name);
            } else {
                redirect('logout');
            }
        } else {
            redirect('Home');
        }
        $this->template->load('default_layout', 'contents' , 'profile/user_profile_photo_view', $data);
    }

    function udate($format = "YmdHis", $utimestamp = null) {
        $m = explode(' ', microtime());
        list($totalSeconds, $extraMilliseconds) = array($m[1], (int) round($m[0] * 1000, 3));
        return date($format, $totalSeconds) . sprintf('%03d', $extraMilliseconds);
    }
    
    function getClientIP(){
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)){
            return  $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (array_key_exists('REMOTE_ADDR', $_SERVER)) {
            return $_SERVER["REMOTE_ADDR"];
        } else if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
            return $_SERVER["HTTP_CLIENT_IP"];
        } else{return '';}
    }
}