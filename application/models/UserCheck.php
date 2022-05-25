<?php
Class UserCheck extends CI_Model
{   
    function __construct()
    {
        parent::__construct();        
        $this->load->model('ModelCommon');
        $this->load->model('ModelLogActivity');
    }

    function login($user_name, $password, $client_ip)
    {
        $this->db->select('u.user_name as user_name, u.password as password, u.user_id as user_id, u.full_name as full_name, u.photo as photo, a.access_level as access_level, a.change_pass as change_pass');
        $this->db->from('tbl_users u');
        $this->db->join('tbl_user_access a', 'u.user_id = a.user_id');
        $this->db->where('u.user_name', $user_name);
        $this->db->limit(1);        
        $query=$this->db->get();
        $res=$query->result();
        
        if($query->num_rows()>=1)
        {
            if ($res[0]->password == hash('sha512', $password)) {
                return $res;
            } else {
                $log_param = array(
                    'user_name'         => $user_name,
                    'user_ip'           => $client_ip,
                    'log_type'          => "login",
                    'activity'          => "Wrong Password"
                );
                $this->ModelLogActivity->add_log($log_param);
                $password_attempt = $this->ModelCommon->single_result('tbl_users', 'password_attempt', 'user_name', $user_name);
                if($password_attempt < 5){
                    $this->ModelCommon->update_data_single_cond('tbl_users', 'user_name', $user_name, 'password_attempt', $password_attempt+1);
                } else {
                    $this->ModelCommon->update_data_single_cond('tbl_users', 'user_name', $user_name, 'account_status', -1);
                }
            }
        }
        return false;
    }

    function reset_user_check($user_name)
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('user_name', $user_name);
        $this->db->limit(1);        
        $query=$this->db->get();
        
        if($query ->num_rows()>=1)
        {
            return $query->result();
        } else {
            return false;
        }
    }

    function change_password_user($user,$pass)
    {
        $new_pass_dec = $this->encryption->decrypt($pass);
        $new_pass = hash('sha512', $new_pass_dec);

        $data = [
            'password' => $new_pass,
        ];
        $this->db->where('user_name', $user);
        $this->db->update('tbl_users', $data);

        return ($this->db->affected_rows() > 0);
    }

    function profile_update_user($user, $data)
    {
        $user_name = $this->encryption->decrypt($user);
        $this->db->where('user_name', $user_name);
        $this->db->update('tbl_users', $data);

        return ($this->db->affected_rows() > 0);
    }

    function send_reset_mail($user_email) {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'rbluserrequest@gmail.com',
            'smtp_pass' => 'RBLuser@123456',
            'mailtype' => 'html'
        );
        $this->load->library('email', $config);

        if ($user_email) {
            $user_id = $this->ModelCommon->single_result('tbl_users', 'user_id', 'user_email', $user_email);
            $user_name = $this->ModelCommon->single_result('tbl_users', 'user_name', 'user_email', $user_email);
            $key = $user_id . $user_name . $user_email;
            $key = hash('sha512', $key);

            $this->email->set_newline("\r\n");
            $this->email->to("$user_email");
            $this->email->from("rbluserrequest@gmail.com", "RBL Reset Password Request");
            $this->email->subject("RBL Password Reset Request by User");

            $message = "
                Hello,
                <br/><br/>
                Greetings from RBL!<br/>
                We received a request to reset your Uber password. Click the link below to choose a new one:                
                <br/><br/>
                <a href='" . base_url() . "setnewpassword?key=$key'>Reset Your Password</a>
                <br/><br/>
                OR
                <br/><br/> Copy and paste the following URL on your browser: <br/><br/>" . base_url() . "setnewpassword?key=$key
                <br/><br/><br/>
                If you did not make this request or need assistance, please contact administrator.
                <br/><br/>
                Thanks,
                <br/>
                <br/>
                IT Operations.
                <br/>
                RBL.
            ";

            $this->email->message($message);
            if($this->email->send()){
                return $key;
            }
            return false;
        }
    }
}
?>