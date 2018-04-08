<?php
class WaaraRequest extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('WaaraRequestDisableDatesModel');
    }


    function index() {
        
        $this->loadView('admin/waara_request/request_dates', null);

    }


    function getDays() {

        $date = $this->input->get('date');

        $startDate = $this->getStartedDateOfWeek($date);
        $endDate = date('Y-m-d', strtotime('+6 days', strtotime($startDate )));

        $days = $startDate . ',';
        $dayName = date('l', strtotime($startDate));

        $result = $this->WaaraRequestDisableDatesModel->getByDate('2018-04-16');

        $html = '<table class="table table-striped" id="table" width="80%">
                    <h4> Starting Date: '. $startDate .' <br> Ending Date: '. $endDate .'
                                <tbody>
                                    <tr>';

        for ($i = 0; $i < 7; $i++) {

            $disableDate = $this->WaaraRequestDisableDatesModel->getByDate($startDate);
            $checked = '';

            if (sizeof($disableDate) > 0) {
                $checked = 'checked';
            }          

            $html = $html . '<td> '. $dayName .' <input type="checkbox" name="day" '. $checked .' value="'. $startDate .'"/> </td>';

            $startDate = date('Y-m-d', strtotime('+1 days', strtotime($startDate)));
            $dayName = date('l', strtotime($startDate));
            $days = $days . $startDate . ',';

        }

        $days = rtrim($days,',');

        $html = $html . '</tr></tbody></table>';

        echo $html;
    }


    function addDays() {

        if ($this->input->post()) {

            $dates = $this->input->post('dates');
            $selectedDate = $this->input->post('selectedDate');

            $startDate = $this->getStartedDateOfWeek($selectedDate);
            // $days = '"' . $startDate . '",';
            $days = '';

            for ($i = 0; $i < 7; $i++) {
                $days = $days . '"' . $startDate . '",';
                $startDate = date('Y-m-d', strtotime('+1 days', strtotime($startDate)));
            }

            $days = rtrim($days,',');

            $this->WaaraRequestDisableDatesModel->deleteDates($days);

            if ($dates) {
                
                foreach ($dates as $date) {
                    $this->WaaraRequestDisableDatesModel->insert(array('date' => $date));
                }
            
            }
        }

        

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
