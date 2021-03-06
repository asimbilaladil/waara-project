<?php
class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        error_reporting(0);

        $id = $this->session->userdata('user_id');
        $type = $this->session->userdata('type');

        if( $id != NULL  && $type != 'User' ) {
            $this->load->model('AdminModel');

        } else {

            redirect('Login/');

        }

    }

    function index()
    {   
        //ASSIGN DUTY
        if($this->input->post()) {

            //if email is checked send email to the assigned user
            if( $this->input->post('byEmail') ) {
                
                $user = $this->AdminModel->getrecordById('user', 'user_id', $this->input->post('selectedUser'));

                //mail($user->email, "");

            }

            $date = $this->input->post('date');

            $assign = array( 
                "user_id" => $this->input->post('selectedUser'),
                "duty_id" => $this->input->post('selectedDuty'),
                "jk_id" => $this->input->post('jk'),
                "start_date" => $date,
                "end_date" => $date,
                "shift" => $this->input->post('selectedShift')
            );

        $this->AdminModel->insert('assign_duty', $assign);

        }

        $jkId = $this->session->userdata('jk_id');
        $type = $this->session->userdata('type');

        //if jk id is set in session. if jkid = 0 it call see all jks
        if( isset( $jkId ) && $jkId != 0 )  {

            $jk = $this->AdminModel->getJkById( $jkId );

        } else {

            $jk = $this->AdminModel->getAllfromTable('jk');

            $data['duty'] = $this->AdminModel->getAllfromTable( 'duty' );

        }

        $users = $this->AdminModel->getAllfromTable('user');

        $data['users'] = $users;

        $data['jk'] = $jk;

        $data['events'] = $this->AdminModel->get_calendar_duties(); 
            $events = [];
            foreach( $data['events']  as $row ) {
                 $subevent['title'] = $row->duty_name;
                 $subevent['start'] = $row->start_date;
                 $subevent['end'] = $row->end_date;
                 $subevent['url'] = 'Welcome/waara?id='.$row->id;
                 array_push($events, $subevent);
        }
        $data['events'] = $events;
        $data['type'] = $type;
        
        $this->loadView('admin/index', $data);

    }

    function getUsers(){

        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->AdminModel->getUsers($q);
        }

    }


    function ajaxGetDutyFromJk() {

        $state=$this->input->post('state');

        $date=$this->input->post('date');

        $duty = $this->AdminModel->getDutyByJk( $state );

        $html = '<table class="table table-striped" id="dutyTable">
        <thead>
        <tr>
            <th> Waara </th>
            <th> Username </th>
            <th> Action </th>
        </tr>
        </thead>
        <tbody>';
        
        $count = 0;

        foreach($duty as $row) { 

            $count++;

            $result = $this->AdminModel->getUserOfDutyByDate( $date, $row->duty_id );

            

            if( count($result) > 0) {

                $user =  $result[0]->first_name;
                $assignId =  $result[0]->assign_id;  

                $html = $html . '<tr>
                                <td> '. $row->name .' </td>
                                <td> '. $user . '</td>     
                                <td> <a href= " ' . site_url("Welcome/waara?id=" . $assignId ) . ' " <button type="button" class="btn btn-primary btn-block"  >View</button> </td>
                                <td> <a href= " ' . site_url("admin/editAssignDuty?id=" . $assignId ) . ' " <button type="button" class="btn btn-primary btn-block"  >Edit</button></a></td>
                                </tr>';


            } else {

                $html = $html . '<tr>
                                <td> '. $row->name .' </td>
                                <td> <input onkeyup="getUserName(this)" type="text" name="users" id="users_'. $count .'" class="form-control" placeholder="Search User.." required> </td>     
                                <td> <button type="button" class="btn btn-primary btn-block"   onclick="ajaxCallUserHistory('. $row->duty_id .')">Save</button> </td>
                                </tr>';
            }

        }

        $html = $html . '<tbody></table>';



        echo $html;

    }


    function addJK() {   
        if($this->input->post()) {

            $data = array (
                'name' => $this->input->post('jkName', true),
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

            $beforeDuty = $this->input->post('beforeDuty', true);

            //insert and update priority
            $this->AdminModel->updateDutyByOrder(
            $beforeDuty, $this->input->post('duty_name', true), $this->input->post('description', true) );

            $selectJkIds = $this->input->post('jk', true);

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

        $data['duty'] = $this->AdminModel->getAllfromTableOrderBy('duty', 'priority', 'asc');

        $data['jkArray'] = $jkArray;
        $data['jkDb'] = $jamatKhanas;

       $this->loadView('admin/addDuty', $data);

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

        $jk = $this->AdminModel->getJkFromDuty( $state );

        echo '<option value="">Select Jamatkhana </option>';
            foreach($jk as $row) { 
                 echo "<option value='".$row->id."'>".$row->name."</option>";
        }

    }


    //ajax call to populate jk dropdown
    function getUser() {

        $state = $this->input->post('state');
        
        $user = $this->AdminModel->getUserById( $state['userId'] );

        if( $user->pref_duty == "" && $user->pref_jk == "" ) {
            echo "0";
            return;

        } else {
            
            $flag = "-1";

            foreach ( explode(',', $user->pref_jk) as $item) {
                if($item == $state['jkId']) {
                    $flag = "1";
                }
            }            

            if($flag == "1") {

                $flag = false;

                foreach ( explode(',', $user->pref_duty) as $item) {
                    if($item == $state['duty']) {
                        $flag = true;
                    }
                }                
            }

            echo $flag;
            return; 

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

            $userId = $this->input->post('userId', true);
            $type = $this->input->post('type', true);
            $jk_id = $this->input->post('jk_id', true);
            $shift_id = $this->input->post('shift_id', true);

            $data = array (
                "type" => $type, 
                "jk_id" => $jk_id,
                "shift"  => $shift_id
            );
            if( $data["type"] == "Super Admin" ){

                $data["jk_id"] = 0;
            }
            $this->AdminModel->update( 'user', 'user_id', $userId, $data );
           
            header('Location:http://waaranet.ca/index.php/Admin/user');
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


    function edituser() {

        if($this->input->post()) {

            $id = $this->input->post('userId', true);

            $customfields = $this->AdminModel->getAllfromTable('customfields');

            $customData = array();

            //iterate every custom field and check if the key exist in posted data. If exist insert it in user custom data
            foreach( $customfields as $item ) {
                if( array_key_exists( $item->field_name, $this->input->post() ) ) {

                    $customData = array( "value" => $this->input->post( $item->field_name, true) );
                                            // tablename           key      value   key    value               data   
                    $this->AdminModel->updateWhere('user_custom_data', 'user_id', $id, 'key', $item->field_name, $customData);

                }
            }
            if (!empty($customData)){
                $this->AdminModel->update('user_custom_data' ,'user_id' , $id, $customData);

            }


            $data = array (
                "first_name" => $this->input->post('firstName', true),
                "last_name" => $this->input->post('lastName', true),
                "email" => $this->input->post('email', true),
                "phone" => $this->input->post('phone', true),
                "password" => md5( $this->input->post('password', true) )
            );

            

            $this->AdminModel->update('user' ,'user_id' , $id, $data);

            redirect('admin/edituser?uid=' . $id );

        }

        if( $this->input->get('uid', TRUE) ) {

            $id = $this->input->get('uid', TRUE);
   
            $data['customFields'] = $this->AdminModel->getCustomFieldByUserId( $id );

            $data['user'] = $this->AdminModel->getUserById( $id );

            $this->loadView('admin/edituser', $data);

        }
  
    }

    /**
     * logout
     */
    function logout() {

        $this->session->sess_destroy();

        redirect('admin/');

    }

    function news() {

         if($this->input->post()) {

           
            $title = $this->input->post('title', true);
            $details = $this->input->post('details', true);
            $created_date = date("d-m-Y");


            $data = array (
                "title" => $title, 
                "details" => $details,
                "created_date" => $created_date
            );

             
            if ( $this->AdminModel->insert( 'news',$data ) ) {

                $data = array (
                    'message' => 'Successfully News Created'
                    );
                
            }  
            $data["news"] = $this->AdminModel->getAllfromTable( 'news' );

            $this->loadView('admin/news',  $data);


        } else{
                     $data["news"] = $this->AdminModel->getAllfromTable( 'news' );

            $this->loadView('admin/news',  $data);
        }
        

           

    }

    /**
     * delete news
     */
    function deleteNews() {

        $id = $this->input->get('id', TRUE);
        $this->AdminModel->delete( 'id', $id, 'news');
        redirect('admin/news');

    }

    /**
     * Edit news
     */
    function editNews() {

        if($this->input->post()) {

        echo    $title = $this->input->post('title', true);
        echo    $details = $this->input->post('details', true);
        echo    $id = $this->input->post('id', true);
            $data = array (
                "title" => $title, 
                "details" => $details,
            );
            $this->AdminModel->update('news','id',$id, $data);
            
            redirect('admin/news');


        } else {
        $id = $this->input->get('id', TRUE);
        $data = $this->AdminModel->getrecordById('news','id',$id);
        $this->loadView('admin/editNews',  $data);
        }

    }
    /**
     * Edit JK
     */
    function editJK() {

        if($this->input->post()) {
            $name = $this->input->post('jkName', true);
            $location = $this->input->post('location', true);
            $id = $this->input->post('id', true);
            $data = array (
                "name" => $name, 
                "location" => $location
            );
            $this->AdminModel->update('jk','id',$id, $data);
            
           redirect('admin/addJK');


        } else {
        $id = $this->input->get('id', TRUE);
        $data = $this->AdminModel->getrecordById('jk','id',$id);
        $this->loadView('admin/editJK',  $data);
        }

    }


    /**
     * deleteDuty
     * @param 1 : DutyId
     */
    function deleteDuty() {

        $id = $this->input->get('id', TRUE);
        $this->AdminModel->delete( 'duty_id', $id, 'duty');
        redirect('admin/addDuty');

    }

    function editDuty() {

        if($this->input->post()) {

            $name = $this->input->post('name', true);
            $description = $this->input->post('description', true);
            $id = $this->input->post('id', true);
            $beforeDuty = $this->input->post('beforeDuty', true);

            $this->AdminModel->updatePriority( $beforeDuty, $name, $description, $id );
            
            redirect('admin/addDuty');


        }

        $id = $this->input->get('id', TRUE);
        $data['duty'] = $this->AdminModel->getrecordById('duty','duty_id',$id);

        $data['duties'] = $this->AdminModel->getAllfromTableOrderBy('duty', 'priority', 'asc');


        $this->loadView('admin/editduty',  $data);
    }



    function ajaxUserHistory() {

        $userId=$this->input->post('state');

        $userHistory = $this->AdminModel->getUserHistory( $userId );

        
        $html = '<table class="table table-striped">
        <thead>
        <tr>
            <th> Name </th>
            <th> Duty </th>
            <th> Reason </th>
            <th> Date </th>
        </tr>
        </thead>
        <tbody>';
        

        foreach($userHistory as $row) { 


            $html = $html . '<tr>
                                <td> '. $row->first_name .' </td>
                                <td> '. $row->name .' </td>
                                <td> '. $row->reason .' </td>
                                <td> '. $row->start_date .' </td>
                            </tr>';

        }

        $html = $html . '<tbody></table>';

        echo $html;

    }



    function ajaxDutyByDate() {

        $date = $this->input->post('date');

        $duty = $this->AdminModel->getAssignDutyDetailByStartDate( $date );

        $html = '<table class="table table-striped" id="dutyTable">
        <thead>
        <tr>
            <th> User Name </th>
            <th> Duty Name  </th>
            <th> Jamat Khana </th>
            <th> Shift </th>
            <th> Date </th>

        </tr>
        </thead>
        <tbody>';




        foreach($duty as $row) { 

            $html = $html . '<tr>
                                <td>' . $row->first_name . ' </td>
                                <td>' . $row->dutyname . '</td>
                                <td>' . $row->jkname . '</td>
                                <td>' .  ($row->shift == 1? "Evening": ($row->shift == 2? "Morning" :"both"))   . '</td>
                                <td>' . $row->start_date . '</td>
                                <td>
                                    <a href="'. site_url('admin/editAssignDuty?id=' . $row->assign_id ) .'" ><span class="glyphicon glyphicon-pencil">
                                    </span> 
                                    </a>
                                </td>
                            </tr>';
        }

        $html = $html . '<tbody></table>';

        echo $html;

    }



    function assignedDuties() {
        $this->loadView('admin/assigned_duties', null);
    }

    
    function editAssignDuty() {

        if($this->input->post()) {

            $selectedUser = $this->input->post('selectedUser', true);

            $reason = $this->input->post('reason', true);

            $assignId = $this->input->post('assignId', true);

            $data = array (
                "user_id" => $selectedUser,
                "reason" => $reason
            );

            $this->AdminModel->update( 'assign_duty', 'assign_id', $assignId, $data );

            redirect('admin/assignedDuties');

        } else {

            $assignId = $this->input->get('id', TRUE);

            $user = $this->AdminModel->getUserByAssignedDuty( $assignId );

            if(count($user) <= 0 ) {
            redirect('admin/');
            }

            $data['assignId'] = $assignId;
            $data['user'] = $user;


            $this->loadView('admin/editAssignDuty', $data);

        }

    }


    public function addNewUser() {

        if($this->input->post()) {

            print_r($this->input->post());

            $firstName = $this->input->post('firstName', TRUE);
            $lastName = $this->input->post('lastName', TRUE);
            $email = $this->input->post('email', TRUE);
            $phone = $this->input->post('phone', TRUE);
            $password = md5($this->input->post('password', TRUE));
            $token = $this->AdminModel->generateToken();

            $data = array(
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'status' => 'false',
                'verified' => 'false',
                'type' => 'User',
                'token' => $token
            );

            $this->AdminModel->insert('user', $data);

            $emailMessage = "Please verify your account using this link \n".base_url()."index.php/Welcome/verify?token=".$token. " and your temporary password is " . $password ;

            mail($email,"User verification",$emailMessage);

            redirect('admin/');
            header('Location:http://waaranet.ca/index.php/Admin/index');
                   
        }

        $this->loadView('admin/addNewUser', null);
    }

   public function request() {   

    $data['result'] = $this->AdminModel->getRequest();
    $this->loadView('admin/request', $data);

       
    }

    public function deleteRequest() {

        $id = $this->input->get('id', TRUE);
        $this->AdminModel->delete( 'id', $id, 'request');
        redirect('admin/request');

    }


    public function updateStatus() {

        $id = $this->input->get('id', TRUE);
        $status = $this->input->get('status', TRUE);
        $status = ($status == 'true' ? 'false' : 'true' ); 
        $data =  array('status' =>   $status );
        $this->AdminModel->update( 'user', 'user_id', $id,  $data );
        redirect('admin/user');

    } 
    public function waaraNotification (){
        
        $currentDate = date ("d-m-Y");
        $day_after = date( 'Y-m-d', strtotime( $currentDate . ' +1 day' ) );
        $data['result'] = $this->AdminModel->getWaaraFromdate($day_after);
        $date=date_create($day_after);
        $date =  date_format( $date, "F j, Y");

        foreach ($data['result'] as $key => $value) {
            $name =  $value->first_name . " " .  $value->last_name; 
            $duty_name =  $value->duty_name; 
            $jk_name = $value->jk_name;
            $duty_description = $value->duty_description;
            $shift = $value->shift;
            $message = 'Dear \n'. $name . ', \n This is to remind you that you have a ' . $duty_name . ' Waara at '.$jk_name.' on: \n'.$date.'\n Please contact Waara Coordinator @ 403-999-9999 or email @ waara@franklinjk.ca  as soon as possible if you need to re-schedule \n Thank you, \n'. $jk_name .' WAARA Team' ;
            $email  = $value->email;
            mail( $email, "Waara Notification", $message);
        }
    }         
    public function exportPDF (){

         $dbData = $this->AdminModel->get_calendar_duties();
         $temp = [];
         $data['result'] = [['Fullname', 'JK Name', 'Waara Name', 'Date'],[' ', ' ', ' ', ' ']];

         foreach ($dbData as $key => $value) {
            $name = $value->first_name . " " . $value->last_name;
            array_push($temp,  $name);
            array_push($temp,  $value->jk_name);
            array_push($temp,  $value->duty_name);
            array_push($temp,  $value->start_date);
            array_push($data['result'],  $temp);

         }
        
        $this->loadView('admin/exportPDF', $data );

    }

    public function updateVerify() {

        $id = $this->input->get('id', TRUE);
        $verified = $this->input->get('verified', TRUE);
        $verified = ($verified == 'true' ? 'false' : 'true' ); 
        $data =  array('verified' =>   $verified );
        $this->AdminModel->update( 'user', 'user_id', $id,  $data );
        redirect('admin/user');

    } 
}
?>