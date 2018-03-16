<?php
class DailyWaara extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model('AdminModel');
        $this->load->model('EmailModel');
        $this->load->library('upload');
				$this->load->model('MajalisModel');
				$this->load->model('MajalisSortModel');
				$this->load->model('UserModel');
				$this->load->helper('string');
				$this->load->library('user_agent');   
    }



    function index(){
      


        $this->loadView('admin/dailyWaara', null );
    }
   function ajaxGetDutyFromJk() {

        $state=$this->input->post('state');

        $date=$this->input->post('date');
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

        $html = '<h2 style="text-align:  center;">Regular Waara</h2> <table class="table table-striped table-bordered" id="dutyTable">
        <thead>
        <tr>
            <th> Waara </th>
            <th> User Fullname </th>
         
        </tr>
        </thead>
        <tbody>';
        
        $count = 0;

        foreach($duty as $row) { 

            $count++;

            $result = $this->AdminModel->getUserOfDutyByDate( $date, $row->duty_id );

            

            if( count($result) > 0) {

                $user =  $result[0]->first_name . " " . $result[0]->last_name ;
                $assignId =  $result[0]->assign_id;  
                $ratingHtml = ($result[0]->rating == 'not exists') ? ' <td>  <button id="rating_'. $assignId.'" data-toggle="modal" onclick="setAssignDutyId('. $assignId .',0)" data-target="#userRating" type="button" class="btn btn-primary btn-block"  >Rating</button> </td> <td  style="display:none;"></td>  <td style="display:none;"></td>' : ' <td>  <button id="rating_'. $assignId.'" data-toggle="modal" onclick="setAssignDutyId('. $assignId .','.$result[0]->rating.')" data-target="#userRating" type="button" class="btn btn-primary btn-block"  >Edit Rating</button> </td><td  style="display:none;"></td> <td style="display:none;"></td>';
								$rowCount = 7;
                $html = $html . '<tr>
                                <td style="display:none;"> '. $row->duty_id .' </td>
                                <td> '. $row->name .' </td>
                                <td>  '. $user . '</td>     
                       
                                
                               </tr>';


            } else {
							
								$rowCount = 7;
                $html = $html . '<tr>
                                <td style="display:none;"> '. $row->duty_id .' </td>
                                <td> '. $row->name .' </td>
                                <td> </td>     

                                </tr>';
            }

        }

        $html = $html . '<tbody></table>';



        echo $html;

    }
   function ajaxGetMajalisDuties() {

        $date = $this->input->post('date');
        $majalisBoxHideShow =  '<script>$(".majalisBox").hide()</script>';
        $userIds = array();

        $html = '<h2 style="text-align:  center;">Majalis Waara</h2>  <table class="table table-striped" >
        <thead>
        <tr>
            <th> Waara </th>
            <th> User Fullname </th>
          
        </tr>
        </thead>
        <tbody>';


        $result = $this->MajalisModel->getDutiesByDate($date);

        $specficDates = $this->MajalisModel->getDutiesFromSpecficTable($date); 

        foreach($specficDates as $item) {
            array_push($result, $item);
        }

        foreach ($result as $value) {
            
            if($value->user_id) {
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
                $viewUrl = site_url('AdminMajalis/viewDuty?id=' . $row->id . '&date=' . $row->date );
                $html = $html . '<tr>
                <td style="display:none;">'. $row->id .'</td>
                <td> '. $row->name .' </td>
                <td> '. $name  .' </td>';  

            } else {
                $html = $html . '<tr>
                <td style="display:none;">'. $row->id .'</td>
                <td> '. $row->name .' </td>
                <td> </td>';
            }

        }
        $html = $html .$majalisBoxHideShow;
        echo $html;

    }	
    /**
     * Load view 
     * @param 1 : view name
     * @param 2 : data to be render on view. If no data pass null
     */
    function loadView($view, $data) {


        $this->load->view($view, array('data' => $data));


    }

}
?>