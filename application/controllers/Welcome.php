<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    

    public function __construct(){
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function index()
	{
		$this->load->view('common/header');
		$this->load->view('website/index');
        $this->load->view('common/footer');
	}
	public function login()
	{
		$this->load->view('common/header');
		$this->load->view('website/login');
        $this->load->view('common/footer');
	}
	public function signup()
	{
		if($this->input->post()){

			$token = $this->generateToken();
            $data = array (
            'first_name' => $this->input->post('firstName', true),
            'last_name' => $this->input->post('lastName', true),
            'email' => $this->input->post('email', true),
            'password' => md5($this->input->post('password', true)),
            'phone' => $this->input->post('phone', true),
            'type' => "USER",
            'verified' => "false",
            'token' => $token
            );
        $emailMessage = "Please verify your account using this link \n".base_url()."/Welcome/verify?token=".$token;     
        $this->UserModel->insert('user', $data);
        mail($data["email"],"User verification",$msg);

        redirect('Welcome/login');


		} else {
			$data   = array();
	        $data['result'] = $this->UserModel->getCustomFields();
			$this->load->view('common/header');
			$this->load->view('website/signup',$data);
	        $this->load->view('common/footer');
    	}
	}
	    //when admin login button is click
    public function user_login_check() {
        $email = $this->input->post('email', true);
        $password = md5($this->input->post('password', true));

        //$result = $this->UserModel->user_login_check_info($email, $password);

        //if query found any result i.e userfound
        if($result) {
            $data['user_id'] = $result->user_id;
            $data['message'] = 'Your are successfully Login && your session has been start';
            $this->session->set_userdata($data);
            redirect('Welcome/');

        }else{
            $data['message'] = ' Your Email ID or Password is invalid  !!!!! ';
            $this->session->set_userdata($data);
            redirect('Welcome/login');
        }


    }
    //genrate token for user verification
    public function generateToken($length = 15) {

	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}
