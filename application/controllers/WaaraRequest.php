<?php
class WaaraRequest extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('WaaraRequestDisableDatesModel');
    }


    function index() {
        
        $this->loadView('admin/waara_request/disable_dates', null);

    }

    function deleteDate() {
        $id = $this->input->post('id');
        $this->WaaraRequestDisableDatesModel->delete($id);
    }

    function getDaysV2() {
        $result = $this->WaaraRequestDisableDatesModel->getAllDates();

        echo json_encode($result);
    }

    function addDaysV2() {
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $weekDays = $this->input->post('weekDays');

        $date1 = new DateTime($startDate);
        $date2 = new DateTime($endDate);

        $diff = $date2->diff($date1)->format("%a");

        $dateCursor = $startDate;

        for ($i = 0; $i < $diff + 1; $i++) {
            
            $weekDay = date('w', strtotime($dateCursor));

            $contains = in_array($weekDay, $weekDays);

            if ($contains) {
                $this->WaaraRequestDisableDatesModel->deleteByDate( $dateCursor );
                $this->WaaraRequestDisableDatesModel->insert(array('date' => $dateCursor));
            }

            $dateCursor = date('Y-m-d', strtotime('+1 days', strtotime($dateCursor)));
        }

        echo json_encode( array('success' => 'true') );        
    }


    function getStartedDateOfWeek($date) {

        if ($date) {
            $dayOfWeek = date('w', strtotime($date));
            $startDate = date('Y-m-d', strtotime('-'. $dayOfWeek .' days', strtotime($date)));        
            return $startDate;
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
