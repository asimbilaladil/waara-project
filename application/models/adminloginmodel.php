<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');


class AdminLoginModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function admin_login_check_info($admin_email, $admin_password){
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('admin_email', $admin_email);
        $this->db->where('admin_password', md5($admin_password));
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        return $result;
    }

}