<?php
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('AdminModel');
        $this->load->model('WaaraRequestModel');
        $this->load->model('WaaraRequestDisableDatesModel');       
        $this->load->helper('string');
        $this->load->library('user_agent');
        $this->load->helper('custom_helper');
        
    }

    function index() {


        $this->loadView('user/home', null);

    }

    function getCalendarData() {
        $disableDates = $this->WaaraRequestDisableDatesModel->getAllDates();
        $requestedWaara = $this->WaaraRequestModel->getRequestedWaara();
        $events = array_merge($disableDates, $requestedWaara);
        echo json_encode($events);

    }   


    function loadView($view, $data) {

        $this->load->view('admin/common/header');
        $this->load->view('admin/common/user_sidebar');
        $this->load->view($view, array('data' => $data));
        $this->load->view('admin/common/footer');

    }

    function ajaxGetDutyFromJk() {

        $state=$this->input->post('state');

        $date=$this->input->post('date');
        $checkMajalisOverride = $this->AdminModel->checkOverrideForMajalis( $date );
        $overrideFlag = sizeof($checkMajalisOverride);
        $html = '<script>$(".regularWaaraBox").hide()</script>';
        if($overrideFlag == 0){
              //Check is there any sorting available for specific day if not go for global specific day sort
            $checkSpecificDuty = $this->AdminModel->checkSpecificDayDutyByJkandDate( $state, $date );
            if(empty($checkSpecificDuty)){
                //Check is there any global specific day available for specific day if not go for global template sort
                $checkGlobalSpecificDuty = $this->AdminModel->checkGlobalSpecificSortRecord( $state, $date );
                if(empty($checkGlobalSpecificDuty)){
                    $duty = $this->AdminModel->getGlobalSortDutyByTodayDate( $state, $date, false );
                    if(empty($duty)){
                        //Get Duties without sorting because there is no sort available
                        $duty = $this->AdminModel->getDutyByJkandDate( $state, $date );     
                    }   

                } else {
                    //Get Global specific day sort
                    $duty = $this->AdminModel->getSpecificGlobalDayDutyByJkandDate( $state, $date );
                }

            } else {
              //Get specific day sort
              $duty = $this->AdminModel->getSpecificDayDutyByJkandDate( $state, $date );
            }

            $html = '<script>$(".regularWaaraBox").show()</script><table class="table table-striped" id="dutyTable">
            <thead>
            <tr>
                <th> Waara </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>';

            $count = 0;

            // echo json_encode($duty); die;

            foreach($duty as $row) { 

                $count++;

                $result = $this->AdminModel->getUserOfDutyByDate( $date, $row->duty_id );

                // echo json_encode($duty); die;

                //if( count($result) > 0) {

                    // $user =  $result[0]->first_name . " " . $result[0]->last_name ;
                    // $assignId =  $result[0]->assign_id;  
                    // $ratingHtml = ($result[0]->rating == 'not exists') ? ' <td class="waaraDuty">  <button id="rating_'. $assignId.'" data-toggle="modal" onclick="setAssignDutyId('. $assignId .',0)" data-target="#userRating" type="button" class="btn btn-primary btn-block"  >Rating</button> </td> <td  style="display:none;">'.$row->unionsorting.'</td>  <td style="display:none;"></td>' : ' <td>  <button id="rating_'. $assignId.'" data-toggle="modal" onclick="setAssignDutyId('. $assignId .','.$result[0]->rating.')" data-target="#userRating" type="button" class="btn btn-primary btn-block"  >Edit Rating</button> </td><td  style="display:none;">'.$row->unionsorting.'</td> <td style="display:none;"></td>';
                    // $rowCount = 7;
                    // $html = $html . '<tr>
                    //                 <td style="display:none;"> '. $row->duty_id .' </td>
                    //                 <td> '. $row->name .' </td>
                    //                 <td>  <a href="'. site_url('userHistory/index?id=' .$result[0]->user_id ) .'" >'. $user . '</a></td>     
                    //                 <td> <a href= " ' . site_url("Welcome/waara?id=" . $assignId ) . ' " <button type="button" class="btn btn-primary btn-block"  >View</button> </td>
                    //                 <td class="waaraDuty"> <a href= " ' . site_url("admin/editAssignDuty?id=" . $assignId ) . ' " <button type="button" class="btn btn-primary btn-block"  >Edit</button></a></td>
                                    
                    //                </tr>';


                //} else {

                    $rowCount = 7;
                    $html = $html . '<tr>
                                    <td style="display:none;"> '. $row->duty_id .' </td>
                                    <td> '. $row->name .' </td>
    
                                    <td class="waaraDuty"> <button type="button" class="btn btn-primary btn-block"  onclick="onRequestClick('. $row->duty_id .')">REQUEST</button> </td>
                                    <td style="display:none;"></td>
                                    <td style="display:none;"></td>
                                    
                                    <td style="display:none;"></td>
                                    </tr>';
                //}

            }

            $html = $html . '<tbody></table>';       
        } 

        echo $html;

    }    

    function waaraRequest() {
        $date = $this->input->post('date');
        $dutyId = $this->input->post('dutyId');
        $userId = $this->session->userdata('user_id');

        $disableDate = $this->WaaraRequestDisableDatesModel->getByDate($date);



        if (count($disableDate)) {
            echo json_encode(array('success' => false, 'message' => 'This date is disabled for request'));
        } else {

            $requestedWaaras = $this->WaaraRequestModel->getAllRequestWaaraOnDate($dutyId, $date);

            if (count($requestedWaaras) < 2) {
                $data = array (
                    'date' => $date,
                    'duty_id' => $dutyId,
                    'user_id' => $userId
                );

                $this->WaaraRequestModel->insert($data);

                echo json_encode(array('success' => true, 'message' => 'Successfully requested for waara.'));

            } else {
                echo json_encode(array('success' => false, 'message' => 'Two Person already requested for this waara.'));  
            }
         
        }

    }

}