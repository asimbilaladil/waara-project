<?php
class Majalis extends CI_Controller {

    public function __construct(){
        parent::__construct();

            $this->load->model('MajalisModel'); 
            $this->load->model('MajalisDataModel'); 
            $this->load->helper('string');
            $this->load->helper('custom_helper');
            $this->load->library('user_agent');
    }

    /**
     * Index
     * Created By: Moiz
     */
    function index(){
      $majalisWithDates = $this->MajalisModel->getMajalisWithDates();

      $majalisArray = array();

      foreach ($majalisWithDates as $majalis) {
       
        $index = getIndexOf($majalisArray, 'id', $majalis->id);
        $majalisMonth = getMonthFromDate($majalis->date);
        $date = date("d",strtotime($majalis->date));
        $completeDate = $majalis->date;
        $dateToken = $majalis->dateToken;

        $dateItem = array(
          'date' => $date,
          'completeDate' => $completeDate,
          'dateToken' => $dateToken
        );

        if ($index > -1) {
          
          if (!isset($majalisArray[$index][$majalisMonth])) {
            $majalisArray[$index][$majalisMonth] = array();
          }

          array_push($majalisArray[$index][$majalisMonth], $dateItem);
          
        } else {
          $dateArray = array();
          $item['id'] = $majalis->id;
          $item['majalisName'] = $majalis->name;
          $item['token'] = $majalis->token;

          array_push($dateArray, $dateItem);
          $item[$majalisMonth] = $dateArray;

          array_push($majalisArray, $item);

        }

      }

      //echo json_encode($majalisArray);
      //print_r($majalisArray);
      //die;
    
      $this->loadView('admin/majalis/view_majalis', $majalisArray);        
    }

    /**
     * Majalis Detail
     * Created By: Moiz
     */  
    function detail() {

      if($this->input->get('token')) {
        $token = $this->input->get('token');
        $result = $this->MajalisModel->getMajlisAndDatesByToken($token);
        $this->loadView('admin/majalis/detail_majalis', $result);
      } else {
        redirect('majalis/');
      }

    }

    /**
     * Delete Majalis by date
     * Created By: Moiz
     */  
    function deleteMajalidDate() {

      if($this->input->get('token')) {
        $token = $this->input->get('token');
        $this->MajalisModel->deleteMajalisDateByToken($token);
        redirect($this->agent->referrer());
      } else {
        redirect($this->agent->referrer());
      }

    }

    /**
     * Add date in Majalis
     * Created By: Moiz
     */ 
    function addDateInMajalis() {

      $token = $this->input->post('token', true);
      $date = $this->input->post('date', true);
      $adminId = $this->session->userdata('user_id');
      $result = $this->MajalisModel->getMajalisByToken($token);

      $dateModel = array (
          'majalis_id' => $result->id,
          'date' => $date,
          'admin_id' => $adminId,
          'token'=> random_string('unique', 30)
      );

      $dateId = $this->MajalisModel->insertMajalisDates($dateModel);
      redirect('majalis/detail?token=' . $token);

    }

    /**
     * Add Majalis
     * Created By: Moiz
     */  
    function add() {
      $this->loadView('admin/majalis/add_majalis', null);
    }

    /**
     * Add Majalis
     * Created By: Moiz
     */  
    function addMajalis() {   
    
      if($this->input->post()) {

        $majalisName = $this->input->post('majalisName', true);
        $adminId = $this->session->userdata('user_id');
        $duties = $this->input->post('duties', true);
        $majalisDate = $this->input->post('majalisDate', true);

        $majalisModel = array (
          'name' => $majalisName,
          'admin_id' => $adminId,
          'token'=> random_string('unique', 30)
        );

        $majalis_id = $this->MajalisModel->insert($majalisModel);

        foreach($duties as $duty) {

          $dutyModel = array (
            'name' => $duty,
            'majalis_id' => $majalis_id,
            'admin_id' => $adminId,
            'token'=> random_string('unique', 30)
          );

          $dutyId = $this->MajalisModel->insertMajalisDuties($dutyModel);

        }

        foreach($majalisDate as $date) {

          $dateModel = array (
              'majalis_id' => $majalis_id,
              'date' => $date,
              'admin_id' => $adminId,
              'token'=> random_string('unique', 30)
          );

          $dateId = $this->MajalisModel->insertMajalisDates($dateModel);
        }
        
        redirect("Majalis");
      }

    }

    /**
     * Edit Majalis Date
     * Created By: Moiz
     */      
    function editMajalisDate() {

      if ($this->input->post()) {

        $data = array(
          'date' => $this->input->post('value')
        );

        $result = $this->MajalisModel->updateMajalisDate($this->input->post('pk'), $data);
        echo json_encode(array('success' => $result));
      }

    }

    function viewMajalisDuties() {

      if($this->input->get('token')) {
        $token = $this->input->get('token');
        $date = $this->input->get('date');
        $majalis = $this->MajalisModel->getMajalisByToken($token);
        $duties = $this->MajalisModel->getDutiesForDateOrMajalis($majalis->id, $date);
        $this->loadView('admin/majalis/view_duties', $duties);

      } else {
        redirect('majalis/');
      }

    }

    function deleteMajalisDuty() {
      if($this->input->get('token')) {
        $token = $this->input->get('token');
        $this->MajalisModel->deleteMajalisDutyByToken($token);
        redirect($this->agent->referrer());
      } else {
        redirect($this->agent->referrer());
      }      
    }
    

/*********************************************** OLD WORK ***********************************************/

    /**
     * Majalis Home
     */ 
  
    function home(){
        
        $majalisId = $this->session->userdata('majalis_id');
        $type = $this->session->userdata('type');
      
        //if majalis id is set in session. and user type is majalis admin
        if( isset( $majalisId ) && $type == 'Majalis Admin' )  {

            $data['majalis'] = $this->MajalisModel->getMajalisById( $majalisId );
            $data['majalis_waara'] = $this->MajalisModel->getMajalisWaara($majalisId);

        } else if($type == 'Super Admin') {

            $data['majalis'] = $this->MajalisModel->getAllMajalis('majalis');
            if( count( $data['majalis'] ) > 0 ){
                $majalisId = $data['majalis'][0]->id;
                $data['majalis_waara'] = $this->MajalisModel->getMajalisWaara($majalisId);
            }

        }      
       // $data['majalis'] = $this->MajalisModel->getAllMajalis();
        //$this->loadView('admin/majalisHome', $data );
    }
    
    /**
     * Add / View Majalis Waara
     */  
    function addWaara() {   
      
   if($this->input->post()) {

          $beforeDuty = $this->input->post('beforeDuty', true);

          //Date or for_all to add duty for specific day only
          $addDutyDate =  $this->input->post('addDutyDate', true);
          $admin_id = $this->session->userdata('user_id');
          $token =  random_string('unique', 30);
          $majalis_token =  $this->input->post('majalis_token', true);
          //insert and update priority
          $data['id'] = $this->MajalisDataModel->getAllIds($majalis_token);
          $counter = 0 ;
          foreach(  $data['id']  as $item ) {
             if($counter == 0){
                $counter = 1;
                $this->MajalisDataModel->updateDutyByOrder($beforeDuty, $this->input->post('duty_name', true), $this->input->post('description', true), 'all',$admin_id,$token, $item->id );

             }
          }
         

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

//         $jamatKhanas = $this->AdminModel->getJamatKhana();

//         $jkArray = array();

//         //populate array with Id as key and value
//         foreach($jamatKhanas as $item => $value) {
//             $jkArray[$value->id] = $value->name;
//         }

        $data['majalis_token'] = $this->uri->segment(4);
        $data['waara'] = $this->MajalisDataModel->getAllfromTableOrderBy( $data['majalis_token'] );


//         $data['jkArray'] = $jkArray;
//         $data['jkDb'] = $jamatKhanas;

       $this->loadView('admin/addMajalisWaara', $data);

    }
  
    /**
     * Delete Majalis Dates
     */  
    function deleteMajalisDate() {   
      
        if($this->input->get()) {

            $data = array (
                'id' => $this->input->get('majalis_id', true)
            );
            $this->MajalisDataModel->delete( $data );
            redirect("Majalis");
        }

    }
  
    /**
     * Delete Majalis
     */  
    function deleteMajalis() {   
      
        if($this->input->get()) {

            $data = array (
                'id' => $this->input->get('majalis_id', true)
            );
            $this->MajalisDataModel->delete( $data );
            redirect("Majalis");
        }

    }
    /**
     * Add Majalis Date
     */  
    function addMajalisDate() {   
      
            if($this->input->post()) {
              $majalis_token= $this->input->post('majalis', true);
              $majalis_data = $this->MajalisModel->getMajalisByToken($majalis_token);

                $data = array (
                    'date' => $this->input->post('majalisDate', true),
                    'admin_id' => $this->session->userdata('user_id'),
                    'token'=> random_string('unique', 30),
                    'majalis_id' => $majalis_data->id
                );
              $this->MajalisDataModel->insert( $data );
              redirect("Majalis/".$majalis_data->name.'/'.$majalis_token);
            }
      
            $token =  $this->uri->segment(3);
            $majalisName =  $this->uri->segment(2);
            $data['majalis'] = $this->MajalisDataModel->getAllMajalisDates($token);
            $data['token'] = $token;
            $this->loadView('admin/addMajalisDates', $data );            

    }  
  
  
    /**
     * Load view 
     * @param 1 : view name
     * @param 2 : data to be render on view. If no data pass null
     */
    function loadView($view, $data) {

        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view($view, array('data' => $data));
        $this->load->view('admin/common/footer');

    }

}
?>