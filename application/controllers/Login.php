<?php
class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();

            $this->load->model('AdminModel');
            $this->load->model('MajalisModel');
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

                    $majalisAdminIds = array();
                    $majalisArray = array();

                    //get all majalis    
                    $allMajalis = $this->MajalisModel->getAllMajalis();
                    foreach($allMajalis as $majalis) {
                        array_push($majalisArray, $majalis->id);
                    }

                    $data['majalis'] = $majalisArray;

                    //get Admin Majalis 
                    if ($item->majalis_id) {

                        foreach($result as $row) { 
                            array_push($majalisAdminIds, $row->majalis_id);
                        }
                        
                        $data['isMajalisAdmin'] = true;

                    } else {
                        $data['isMajalisAdmin'] = false;
                    }

                    $data['majalisAdminIds'] = $majalisAdminIds;
                    
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