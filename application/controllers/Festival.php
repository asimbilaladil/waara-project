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

            $festivalModel = array (
              'festival' => $festivalName,
              'admin_id' => $adminId,
              'token'=> random_string('unique', 30)
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

            redirect("festival/add");
        } else {
            redirect("festival/add");
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