<?php
class Festival extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('string');
        $id = $this->session->userdata('user_id');
        $type = $this->session->userdata('type');
        
        if( $id != NULL  && $type != 'User' ) {
            $this->load->model('FestivalModel'); 
            $this->load->model('FestivalMajalisModel'); 
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

            foreach($duties as $duty) {

                $dutyModel = array (
                    'duty' => $duty,
                    'festival_id' => $festival_id,
                    'admin_id' => $adminId,
                    'token'=> random_string('unique', 30)
                );

                $dutyId = $this->FestivalModel->insertFestivalDuties($dutyModel);

            }

            foreach($festivalDate as $date) {

                $dateModel = array (
                    'festival_id' => $festival_id,
                    'date' => $date,
                    'admin_id' => $adminId,
                    'token'=> random_string('unique', 30)
                );

                $dateId = $this->FestivalModel->insertFestivalDates($dateModel);
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
        'festival_id' => ($date ? '' : $result->id ),
        'duty' => $duty,
        'admin_id' => $adminId,
        'token'=> random_string('unique', 30)
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
        $token = $this->input->get('token');
        $date = $this->input->get('date');
        
        $duties = $this->FestivalModel->getDutiesForFestival($token);

        if ($date) {

          $dateSpecficDuties = $this->FestivalModel->getDutiesForSpecticDate($date, 'FESTIVAL');

          if ($dateSpecficDuties) {

            foreach ($dateSpecficDuties as $item) {
              array_push($duties, $item);

            }
          }
        } 

        $data = array(
          'duties' => $duties,
        );            
        
        $this->loadView('admin/festival/view_festival_duties', $data);
        
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