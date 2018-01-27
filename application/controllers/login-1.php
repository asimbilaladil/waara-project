<?php
class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();

            $this->load->model('AdminModel');
    }



    function index() {
        
        if($this->input->post()) {
           
            $data = array (
                'email' => $this->input->post('email', true),
                'password' => md5($this->input->post('password', true) )
            );
            $result = $this->AdminModel->admin_login_check_info($data);

            //if query found any result i.e userfound
            if($result) {
                    
                $data['type'] = $result->type;
                if( $data['type'] != 'User' ){

                    $data['user_id'] = $result->user_id;
                    $data['message'] = 'Your are successfully Login && your session has been start';
                    $data['jk_id'] = $result->jk_id;
                    $data['type'] = $result->type;
                    $this->session->set_userdata($data);
                    redirect('admin/');

                } else{ 
                    $data['message'] = ' Your Email ID or Password is invalid  !!!!! ';
                    redirect('login/');                    
                }
            }else{
                $data['message'] = ' Your Email ID or Password is invalid  !!!!! ';
                redirect('login/');
            }


        } else {
            $this->load->view('admin/login');
        }

    }


}
?>