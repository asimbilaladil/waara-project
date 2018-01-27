<?php
class SamarMayat extends CI_Controller {

    public function __construct(){
        parent::__construct();

            $this->load->model('AdminModel');
            $this->load->model('EmailModel');
            $this->load->model('ColorModel');
            $this->load->model('SamarMayatEmailModel');
      
      

    }

    function index(){
        $type = $this->uri->segment(2);
        if($type == 'mayat'){
          $data['tableHeaders'] = $this->AdminModel->getMayatTableHeaders('admin_mayat');
          $data['mayatTableValues'] = $this->AdminModel->getMayatTableHeaders('mayat');
          $data['tableHeaders'] = explode(",",$data['tableHeaders'][0]->names );
          $data['mayatTableValues'] = explode(",",$data['mayatTableValues'][0]->names );
          $data['emailNotification'] = $this->SamarMayatEmailModel->getEmailContent();
          $data['emailNotificationSwitch'] = $this->SamarMayatEmailModel->getEmailNotification();      
          $data['samarMayat'] = $this->AdminModel->getAllSamarMayat();
          $data['users'] = $this->SamarMayatEmailModel->getUsers();
          $data['url'] = $this->AdminModel->getUrlByType($type);

          $this->loadView('admin/viewSamarMayat', $data );          
        } else if ($type == 'samar'){
          $data['emailNotification'] = $this->SamarMayatEmailModel->getEmailContent();
          $data['emailNotificationSwitch'] = $this->SamarMayatEmailModel->getEmailNotification();      
          $data['samarMayat'] = $this->AdminModel->getAllSamar();
          $data['users'] = $this->SamarMayatEmailModel->getUsers();
        $this->loadView('admin/viewSamar', $data );        
        } else {
          show_404();
        }

    }
  
  function saveMayatHeader(){
     if($this->input->post()) {
       $names = $this->input->post('tableHeader', true);
       $names = implode(',',$names);
       $data = array(
          'names' => $names,
          'type' => 'mayat',
          'admin_id' => $this->session->userdata('user_id')
         
       );
       $this->AdminModel->insert( 'samarMayatTableHide' , $data);
       redirect('Administrator/mayat');
     }
  }
      /**
     * deleteJK
     * @param 1 : jk id
     */
    function delete() {

        $id = $this->input->get('id', TRUE);
        $type = $this->input->get('type', TRUE);      
        if( $type == 'mayat'){
            $this->AdminModel->delete( 'id', $id, 'samarMayat');
            redirect('Administrator/mayat');
    
        } else if ( $type == 'samar'){
            $this->AdminModel->delete( 'id', $id, 'Samar');
            redirect('Administrator/samar');       
        } else {
            show_404();
        }

    }
    
   function editMayat(){
     
     $id = $this->input->get('id', true);
     $data['jk'] = $this->AdminModel->getAllfromTable('jk');
     $data['mayat'] = $this->AdminModel->getMayatById($id);
     $this->loadView('admin/editMayat', $data );        
     
    } 
   function updateMayat(){
     
      if($this->input->post()) {
           $id = $this->input->post('id', true); 
           $title = $this->input->post('title', true);
           $fName = $this->input->post('fName', true);
           $lName = $this->input->post('lName', true);
           $originallyFrom = $this->input->post('originallyFrom', true);
           $age = $this->input->post('age', true);
           $funeralDate = $this->input->post('funeralDate', true);
           $date = $this->input->post('date', true);
           $time = $this->input->post('time', true);
           $type = $this->input->post('type', true);
           $jk_id = $this->input->post('jk_id', true);  
           $data = array(
               'title' => $title,
               'first_name' => $fName,
               'last_name' => $lName,
               'original_from' => $originallyFrom,
               'age' => $age,
               'funeral_date' => $funeralDate,
               'date' => $date,
               'time' => $time,
               'type' => $type,
               'jk_id' => $jk_id
           );
           $this->AdminModel->update( 'samarMayat', 'id', $id, $data );
           redirect("Administrator/mayat");
     }     
   } 
   function Add(){
      $type = $this->uri->segment(2);
      if( $type == 'mayat'){
          $data['jk'] = $this->AdminModel->getAllfromTable('jk');
          $data['type'] = $type;
          $this->load->view('admin/common/header');
          $this->load->view('admin/addSamarMayat', array('data' => $data));
          $this->load->view('admin/common/footer');        
      } else if ($type == 'samar'){
          $data['jk'] = $this->AdminModel->getAllfromTable('jk');
          $data['type'] = $type;
          $this->load->view('admin/common/header');
          $this->load->view('admin/addSamar', array('data' => $data));
          $this->load->view('admin/common/footer');      
      } else {
         show_404();
      }

    }
   function SamarNews(){
      $data['news'] = $this->AdminModel->getAllSamarMayatByType('samar');
      $content  = $this->SamarMayatEmailModel->getSamarEmailContent();
      $data['content'] = $content[0]->content;
      $this->load->view('admin/newsSamarMayat', array('data' => $data));

    } 
   function MayatNews(){
     $data['news'] = $this->AdminModel->getAllSamarMayatByType('Mayat');
     $content  = $this->SamarMayatEmailModel->getSamarMayatEmailContent();
     $data['content'] = $content[0]->content;

     if(count($data['news']) == 0){
       
          $data['url'] = $this->AdminModel->getUrlByType('mayat');
          $url = !empty($data['url'][0]->url) ? $data['url'][0]->url : 'no-url'; 
          if($url == 'no-url'){
           
            $this->load->view('admin/newsSamarMayat', array('data' => $data));
            
          } else {
            redirect( $url);
          }
          
      } 
     
     $this->load->view('admin/newsSamarMayat', array('data' => $data));

    }   
   function changeStatus(){
        if($this->input->post()) {
            $id = $this->input->post('id', true);
            $status = $this->input->post('status', true);
            $type = $this->input->post('type', true);
            $data = array(
                'status' => $status
            );
            //
            if($type == 'samar'){
               //$this->SamarMayatEmailModel->samarMayatNotificationEmail($id);
               $this->AdminModel->update( 'Samar', 'id', $id, $data );
            } else {
               $this->SamarMayatEmailModel->samarMayatNotificationEmail($id);
               $this->AdminModel->update( 'samarMayat', 'id', $id, $data );
            }
            
        }
    }    
   function SaveMayat(){
      
       if($this->input->post()) {
           
           $title = $this->input->post('title', true);
           $fName = $this->input->post('fName', true);
           $lName = $this->input->post('lName', true);
           $originallyFrom = $this->input->post('originallyFrom', true);
           $age = $this->input->post('age', true);
           $funeralDate = $this->input->post('funeralDate', true);
           $date = $this->input->post('date', true);
           $time = $this->input->post('time', true);
           $type = $this->input->post('type', true);
           $jk_id = $this->input->post('jk_id', true);
           $status = 'pending';
           
           $data = array(
               'title' => $title,
               'first_name' => $fName,
               'last_name' => $lName,
               'original_from' => $originallyFrom,
               'age' => $age,
               'funeral_date' => $funeralDate,
               'date' => $date,
               'time' => $time,
               'type' => $type,
               'status' => $status,
               'jk_id' => $jk_id
           );
           $insert_id = $this->AdminModel->insertSamar('samarMayat', $data);
          
          $this->SamarMayatEmailModel->samarMayatNotificationEmail($insert_id);
          redirect("SamarMayat/Success?type=$type");
       }
      
    }
  function SaveSamar(){
      
       if($this->input->post()) {

           $title = $this->input->post('title', true);
           $fName = $this->input->post('fName', true);
           $lName = $this->input->post('lName', true);
           $originallyFrom = $this->input->post('originallyFrom', true);
           $age = $this->input->post('age', true);
           $on = $this->input->post('on', true);
           $observedBy = $this->input->post('observedBy', true);
           $type = $this->input->post('type', true);
           $jk_id = $this->input->post('jk_id', true);         
           $familyName = $this->input->post('familyName', true);
           $familyPhone = $this->input->post('familyPhone', true);
           $submittedBy = $this->input->post('submittedBy', true);
           $position = $this->input->post('position', true);
           $phone = $this->input->post('phone', true);
          
           $status = 'pending';
           
           $data = array(
               'title' => $title,
               'first_name' => $fName,
               'last_name' => $lName,
               'original_from' => $originallyFrom,
               'age' => $age,
               'on' => $on,
               'observedBy' => $observedBy,
               'type' => $type,
               'jk_id' => $jk_id,
               'familyName' => $familyName,
               'submittedBy' => $submittedBy,
               'position' => $position,
               'familyPhone' => $familyPhone,
               'phone' => $phone,
               'status' => 'pending'
           );
           $insert_id = $this->AdminModel->insertSamar('Samar', $data);
          
          $this->SamarMayatEmailModel->samarMayatNotificationEmail($insert_id);
           redirect('SamarMayat/Success?type='+$type);
       }
      
    }
  
   function addNotification(){
      
        $data = array(
          'content' => $this->input->post('content', true),
          'type' => $this->input->post('type', true),
          'subject' => $this->input->post('subject', true),
          'date' => date("d-m-Y"),
          'user_id' => $this->session->userdata('user_id')
        );
        $this->SamarMayatEmailModel->insert( $data );
        $type = $this->input->post('type', true);
        if($type == 'samar'){
          redirect("Administrator/samar");
        } else {
          redirect("Administrator/mayat");
        }
        


    }

    
   function saveUsers(){
      
        $data = array(
          'users' => $this->input->post('users', true),
          'date' => date("d-m-Y"),
          'admin_id' => $this->session->userdata('user_id')
        );
        $this->AdminModel->insert( 'samarMayatNotificationUsers', $data );
        


    }

    function setSwitchNotification(){

        $data = array(
          'notification' => $this->input->post('samarMayatEmailNotification', true),
          'date' => date("d-m-Y"),
          'admin_id' => $this->session->userdata('user_id')
        );
        $this->SamarMayatEmailModel->setNotification( $data );
    }    
   function Success(){
          
      $this->load->view('admin/common/header');
      $this->load->view('admin/success', array('data' => null));
      $this->load->view('admin/common/footer');
   }
    function saveURL (){
        if($this->input->post()) {
                 $type = $this->input->post('type', true); 
                 $url = $this->input->post('url', true);
          $data = array(
               'type' => $type,
               'url' => $url,
               'admin_id' => $this->session->userdata('user_id')
          );
          $this->AdminModel->insert( 'samarMayatURL', $data );
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
?>