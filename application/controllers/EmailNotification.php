<?php
class EmailNotification extends CI_Controller {

    public function __construct(){
        parent::__construct();

           $id = $this->session->userdata('user_id');



        // if( $id != NULL  && $type != 'User' ) {
            $this->load->model('AdminModel');
            $this->load->model('EmailModel');

        // } else {

        //    redirect('Login/');

        // }        
    }

    function index(){

        $data['emailNotification'] = $this->EmailModel->getEmailContent();
        $data['emailNotificationSwitch'] = $this->EmailModel->getEmailNotification();
        $this->loadView('admin/emailNotification', $data );
    }


    function add(){
      
        $data = array(
          'content' => $this->input->post('content', true),
          'date' => date("d-m-Y"),
          'user_id' => $this->session->userdata('user_id')
        );
        $this->EmailModel->insert( $data );
        redirect("emailNotification");


    }


    function setNotification(){

        $data = array(
          'notification' => $this->input->post('emailNotification', true),
          'date' => date("d-m-Y"),
          'admin_id' => $this->session->userdata('user_id')
        );
        $this->EmailModel->setNotification( $data );
    }  
    /**
     * Load view 
     * @param 1 : view name
     * @param 2 : data to be render on view. If no data pass null
     */
    function loadView($view, $data) {
        //error_reporting(0);
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view($view, array('data' => $data));
        $this->load->view('admin/common/footer');

    }

}
?>