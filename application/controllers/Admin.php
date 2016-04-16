<?php  if( ! defined('BASEPATH')) exit('No direct script access allowed');


session_start();
class Admin extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $id = $this->session->userdata('admin_id');
        if ($id == NULL) {
            redirect('AdminLogin', 'refresh');
        }
        $this->load->model('Admin_model');
        $this->load->model('WebSite');
    }

    public function index(){
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/index');
        $this->load->view('admin/footer');
    }

    public function admin_list(){
        $data =array();
        $data['admins']=$this->Admin_model->get_all_admin();
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/admins/adminList',$data);
        $this->load->view('admin/footer');
    }

    public function newAdmin(){
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/admins/addAdmin');
        $this->load->view('admin/footer');
    }

    function addAdmin()
    {
        if(isset($_POST) && count($_POST) > 0)
        {
            $params = array(
                'admin_name' => $this->input->post('admin_name'),
                'admin_email' => $this->input->post('admin_email'),
                'admin_password' => md5($this->input->post('admin_password'))
            );

            if( $this->db->insert('admin',$params)){
                $message['sucess_message'] = '<p><b>Sucess: Record inserted successfully !!</b></p>';
                $this->session->set_userdata($message);
                redirect('Admin/admin_list');

            }else{
                $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
                $this->session->set_userdata($message);
                redirect('Admin/addAdmin');
            }
            redirect('admin/index');
        }
        else
        {
            $this->load->view('Admin/admin_list');
        }
    }

    /*
     * Editing a admin
     */
    public function admin_edit($id){
        $data= array();
        $data['admin'] = $this->Admin_model->get_admin($id);
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/admins/editAdmin',$data);
        $this->load->view('admin/footer');
    }
    function updateAdmin()
    {
        $id =$this->input->post('id');
                $params = array(
                    'admin_name' => $this->input->post('admin_name'),
                    'admin_email' => $this->input->post('admin_email')
                );


               if($this->Admin_model->update_admin($id,$params)){
                   $message['sucess_message'] = '<p><b>Sucess: Record update successfully !!</b></p>';
                   $this->session->set_userdata($message);
                   redirect('Admin/admin_list');

               }else{
                   $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
                   $this->session->set_userdata($message);
                   redirect('Admin/admin_list');
               }

    }

    /*
     * Deleting admin
     */
    function admin_delete($id)
    {
        $admin = $this->Admin_model->get_admin($id);

        // check if the admin exists before trying to delete it
        if(isset($admin['admin_id']))
        {
            if( $this->Admin_model->delete_admin($id)){
                $message['sucess_message'] = '<p><b>Sucess: Record delete successfully !!</b></p>';
                $this->session->set_userdata($message);
                redirect('Admin/admin_list');

            }else{
                $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
                $this->session->set_userdata($message);
                redirect('Admin/admin_list');
            }
        }
        else
            show_error('The admin you are trying to delete does not exist.');
    }

    public function updatePassword(){
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/admins/editAdminPassword');
        $this->load->view('admin/footer');
    }
    public function setPassword(){
        $params= array();
        $id= $this->session->userdata('admin_id');
        $params['admin_password']=md5($this->input->post('confirmPassword'));

        if ($this->Admin_model->update_admin($id,$params )){
            $message['sucess_message'] = '<p><b>Sucess: Record Update successfully !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/updatePassword');

        }else{
            $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/updatePassword');
        }

    }

    public function categoryList(){
        $data =array();
        $data['category']= $this->Admin_model->get_all_category();
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/category/categoryList',$data);
        $this->load->view('admin/footer');
    }

    public function addCategory(){
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/category/addCategory');
        $this->load->view('admin/footer');
    }

    public function setCategory(){
        if(isset($_POST) && count($_POST) > 0)
        {
            $params = array(
                'cat_name' => $this->input->post('cat_name'),
            );
            if( $this->db->insert('category',$params)){

                $message['sucess_message'] = '<p><b>Sucess: Record Add successfully !!</b></p>';
                $this->session->set_userdata($message);
                redirect('Admin/categoryList');

            }else{
                $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
                $this->session->set_userdata($message);
                redirect('Admin/categoryList');
            }
        }
        else
        {
            $this->load->view('Admin');
        }
    }

    public function category_edit($id){
        $data = array();
        $data['category']=$this->Admin_model->get_category($id);
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/category/editCategory',$data);
        $this->load->view('admin/footer');
    }
    public function updateCategory(){
        if(isset($_POST) && count($_POST) > 0)
        {
            $id= $this->input->post('id');
            $params = array(
                'cat_name' => $this->input->post('cat_name')
            );

            if( $this->Admin_model->update_category($id,$params)){

                $message['sucess_message'] = '<p><b>Sucess: Record update successfully !!</b></p>';
                $this->session->set_userdata($message);
                redirect('Admin/categoryList');

            }else{
                $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
                $this->session->set_userdata($message);
                redirect('Admin/categoryList');
            }

        }
        else
        {
            redirect('Admin');
        }
    }
    public function category_delete ($id){
       if( $this->Admin_model->delete_category($id)){

            $message['sucess_message'] = '<p><b>Sucess: Record delete successfully !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/categoryList');

        }else{
            $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/categoryList');
        }
    }

    public function candidateList(){
        $data =array();
        $data['candidate']= $this->Admin_model->get_all_candidate();
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/clients/candidateList',$data);
        $this->load->view('admin/footer');
    }

    public function candidateBlock($id){
        $params = array(
            'candidate_status' =>'Block'
        );

        if( $this->WebSite->updateCandidateInfo($id,$params)){

            $message['sucess_message'] = '<p><b>Sucess: Record update successfully !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/candidateList');

        }else{
            $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/candidateList');
        }
    }
    public function candidateActive($id){
        $params = array(
            'candidate_status' =>'Active'
        );

        if( $this->WebSite->updateCandidateInfo($id,$params)){

            $message['sucess_message'] = '<p><b>Sucess: Record update successfully !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/candidateList');

        }else{
            $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/candidateList');
        }
    }

    public function candidateDelete($id){
        if( $this->Admin_model->delete_candidate($id)){

            $message['sucess_message'] = '<p><b>Sucess: Record delete successfully !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/candidateList');

        }else{
            $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/candidateList');
        }
    }
    public function voterList(){
        $data =array();
        $data['voter']= $this->Admin_model->get_all_voter();
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/clients/voterList',$data);
        $this->load->view('admin/footer');
    }

    public function voterIdBlock($id){
        $params = array(
            'voter_status' =>'Block'
        );

        if( $this->WebSite->updateVoterInfo($id,$params)){

            $message['sucess_message'] = '<p><b>Sucess: Record update successfully !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/voterList');

        }else{
            $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/voterList');
        }
    }

    public function voterIdActive($id){
        $params = array(
            'voter_status' =>'Active'
        );

        if( $this->WebSite->updateVoterInfo($id,$params)){

            $message['sucess_message'] = '<p><b>Sucess: Record update successfully !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/voterList');

        }else{
            $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/voterList');
        }
    }
    public function voter_delete($id){
        if( $this->Admin_model->delete_voter($id)){

            $message['sucess_message'] = '<p><b>Sucess: Record delete successfully !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/voterList');

        }else{
            $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/voterList');
        }
    }
    public function message(){
        $data['messages'] = $this->Admin_model->get_all_messages();
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/message/messageList',$data);
        $this->load->view('admin/footer');
    }

    public function message_delete($id){
        if( $this->Admin_model->delete_message($id)){

            $message['sucess_message'] = '<p><b>Sucess: Record delete successfully !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/message');

        }else{
            $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/message');
        }
    }

    public function eventList(){
        $data['events'] = $this->Admin_model->get_all_events();
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/event/eventList',$data);
        $this->load->view('admin/footer');
    }
    public function addEvent(){
        $data['category'] = $this->Admin_model->get_all_category();
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/event/addEvent',$data);
        $this->load->view('admin/footer');
    }
    public function setEvent(){
        if(isset($_POST) && count($_POST) > 0)
        {
            $category_id = $this->input->post('category_id');
            $params = array(
                'event_title' => $this->input->post('event_title'),
                'event_description' => $this->input->post('event_description'),
                'category_id' => $this->input->post('category_id'),
                'event_startDate' =>date('Y-m-d', strtotime($this->input->post('event_startDate'))) ,
                'event_endDate' => date('Y-m-d', strtotime($this->input->post('event_endDate'))),
                'event_status' => "active",
            );
            $this->db->insert('events',$params);
            $event_id = $this->db->insert_id();

            if( $event_id !=null){
                $voter = $this->Admin_model->get_all_voter();
                foreach($voter as $v){
                    $data['event_id']=$event_id;
                    $data['voter_id']=  $v['voter_id'];
                    $data['status']='false';
                    $this->db->insert('store_event',$data);
                }

                $this->Admin_model->get_all_can_by_category($category_id,$event_id);
                $data['event_id']=$event_id;
                $data['voter_id']=  $id = $this->session->userdata('admin_id');
                $data['status']='false';
                $this->db->insert('store_event',$data);

                $message['sucess_message'] = '<p><b>Sucess: Record add successfully !!</b></p>';
                $this->session->set_userdata($message);
                redirect('Admin/eventList');

            }else{
                $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
                $this->session->set_userdata($message);
                redirect('Admin/eventList');
            }
        }
        else
        {
            $this->load->view('event/add');
        }
    }
    public function event_edit($id){
        $data['category'] = $this->Admin_model->get_all_category();
        $data['events'] = $this->Admin_model->get_event($id);
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/event/editevent',$data);
        $this->load->view('admin/footer');
    }
    public function updateEvent(){
        if(isset($_POST) && count($_POST) > 0) {
            $id = $this->input->post('id');
            $params = array(
                'event_title' => $this->input->post('event_title'),
                'event_description' => $this->input->post('event_description'),
                'category_id' => $this->input->post('category_id'),
                'event_startDate' => date('Y-m-d', strtotime($this->input->post('event_startDate'))),
                'event_endDate' => date('Y-m-d', strtotime($this->input->post('event_endDate'))),
                'event_status' => 'active',
            );

         if  ($this->Admin_model->update_event($id,$params))
           {
               $message['sucess_message'] = '<p><b>Sucess: Record update successfully !!</b></p>';
               $this->session->set_userdata($message);
               redirect('Admin/eventList');

           }else{
            $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/eventList');
        }
        }
        else
        {
            redirect('Admin');
        }
    }

    public function event_delete($id){
        if( $this->Admin_model->delete_event($id)){

            $message['sucess_message'] = '<p><b>Sucess: Record delete successfully !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/eventList');

        }else{
            $message['error_message'] = '<p><b>Error: Sorry! Something wrong, Try again later  !!</b></p>';
            $this->session->set_userdata($message);
            redirect('Admin/eventList');
        }
    }

    public function resultList(){
    $data['result'] = $this->Admin_model->get_all_result();
    $this->load->view('admin/header');
    $this->load->view('admin/sidebar');
    $this->load->view('admin/resultList',$data);
    $this->load->view('admin/footer');
}

    public function logout(){
        $this->session->unset_userdata('admin_id');
        $this->session->sess_destroy();
        session_destroy();
        redirect('AdminLogin','refresh');
    }
    public function report(){

        $data   = array();
        $data['result'] = $this->WebSite->get_event();
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/report',$data);
        $this->load->view('admin/footer');
    }

    public function result(){

        if (isset($_POST) && count($_POST) > 0) {
            $id = $this->input->post('event');
            $data['result'] = $this->WebSite->get_result($id);
            

            $this->load->view('admin/header');                
            $this->load->view('admin/sidebar');
            $this->load->view('admin/result',$data);
            $this->load->view('admin/footer');

        } else {
            return false;
            redirect('website/pages/report');
        }
        
    }
}