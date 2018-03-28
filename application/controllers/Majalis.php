<?php
class Majalis extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model('MajalisModel'); 
        $this->load->model('FestivalMajalisModel'); 
        $this->load->model('MajalisDataModel'); 
        $this->load->model('MajalisSortModel'); 
        $this->load->model('MajalisDateModel'); 
        $this->load->helper('string');
        $this->load->helper('custom_helper');
        $this->load->library('user_agent');
        
    }

    /**
     * Index
     * Created By: Moiz
     */
    function index() {

      $festivalYears = $this->MajalisModel->getFestivalDutiesByYear();
      $years = $this->MajalisModel->getDutiesByYear();
      
      $data = array(
        'years' => $years,
        'festivalYears' => $festivalYears
      );
      
      $this->loadView('admin/majalis/view_majalis', $data);

    }

    /**
     * View global duties
     * Created By: Moiz
     */
    function viewGlobalDuties() {

      $token = $this->input->get('token');

      if ($token) {

        $result = $this->MajalisModel->getGlobalDuties($token);  

        $this->loadView('admin/majalis/global_duties', null);

      } else {
        redirect($this->agent->referrer());
      }

    }

    function getGlobalDuties() {

      $token = $this->input->get('token');
      $result = $this->MajalisModel->getGlobalDuties($token);

      $html = '';

      foreach ($result as $row) { 
        $deleteUrl = site_url('Majalis/deleteMajalisDutyById?id=' . $row->dutyid);
        $editDutyUrl = site_url('Majalis/editMajalisDuty');
        $html = $html . '<tr>
            <td> '. $row->name .' </td>
            <td class="majalisId_'. $row->majalisId .'" > <a href="'. $deleteUrl .'" onclick="return confirm(`Are you sure you want to Delele?`);" > <span class="glyphicon glyphicon-trash"></span></a> </td>

            <td class="majalisId_'. $row->majalisId .'" > <a href="#" name="editDuty" data-type="text" data-pk="'. $row->dutyid .'" data-value="'. $row->name .'" data-url="'. $editDutyUrl .'"> EDIT  </a> </td>                                                

        </tr>';    
      } 

      echo $html;     

    }

    function deleteMajalisDutyById() {
      $id = $this->input->get('id');
      $this->MajalisModel->deleteMajalisDuty($id);
      redirect($this->agent->referrer());
    }


    /**
     * get Majalis by year
     * Created By: Moiz
     */
    function getMajalisByYear() {

      $year = $this->input->post('year');
      $majalisData = $this->FestivalMajalisModel->getMajalisForTable($year);

      $html = '';

      foreach ($majalisData as $item) {

        $deleteUrl = site_url('majalis/deleteMajalis?token=' . $item["token"]);
        $viewDutiesUrl = site_url("majalis/viewMajalisDates?token=" . $item["token"]);
        $editMajalisUrl = site_url("majalis/editMajalis");

        $html = $html . '<tr>
            <td> <a href="' . $viewDutiesUrl . '">' . $item["majalisName"] . '</a> </td>
            <td> ' . $this->printMonthMajalis($item, "January") . ' </td>
            <td> ' . $this->printMonthMajalis($item, "February") . ' </td>
            <td> ' . $this->printMonthMajalis($item, "March") . ' </td>
            <td> ' . $this->printMonthMajalis($item, "April") . ' </td>
            <td> ' . $this->printMonthMajalis($item, "May") . ' </td>
            <td> ' . $this->printMonthMajalis($item, "June") . ' </td>
            <td> ' . $this->printMonthMajalis($item, "July") . ' </td>
            <td> ' . $this->printMonthMajalis($item, "August") . ' </td>
            <td> ' . $this->printMonthMajalis($item, "September") . ' </td>
            <td> ' . $this->printMonthMajalis($item, "October") . ' </td>
            <td> ' . $this->printMonthMajalis($item, "November") . ' </td>
            <td> ' . $this->printMonthMajalis($item, "December") . ' </td>
            <td class="majalisId_'. $item["id"] .'" > <a href="'. $deleteUrl .'" onclick="return confirm(`Are you sure you want to Delele?`);" > <span class="glyphicon glyphicon-trash"></span></a> </td>

            <td class="majalisId_'. $item["id"] .'" > <a href="#" name="editMajalis" data-type="text" data-pk="'. $item["token"] .'" data-value="'. $item["majalisName"] .'" data-url="'. $editMajalisUrl .'"> EDIT  </a> </td>

        </tr>';

      }

      echo $html;

    }

    function printMonthMajalis($item, $month) {
        $str = '';
        if (isset($item[$month])) {
            foreach($item[$month] as $m) {
                if(!empty($m['date'])) {
                  $dutyUrl = site_url('majalis/viewMajalisDates?token=' . $item["token"] .'&date='. $m['completeDate']);
                  $str = $str . '<a href="'. $dutyUrl .'">'. $m['date'] .'</a> <br>';                  
                } else {
                  $addUrl = site_url('majalis/viewMajalisDates?token=' . $item["token"]);
                  $str = '<a href="'. $addUrl .'"> ADD </a>';
                }
                        
            }
        } else {
            $addUrl = site_url('majalis/viewMajalisDates?token=' . $item["token"]);
            $str = '<a href="'. $addUrl .'"> ADD </a>';
        }
        return $str;
    }


    /**
     * view majalis dates
     * Created By: Moiz
     */  
    function viewMajalisDates() {

      if($this->input->get('token')) {
        $token = $this->input->get('token');
        $years = $this->MajalisModel->getDutiesYear($token);
        $majalis = $this->MajalisModel->getMajalisByToken($token);

        $data = array(
          'years' => $years,
          'majalis' => $majalis
        );

        $this->loadView('admin/majalis/view_majalis_dates', $data);

      } else {
        redirect('majalis/');
      }

    }

    /**
     * get majalis dates by year
     * Created By: Moiz
     */
    function getMajalisDateByYear() {

      $token = $this->input->post('token');
      $year = $this->input->post('year');

      $dates = $this->MajalisModel->getMajalisDatesByYear($token, $year);

      $majalisId = '';

      $html = '<thead>
                <tr>
                    <th> Date </th>
                    <th> Action </th>
                </tr>
              </thead>
              <tbody>';


      foreach ($dates as $key => $item) {

        $majalisId = $item->id;
        $dutiesUrl = site_url('Majalis/viewMajalisDuties?token=' . $item->token . '&date=' . $item->date);

        $html = $html . '<tr>
        <td> <a href="'. $dutiesUrl .'">' . $item->date . '</a> </td>
        <td class="majalisId_'. $item->id .'"> 

        <a href="deleteMajalisDate?token=' . $item->token . '" onclick="return confirm(`Are you sure you want to Delele?`);" > <span class="glyphicon glyphicon-trash"></span></a> 

        </td>

        <td class="majalisId_'. $item->id .'" > <a href="#" id="date_'.$key.'" name="editDate"  data-type="date" data-pk="'. $item->dateId .'" data-url="editMajalisDate" data-title="Select date" data-value="'. $item->date .'" >EDIT</a> </td>
        <td>

        </tr>';
        
      }   

    
      echo $html;          

    }


    function addMajalisDate() {

      if ($this->input->post()) {

        $token = $this->input->post('token');
        $date = $this->input->post('date', true);
        $adminId = $this->session->userdata('user_id');
        $result = $this->MajalisModel->getMajalisByToken($token);

        $data = array (
          'admin_id' => $adminId,
          'majalis_id' => $result->id,
          'date' => $date,
          'token' => random_string('unique', 30)
        );

        $this->MajalisModel->insertMajalisDates($data);

        redirect('majalis/viewMajalisDates?token=' . $token);

      }

    }


    /**
     * Delete Majalis by date
     * Created By: Moiz
     */  
    function deleteMajalisDate() {

      if($this->input->get('token')) {
        $token = $this->input->get('token');

        $majalisId = $this->MajalisDateModel->getMajalisIdFromDateByToken($token);

        $allow = $this->MajalisModel->allowEditDelete($majalisId);
        
        if ($allow) {  
          $this->MajalisModel->deleteMajalisDateByToken($token);
        }

        redirect($this->agent->referrer());
      } else {
        redirect($this->agent->referrer());
      }

    }



    /**
     * Delete Majalis by date
     * Created By: Moiz
     */  
    function deleteFestivalDuty() {

      if ($this->input->get('token')) {
        $token = $this->input->get('token');
        $this->MajalisModel->deleteFestivalDuty($token);
        redirect($this->agent->referrer());
      } else {
        redirect($this->agent->referrer());
      }

    }

    /**
     * Delete Majalis
     * Created By: Moiz
     */  
    function deleteMajalis() {

      if($this->input->get('token')) {
        $token = $this->input->get('token');

        $majalis = $this->MajalisModel->getMajalisByToken($token);

        if($majalis) {
          $this->MajalisModel->deleteMajalisWithDutiesAndDates($majalis->id);  
        }

        redirect($this->agent->referrer());
      } else {
        redirect($this->agent->referrer());
      }

    }
  

    /**
     * Add duty in Majalis
     * Created By: Moiz
     */ 
    function addDuty() {

      $token = $this->input->post('token', true);
      $id = $this->input->post('id', true);
      $duty = $this->input->post('duty', true);
      $date = $this->input->post('date', true);
      $adminId = $this->session->userdata('user_id');

      if ($token) {
        $id = $this->MajalisModel->getMajalisByToken($token)->id;  
      }

      $dutyModel = array (
        'name' => $duty,
        'admin_id' => $adminId,
        'token'=> random_string('unique', 30),
        'majalis_id' => $id,
        'type' => $date ? 'SPECFIC' : 'GLOBAL'
      );

      if ($date) {

        // $maxSort = $this->MajalisSortModel->getMaxSort($date);
        // $maxSort++;

        $dutyId = $this->MajalisModel->insertMajalisDuties($dutyModel);

        $this->MajalisModel->insertDutyOnSpecfic(array(
          'date' => $date,
          'duty_id' => $dutyId,
          'type' => 'MAJALIS'
        ));

        // $sortDutyData = array(
        //   'date' => $date,
        //   'duty_id' => $dutyId,
        //   'sort' => $maxSort,
        //   'type' => 'SPECFIC'
        // );

        // $this->MajalisSortModel->insert($sortDutyData);        

        redirect('majalis/viewMajalisDuties?token=' . $token . '&date=' . $date);

      } else {

        $dutyId = $this->MajalisModel->insertMajalisDuties($dutyModel);

        redirect('majalis/viewMajalisDates?token=' . $token);

      }

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
        $override = $this->input->post('override') ? 1 : 0;

        $majalisModel = array (
          'name' => $majalisName,
          'admin_id' => $adminId,
          'token' => random_string('unique', 30),
          'override' => $override
        );

        $majalis_id = $this->MajalisModel->insert($majalisModel);

        if ($duties) {

          foreach($duties as $duty) {

            if (!empty($duty)) {
              $dutyModel = array (
                'name' => $duty,
                'majalis_id' => $majalis_id,
                'admin_id' => $adminId,
                'token'=> random_string('unique', 30),
                'type' => 'GLOBAL'
              );

              $dutyId = $this->MajalisModel->insertMajalisDuties($dutyModel);            
            }
          }
        }

        if ($majalisDate) {

          foreach($majalisDate as $date) {

            if (!empty($date)) {

              $dateModel = array (
                  'majalis_id' => $majalis_id,
                  'date' => $date,
                  'admin_id' => $adminId,
                  'token'=> random_string('unique', 30)
              );

              $dateId = $this->MajalisModel->insertMajalisDates($dateModel);
            }

          }

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

        $id = $this->input->post('pk');

        $majalisId = $this->MajalisDateModel->getMajalisIdFromDateById($id);

        $allow = $this->MajalisModel->allowEditDelete($majalisId);

        if ($allow) {

          $data = array(
            'date' => $this->input->post('value')
          );

          $result = $this->MajalisModel->updateMajalisDate($id, $data);

          echo json_encode(array('success' => $result));

        }

        
      }

    }

    /**
     * edit majalis override
     * Created By: Moiz
     */ 
    function editMajalisOverride() {

      if ($this->input->post()) {

        $token = $this->input->post('token');

        $data = array(
          'override' => $this->input->post('override')
        );

        $result = $this->MajalisModel->updateMajalis($token, $data);
        echo json_encode(array('success' => $result));

      }

    }


    /**
     * Edit majalis duty
     * Created By: Moiz
     */ 
    function editFestivalDuty() {

      if ($this->input->post()) {

        $data = array(
          'duty' => $this->input->post('value')
        );

        $result = $this->MajalisModel->updateFestivalDuty($this->input->post('pk'), $data);
        echo json_encode(array('success' => $result));
      }

    }

    /**
     * Edit Festival Date
     * Created By: Moiz
     */      
    function editFestivalDate() {
      if ($this->input->post()) {

        $data = array(
          'date' => $this->input->post('value')
        );

        $result = $this->MajalisModel->updateFestivalDate($this->input->post('pk'), $data);
        echo json_encode(array('success' => $result));
      }      
    }

    /**
     * Edit Majalis Duty Name
     * Created By: Moiz
     */
    function editMajalisDuty() {

      if ($this->input->post()) {

        $id = $this->input->post('pk');

        $data = array(
          'name' => $this->input->post('value')
        );

        $result = $this->MajalisModel->updateMajalisDuty($id, $data);
        echo json_encode(array('success' => $result));
      }

    }

    function editMajalis() {

      if($this->input->post()) {

        $token = $this->input->post('pk');

        $data = array(
          'name' => $this->input->post('value')
        );

        $result = $this->MajalisModel->updateMajalis($token, $data);
        echo json_encode(array('success' => $result));        

      }

    }

    /**
     * Edit Festival Name
     * Created By: Moiz
     */    
    function editFestival() {

      if($this->input->post()) {

        $token = $this->input->post('pk');

        $data = array(
          'festival' => $this->input->post('value')
        );

        $result = $this->MajalisModel->updateFestival($token, $data);
        echo json_encode(array('success' => $result));        

      }

    }  

    function viewMajalisDuties() {

      if($this->input->get('token')) {
        $token = $this->input->get('token');
        $date = $this->input->get('date');
        $majalis = $this->MajalisModel->getMajalisByToken($token);

        if ($majalis) {

          $this->loadView('admin/majalis/view_duties', array('majalis' => $majalis ));

        } else {
          redirect('majalis/');
        }

      } else {
        redirect('majalis/');
      }

    }

    function deleteMajalisDuty() {
      if($this->input->get('token')) {
        
        $token = $this->input->get('token');
        $duty = $this->MajalisModel->getDutyByToken($token);
        $dutyId = $duty->id;

        $this->MajalisModel->deleteMajalisDutyByToken($token);
        $this->MajalisModel->deleteDutyForSpecficDate($dutyId, 'MAJALIS');

        redirect($this->agent->referrer());
      } else {
        redirect($this->agent->referrer());
      }      
    }
    

    function viewDutyAssign() {
      $this->loadView('admin/majalis/assign_majalis_duty', null);
    }

    function assginMajalisDuty() {

      if($this->input->post()) {

        $selectedUserId = $this->input->post('selectedUser', true);
        $selectedDutyId = $this->input->post('selectedDuty', true);
        $token = $this->input->post('token', true);
        $date = $this->input->post('date', true);
        $adminId = $this->session->userdata('user_id');

        $data = array (
          'duty_id' => $selectedDutyId,
          'user_id' => $selectedUserId,
          'token' => random_string('unique', 30),
          'admin_id' => $adminId 
        );

        $this->MajalisModel->insertAssignMajalisDuty($data);

        redirect('majalis/viewMajalisDuties?token=' . $token . '&date=' . $date);

      }

    }


    function sortMajalisDuties() {

      if($this->input->post()) {

        $selectedDate = $this->input->post('selectedDate');
        $duties = $this->input->post('duties');        

        $this->MajalisSortModel->deleteSortByDate($selectedDate);

        $sort = 0;
        
        foreach ($duties as $duty) {

          $sort++;

          $dutyData = array(
            'date' => $selectedDate,
            'duty_id' => $duty,
            'sort' => $sort,
            'type' => 'SPECFIC'
          );

          $this->MajalisSortModel->insert($dutyData);

        }

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
     * Load view 
     * @param 1 : view name
     * @param 2 : data to be render on view. If no data pass null
     */
    function loadView($view, $data) {

        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view($view, array('data' => $data));
        $this->load->view('admin/common/footer');
        $this->load->view('admin/common/allow_access');

    }

}
?>