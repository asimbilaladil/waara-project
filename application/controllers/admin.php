<?php
class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('AdminModel');
    }

    function index()
    {   
      
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/index');
        $this->load->view('admin/common/footer');

    }

    function login() {
        $this->load->view('admin/login');
    }

    function addJK() {   
      
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/addJK');
        $this->load->view('admin/common/footer');

    }

    function addDuty() {   
      
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/addDuty');
        $this->load->view('admin/common/footer');

    }


    //when admin login button is click
    function admin_login_check() {
        $admin_email = $this->input->post('email', true);
        $admin_password = md5($this->input->post('password', true));
        $result = $this->AdminModel->admin_login_check_info($admin_email, $admin_password);

        //if query found any result i.e userfound
        if($result) {
            $data['user_id'] = $result->user_id;
            $data['message'] = 'Your are successfully Login && your session has been start';
            $this->session->set_userdata($data);
            redirect('admin/');

        }else{
            $data['message'] = ' Your Email ID or Password is invalid  !!!!! ';
            $this->session->set_userdata($data);
            redirect('admin/login');
        }

    }

    /**
     * Insert Custom field data
     * 1. @param : customField
     */

    function addNewCustomField() {

        if($this->input->post('custom_field', true)){

           //Insert custom field 

            $customField = $this->input->post('custom_field', true);
            
            //replace space with _ to make name of the field
            $fieldName = str_replace( ' ', '_' , $customField);

            $data = array (
                'input_type' => 'TEXT',
                'field_name' => $fieldName,
                'field_lable' => $customField
                );

            if ( $this->AdminModel->insert('customfields', $data) ) {

                $data = array (
                    'message' => 'successfully inserted'
                    );

                $this->load->view('admin/common/header');
                $this->load->view('admin/common/sidebar');
                $this->load->view('admin/addNewCustomField', array('data' => $data));
                $this->load->view('admin/common/footer');
                
            }


        } else {
      
            $this->load->view('admin/common/header');
            $this->load->view('admin/common/sidebar');
            $this->load->view('admin/addNewCustomField');
            $this->load->view('admin/common/footer');

        }




    }



}
?>