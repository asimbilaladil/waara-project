<?php
class Report extends CI_Controller {

    public function __construct(){
        parent::__construct();

        
        // if( $id != NULL  && $type != 'User' ) {
            $this->load->model('AdminModel');
            $this->load->model('EmailModel');

        // } else {

        //    redirect('Login/');

        // }        
    }

    /**
     * delete
     * @param id :  id
     */
    function delete() {

        $id = $this->input->get('id', TRUE);
        $this->AdminModel->delete( 'id', $id, 'report');
        redirect('Report');

    }
    function createReport() {
        
        $jkId = $this->session->userdata('jk_id');
        $type = $this->session->userdata('type');

        if( isset( $jkId ) && $jkId != 0 )  {

            $data['jk'] = $this->AdminModel->getJkById( $jkId );

        } else {

            $data['jk'] = $this->AdminModel->getAllfromTable('jk');

            $data['duty'] = $this->AdminModel->getAllfromTable( 'duty' );

        }

        $this->loadView('admin/createReport', $data );
        
    }

    function index(){

        $data['report'] = $this->AdminModel->getAllfromTable( 'report' );
        $this->loadView('admin/report', $data );
    }

    function viewReport() {
        $report_id = $this->input->get('id');
        if( isset( $report_id ) ) {
            $report = $this->AdminModel->getReportById($report_id);
            $data['duties'] = $report->waara_ids;
            $data['name'] = $report->name;
            $data['jk'] = $report->jk_id;
            $data['ageGroup'] = $this->AdminModel->getAllfromTable( 'age_group' );
            $data['waara_details'] = $this->AdminModel->getWaarabyIds($data['duties']);
            $data['excluded_waara'] = $this->AdminModel->getWaaraExcludebyIds($data['duties']);
            $this->loadView('admin/viewReport', $data );
        }
    } 
    function getDutyFromJk() {
        $jk_id = $this->input->post('state');

        if( isset( $jk_id ) )  {
            $html = '';
            if( $jk_id == 'select' ){
                echo $html;
            } else {
                $duties  = $this->AdminModel->getDutyByJk($jk_id);
                foreach ($duties as $key => $value) {
                   $html = $html . "<option value= '" . $value->duty_id . "' >" . $value->name . "</option>";
                }
                echo $html;
            }
        }
    }

    function addReport() {
        $jk_id = $this->input->post('jk');
        $duties = $this->input->post('duties');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        if( isset( $jk_id ) )  {
            $html = '';
            $data  = $this->AdminModel->getReportDetails($duties , $start_date , $end_date);
            $duties_dates = []; 
            foreach ($data as $key => $value) {
                $new_date = date("m/d/Y", strtotime($value->start_date));
                array_push($duties_dates, $new_date);
            }
            $duties_dates = array_unique($duties_dates);
            asort($duties_dates);
            $html = $html . '<option value="select">Select Date</option>';
            foreach ( $duties_dates as $key => $value) {
               $html = $html . "<option value= '" . $value . "' >" . $value . "</option>";
            }
            echo $html;            
        }
    }    
    function getReport() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $highlight = $this->input->post('highlight');
        $runQuery = $this->input->post('runQuery');
        $duties =  explode(',', $this->input->post('duties') );
        $nowDate = date("Y-m-d");
        $future14 = date('Y-m-d', strtotime($nowDate. ' + 14 days'));
        $past14 = date('Y-m-d', strtotime($nowDate. ' - 14 days'));
        $future14 = strtotime($future14);
        $past14 = strtotime($past14);

        if( (isset( $start_date )) && (isset( $end_date )) && (isset( $duties )) )  {

            $html = '';
            
         
            if($runQuery == 'true' ){

                $date_start =  $past14 = date('Y-m-d', strtotime($start_date. ' - 1 days'));
                $date_end = "1901-01-01";

               $user_data_without_date_range  = $this->AdminModel->getReportDataWithoutRange($date_end, $date_start, $duties);
              
            }
            $data  = $this->AdminModel->getReportData($end_date, $start_date, $duties);
            $user_data  = $this->AdminModel->getUserDataWithoutWaara ($end_date, $start_date, $duties);
          
          
          


          
            foreach ($user_data as $key => $value) {

               $html = $html . '<tr id="tr'. $value->user_id  .'" > <td onClick="showInfo(tr'. $value->user_id  .')" style="cursor: pointer;" >'. $value->name  .'</td> <td style="display:none;">'. $value->age .' </td> <td style="display:none;">'. $value->email .' </td> <td style="display:none;"> '. $value->email .' </td> <td style="display:none;"> '. $value->phone .' </td>  <td> <div class="col-sm-6"> <button type="button" data-toggle="modal" data-target="#assignWaara" class="col-sm-2 btn btn-primary btn-block" onclick="setId('. $value->user_id .')"  >Assign Waara </button> </div> </td> <td> <i class="glyphicon glyphicon-remove" ></i> </td> </tr> ';
            }
            if($runQuery == 'true' ){
                foreach ($user_data_without_date_range as $key => $value) {

                    $html = $html . '<tr id="tr'. $value->user_id  .'" > <td onClick="showInfo(tr'. $value->user_id  .')" style="cursor: pointer;" >'. $value->name  .'</td>  <td style="display:none;">'. $value->age .' </td> <td style="display:none;">'. $value->email .' </td> <td style="display:none;"> '. $value->email .' </td> <td style="display:none;"> '. $value->phone .' </td>  <td> <div class="col-sm-6"> <button type="button" data-toggle="modal" data-target="#assignWaara" class="col-sm-2 btn btn-primary btn-block" onclick="setId('. $value->user_id .')"  >Assign Waara </button> </div> </td> <td> <i class="glyphicon glyphicon-remove" ></i> </td> </tr> ';
                }
            }
            foreach ($data as $key => $value) {
                if( !empty($value->name) ){
                    if ( ( ( strtotime( $value->start_date ) <= $future14 )  && (  strtotime( $value->start_date) >= $past14  ) ) && $highlight == 'true')  {
                       $html = $html . '<tr id="tr'. $value->user_id  .'" > <td onClick="showInfo(tr'. $value->user_id  .')" style="cursor: pointer;" >'. $value->name  .'</td>  <td style="display:none;">'. $value->age .' </td><td> <mark>'. $value->start_date .'</mark> </td> <td style="display:none;"> '. $value->email .' </td> <td style="display:none;"> '. $value->phone .' </td> <td> <i  class="glyphicon glyphicon-ok" ></i> </td> </tr> ';

                    } else {
                       $html = $html . '<tr id="tr'. $value->user_id  .'" > <td onClick="showInfo(tr'. $value->user_id  .')"  style="cursor: pointer;"  >'. $value->name  .'</td>  <td style="display:none;">'. $value->age .' </td> <td> '. $value->start_date .' </td> <td style="display:none;"> '. $value->email .' </td> <td style="display:none;"> '. $value->phone .' </td> <td> <i  class="glyphicon glyphicon-ok" ></i> </td> </tr> ';

                    }
                }
            }                   
            echo $html;    
        }        
        
    } 
    function saveReport() {
        $duties = implode(',', $this->input->post('duties') );
        $name = $this->input->post('name');
        $jk_id = $this->input->post('jk');
        if( (isset( $duties )) && (isset( $name )) )  {
            $data = array( 
                        "waara_ids" => $duties,
                        "name" => $name,
                        "jk_id " => $jk_id
                    );

            $this->AdminModel->insert('report', $data);            
        }
    }   
    function assignWaara() {
        
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

    }

}
?>