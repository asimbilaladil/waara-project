<?php
class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        error_reporting(0);

        $id = $this->session->userdata('user_id');
        $type = $this->session->userdata('type');

        if( $id != NULL  && $type != 'User' ) {
            $this->load->model('AdminModel');
            $this->load->model('EmailModel');
            $this->load->model('ColorModel');
            $this->load->model('MajalisModel');

        } else {

            redirect('Login/');

        }

    }
    function globalSort() {   
      $data = array();
      $data['duties'] =  $this->AdminModel->getGlobalDuty();
      $data['jk'] = $this->AdminModel->getAllfromTable('jk');
      $jamatKhanas = $this->AdminModel->getJamatKhana();

      $jkArray = array();

      //populate array with Id as key and value
      foreach($jamatKhanas as $item => $value) {
          $jkArray[$value->id] = $value->name;
      }

      $data['duty'] = $this->AdminModel->getAllfromTableOrderBy('duty', 'priority', 'asc');

      $data['jkArray'] = $jkArray;
      $data['jkDb'] = $jamatKhanas;
      
      $this->loadView('admin/globalSort', $data);

    }
    function changeDutyType(){
        if($this->input->post()) {
            $duty_id =  $this->input->post('duty_id');
            $for_day =  $this->input->post('for_day');
            $data = array(
              'for_day' => $for_day
            );
            $this->AdminModel->update( 'duty', 'duty_id', $duty_id, $data );
            
        }
    }
    function addGlobalTemplateDuty(){
        if($this->input->post()) {
          $duty_id =  $this->input->post('duty_id');
          $data = array(
            'duty_id' => $duty_id,
            'admin_id' => $this->session->userdata('user_id')
          );
          $this->AdminModel->insert('waara_global_template', $data);
//          $beforeDutyData = $this->AdminModel->getHighestGlobalSortNumber(date('Y-m-d'));

//          $highestGlobalSortNumber = $this->AdminModel->getDutyPriority($duty_id);
          
          
//          if(!empty($highestGlobalSortNumber)){
              
//              $data1 = array(
//                'priority' => $highestGlobalSortNumber[0]->priority,
//                'duty_id' => $duty_id,
//                'date' => ($beforeDutyData[0]->date == NULL ? date('Y-m-d') : $beforeDutyData[0]->date),
//                'admin_id' => $this->session->userdata('user_id'),
//                'sort_number' => ($beforeDutyData[0]->max_sort_number+1)
//              );
//              $this->AdminModel->insert('globalWaaraSort' , $data1);  
//          }           
          redirect('admin/globalSort');
        }
    }

    function index()
    {   
        //ASSIGN DUTY
        if($this->input->post()) {

            //if email is checked send email to the assigned user
            if( $this->input->post('byEmail') ) {
                
                $user = $this->AdminModel->getrecordById('user', 'user_id', $this->input->post('selectedUser'));

                //mail($user->email, "");

            }

            $date = $this->input->post('date');

            $assign = array( 
                "user_id" => $this->input->post('selectedUser'),
                "duty_id" => $this->input->post('selectedDuty'),
                "jk_id" => $this->input->post('jk'),
                "start_date" => $date,
                "end_date" => $date,
                "shift" => $this->input->post('selectedShift'),
                "admin_id" => $this->session->userdata('user_id')
            );

        $this->AdminModel->insert('assign_duty', $assign);
        $emailMessage = $this->EmailModel->getEmailContent();
        $this->AdminModel->waaraNotificationEmail($assign['user_id'], $assign['jk_id'], $assign['duty_id'], $date , $emailMessage[0]->content );

        }

        $jkId = $this->session->userdata('jk_id');
        $type = $this->session->userdata('type');

        //if jk id is set in session. if jkid = 0 it call see all jks
        if( isset( $jkId ) && $jkId != 0 )  {

            $jk = $this->AdminModel->getJkById( $jkId );

        } else {

            $jk = $this->AdminModel->getAllfromTable('jk');

            $data['duty'] = $this->AdminModel->getAllfromTable( 'duty' );

        }

        $users = $this->AdminModel->getAllfromTable('user');
        $data['color'] =  $this->ColorModel->getAssignColors();
        $data['users'] = $users;
        $data['user_count'] = $this->AdminModel->getDisableUserCount();

        $data['jk'] = $jk;

        $data['events'] = $this->AdminModel->get_calendar_duties(); 
            $events = [];
            foreach( $data['events']  as $row ) {
                 $subevent['title'] = $row->duty_name;
                 $subevent['start'] = $row->start_date;
                 $subevent['end'] = $row->end_date;
                 //$subevent['onclick'] = 'eventClick("2010.0.02")';
                 //$subevent['url'] = 'Welcome/waara?id='.$row->id;
                 $subevent['color'] = ($row->color != 'NULL' ? $row->color : '#337ab7' ) ;

                 array_push($events, $subevent);
        }
        $data['events'] = $events;
        $data['type'] = $type;
        
        $this->loadView('admin/index', $data);

    }

    function getUsers(){

        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->AdminModel->getUsers($q);
        }

    }

    function assignMultipleWaara(){
      
      $data['ageGroup'] = $this->AdminModel->getAllfromTable( 'age_group' );
      $data['jk'] = $this->AdminModel->getAllfromTable('jk');
      $data['events'] = $this->AdminModel->get_calendar_duties(); 
            $events = [];
            foreach( $data['events']  as $row ) {
                 $subevent['title'] = $row->duty_name;
                 $subevent['start'] = $row->start_date;
                 $subevent['end'] = $row->end_date;
                 //$subevent['url'] = 'Welcome/waara?id='.$row->id;
                 array_push($events, $subevent);
        }
        $data['events'] = $events;
      $this->loadView('admin/assignMultipleWaara',  $data);
    }

    function assignMultipleDutyFromJk() {

        $state=$this->input->post('state');

        $date=$this->input->post('date');
        
        $duty = $this->AdminModel->getDutyByJkandDate( $state, $date );
        

        $html = '<table class="table table-striped" id="dutyTable">
        <thead>
        <tr>
            <th> Waara </th>
            <th> User Fullname </th>
            <th> Action </th>
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
                $ratingHtml = ($result[0]->rating == 'not exists') ? ' <td class="waaraDuty">  <button id="rating_'. $assignId.'" data-toggle="modal" onclick="setAssignDutyId('. $assignId .',0)" data-target="#userRating" type="button" class="btn btn-primary btn-block"  >Rating</button> </td>' : ' <td>  <button id="rating_'. $assignId.'" data-toggle="modal" onclick="setAssignDutyId('. $assignId .','.$result[0]->rating.')" data-target="#userRating" type="button" class="btn btn-primary btn-block"  >Edit Rating</button> </td>';
                $html = $html . '<tr>
                                <td> '. $row->name .' </td>
                                <td>  <a href="'. site_url('userHistory/index?id=' .$result[0]->user_id ) .'" >'. $user . '</a></td>     
                                <td> <a href= " ' . site_url("Welcome/waara?id=" . $assignId ) . ' " <button type="button" class="btn btn-primary btn-block"  >View</button> </td>
                                <td class="waaraDuty"> <a href= " ' . site_url("admin/editAssignDuty?id=" . $assignId ) . ' " <button type="button" class="btn btn-primary btn-block"  >Edit</button></a></td>
                                '.$ratingHtml.'

                                </tr>';


            } else {

                $html = $html . '<tr>
                                <td> '. $row->name .' </td>
                                <td> <input style="text-transform:capitalize;" onkeyup="getUserName(this)" type="text" name="users" id="users_'. $count .'" class="form-control" placeholder="Search User.." required><input type="hidden" value="" id="userid_'. $count .'" > <input type="hidden" value="'. $row->duty_id .'" id="waara_'. $count .'"></td>     
                                
                                </tr>';
            }

        }

        $html = $html . '<tbody></table>';



        echo $html;

    }
  function ajaxGetMultipleAssignDutyFromJk() {

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

    
       


        $html = '<table class="table table-striped" id="dutyTable">
        <thead>
        <tr>
            <th> Waara </th>
            <th> User Fullname </th>
            <th> Action </th>
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
                $ratingHtml = ($result[0]->rating == 'not exists') ? ' <td class="waaraDuty">  <button id="rating_'. $assignId.'" data-toggle="modal" onclick="setAssignDutyId('. $assignId .',0)" data-target="#userRating" type="button" class="btn btn-primary btn-block"  >Rating</button> </td> <td  style="display:none;">'.$row->unionsorting.'</td>  <td style="display:none;"></td>' : ' <td>  <button id="rating_'. $assignId.'" data-toggle="modal" onclick="setAssignDutyId('. $assignId .','.$result[0]->rating.')" data-target="#userRating" type="button" class="btn btn-primary btn-block"  >Edit Rating</button> </td><td  style="display:none;">'.$row->unionsorting.'</td> <td style="display:none;"></td>';
                $rowCount = 7;
                $html = $html . '<tr>
                                <td style="display:none;"> '. $row->duty_id .' </td>
                                <td> '. $row->name .' </td>
                                <td>  <a href="'. site_url('userHistory/index?id=' .$result[0]->user_id ) .'" >'. $user . '</a></td>     
                                <td> <a href= " ' . site_url("Welcome/waara?id=" . $assignId ) . ' " <button type="button" class="btn btn-primary btn-block"  >View</button> </td>
                                <td class="waaraDuty"> <a href= " ' . site_url("admin/editAssignDuty?id=" . $assignId ) . ' " <button type="button" class="btn btn-primary btn-block"  >Edit</button></a></td>
                                '.$ratingHtml.'
                                
                               </tr>';


            } else {
              
                $rowCount = 7;
                $html = $html . '<tr>
                                <td style="display:none;"> '. $row->duty_id .' </td>
                                <td> '. $row->name .' </td>
                                <td><input type="hidden" value="" id="userid_'. $count .'" > <input  onkeyup="getUserName(this)" type="text" name="users" id="users_'. $count .'" class="form-control " placeholder="Search User.." required> <input type="hidden" value="'. $row->duty_id .'" id="waara_'. $count .'"></td>     
                                <td  style="display:none;" class="waaraDuty"> <button type="button" class="btn btn-primary btn-block"   onclick="ajaxCallUserHistory('. $row->duty_id .')">Save</button> </td>
                                <td style="display:none;"></td>
                                <td style="display:none;"></td>
                                <td  style="display:none;">'.$row->unionsorting.'</td>
                                <td style="display:none;"></td>
                                </tr>';
            }

        }

        $html = $html . '<tbody></table><script>$( "#dutyTable tbody" ).sortable( {
  update: function( event, ui ) {
    var totalRowCount = $("#dutyTable > tbody > tr:first > td").length //$("#dutyTable tbody tr").length;
    var rowCount = 7'.$rowCount.' //$("#dutyTable td").closest("tr").length;

    var selectedDate = $("#selectDate").val()
    $(this).children().each(function(index) {
    $(this).find("td").last().html(index + 1)
    });
    var priority = []; 
    var duty_id = [];
    var order = [];
    $("#dutyTable tbody tr").each(function() {
        var counter = 0;

        $.each(this.cells, function(){
            //console.log("rowCount: " + rowCount);
          //  console.log($(this).text())
            if(counter == (rowCount - 1) ){
                //console.log( "priority: " + $(this).text());
                priority.push(parseInt($.trim($(this).text())));
            }
            if( counter == 0){
                //console.log( "duty id: " + $(this).text());
                duty_id.push(parseInt($.trim($(this).text())));

            }
            //console.log(counter)
            if( counter == rowCount){
                //console.log( "Order Index: " + $(this).text());
                order.push(parseInt($.trim($(this).text())));
            }
            counter++;
        });
        
    });

        sortDuties(priority, duty_id, order, selectedDate);
  }
});
  var sortDuties = function sortDuties(priority, duty_id, order, selectedDate){

      $.ajax({
         url: "'.site_url('Admin/updateDutyPriority').'",
         type: "POST",
         data: {
             "priority" : priority,
             "duty_id" : duty_id,
             "order" : order,
             "selectedDate" : selectedDate
         },
         success: function(response){
         },
         error: function(){  
         }
     });
  }

</script>';



        echo $html;

    }
   function getGlobalSortDutyFromJk() {

        $state=$this->input->post('state');

        $date=$this->input->post('date');
        
        $duty = $this->AdminModel->getGlobalSortDutyByTodayDate( $state, $date, true );
        if(empty($duty)){
            $duty = $this->AdminModel->getDutyByJkandDate( $state, $date );     
        }

        $html = '<table class="table table-striped" id="dutyTable">
        <thead>
        <tr>
            <th> Waara </th>

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
                $ratingHtml = ($result[0]->rating == 'not exists') ? ' <td>  <button id="rating_'. $assignId.'" data-toggle="modal" onclick="setAssignDutyId('. $assignId .',0)" data-target="#userRating" type="button" class="btn btn-primary btn-block"  >Rating</button> </td> <td  style="display:none;">'.$row->unionsorting.'</td>  <td style="display:none;"></td>' : ' <td>  <button id="rating_'. $assignId.'" data-toggle="modal" onclick="setAssignDutyId('. $assignId .','.$result[0]->rating.')" data-target="#userRating" type="button" class="btn btn-primary btn-block"  >Edit Rating</button> </td><td  style="display:none;">'.$row->unionsorting.'</td> <td style="display:none;"></td>';
                $rowCount = 7;
                $html = $html . '<tr>
                                <td style="display:none;"> '. $row->duty_id .' </td>
                                <td> '. $row->name .' </td>
                                <td style="display:none;">  <a href="'. site_url('userHistory/index?id=' .$result[0]->user_id ) .'" >'. $user . '</a></td>     
                                <td style="display:none;"> <a href= " ' . site_url("Welcome/waara?id=" . $assignId ) . ' " <button type="button" class="btn btn-primary btn-block"  >View</button> </td>
                                <td style="display:none;"> <a href= " ' . site_url("admin/editAssignDuty?id=" . $assignId ) . ' " <button type="button" class="btn btn-primary btn-block"  >Edit</button></a></td>
                                '.$ratingHtml.'
                                
                               </tr>';


            } else {
              
                $rowCount = 7;
                $html = $html . '<tr>
                                <td style="display:none;"> '. $row->duty_id .' </td>
                                <td> '. $row->name .' </td>
                                <td style="display:none;"> <input  onkeyup="getUserName(this)" type="text" name="users" id="users_'. $count .'" class="form-control " placeholder="Search User.." required> <input type="hidden" value="'. $row->duty_id .'" id="waara_'. $count .'"></td>     
                                <td> <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal"  onclick="setDaysChecklist('.$row->duty_id.',&#39;'.$row->Monday.'&#39;,&#39;'.$row->Tuesday.'&#39;,&#39;'.$row->Wednesday.'&#39;,&#39;'.$row->Thursday.'&#39;,&#39;'.$row->Friday.'&#39;,&#39;'.$row->Saturday.'&#39;,&#39;'.$row->Sunday.'&#39;)">Disable Days</button> </td>
                                <td> <a href="deleteGlobalDuty?id='.$row->duty_id.'" > <span class="glyphicon glyphicon-trash"></span></a> </td>
                                <td style="display:none;"></td>
                                <td  style="display:none;">'.$row->unionsorting.'</td>
                                <td style="display:none;"></td>
                                </tr>';
            }

        }

        $html = $html . '<tbody></table><script>$( "#dutyTable tbody" ).sortable( {
  update: function( event, ui ) {
    var totalRowCount = $("#dutyTable > tbody > tr:first > td").length //$("#dutyTable tbody tr").length;
    var rowCount = '.$rowCount.' //$("#dutyTable td").closest("tr").length;

    var selectedDate = $("#date").val()
    $(this).children().each(function(index) {
    $(this).find("td").last().html(index + 1)
    });
    var priority = []; 
    var duty_id = [];
    var order = [];
    $("#dutyTable tbody tr").each(function() {
        var counter = 0;

        $.each(this.cells, function(){
            //console.log("rowCount: " + rowCount);
          //  console.log($(this).text())
            if(counter == (rowCount - 1) ){
                //console.log( "priority: " + $(this).text());
                priority.push(parseInt($.trim($(this).text())));
            }
            if( counter == 0){
                //console.log( "duty id: " + $(this).text());
                duty_id.push(parseInt($.trim($(this).text())));

            }
            //console.log(counter)
            if( counter == rowCount){
                //console.log( "Order Index: " + $(this).text());
                order.push(parseInt($.trim($(this).text())));
            }
            counter++;
        });
        
    });

        sortGlobalDuties(priority, duty_id, order, selectedDate);
  }
});
  var sortGlobalDuties = function sortGlobalDuties(priority, duty_id, order, selectedDate){

      $.ajax({
         url: "'.site_url('Admin/updateGlobalDutyPriority').'",
         type: "POST",
         data: {
             "priority" : priority,
             "duty_id" : duty_id,
             "order" : order,
             "selectedDate" : selectedDate
         },
         success: function(response){
         },
         error: function(){  
         }
     });
  }

</script>';



        echo $html;

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
                <th> User Fullname </th>
                <th> Action </th>
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
                    $ratingHtml = ($result[0]->rating == 'not exists') ? ' <td class="waaraDuty">  <button id="rating_'. $assignId.'" data-toggle="modal" onclick="setAssignDutyId('. $assignId .',0)" data-target="#userRating" type="button" class="btn btn-primary btn-block"  >Rating</button> </td> <td  style="display:none;">'.$row->unionsorting.'</td>  <td style="display:none;"></td>' : ' <td>  <button id="rating_'. $assignId.'" data-toggle="modal" onclick="setAssignDutyId('. $assignId .','.$result[0]->rating.')" data-target="#userRating" type="button" class="btn btn-primary btn-block"  >Edit Rating</button> </td><td  style="display:none;">'.$row->unionsorting.'</td> <td style="display:none;"></td>';
                    $rowCount = 7;
                    $html = $html . '<tr>
                                    <td style="display:none;"> '. $row->duty_id .' </td>
                                    <td> '. $row->name .' </td>
                                    <td>  <a href="'. site_url('userHistory/index?id=' .$result[0]->user_id ) .'" >'. $user . '</a></td>     
                                    <td> <a href= " ' . site_url("Welcome/waara?id=" . $assignId ) . ' " <button type="button" class="btn btn-primary btn-block"  >View</button> </td>
                                    <td class="waaraDuty"> <a href= " ' . site_url("admin/editAssignDuty?id=" . $assignId ) . ' " <button type="button" class="btn btn-primary btn-block"  >Edit</button></a></td>
                                    '.$ratingHtml.'

                                   </tr>';


                } else {

                    $rowCount = 7;
                    $html = $html . '<tr>
                                    <td style="display:none;"> '. $row->duty_id .' </td>
                                    <td> '. $row->name .' </td>
                                    <td> <input  onkeyup="getUserName(this)" type="text" name="users" id="users_'. $count .'" class="form-control " placeholder="Search User.." required> <input type="hidden" value="'. $row->duty_id .'" id="waara_'. $count .'"></td>     
                                    <td class="waaraDuty"> <button type="button" class="btn btn-primary btn-block"   onclick="ajaxCallUserHistory('. $row->duty_id .')">Save</button> </td>
                                    <td style="display:none;"></td>
                                    <td style="display:none;"></td>
                                    <td  style="display:none;">'.$row->unionsorting.'</td>
                                    <td style="display:none;"></td>
                                    </tr>';
                }

            }

            $html = $html . '<tbody></table><script>$( "#dutyTable tbody" ).sortable( {
                update: function( event, ui ) {
                  var totalRowCount = $("#dutyTable > tbody > tr:first > td").length //$("#dutyTable tbody tr").length;
                  var rowCount = '.$rowCount.' //$("#dutyTable td").closest("tr").length;

                  var selectedDate = $("#date").val()
                  $(this).children().each(function(index) {
                  $(this).find("td").last().html(index + 1)
                  });
                  var priority = []; 
                  var duty_id = [];
                  var order = [];
                  $("#dutyTable tbody tr").each(function() {
                      var counter = 0;

                      $.each(this.cells, function(){
                          //console.log("rowCount: " + rowCount);
                        //  console.log($(this).text())
                          if(counter == (rowCount - 1) ){
                              //console.log( "priority: " + $(this).text());
                              priority.push(parseInt($.trim($(this).text())));
                          }
                          if( counter == 0){
                              //console.log( "duty id: " + $(this).text());
                              duty_id.push(parseInt($.trim($(this).text())));

                          }
                          //console.log(counter)
                          if( counter == rowCount){
                              //console.log( "Order Index: " + $(this).text());
                              order.push(parseInt($.trim($(this).text())));
                          }
                          counter++;
                      });

                  });

                      sortDuties(priority, duty_id, order, selectedDate);
                }
              });
                var sortDuties = function sortDuties(priority, duty_id, order, selectedDate){

                    $.ajax({
                       url: "'.site_url('Admin/updateDutyPriority').'",
                       type: "POST",
                       data: {
                           "priority" : priority,
                           "duty_id" : duty_id,
                           "order" : order,
                           "selectedDate" : selectedDate
                       },
                       success: function(response){
                       },
                       error: function(){  
                       }
                   });
                }

              </script>';       
        } 




        echo $html;

    }

    function updateGlobalDutyPriority(){
        
      if($this->input->post()) {

        $priority = $this->input->post('priority', true);
        $duty_id = $this->input->post('duty_id', true);
        $order = $this->input->post('order', true);
        $selectedDate = $this->input->post('selectedDate', true);
        //echo  " Count order: ". count($order);

        //echo  " Count order 1: ". count($order);
        for( $i= 0; $i < count($order); $i++ ){
          
            $data = array(
              'priority' => $priority[$i],
              'duty_id' => $duty_id[$i],
              'sort_number' => $order[$i],
              'date' => $selectedDate,
              'admin_id' => $this->session->userdata('user_id')
            );
          
            //Delete all old sort data by date and if duty is enable only
            $this->AdminModel->deleteDutyIfEnable( 'globalWaaraSort', $selectedDate, $duty_id[$i]);         
            $this->AdminModel->insert( 'globalWaaraSort', $data );
        }
      
      }
    } 
    function deleteGlobalDuty(){
        if($this->input->get()) {
            $id = $this->input->get('id');
            $this->AdminModel->delete ( 'duty_id', $id, 'waara_global_template' );
            $this->AdminModel->delete ( 'duty_id', $id, 'globalWaaraSort' );
            redirect('Admin/globalSort');
          
        }
    }
    function updateDutyPriority(){
        
      if($this->input->post()) {

        $priority = $this->input->post('priority', true);
        $duty_id = $this->input->post('duty_id', true);
        $order = $this->input->post('order', true);
        $selectedDate = $this->input->post('selectedDate', true);
        //echo  " Count order: ". count($order);

        //echo  " Count order 1: ". count($order);
        for( $i= 0; $i < count($order); $i++ ){
          
            $data = array(
              'priority' => $priority[$i],
              'duty_id' => $duty_id[$i],
              'sort_number' => $order[$i],
              'date' => $selectedDate,
              'admin_id' => $this->session->userdata('user_id')
            );
          
            //Delete all old sort data by date and if duty is enable only
            $this->AdminModel->deleteDutyIfEnable( 'waaraSort' , $selectedDate, $duty_id[$i]);          
            $this->AdminModel->insert( 'waaraSort', $data );
        }
      
      }
    }
    function addJK() {   
        if($this->input->post()) {

            $data = array (
                'name' => $this->input->post('jkName', true),
                'location' => $this->input->post('location', true)
            );


        if ( $this->AdminModel->addJK( $data ) ) {

            $data = array (
                    'message' => 'JK created successfully.'
            );

            $data['JK'] = $this->AdminModel->getJamatKhana();
            $this->loadView('admin/addJK', $data);

        }

      } else {
            $data['JK'] = $this->AdminModel->getJamatKhana();
            $this->loadView('admin/addJK', $data);

        }

    }
function addNewDuty(){
         if($this->input->post()) {

            $beforeDuty = $this->input->post('beforeDuty', true);
            
            //Date or for_all to add duty for specific day only
            $addDutyDate =  $this->input->post('addDutyDate', true);
            $selectedSpecificDate =  $this->input->post('addDutyDate', true);
            $refresh =  $this->input->post('refresh', true);
           
            $dutyExists = $this->AdminModel->getDutyDetails( $this->input->post('duty_name', true) );

 
            if( count($dutyExists) > 0 ){
              
                $dutyOldDate = $dutyExists[0]->for_day;
                $oldDutyID = $dutyExists[0]->duty_id;
                $addDutyDate = $addDutyDate ."," . $dutyOldDate;
                $data = array(
                    'for_day' => $addDutyDate
                );
                $this->AdminModel->update( 'duty', 'duty_id', $oldDutyID, $data );
            } else {
              
                //insert and update priority
                $this->AdminModel->updateDutyByOrder($beforeDuty, $this->input->post('duty_name', true), $this->input->post('description', true), $addDutyDate );

                $selectJkIds = $this->input->post('jk', true);

                //get inserted id of duty
                $dutyInsertedId = $this->db->insert_id();

              //Global Duty Added 


              if($addDutyDate == 'all'){
                
                  $check_record_exists = $this->AdminModel->checkGlobalSortRecord();
                  //Check if there is any record exists in the global waara sort table or not before add any new record
                  if ( count($check_record_exists) > 0 ){
                      
                      $waara_data = $this->AdminModel->getWaaraidByPriority($beforeDuty+1);
                      if( isset($waara_data)  ){
                                $waara_id = $waara_data->duty_id;
                                $sort_data = $this->AdminModel->getGlobalSortNumber($waara_id);

                                //Data found in waara sort table by duty id and selected date
                                if(!empty($sort_data)){

                                  $sort_number = $sort_data[0]->sort_number;
                                  $dutyDate = $sort_data[0]->date;
                                  $this->AdminModel->globalSortDutyNumbers( $sort_number, $dutyInsertedId, $dutyDate, $this->session->userdata('user_id'));

                                }

                       } else {
                              //Get Max sort number  global waara Sort Table by date selected using limit 1
                              $getMaxSortNumber = $this->AdminModel->getHighestGlobalSortNumber();

                              //Data found by date but no Priority found
                              if(!empty($getMaxSortNumber)){
                                    $data = array(
                                      'priority' => $beforeDuty,
                                      'duty_id' => $dutyInsertedId,
                                      'date' => $getMaxSortNumber[0]->date,
                                      'admin_id' => $this->session->userdata('user_id'),
                                      'sort_number' => ($getMaxSortNumber[0]->max_sort_number+1)
                                    );

                                    $this->AdminModel->insert('globalWaaraSort' , $data); 
                                }                     

                      }   
                  }


            
              } else {
                  $check_record_exists = $this->AdminModel->checkSpecificSortRecord($selectedSpecificDate);
                  if(count($check_record_exists) > 0 ){
                        //Specific Day Duty Added
                        //get order_number from waaraSort by date and duty_id  
                        //Priority not empty
                        if(!empty($beforeDuty)){
                            $waara_data = $this->AdminModel->getWaaraidByPriority($beforeDuty+1);

                            if(!empty($waara_data)){
                                  $waara_id = $waara_data->duty_id;
                                  $sort_data = $this->AdminModel->getWaaraSortNumber($waara_id, $addDutyDate);

                                  //Data found in waara sort table by duty id and selected date
                                  if(!empty($sort_data)){
                                    $sort_number = $sort_data->sort_number;
                                    $this->AdminModel->sortDutyNumbers( $sort_number, $dutyInsertedId, $addDutyDate, $this->session->userdata('user_id'));
                                  } 
                            } else {
                                  //Get Max sort number from waara Sort Table by date selected
                                  $getMaxSortNumber = $this->AdminModel->getHighestSortNumber($addDutyDate);

                                  //Data found by date but no Priority found
                                  if(!empty($getMaxSortNumber)){
                                    $data = array(
                                      'priority' => $beforeDuty,
                                      'duty_id' => $dutyInsertedId,
                                      'date' => $addDutyDate,
                                      'admin_id' => $this->session->userdata('user_id'),
                                      'sort_number' => ($getMaxSortNumber[0]->max_sort_number+1)
                                    );

                                    $this->AdminModel->insert('waaraSort' , $data); 
                                  } 

                            }             
                        }                     
                  }
                
              }




                
              //  die();
              
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
            }

            $data = array (
                'message' => 'Duty successfully inserted.'
            );

        }
  
   redirect("Admin/addDuty");
}
    function addDuty() {   

 

        $jamatKhanas = $this->AdminModel->getJamatKhana();

        $jkArray = array();

        //populate array with Id as key and value
        foreach($jamatKhanas as $item => $value) {
            $jkArray[$value->id] = $value->name;
        }

        $data['duty'] = $this->AdminModel->getAllfromTableOrderBy('duty', 'priority', 'asc');

        $data['jkArray'] = $jkArray;
        $data['jkDb'] = $jamatKhanas;
        //Redirect user to global sort page if duty is created from globalSort page
        if($refresh == 'globalSort'){
          redirect('admin/globalSort');
        }
       $this->loadView('admin/addDuty', $data);

    }

    /**
     * Insert Custom field data
     * 1. @param : customField
     */

    function addNewCustomField() {

        if($this->input->post('custom_field', true)){

           //Insert custom field 

            $customField = $this->input->post('custom_field', true);
            
            //replace space with _ to make name of the field
            $fieldName = str_replace( ' ', '_' , $customField);

            $data = array (
                'input_type' => 'TEXT',
                'field_name' => $fieldName,
                'field_lable' => $customField
                );

            if ( $this->AdminModel->insert('customfields', $data) ) {

                $data = array (
                    'message' => 'successfully inserted'
                    );

                $this->loadView('admin/addNewCustomField', $data);
                
            }

        } else {
            
            $this->loadView('admin/addNewCustomField', null);

        }

    }
    function assign_multiple_duty() {   



            $assignDuty = array (
                "user_id" => $this->input->post('userid', true),
                "jk_id" => $this->input->post('jk', true),
                "duty_id" => $this->input->post('duty', true),
                "start_date" => $this->input->post('startDate', true),
                "end_date" => $this->input->post('endDate', true),
                "admin_id" => $this->session->userdata('user_id')
            );
            $rowCount = $this->AdminModel->checkForExists('assign_duty', $assignDuty);
            if( $rowCount < 1 ){
                //insert in assign_duty table
                $this->AdminModel->insert('assign_duty', $assignDuty);
               // echo "Waara Assign Successfully.";
            }


    }

    function assign_duty() {   

        if($this->input->post()) {

            $assignDuty = array (
                "user_id" => $this->input->post('userid', true),
                "jk_id" => $this->input->post('jk', true),
                "duty_id" => $this->input->post('duty', true),
                "start_date" => $this->input->post('startDate', true),
                "end_date" => $this->input->post('endDate', true),
                "admin_id" => $this->session->userdata('user_id')
            );

            $data = array (
                'message' => 'Assign Duty Successfully.'
            );
            //insert in assign_duty table
            $this->AdminModel->insert('assign_duty', $assignDuty);
        } 
       
        
        $data['users'] = $this->AdminModel->getAllfromTable( 'user' );

        $dutyArray = array();

        $data['duty'] = $this->AdminModel->getAllfromTable( 'duty' );

        $this->loadView('admin/assign_duty', $data);

        
    }


    //ajax call to populate jk dropdown
    function ajaxJk() {

        $state=$this->input->post('state');

        $jk = $this->AdminModel->getJkFromDuty( $state );

        echo '<option value="">Select Jamatkhana </option>';
            foreach($jk as $row) { 
                 echo "<option value='".$row->id."'>".$row->name."</option>";
        }

    }


    //ajax call to populate jk dropdown
    function getUser() {

        $state = $this->input->post('state');
        
        $user = $this->AdminModel->getUserById( $state['userId'] );

        if( $user->pref_duty == "" && $user->pref_jk == "" ) {
            echo "0";
            return;

        } else {
            
            $flag = "-1";

            foreach ( explode(',', $user->pref_jk) as $item) {
                if($item == $state['jkId']) {
                    $flag = "1";
                }
            }            

            if($flag == "1") {

                $flag = false;

                foreach ( explode(',', $user->pref_duty) as $item) {
                    if($item == $state['duty']) {
                        $flag = true;
                    }
                }                
            }

            echo $flag;
            return; 

        }

    }

    function assignment() {

        $id =  $this->input->get('id');

        $this->loadView('admin/assignment', null);

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

    /**
     * deleteJK
     * @param 1 : jk id
     */
    function deleteJK() {

        $id = $this->input->get('id', TRUE);
        $this->AdminModel->delete( 'id', $id, 'jk');
        redirect('admin/addJK');

    }

    /**
     * User
     */
    function user() {

        //$data['user'] = $this->AdminModel->getAllfromTableOrderBy( 'user', 'first_name', 'asc' );
        $data['user'] = $this->AdminModel->getAllSortedUser();
        $data['jk'] = $this->AdminModel->getAllfromTable( 'jk' );
        $data['ageGroup'] = $this->AdminModel->getAllfromTable( 'age_group' );
        $data['color'] = $this->ColorModel->getUnassignColors();
        $this->loadView('admin/user', $data);

    }
  
      /**
     * User
     */
    function userList() {

        //$data['user'] = $this->AdminModel->getAllfromTableOrderBy( 'user', 'first_name', 'asc' );
        $data['user'] = $this->AdminModel->getUsersByWaaraDays(date('y-m-d'));
        $data['tableData'] = $this->AdminModel->getTableData('client', 'userList');
        $data['jk'] = $this->AdminModel->getAllfromTable( 'jk' );
        $data['ageGroup'] = $this->AdminModel->getAllfromTable( 'age_group' );
        $data['color'] = $this->ColorModel->getUnassignColors();
        $data['duties'] = $this->AdminModel->getAllfromTable('duty');
        $data['majalis'] = $this->MajalisModel->getAllMajalis();

           // $data['waara_details'] = $this->AdminModel->getWaarabyIds($data['duties']);
            //$data['excluded_waara'] = $this->AdminModel->getWaaraExcludebyIds($data['duties']);      
        $this->loadView('admin/userList', $data);

    }
      /**
     * User
     */
    function userListSetting() {

        $data['tableData'] = $this->AdminModel->getTableData('settings', 'userList');
        $data['tableDataValues'] = $this->AdminModel->getTableData('client', 'userList');

        $data['tableDataValues'] = explode(',' , $data['tableDataValues'][0]->values);


      
        $this->loadView('admin/userListSetting', $data);

    }  
  
    function saveTableSettingsData(){
      if($this->input->post()) {
         $values = $this->input->post('tableData', true);
         $controller_name = $this->input->post('controller_name', true);
         $type = $this->input->post('type', true);
         $scriptData = '';

        for($i=0; $i< count($values); $i++ ){
                    $scriptData = $scriptData . '  {
                "targets": [ '.$values[$i].' ],
                "visible": false
           },';
        }
        $scriptData = substr($scriptData, 0, -1);
        $scriptData = ',"columnDefs": [' . $scriptData . ']';

         $values = implode(',',$values);
         $data = array(
            'values' => $values,
            'type' => $type,
            'controller_name' => $controller_name,
            'script' => $scriptData,
            'admin_id' => $this->session->userdata('user_id')

         );
        $this->AdminModel->insert( 'tableSettingsData' , $data);
        redirect('Admin/userListSetting');
      }
    }

    function addUserRole() {

     if ($this->input->post()) {
 
        $type = $this->input->post('type', true);
        $userId = $this->input->post('userId', true);
        
        $jk_id = '';
        $shift_id = '';
    

        if($type == 'Majalis') {

          $majalisData = array (
            'user_id' => $userId,
            'majalis_id' => $this->input->post('majalis'),
            'type' => $type
          );

          $this->AdminModel->insert('majalis_admin', $majalisData);

        } else {

          $jk_id = $this->input->post('jk_id', true);
          $shift_id = $this->input->post('shift_id', true); 
        }

        $data = array (
            "type" => $type, 
            "jk_id" => $jk_id,
            "shift"  => $shift_id
        );

      
        if( $data["type"] == "Super Admin" ){
          $data["jk_id"] = 0;
        }

        $this->AdminModel->update( 'user', 'user_id', $userId, $data );
       
        redirect('admin/userList');
      }
    }

    /**
     * deleteUser
     */
    function deleteUser() {

        $id = $this->input->get('id', TRUE);
        $this->AdminModel->delete( 'user_id', $id, 'user');
        redirect('admin/user');

    }


    function edituser() {

        if($this->input->post()) {

            $id = $this->input->post('userId', true);

            $customfields = $this->AdminModel->getAllfromTable('customfields');
            $selected_duties = $this->input->post('duties', true);

            $customData = array();

            //iterate every custom field and check if the key exist in posted data. If exist insert it in user custom data
            foreach( $customfields as $item ) {
                if( array_key_exists( $item->field_name, $this->input->post() ) ) {

                    $customData = array( "value" => $this->input->post( $item->field_name, true) );
                                            // tablename           key      value   key    value               data   
                    $this->AdminModel->updateWhere('user_custom_data', 'user_id', $id, 'key', $item->field_name, $customData);

                }
            }
            if (!empty($customData)){
                $this->AdminModel->update('user_custom_data' ,'user_id' , $id, $customData);

            }


            $data = array (
                "first_name" => $this->input->post('firstName', true),
                "last_name" => $this->input->post('lastName', true),
                "email" => $this->input->post('email', true),
                "phone" => $this->input->post('phone', true),
                "age_group"=>$this->input->post('age_group', true),
                "pref_duty" =>implode(",", $selected_duties),
                "admin_id" => $this->session->userdata('user_id')
            );
            $password = $this->input->post('password', true);
            if( isset( $password ) ){
                 $data["password"] = md5( $this->input->post('password', true) );
            }
            

            $this->AdminModel->update('user' ,'user_id' , $id, $data);

            redirect('admin/edituser?uid=' . $id );

        }

        if( $this->input->get('uid', TRUE) ) {

            $id = $this->input->get('uid', TRUE);
   
            $data['customFields'] = $this->AdminModel->getCustomFieldByUserId( $id );

            $data['user'] = $this->AdminModel->getUserById( $id );
//            if(!empty($data['user']->pref_jk)){
//                $data['duties'] = $this->AdminModel->getDuties( $data['user']->pref_jk );
//            }
            $data['duties'] = $this->AdminModel->getAllfromTable( 'duty' );
            $data['ageGroup'] = $this->AdminModel->getAllfromTable( 'age_group' );

            $this->loadView('admin/edituser', $data);

        }
  
    }

    /**
     * logout
     */
    function logout() {

        $this->session->sess_destroy();

        redirect('admin/');

    }

    function news() {

         if($this->input->post()) {

           
            $title = $this->input->post('title', true);
            $details = $this->input->post('details', true);
            $created_date = date("d-m-Y");


            $data = array (
                "title" => $title, 
                "details" => $details,
                "created_date" => $created_date
            );

             
            if ( $this->AdminModel->insert( 'news',$data ) ) {

                $data = array (
                    'message' => 'Successfully News Created'
                    );
                
            }  
            $data["news"] = $this->AdminModel->getAllfromTable( 'news' );

            $this->loadView('admin/news',  $data);


        } else{
                     $data["news"] = $this->AdminModel->getAllfromTable( 'news' );

            $this->loadView('admin/news',  $data);
        }
        

           

    }

    /**
     * delete news
     */
    function deleteNews() {

        $id = $this->input->get('id', TRUE);
        $this->AdminModel->delete( 'id', $id, 'news');
        redirect('admin/news');

    }

    /**
     * Edit news
     */
    function editNews() {

        if($this->input->post()) {

        echo    $title = $this->input->post('title', true);
        echo    $details = $this->input->post('details', true);
        echo    $id = $this->input->post('id', true);
            $data = array (
                "title" => $title, 
                "details" => $details,
            );
            $this->AdminModel->update('news','id',$id, $data);
            
            redirect('admin/news');


        } else {
        $id = $this->input->get('id', TRUE);
        $data = $this->AdminModel->getrecordById('news','id',$id);
        $this->loadView('admin/editNews',  $data);
        }

    }
    /**
     * Edit JK
     */
    function editJK() {

        if($this->input->post()) {
            $name = $this->input->post('jkName', true);
            $location = $this->input->post('location', true);
            $id = $this->input->post('id', true);
            $data = array (
                "name" => $name, 
                "location" => $location
            );
            $this->AdminModel->update('jk','id',$id, $data);
            
           redirect('admin/addJK');


        } else {
        $id = $this->input->get('id', TRUE);
        $data = $this->AdminModel->getrecordById('jk','id',$id);
        $this->loadView('admin/editJK',  $data);
        }

    }


    /**
     * deleteDuty
     * @param 1 : DutyId
     */
    function deleteDuty() {

        $id = $this->input->get('id', TRUE);
        return $this->AdminModel->delete( 'duty_id', $id, 'duty');
        
        //redirect('admin/addDuty');

    }
  
     /**
     * deleteAssignDuty
     * @param 1 : AssignDutyId
     */
    function deleteAssignDuty() {

        $id = $this->input->post('id', TRUE);
        $this->AdminModel->delete( 'assign_id', $id, 'assign_duty');
        echo "Deleted Successfully";
    }

    function editDuty() {

        if($this->input->post()) {

            $name = $this->input->post('name', true);
            $description = $this->input->post('description', true);
            $id = $this->input->post('id', true);
            $beforeDuty = $this->input->post('beforeDuty', true);

            $this->AdminModel->updatePriority( $beforeDuty, $name, $description, $id );
            
            redirect('admin/addDuty');


        }

        $id = $this->input->get('id', TRUE);
        $data['duty'] = $this->AdminModel->getrecordById('duty','duty_id',$id);

        $data['duties'] = $this->AdminModel->getAllfromTableOrderBy('duty', 'priority', 'asc');


        $this->loadView('admin/editduty',  $data);
    }



    function ajaxUserHistory() {

        $userId=$this->input->post('state');

        //$userHistory = $this->AdminModel->getUserHistory( $userId );
        $userHistory = $this->AdminModel->getUserHistory( $userId );
        $userHistoryLog = $this->AdminModel->getUserHistoryLog( $userId );
        $result = array_merge($userHistory, $userHistoryLog);
        
        $html = '<table id="userHistoryt" class="table table-striped">
        <thead>
        <tr>
            <th> Name </th>
            <th> Duty </th>
            <th> Reason </th>
            <th> Date </th>
            <th> Total Days </th>
        </tr>
        </thead>
        <tbody>';
        

        foreach($result as $row) { 


            $OldDate = new DateTime($row->start_date);
            $now = new DateTime(Date('Y-m-d'));
            $datediff = $OldDate->diff($now);
            $html = $html . '<tr class="historyRows">
                                <td> '. $row->first_name .' </td>
                                <td> '. $row->name .' </td>
                                <td> '. $row->reason .' </td>
                                <td>'. $row->start_date .' </td>
                                <td> '.$datediff->days .' </td>
                            </tr>';

        }

        $html = $html . '<tbody></table> <script > sortByDate()  </script>';

        echo $html;

    }



    function ajaxDutyByDate() {

        $date = $this->input->post('date');

        $duty = $this->AdminModel->getAssignDutyDetailByStartDate( $date );

        $html = '<table  class="table table-striped" id="dutyTable">
        <thead>
        <tr>
            <th> User Name </th>
            <th> Duty Name  </th>
            <th> Jamat Khana </th>
            <th> Shift </th>
            <th> Date </th>

        </tr>
        </thead>
        <tbody>';




        foreach($duty as $row) { 

            $html = $html . '<tr>
                                <td>' . $row->first_name . ' </td>
                                <td>' . $row->dutyname . '</td>
                                <td>' . $row->jkname . '</td>
                                <td>' .  ($row->shift == 1? "Evening": ($row->shift == 2? "Morning" :"both"))   . '</td>
                                <td>' . $row->start_date . '</td>
                                <td>
                                    <a href="'. site_url('admin/editAssignDuty?id=' . $row->assign_id ) .'" ><span class="glyphicon glyphicon-pencil">
                                    </span> 
                                    </a>
                                </td>
                            </tr>';
        }

        $html = $html . '<tbody></table>';

        echo $html;

    }



    function assignedDuties() {
        $this->loadView('admin/assigned_duties', null);
    }

    
    function editAssignDuty() {

        if($this->input->post()) {

            $selectedUser = $this->input->post('selectedUser', true);

            $reason = $this->input->post('reason', true);

            $assignId = $this->input->post('assignId', true);

            $data = array (
                "user_id" => $selectedUser
            );
            $assign_user_data = $this->AdminModel->getAssignUserData( $assignId );
            $assign_duty_log_data = array (
                "duty_id" =>  $assign_user_data->duty_id,
                "user_id" => $assign_user_data->user_id,
                "jk_id" =>  $assign_user_data->jk_id,
                "start_date" =>  $assign_user_data->start_date,
                "date" =>  date("Y-m-d"),
                "shift" =>  $assign_user_data->shift,
                "reason" => $reason,
                "admin_id" => $this->session->userdata('user_id')
            );
          

            $this->AdminModel->insert('assign_duty_logs', $assign_duty_log_data);
            $this->AdminModel->update( 'assign_duty', 'assign_id', $assignId, $data );
            $emailMessage = $this->EmailModel->getEmailContent();
            $this->AdminModel->waaraNotificationEmail($selectedUser, $assign_user_data->jk_id, $assign_user_data->duty_id, $assign_user_data->start_date , $emailMessage[0]->content );

            redirect('admin/assignedDuties');

        } else {

            $assignId = $this->input->get('id', TRUE);

            $user = $this->AdminModel->getUserByAssignedDuty( $assignId );

            if(count($user) <= 0 ) {
            redirect('admin/');
            }

            $data['assignId'] = $assignId;
            $data['user'] = $user;


            $this->loadView('admin/editAssignDuty', $data);

        }

    }
    public function saveUser() {

        if($this->input->post()) {

            $firstName = $this->input->post('firstName', TRUE);
            $lastName = $this->input->post('lastName', TRUE);
            $password = $this->input->post('password', TRUE);
            $email = $this->input->post('email', TRUE);
            $phone = $this->input->post('phone', TRUE);
            $age_group = $this->input->post('age_group', TRUE);
            if(empty($password)){
                $password = "1234";
            }
            
            $token = $this->AdminModel->generateToken();

            $data = array(
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'phone' => $phone,
                'password' => md5($password),
                'status' => 'false',
                'verified' => 'false',
                'type' => 'User',
                'token' => $token,
                'age_group' => $age_group
            );

            $this->AdminModel->insert('user', $data);
            $user_id = $this->AdminModel->getLastInserted();


            $emailMessage = "Please verify your account using this link \n".base_url()."index.php/Welcome/verify?token=".$token. " and your temporary password is " . $password ;

            mail($email,"User verification",$emailMessage);
            echo $user_id;
                   
        }
        
    }
 public function createNewUser() {

        if($this->input->post()) {

            //print_r($this->input->post());

            $firstName = $this->input->post('firstName', TRUE);
            $lastName = $this->input->post('lastName', TRUE);
            $password = $this->input->post('password', TRUE);
            $email = $this->input->post('email', TRUE);
            $phone = $this->input->post('phone', TRUE);
            $waara_id = $this->input->post('waara_id', TRUE);
            $date = $this->input->post('assign_date', TRUE);
            $age_group = $this->input->post('age_group', TRUE);
            $duties = $this->input->post('duties', true);
            $jks = $this->input->post('jks', true);
            if(empty($password)){
                $password = "1234";
            }
            
            $token = $this->AdminModel->generateToken();

            $data = array(
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'phone' => $phone,
                'password' => md5($password),
                'status' => 'false',
                'verified' => 'false',
                'type' => 'User',
                'token' => $token,
                'age_group' => $age_group,
                'pref_duty' => implode(",",$duties),
                'pref_jk' => implode(",",$jks)
            );

            $this->AdminModel->insert('user', $data);
//             $user_id = $this->AdminModel->getLastInserted();
//             $jk = $this->AdminModel->getJkFromDuty( $waara_id );
//             $jk_id = $jk[0]->id;

//             $emailMessage = "Please verify your account using this link \n".base_url()."index.php/Welcome/verify?token=".$token. " and your temporary password is " . $password ;

//             mail($email,"User verification",$emailMessage);
//             $assign = array( 
//                 "user_id" => $user_id,
//                 "duty_id" => $waara_id,
//                 "jk_id" => $jk_id,
//                 "start_date" => $date,
//                 "end_date" => $date,
//                 "shift" => 'both'
//             );

           // $this->AdminModel->insert('assign_duty', $assign);
          //  $emailMessage = $this->EmailModel->getEmailContent();
          //  $this->AdminModel->waaraNotificationEmail($user_id, $jk_id, $waara_id, $date, $emailMessage[0]->content );
          //  redirect('admin/');
            header('Location:http://waaranet.ca/index.php/Admin/index');
                   
        }

        
        $data['ageGroup'] = $this->AdminModel->getAllfromTable( 'age_group' );
  
        $this->loadView('admin/addNewUser', $data);
    }
    public function addNewUser() {

        if($this->input->post()) {

            //print_r($this->input->post());

            $firstName = $this->input->post('firstName', TRUE);
            $lastName = $this->input->post('lastName', TRUE);
            $password = $this->input->post('password', TRUE);
            $email = $this->input->post('email', TRUE);
            $phone = $this->input->post('phone', TRUE);
            $waara_id = $this->input->post('waara_id', TRUE);
            $date = $this->input->post('assign_date', TRUE);
            $duties = $this->input->post('duties', true);
            $age_group = $this->input->post('age_group', TRUE);
            if(empty($password)){
                $password = "1234";
            }
            
            $token = $this->AdminModel->generateToken();

            $data = array(
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'phone' => $phone,
                'password' => md5($password),
                'status' => 'false',
                'verified' => 'false',
                'type' => 'User',
                'token' => $token,
                'age_group' => $age_group,
                'pref_duty' => $duties,
                "admin_id" => $this->session->userdata('user_id')
            );

            $this->AdminModel->insert('user', $data);
            $user_id = $this->AdminModel->getLastInserted();
            $jk = $this->AdminModel->getJkFromDuty( $waara_id );
            $jk_id = $jk[0]->id;

            $emailMessage = "Please verify your account using this link \n".base_url()."index.php/Welcome/verify?token=".$token. " and your temporary password is " . $password ;

            mail($email,"User verification",$emailMessage);
            $assign = array( 
                "user_id" => $user_id,
                "duty_id" => $waara_id,
                "jk_id" => $jk_id,
                "start_date" => $date,
                "end_date" => $date,
                "shift" => 'both'
            );

            $this->AdminModel->insert('assign_duty', $assign);
            $emailMessage = $this->EmailModel->getEmailContent();
            $this->AdminModel->waaraNotificationEmail($user_id, $jk_id, $waara_id, $date, $emailMessage[0]->content );
            redirect('admin/');
            header('Location:http://waaranet.ca/index.php/Admin/index');
                   
        }



            $jkArray = $this->AdminModel->getAllfromTable('jk');
            $jks = array();

            foreach($jkArray as $item => $value) {
                $jks[$value->id] = $value->name;
            }            

            $data['jks'] = $jks;
        $data['ageGroup'] = $this->AdminModel->getAllfromTable( 'age_group' );

        $this->loadView('admin/addNewUser', $data);
    }

   public function request() {   

    $data['result'] = $this->AdminModel->getRequest();
    $this->loadView('admin/request', $data);

       
    }

    public function deleteRequest() {

        $id = $this->input->get('id', TRUE);
        $this->AdminModel->delete( 'id', $id, 'request');
        redirect('admin/request');

    }


    public function updateStatus() {

        $id = $this->input->get('id', TRUE);
        $status = $this->input->get('status', TRUE);
        $status = ($status == 'true' ? 'false' : 'true' ); 
        $data =  array('status' =>   $status );
        $this->AdminModel->update( 'user', 'user_id', $id,  $data );
       // redirect('admin/userList');

    } 
    public function waaraNotification (){
        
        $currentDate = date ("d-m-Y");
        $day_after = date( 'Y-m-d', strtotime( $currentDate . ' +1 day' ) );
        $data['result'] = $this->AdminModel->getWaaraFromdate($day_after);
        $date=date_create($day_after);
        $date =  date_format( $date, "F j, Y");

        foreach ($data['result'] as $key => $value) {
            $name =  $value->first_name . " " .  $value->last_name; 
            $duty_name =  $value->duty_name; 
            $jk_name = $value->jk_name;
            $duty_description = $value->duty_description;
            $shift = $value->shift;
            $message = 'Dear \n'. $name . ', \n This is to remind you that you have a ' . $duty_name . ' Waara at '.$jk_name.' on: \n'.$date.'\n Please contact Waara Coordinator @ 403-999-9999 or email @ waara@franklinjk.ca  as soon as possible if you need to re-schedule \n Thank you, \n'. $jk_name .' WAARA Team' ;
            $email  = $value->email;
            mail( $email, "Waara Notification", $message);
        }
    }         
    public function exportPDF (){

         $dbData = $this->AdminModel->get_calendar_duties();
         $temp = [];
         $data['result'] = [['Fullname', 'JK Name', 'Waara Name', 'Date'],[' ', ' ', ' ', ' ']];

         foreach ($dbData as $key => $value) {
            $name = $value->first_name . " " . $value->last_name;
            array_push($temp,  $name);
            array_push($temp,  $value->jk_name);
            array_push($temp,  $value->duty_name);
            array_push($temp,  $value->start_date);
            array_push($data['result'],  $temp);

         }
        
        $this->loadView('admin/exportPDF', $data );

    }

    public function updateVerify() {

        $id = $this->input->get('id', TRUE);
        $verified = $this->input->get('verified', TRUE);
        $verified = ($verified == 'true' ? 'false' : 'true' ); 
        $data =  array('verified' =>   $verified );
        $this->AdminModel->update( 'user', 'user_id', $id,  $data );
        
        $emailMessage = $this->EmailModel->getEmailContentByType('userApproval');
  
        $this->AdminModel->sendNotificationEmail($id, $emailMessage[0]->content, 'userApproval', 'Account Approval' );

        //redirect('admin/userList');

    } 

    public function enableDisableWaara() {

        $id = $this->input->get('id', TRUE);
        $status = $this->input->get('status', TRUE);
        $status = ( $status  == 1 ? 0 : 1 );
        $data =  array('isEnable' =>   $status );
        $this->AdminModel->update( 'duty', 'duty_id', $id,  $data );
        redirect('admin/addDuty');

    }
    /**
     * Age Group
     */
    function ageGroup() {

        if($this->input->post()) {
          
            $ageGroup = $this->input->post('age_group', TRUE);
          
            $data = array(
                'age_group' => $ageGroup
            );

            $this->AdminModel->insert('age_group', $data);
         }
        $data['ageGroup'] = $this->AdminModel->getAllfromTable( 'age_group' );
        $this->loadView('admin/ageGroup', $data);

    }
    /**
     * Save Duty Dates
     */
    function saveDutyDates() {

        if($this->input->post()) {
          
            $duty_date = $this->input->post('duty_date', TRUE);
            $dutyid = $this->input->post('dutyid', TRUE);

            $duty_date  = implode(",",$duty_date);
            $data = array(
              'for_day' => $duty_date
            );
            $this->AdminModel->update( "duty", "duty_id", $dutyid ,$data );
            redirect('admin/addDuty');
         }
         
        

    }
    /**
     * Age Group
     */
    function addRating() {

        if($this->input->post()) {
          
            $rating = $this->input->post('rating', TRUE);
           $assign_duty_id = $this->input->post('assign_duty_id', TRUE);
          
          
            $data = array(
                'stars' => $rating,
                'assign_duty_id' => $assign_duty_id,
                'admin_id' =>  $this->session->userdata('user_id')
            );

            $this->AdminModel->insert('rating', $data);
         }



    }
  function enableDisableDays(){
    if($this->input->post()) {
          
      
          $monday = $this->input->post('Monday', TRUE) == "" ? '' : 'Monday';
          $tuesday = $this->input->post('Tuesday', TRUE) == "" ? '' : 'Tuesday';
          $wednesday = $this->input->post('Wednesday', TRUE) == "" ? '' : 'Wednesday';
          $thursday = $this->input->post('Thursday', TRUE) == "" ? '' : 'Thursday';
          $friday = $this->input->post('Friday', TRUE) == "" ? '' : 'Friday';
          $saturday = $this->input->post('Saturday', TRUE) == "" ? '' : 'Saturday';
          $sunday = $this->input->post('Sunday') == "" ? '' : 'Sunday';

          $id = $this->input->post('id', TRUE);
          
          $data = array(
                    'Monday' => $monday,
                    'Tuesday' => $tuesday,
                    'Wednesday' => $wednesday,
                    'Thursday' => $thursday,
                    'Friday' => $friday, 
                    'Saturday' => $saturday,
                    'Sunday' => $sunday 
          );

          $this->AdminModel->update( 'duty', 'duty_id', $id, $data );
          redirect('admin/globalSort');
    }
  }
  function assignWaaraToUser() {
        
        $user_id = $this->input->post('user_id');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $duty_id = $this->input->post('duty_id');
        $jk_id = $this->input->post('jk');

        if( (isset( $user_id )) && (isset( $start_date )) )  {
            $data = array( 
                        "user_id" => $user_id,
                        "start_date" => $start_date,
                        "end_date" => $end_date,
                        "duty_id" => $duty_id,
                        "jk_id" => $jk_id,
                        "admin_id" => $this->session->userdata('user_id')
                    );
            $check = $this->AdminModel->checkAssignWaara( $duty_id, $start_date );
            if(empty($check)){
                $this->AdminModel->insert('assign_duty', $data); 
                $emailMessage = $this->EmailModel->getEmailContent();
                $this->AdminModel->waaraNotificationEmail($user_id, $jk_id, $duty_id, $start_date , $emailMessage[0]->content );

 
                echo "Waara assigned successfully";
            } else {
                echo "Waara already assigned";
            }          
        }
    } 

}
?>