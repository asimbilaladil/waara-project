<?php
class Festival extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('string');
        $id = $this->session->userdata('user_id');
        $type = $this->session->userdata('type');
        
        if( $id != NULL  && $type != 'User' ) {
            $this->load->model('FestivalModel'); 
            $this->load->model('UserModel'); 
            $this->load->model('FestivalMajalisModel'); 
            $this->load->model('FestivalSortModel'); 
            $this->load->library('user_agent');
            $this->load->helper('custom_helper');
        } else {
            redirect('Login/');
        }      
    }

    /**
     * Index
     * Created By: Moiz
     */
    function index() {

      $festivalData = $this->FestivalMajalisModel->getFestivalForTable();
      $data = array(
        'festival' => $festivalData,
      );
      
      $this->loadView('admin/festival/view_festival', $data);      
    }


    /**
     * get Festival by year
     * Created By: Moiz
     */
    function getFestivalByYear() {
      $year = $this->input->post('year');
      $festivalData = $this->FestivalMajalisModel->getFestivalForTable($year);

      $html = '';

      foreach ($festivalData as $item) {

        $deleteUrl = site_url('festival/deleteFestival?token=' . $item["token"]);
        $editMajalisUrl = site_url("majalis/editFestival");
        $addUrl = site_url('Festival/viewFestivalDates?token=' . $item["token"]);
        $html = $html . '<tr>
            <td> <a href="' . site_url("festival/viewFestivalDates?token=" . $item["token"]) . '">' . $item["festivalName"] . '</a> </td>
            <td> ' . $this->printMonthFestival($item, "January") . ' </td>
            <td> ' . $this->printMonthFestival($item, "February") . ' </td>
            <td> ' . $this->printMonthFestival($item, "March") . ' </td>
            <td> ' . $this->printMonthFestival($item, "April") . ' </td>
            <td> ' . $this->printMonthFestival($item, "May") . ' </td>
            <td> ' . $this->printMonthFestival($item, "June") . ' </td>
            <td> ' . $this->printMonthFestival($item, "July") . ' </td>
            <td> ' . $this->printMonthFestival($item, "August") . ' </td>
            <td> ' . $this->printMonthFestival($item, "September") . ' </td>
            <td> ' . $this->printMonthFestival($item, "October") . ' </td>
            <td> ' . $this->printMonthFestival($item, "November") . ' </td>
            <td> ' . $this->printMonthFestival($item, "December") . ' </td>
            <td> <a href="'. $deleteUrl .'" onclick="return confirm(`Are you sure you want to Delele?`);" > <span class="glyphicon glyphicon-trash"></span></a> </td>

            <td> <a href="#" name="editFestival" data-type="text" data-pk="'. $item["token"] .'" data-value="'. $item["festivalName"] .'" data-url="'. $editMajalisUrl .'"> EDIT  </a> </td>

            <td> <a href="'. $addUrl .'"> ADD </a </td>
            
        </tr>';
      }

      echo $html;

    }

    /**
     * print month of festival
     * Created By: Moiz
     */
    function printMonthFestival($item, $month) {
        $str = '';
        if (isset($item[$month])) {
            foreach($item[$month] as $m) {
                $dutyUrl = site_url('Festival/viewFestivalDates?token=' . $item["token"] .'&date='. $m['completeDate']);
                $str = $str . '<a href="'. $dutyUrl .'">'. $m['date'] .'</a> <br>';        
            }
        } else {
            $str = ' - ';
        }
        return $str;
    }            

    /**
     * Add festival view
     * Created By: Moiz
     */
    function add() {
        $this->loadView('admin/festival/add_festival', null); 
    }

    /**
     * Insert Festival in DB
     * Created By: Moiz
     */
    function addFestival() {
    
        if($this->input->post()) {

            $festivalName = $this->input->post('festivalName', true);
            $adminId = $this->session->userdata('user_id');
            $duties = $this->input->post('duties', true);
            $festivalDate = $this->input->post('festivalDate', true);
            $override = $this->input->post('override') ? 1 : 0;

            $festivalModel = array (
              'festival' => $festivalName,
              'admin_id' => $adminId,
              'token' => random_string('unique', 30),
              'override' => $override
            );

            $festival_id = $this->FestivalModel->insertFestival($festivalModel);

            if ($duties) {

              foreach($duties as $duty) {
 
                if (!empty($duty)) {
                  $dutyModel = array (
                      'duty' => $duty,
                      'festival_id' => $festival_id,
                      'admin_id' => $adminId,
                      'token' => random_string('unique', 30),
                      'type' => 'GLOBAL'
                  );

                  $dutyId = $this->FestivalModel->insertFestivalDuties($dutyModel);

                }

              }

            }

            if ($festivalDate) {

              foreach($festivalDate as $date) {
                
                if(!empty($date)) {                
                  $dateModel = array (
                      'festival_id' => $festival_id,
                      'date' => $date,
                      'admin_id' => $adminId,
                      'token'=> random_string('unique', 30)
                  );

                  $dateId = $this->FestivalModel->insertFestivalDates($dateModel);
                }
              }
            }

            redirect("Majalis");
        } else {
            redirect("Majalis");
        }        
    }

    function assginFestivalDuty() {

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

        $this->FestivalModel->insertAssignFestivalDuty($data);

        redirect('festival/viewFestivalDuties?token=' . $token . '&date=' . $date);

      }      

    }

    /**
     * Insert Duty in DB
     * Created By: Moiz
     */
    function addDuty() {

      $token = $this->input->post('token', true);
      $duty = $this->input->post('duty', true);
      $date = $this->input->post('date', true);
      $adminId = $this->session->userdata('user_id');
      $result = $this->FestivalModel->getFestivalByToken($token);


      $dutyModel = array (
        'festival_id' => $result->id,
        'duty' => $duty,
        'admin_id' => $adminId,
        'token'=> random_string('unique', 30),
        'type' => ($date ? 'SPECFIC' : 'GLOBAL' )
      );

      if ($date) {

        $dutyId = $this->FestivalModel->insertFestivalDuties($dutyModel);

        $this->FestivalModel->insertDutyOnSpecfic(array(
          'date' => $date,
          'type' => 'FESTIVAL',
          'duty_id' => $dutyId
        ));

        redirect('festival/viewFestivalDuties?token=' . $token . '&date=' . $date);

      } else {

        $dutyId = $this->FestivalModel->insertFestivalDuties($dutyModel);
        redirect('festival/viewFestivalDuties?token=' . $token);

      }

    }


    function editFestival() {

      if($this->input->post()) {

        $token = $this->input->post('token');

        $data = array(
          'override' => $this->input->post('override')
        );

        $result = $this->FestivalModel->updateFestival($token, $data);
        echo json_encode(array('success' => $result));        

      }

    } 

    /**
     * view festival dates
     * Created By: Moiz
     */  
    function viewFestivalDates() {

      if($this->input->get('token')) {
        $token = $this->input->get('token');
        $result = $this->FestivalModel->getFestivalAndDatesByToken($token);
        $this->loadView('admin/festival/view_festival_dates', $result);
      } else {
        redirect('majalis/');
      }

    }


    /**
     * Delete Festival by date
     * Created By: Moiz
     */  
    function deleteFestivalDate() {

      if($this->input->get('token')) {
        $token = $this->input->get('token');
        $this->FestivalModel->deleteFestivalDateByToken($token);
        redirect($this->agent->referrer());
      } else {
        redirect($this->agent->referrer());
      }

    }

    /**
     * Add Festival Date
     * Created By: Moiz
     */      //
    function addFestivalDate() {

      if ($this->input->post()) {

        $token = $this->input->post('token');
        $date = $this->input->post('date', true);
        $adminId = $this->session->userdata('user_id');
        $result = $this->FestivalModel->getFestivalByToken($token);

        $data = array (
          'admin_id' => $adminId,
          'festival_id' => $result->id,
          'date' => $date,
          'token' => random_string('unique', 30)
        );

        $this->FestivalModel->insertFestivalDates($data);

        redirect('Festival/viewFestivalDates?token=' . $token);

      }

    }

    /**
     * View Festival duties Global/Local
     * Created By: Moiz
     */
    function viewFestivalDuties() {

      if($this->input->get('token')) {        

        $this->loadView('admin/festival/view_festival_duties', null);
      
      } else {
        redirect('festival/');
      }

    }

    /**
     * Delete festival duty
     * Created By: Moiz
     */
    function deleteFestivalDuty() {
      if($this->input->get('token')) {
        
        $token = $this->input->get('token');
        $duty = $this->FestivalModel->getDutyByToken($token);
        $dutyId = $duty->id;

        $this->FestivalModel->deletFestivalDutyByToken($token);
        $this->FestivalModel->deleteDutyForSpecficDate($dutyId, 'FESTIVAL');

        redirect($this->agent->referrer());
      } else {
        redirect($this->agent->referrer());
      }      
    }    


    function ajaxGetFestivalDuties() {

        $date = $this->input->post('date');
        $majalisBoxHideShow =  '<script>$(".majalisBox").hide()</script>';
        $userIds = array();

        $html = '<table class="table table-striped" id="festivalDutyTable">
        <thead>
        <tr>
            <th> Duty </th>
            <th> User Fullname </th>
            <th> Action </th>
        </tr>
        </thead>
        <tbody>';

        $result = $this->FestivalModel->getDutiesByDate($date);

        $specficDates = $this->FestivalModel->getDutiesFromSpecficTable($date);

        foreach($specficDates as $item) {
            array_push($result, $item);
        }

        foreach ($result as $value) {

            if ($value->user_id) {
                $user = $user = $this->UserModel->getUserbyId($value->user_id);    
                $value->firstName = $user->first_name;
                $value->lastName = $user->last_name;    
            }

        }

        //sorting by order
        usort($result, function($a, $b) {
            return $a->sort > $b->sort;
        });        

        foreach($result as $key => $row) {
            $majalisBoxHideShow =  '<script>$(".majalisBox").show()</script>';
            $assigned = $row->user_id != null ? true : false;

            if ($assigned) {

                $name = $row->firstName . ' ' . $row->lastName;
                $viewUrl = site_url('Festival/viewDuty?id=' . $row->id . '&date=' . $row->date );
                $html = $html . '<tr>
                <td style="display:none;">'. $row->id .'</td>
                <td> '. strtoupper($row->duty) .' </td>
                <td> '. $name  .' </td>
                <td> <a href="'. $viewUrl .'"> <button class="btn btn-primary">View</button> </a> </td>
                <td><button class="btn btn-primary">Edit</button> </td>
                <td> <button id="dutyRating_'. $row->assignId .'" data-toggle="modal" 
                onclick="setAssignFestivalDutyId('. $row->assignId .',0)" data-target="#userFestivalDutyRating" class="btn btn-primary">Rating</button> </td>';  

            } else {
                $html = $html . '<tr>
                <td style="display:none;">'. $row->id .'</td>
                <td> '. strtoupper($row->duty) .' </td>
                <td> <input type="text" id="festivalDutyUsers_'. $key .'" name="festivalUsers" class="form-control  ui-autocomplete-input"> </td>
                <td> <button class="btn btn-primary" onclick="ajaxCallUserHistoryForFestival('. $row->id .')">SAVE</button> </td>
                <td> '.  $assigned .' </td>';                
            }

        }
        $html = $html .$majalisBoxHideShow;
        echo $html;

    }


    function assignDuty() {

        if ($this->input->post()) {

            $fromViewDuties = $this->input->post('fromViewDuties') ? true : false;

            $selectedUserId = $this->input->post('selectedFestivalUser', true);
            $selectedDutyId = $this->input->post('selectedFestivalDuty', true);
            $festivalDate = $this->input->post('festivalDate', true);            
            $adminId = $this->session->userdata('user_id');

            $data = array (
                'duty_id' => $selectedDutyId,
                'user_id' => $selectedUserId,
                'token' => random_string('unique', 30),
                'admin_id' => $adminId,
                'date' =>  $festivalDate
            );

            $this->FestivalModel->insertAssignFestivalDuty($data);

            if ($fromViewDuties) {
                redirect($this->agent->referrer());
            } else {
                redirect('Admin/index');    
            }
            
        }
    }    


    function addRating() {

        if($this->input->post()) {
          
            $rating = $this->input->post('rating', TRUE);
            $assign_duty_id = $this->input->post('assign_duty_id', TRUE);

            $data = array(
                'stars' => $rating,
                'assign_duty_id' => $assign_duty_id,
                'admin_id' =>  $this->session->userdata('user_id')
            );

            $this->FestivalModel->insertFestivalDutyRating($data);
        }
    }

    function sortFestivalDuties() {

      if($this->input->post()) {

        $selectedDate = $this->input->post('selectedDate');
        $duties = $this->input->post('duties');        

        $this->FestivalSortModel->deleteSortByDate($selectedDate);

        $sort = 0;
        
        foreach ($duties as $duty) {

          $sort++;

          $dutyData = array(
            'date' => $selectedDate,
            'duty_id' => $duty,
            'sort' => $sort,
            'type' => 'SPECFIC'
          );

          $this->FestivalSortModel->insert($dutyData);

        }

      }

    }

    /**
     * Delete Festival
     * Created By: Moiz
     */  
    function deleteFestival() {

      if ($this->input->get('token')) {
        $token = $this->input->get('token');

        $festival = $this->FestivalModel->getFestivalByToken($token);

        if ($festival) {
          $this->FestivalModel->deleteFestival($festival->id);  
        }

       redirect($this->agent->referrer());
      } else {
       redirect($this->agent->referrer());
      }

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