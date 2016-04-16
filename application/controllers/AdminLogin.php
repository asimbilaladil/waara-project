<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Antu Rozario
 * Date: 2/28/2016
 * Time: 11:08 AM
 */
session_start();
class AdminLogin  extends CI_Controller
{
    public function __construct(){
        parent::__construct();
      $id = $this->session->userdata('admin_id');
      if ($id != NULL) {
         redirect('Admin', 'refresh');
      }
        $this->load->model('AdminLoginModel');
    }

    public function index(){
        $this->load->view('admin/login');
    }

    public function admin_login_check(){
        $data = array();
        $admin_email = $this->input->post('email', true);
        $admin_password = $this->input->post('password', true);
        $result = $this->AdminLoginModel->admin_login_check_info($admin_email, $admin_password);
        if($result) {
            if($result->admin_status !=="Active"){
                $sdata['login_message'] = 'Login failed,This user is not Active.';
                $this->session->set_userdata($sdata);
            }
            else{
                $sdata['admin_id'] = $result->admin_id;
                $sdata['message'] = 'Your are successfully Login && your session has been start';
                $this->session->set_userdata($sdata);
                redirect('Admin');
            }
        }else{
            $sdata['message'] = ' Your Email ID or Password is invalid  !!!!! ';
            $this->session->set_userdata($sdata);
            redirect('AdminLogin/index');
        }
    }

}