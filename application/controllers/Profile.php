<?php
class Profile extends CI_Controller {

    public function __construct(){
        parent::__construct();

        
        // if( $id != NULL  && $type != 'User' ) {
            $this->load->model('AdminModel');
            $this->load->model('EmailModel');
            $this->load->library('upload');
        // } else {

        //    redirect('Login/');

        // }        
    }



    function index(){
      
        if(empty($_GET['id'])){
          redirect('Admin');
        }      
        $user_id = $_GET['id'];
       $userHistory = $this->AdminModel->getUserHistory( $user_id );
       $userHistoryLog = $this->AdminModel->getUserHistoryLog( $user_id );
       $data['user_info'] = $this->AdminModel->getUserById($user_id);   
       $data['events'] = $this->AdminModel->get_calendar_duties_by_user($user_id); 
     
      
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
        $data['userHistory']  = array_merge($userHistory, $userHistoryLog);
        $this->loadView('admin/profile', $data );
    }
    function uploadImage(){
        $user_id =  $this->input->post('userId', true);
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $user_id;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('set_img_name')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = $this->upload->data();
            $user_data = array ('user_image' => $data['orig_name'] );
            $this->AdminModel->update('user','user_id',$user_id, $user_data);
            redirect('Profile?id='.$user_id);
        }  
    }
    public function getRatingLogs(){
      
      $user_id =  $this->input->post('user_id', true);
      $date =  $this->input->post('date', true);
      $title =  $this->input->post('title', true);
      $data['rating'] = $this->AdminModel->getRating($user_id, $date, $title);
      $html = '<table class="table"> <thead> <tr> <th>No</th> <th>Rating</th> <th>Date</th> <th>Admin</th> </tr> </thead> <tbody>';
      $body = '';
      $htmlFooter = '</tbody> </table>';
      foreach($data['rating'] as  $key => $row ) { 
        $createDate = new DateTime($row->date);
        $strip = $createDate->format('Y-m-d');
        $body =  $body .'<tr> <td> '. $count =  $key + 1 .' </td> <td><input class="rating-system rating rating-input" id="rating-system_'.$row->id.'"  value="'.$row->stars.'"  name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1"></td> <td>'.$strip.'</td> <td>'.$row->admin_name.'</td> </tr> ';;
      }
      echo $html .  $body  . $htmlFooter;
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