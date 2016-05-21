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
	public function signup() {

		if($this->input->post()) {

            $customFields = array();
            $customFields['result'] = $this->UserModel->getCustomFields();

            $token = $this->generateToken(); 
            $data = array (
                'first_name' => $this->input->post('firstName', true),
                'last_name' => $this->input->post('lastName', true),
                'email' => $this->input->post('email', true),
                'password' => md5($this->input->post('password', true)),
                'phone' => $this->input->post('phone', true),
                'type' => "User",
                'verified' => "false",
                'token' => $token
                );
            $emailMessage = "Please verify your account using this link \n".base_url()."index.php/Welcome/verify?token=".$token;

            //get inserted id of the user
            $userInsertedId = $this->UserModel->insert('user', $data);

            //iterate every custom field and check if the key exist in posted data. If exist insert it in user custom data
            foreach( $customFields['result'] as $value ) {

                if( array_key_exists( $value->field_name, $this->input->post() ) ) {

                    $userCustomData = array (
                        'user_id' => $userInsertedId,
                        'customField_id' => $value->customField_id,
                        'key' => $value->field_name,
                        'value' => $this->input->post( $value->field_name , true)
                        );

                    $this->UserModel->insert('user_custom_data', $userCustomData);

                }     

            }

            mail($data["email"],"User verification",$emailMessage);

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

        $result = $this->UserModel->user_login_check_info($email, $password);

        //if query found any result i.e userfound
        if($result) {
            $data['user_id'] = $result->user_id;
            $data['type'] = $result->type;
            $data['fullName'] = $result->first_name . " " . $result->last_name;
            $data['message'] = 'Your are successfully Login && your session has been start';
            $this->session->set_userdata($data);
            redirect('Welcome/home');

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





    //Home controller
    public function home() {

        $id = $this->session->userdata('user_id');
        $type = $this->session->userdata('type');

        if( $id != NULL  && $type == 'User' ) {


        $data['events'] = $this->UserModel->getUserWaaraCalendar($id); 
        $events = [];
        foreach( $data['events']  as $row ) {
             $subevent['title'] = $row->duty_name;
             $subevent['start'] = $row->start_date;
             $subevent['end'] = $row->end_date;
             $subevent['url'] = 'waara?id='.$row->id;
             array_push($events, $subevent);
        }
        $data['events'] = $events;  

            $this->load->view('common/header');
            $this->load->view('website/home',array('data' => $data));
            $this->load->view('common/footer');


        } else if ( $type == 'Super Admin' || $type == 'JK Admin') {

            redirect('Admin/');

        } else {

            redirect('Welcome/login');

        }


    }


    public function verify(){

         if( $this->input->get() ) {

            $token = $this->input->get('token', TRUE);


            $data = array (
                "verified" => 'true',
                "status" => 'true'
            );

            $this->UserModel->update( 'user', 'token', $token, $data );
           
            redirect('Welcome/login');

        }
    } 


    public function waara(){


        if( $this->input->get() ) {

            $id = $this->input->get('id', TRUE);


            $data['result'] = $this->UserModel->getWaara($id);

            $this->load->view('common/header');
            $this->load->view('website/waara', array('data' => $data));
            $this->load->view('common/footer');
        }
    }

    public function news(){


        $data['result'] = $this->UserModel->getNews();

        $this->load->view('common/header');
        $this->load->view('website/news', array('data' => $data));
        $this->load->view('common/footer');

    }

    public function viewNews(){
    
    if( $this->input->get() ) {

            $id = $this->input->get('id', TRUE);

            $data['result'] = $this->UserModel->getNewsdetails($id);

            $this->load->view('common/header');
            $this->load->view('website/viewNews', array('data' => $data));
            $this->load->view('common/footer');

        }    

    }
    /**
     * logout
     */
  
    public function logout() {

        $this->session->sess_destroy();

        redirect('welcome/login');

    }  

    public function editPassword()
    {
        if(  $this->userLoginStatus() ){
            if( $this->input->post()  ){

                $oldPassword =  md5($this->input->post('oldPassword', TRUE));
                $newPassword =  md5($this->input->post('newPassword', TRUE));
                $id = $this->session->userdata('user_id');
                
                $data['result'] = $this->UserModel->changePassword($id, $oldPassword, $newPassword);

                $this->load->view('common/header');
                $this->load->view('website/editPassword', array('data' => $data));
                $this->load->view('common/footer');

            } else {
                $this->load->view('common/header');
                $this->load->view('website/editPassword', array('data' => null));
                $this->load->view('common/footer');
            }

        }
       

    }    
    public function userLoginStatus()
    {
        
        $id = $this->session->userdata('user_id');
        $type = $this->session->userdata('type');

        if( $id != NULL  && $type == 'User' ) {
            return true;
        }
        redirect('Welcome/login');
            
    }

    public function request(){
        if(  $this->userLoginStatus() ){
            if( $this->input->post()  ){

                $title =  $this->input->post('title', TRUE);
                $request = $this->input->post('request', TRUE);
                $user_id = $this->session->userdata('user_id');
                
                $data = array(
                    'title' => $title,
                    'request' => $request,
                    'user_id' => $user_id
                    );
                $data['result'] = $this->UserModel->insert('request', $data);
                $data['admin'] = $this->UserModel->getAllAdmin();
                foreach ($data['admin'] as  $item) {

                    $email = $item->email;
                    mail( $email, 'New request has been created', $request);
                    # code...
                }
                $this->load->view('common/header');
                $this->load->view('website/request', array('data' => $data));
                $this->load->view('common/footer');

            } else {
                $this->load->view('common/header');
                $this->load->view('website/request', array('data' => null));
                $this->load->view('common/footer');
            }

        }
       

    }  

    function editUser() {
        if(  $this->userLoginStatus() ){
            if($this->input->post()) {

                $id = $this->input->post('userId', true);

                $customfields = $this->UserModel->getAllfromTable('customfields');

                $customData = array();

                //iterate every custom field and check if the key exist in posted data. If exist insert it in user custom data
                foreach( $customfields as $item ) {
                    if( array_key_exists( $item->field_name, $this->input->post() ) ) {

                        $customData = array( "value" => $this->input->post( $item->field_name, true) );
                                                // tablename           key      value   key    value               data   
                        $this->UserModel->updateWhere('user_custom_data', 'user_id', $id, 'key', $item->field_name, $customData);

                    }
                }


                $this->UserModel->update('user_custom_data' ,'user_id' , $id, $customData);

                $data = array (
                    "first_name" => $this->input->post('firstName', true),
                    "last_name" => $this->input->post('lastName', true),
                    "email" => $this->input->post('email', true),
                    "phone" => $this->input->post('phone', true)
                );

                

                $this->UserModel->update('user' ,'user_id' , $id, $data);

                redirect('Welcome/editUser');

            }

            

                $id = $this->session->userdata('user_id');
       
                $data['customFields'] = $this->UserModel->getCustomFieldByUserId( $id );

                $data['user'] = $this->UserModel->getUserById( $id );

                $this->loadView('website/editUser', $data);

        }
  
    }  

    /**
     * Load view 
     * @param 1 : view name
     * @param 2 : data to be render on view. If no data pass null
     */
    function loadView($view, $data) {
        //error_reporting(0);
        $this->load->view('common/header');
        $this->load->view($view, array('data' => $data));
        $this->load->view('common/footer');

    }

    public function sendPasswordLink () {
        if($this->input->post()){
             $email = $this->input->post('email', true); 
             $result = $this->UserModel->getUserByEmail($email);
             if( $result ){
                $message = "Please click on the url to reset your password \n" . base_url() . "index.php/Welcome/resetPassword?".$result->token;
                mail($result->email, "Reset your password", $message);
                redirect('Welcome/login');
             } else {
                redirect('Welcome/login');

             }
        }
    } 

    public function resetPassword () {
        if($this->input->post()){
            $token = $this->input->post('token', true);  
            $password = $this->input->post('newPassword', true); 

            $data = array (
                "password" => md5($password)
            );
            $this->UserModel->updatePassword( $token, $data);
            redirect('Welcome/login');

        } else {
            $this->loadView("website/resetPassword", null);
        }

    }                  
}
