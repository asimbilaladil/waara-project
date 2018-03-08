<?php
class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();

            $this->load->model('AdminModel');
        error_reporting(0);

    }



    function index() {
        
        if($this->input->post()) {
           
            $loginData = array (
                'email' => $this->input->post('email', true),
                'password' => md5($this->input->post('password', true) )
            );
            $result = $this->AdminModel->admin_login_check_info($loginData);

            //if query found any result i.e userfound
            if($result) {

                $item = $result[0];

                $data['type'] = $item->type;

                if( $data['type'] != 'User' ) {

                    $data['user_id'] = $item->user_id;
                    $data['message'] = 'Your are successfully Login && your session has been start';
                    $data['jk_id'] = $item->jk_id;

                    $majalis = array();

                    if ($item->majalis_id) {

                        foreach($result as $row) { 
                            array_push($majalis, $row->majalis_id);
                        }

                        $data['majalisId'] = $majalis;
                        $data['majalisAdmin'] = true;

                    }

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