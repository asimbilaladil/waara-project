<?php
class AdminMajalis extends CI_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(0);

        $id = $this->session->userdata('user_id');
        $type = $this->session->userdata('type');

        if( $id != NULL  && $type != 'User' ) {
            $this->load->model('MajalisModel');
            $this->load->model('MajalisSortModel');
            $this->load->model('MajalisDateModel');
            $this->load->model('UserModel');
            $this->load->helper('string');
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
        
        $majalisAdminIds = $this->session->userdata('majalisAdminIds');
        
        $ids = implode(', ', $majalisAdminIds);

        $majalisDates = $this->MajalisDateModel->getDatesByMajalisIds($ids);

        $this->loadView('admin/majalis_admin', array('majalisDates' => $majalisDates) );

    }    

    function ajaxGetMajalisDuties() {

        $date = $this->input->post('date');
        $majalisBoxHideShow =  '<script>$(".majalisBox").hide()</script>';
        $userIds = array();

        $html = '<table class="table table-striped" id="majalisDutyTable">
        <thead>
        <tr>
            <th> Duty </th>
            <th> User Fullname </th>
            <th> Action </th>
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
                
        $majalisName = '';

        // echo json_encode($result); die;

        //TOTO: FIX
        foreach($result as $key => $row) {

            if (isset($row->majalisName)) {
                $majalisName = $row->majalisName;
            }

            $majalisBoxHideShow =  '<script>$(".majalisBox").show(); $("#majalisHeading").html("'. $majalisName .'"); </script>';
            $assigned = $row->user_id != null ? true : false;


            if ($assigned) {

                $name = $row->firstName . ' ' . $row->lastName;
                $viewUrl = site_url('AdminMajalis/viewDuty?id=' . $row->id . '&date=' . $row->date );
                $html = $html . '<tr>
                <td style="display:none;">'. $row->id .'</td>
                <td> '. $row->name .' </td>
                <td> '. $name  .' </td>
                <td> <a href="'. $viewUrl .'"> <button class="btn btn-primary">View</button> </a> </td>
                <td><button class="btn btn-primary">Edit</button> </td>
                <td> <button id="dutyRating_'. $row->assignId .'" data-toggle="modal" 
                onclick="setAssignMajalisDutyId('. $row->assignId .',0)" data-target="#userMajalisDutyRating" class="btn btn-primary">Rating</button> </td>
                <td> <input type="hidden" id="majalisId" name="" value="'. $row->majalisId .'" /></td> 
                ';  

            } else {

                if ($row->id) {

                    $html = $html . '<tr>
                    <td style="display:none;">'. $row->id .'</td>
                    <td> '. $row->name .' </td>
                    <td> <input type="text" id="majalisDutyUsers_'. $key .'" name="users" class="form-control  ui-autocomplete-input"> </td>
                    <td class="majalisId_'. $row->majalisId .'"> <button class="btn btn-primary" onclick="ajaxCallUserHistoryForMajalis('. $row->id .')">SAVE</button> </td>
                    <td> <input type="hidden" id="majalisId" name="" value="'. $row->majalisId .'" /></td> 
                    ';
                }                
            }

        }
        $html = $html .$majalisBoxHideShow;
        echo $html;

    }


    function ajaxGetMajalisDutiesV2() {

        $date = $this->input->post('date');
        $majalisBoxHideShow =  '<script>$(".majalisBox").hide()</script>';
        $userIds = array();

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

        $majalisArray = array();

        foreach($result as $key => $item) {
            //$majalisArray[$item->majalisId][$key] = $item;

            if ($majalisArray[$item->majalisId]) {
                array_push($majalisArray[$item->majalisId], $item);
            } else {

                $majalisArray[$item->majalisId] = array($item); 
            }

        }
                
    
        // echo json_encode($majalisArray); die;

        $html = '<input type="hidden" name="selectedMajalisUser" id="selectedMajalisUser"/>
                <input type="hidden" name="selectedMajalisDuty" id="selectedMajalisDuty"/>
                <input type="hidden" id="majalisDate" name="majalisDate"  /> ';

        foreach ($majalisArray as $majalis) {
            $html = $html . '
            <div class="box box-success">
                <div class="box-header with-border">
                    <div for="" class="col-sm-4 ">
                        <h3 class="box-title" id="majalisHeading"> '. $majalis[0]->majalisName .' </h3>
                    </div>
                    <div for="" class="col-sm-8 ">
                        <h3 id="selectedMajalisDate" class="box-title"> Selected Date is : '. $date .' </h3>
                    </div>
                </div>
                <div class="col-sm-12" style="top: 20px;">
                    <div class="col-sm-3" >
                    </div>
                </div>
                <div class="box-body">
                    <div>
                        
                            <div class="col-sm-12">
                                </br>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                              
                                </div>
                            </div>
                    </div>
                    <div class="col-sm-12">
                    </br>
                    <div>' . $this->renderMajalisDuties($majalis) . '</div>
                    </div>
                                                           
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                </div>
                <!-- /.box-footer -->
            </div>';
         
        }

        //TOTO: FIX
        echo $html;

    }


    function renderMajalisDuties($data) {

        // sorting by order
        usort($data, function($a, $b) {
            return $a->sort > $b->sort;
        });        

        $html = '<table class="table table-striped" id="majalisDutyTable">
        <thead>
        <tr>
            <th> Duty </th>
            <th> User Fullname </th>
            <th> Action </th>
        </tr>
        </thead>
        <tbody>';        

        foreach($data as $key => $row) {

            if (isset($row->majalisName)) {
                $majalisName = $row->majalisName;
            }

            $majalisBoxHideShow =  '<script>$(".majalisBox").show(); $("#majalisHeading").html("'. $majalisName .'"); </script>';
            $assigned = $row->user_id != null ? true : false;


            if ($assigned) {

                $name = $row->firstName . ' ' . $row->lastName;
                $viewUrl = site_url('AdminMajalis/viewDuty?id=' . $row->id . '&date=' . $row->date );
                $html = $html . '<tr>
                <td style="display:none;">'. $row->id .'</td>
                <td> '. $row->name .' </td>
                <td> '. $name  .' </td>
                <td> <a href="'. $viewUrl .'"> <button class="btn btn-primary">View</button> </a> </td>
                <td><button class="btn btn-primary">Edit</button> </td>
                <td> <button id="dutyRating_'. $row->assignId .'" data-toggle="modal" 
                onclick="setAssignMajalisDutyId('. $row->assignId .',0)" data-target="#userMajalisDutyRating" class="btn btn-primary">Rating</button> </td>
                <td> <input type="hidden" id="majalisId" name="" value="'. $row->majalisId .'" /></td>
                </tr> 
                ';  

            } else {

                if ($row->id) {

                    $html = $html . '<tr>
                    <td style="display:none;">'. $row->id .'</td>
                    <td> '. $row->name .' </td>
                    <td> <input type="text" id="majalisDutyUsers_'. $key .'" name="users" class="form-control  ui-autocomplete-input"> </td>
                    <td class="majalisId_'. $row->majalisId .'"> <button class="btn btn-primary" onclick="ajaxCallUserHistoryForMajalis('. $row->id .')">SAVE</button> </td>
                    <td> <input type="hidden" id="majalisId" name="" value="'. $row->majalisId .'" /></td> 
                    </tr>';
                }                
            }

        }

        $html = $html . '</tbody> </table>';
        $html = $html . $majalisBoxHideShow;
        return $html;

    }


    function viewDuty() {

        if ($this->input->get('id') && $this->input->get('date')) {

            $dutyId = $this->input->get('id');
            $date = $this->input->get('date');

            $data = $this->MajalisModel->getAssignMajalisDutyDetail($dutyId, $date);

            if ($data) {
                $this->loadView('admin/majalis/view_majalis_duty_detail', $data);
            } else {
                redirect('admin/');
            }

        } else {
            redirect('admin/');
        }        
    }

    function assignDuty() {
        
        if ($this->input->post()) {

            $fromViewDuties = $this->input->post('fromViewDuties') ? true : false;


            $selectedUserId = $this->input->post('selectedMajalisUser', true);
            $selectedDutyId = $this->input->post('selectedMajalisDuty', true);
            $majalisDate = $this->input->post('majalisDate', true);            
            $adminId = $this->session->userdata('user_id');

            $data = array (
                'duty_id' => $selectedDutyId,
                'user_id' => $selectedUserId,
                'token' => random_string('unique', 30),
                'admin_id' => $adminId,
                'date' =>  $majalisDate
            );

            $this->MajalisModel->insertAssignMajalisDuty($data);

//            if ($fromViewDuties) {
                redirect($this->agent->referrer());
//            } else {
//                redirect('Admin/index');    
//            }
            
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

            $this->MajalisModel->insertMajalisDutyRating( $data);
        }
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
        $this->load->view('admin/common/allow_access');
    }

}