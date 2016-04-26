<?php
class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('AdminModel');
    }

    function index()
    {   
        $data = $this->AdminModel->get_calendar_duties(); 
        $events = [];
        foreach($data as $row) {

             $subevent['title'] = $row->duty_name;
             $subevent['start'] = $row->start_date;
             $subevent['end'] = $row->end_date;

             array_push($events, $subevent);
        }       

        $this->loadView('admin/index', $events);

    }

    function login() {
        $this->load->view('admin/login');
    }

    function addJK() {   
        if($this->input->post()) {
            $data = array (
                'name' => $this->input->post('name', true),
                'location' => $this->input->post('location', true)
            );
        if ( $this->AdminModel->addJK( $data ) ) {

            $data = array (
                    'message' => 'JK created successfully.'
            );

            $data['JK'] = $this->AdminModel->getJamatKhana();
            $this->loadView('admin/addJK', $data);

        }

      } else {
            $data['JK'] = $this->AdminModel->getJamatKhana();
            $this->loadView('admin/addJK', $data);

      }

    }

    function addDuty() {   
    
        if($this->input->post()) {

            $selectJkIds = $this->input->post('jk', true);

            $dutyItem = array (
                "name" => $this->input->post('name', true),
                "description" => $this->input->post('description', true)
            );

            //insert in duty table
            $this->AdminModel->insert('duty', $dutyItem);

            //get inserted id of duty
            $dutyInsertedId = $this->db->insert_id();

            if( count( $selectJkIds ) > 0 ) {
                //iterate selected jk and add there ids 
                foreach( $selectJkIds as $id ) {

                    $dutyJkItem = array(
                        "jk_id" => $id,
                        "duty_id" => $dutyInsertedId
                    );

                    $this->AdminModel->insert('duty_jk', $dutyJkItem);
                }
            }

            $data = array (
                'message' => 'Duty successfully inserted.'
            );

        }

        $jamatKhanas = $this->AdminModel->getJamatKhana();

        $jkArray = array();

        //populate array with Id as key and value
        foreach($jamatKhanas as $item => $value) {
            $jkArray[$value->id] = $value->name;
        }

        $data['jkArray'] = $jkArray;
        $data['jkDb'] = $jamatKhanas;

        $this->loadView('admin/addDuty', $data);

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

                $this->loadView('admin/addNewCustomField', $data);
                
            }

        } else {
            
            $this->loadView('admin/addNewCustomField', null);

        }

    }


    function assign_duty() {   

        if($this->input->post()) {

            $assignDuty = array (
                "user_id" => $this->input->post('userid', true),
                "jk_id" => $this->input->post('jk', true),
                "duty_id" => $this->input->post('duty', true),
                "start_date" => $this->input->post('startDate', true),
                "end_date" => $this->input->post('endDate', true)
            );

            $data = array (
                'message' => 'Assign Duty Successfully.'
            );
            //insert in assign_duty table
            $this->AdminModel->insert('assign_duty', $assignDuty);
        } 
       
        
        $data['users'] = $this->AdminModel->getAllfromTable( 'user' );

        $dutyArray = array();

        $data['duty'] = $this->AdminModel->getAllfromTable( 'duty' );

        $this->loadView('admin/assign_duty', $data);

        
    }


    //ajax call to populate jk dropdown
    function ajaxJk() {

        $state=$this->input->post('state');

        $jk = $this->AdminModel->getJkbyId( $state );

        echo '<option value="">Select Jamatkhana </option>';
            foreach($jk as $row) { 
                 echo "<option value='".$row->id."'>".$row->name."</option>";
        }

    }

    function assignment() {

        $id =  $this->input->get('id');

        $this->loadView('admin/assignment', null);

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

    /**
     * deleteJK
     * @param 1 : jk id
     */
    function deleteJK() {

        $id = $this->input->get('id', TRUE);
        $this->AdminModel->delete( 'id', $id, 'jk');
        redirect('admin/addJK');

    }

    /**
     * User
     */
    function user() {

        $data['user'] = $this->AdminModel->getAllfromTable( 'user' );
        $data['jk'] = $this->AdminModel->getAllfromTable( 'jk' );

        $this->loadView('admin/user', $data);

    }

    function addUserRole() {

     if($this->input->post()) {

           echo  $userId = $this->input->post('userId', true);
           echo $type = $this->input->post('type', true);
           echo $jk_id = $this->input->post('jk_id', true);

            $data = array (
                "type" => $type, 
                "jk_id" => $jk_id 
            );
            $this->AdminModel->update( 'user', 'user_id', $userId, $data );
            redirect('admin/user');

        }
    }

    /**
     * deleteUser
     */
    function deleteUser() {

        $id = $this->input->get('id', TRUE);
        $this->AdminModel->delete( 'user_id', $id, 'user');
        redirect('admin/user');

    }
}
?>