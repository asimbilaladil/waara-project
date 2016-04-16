<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class WebAction extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $id = $this->session->userdata('id');
        if ($id == NULL) {
            redirect('login', 'refresh');
        }
        $this->load->model('WebSite');
        $this->load->model('Admin_model');
        $currentDate = date("Y-m-d");
        $this->updateEvent($currentDate);

    }

    //for candidate
    public function index()
    {

        $id = $this->session->userdata('id');
        $candidate = $this->WebSite->get_candidate($id);
        $this->load->view('website/header');
        $this->load->view('website/pages/candidate_board', $candidate);
        $this->load->view('website/footer');
    }

    public function voterAction()
    {
        $id = $this->session->userdata('id');
        $data['events'] = $this->WebSite->test($id);
        //"votted" brings information from votes tabel
        $data['voter'] = $this->WebSite->get_voter($id);
        $this->load->view('website/header');
        $this->load->view('website/pages/voter_board', $data);
        $this->load->view('website/footer');
    }

  public function setVote()
    {
        if (isset($_POST) && count($_POST) > 0) {
            $params = array();
            $params['voter_id'] = $voter_id = $this->input->post('voter_id');
            $params['candidate_id'] =$can_id=$this->input->post('candidate_id');
            $params['event_id'] =$event_id= $this->input->post('event_id');

            if ($this->db->insert('votes', $params)) {
                $this->count_votes($can_id,$event_id);
                $data['status']='true';
                $this->WebSite->update_store_event($voter_id,$event_id, $data);
                $sdata['message'] = 'Acceptd';
                $this->session->set_userdata($sdata);
                redirect('WebAction/voterAction');
            }
        } else {
            return false;
            redirect('welcome');
        }
    }
    public function count_votes($can_id,$event_id){
        $result= $this->WebSite->check_cuent_votes($can_id,$event_id);
        if($result) {
            if($result->votes ==0){
                $id= $result->id;
                //do insert 1
                $data['can_id']=$can_id;
                $data['event_id']=$event_id;
                $data['votes']=1;
                $this->db->where('id',$id);
                $this->db->update('count_votes',$data);
            }
            else{
                //update 1
                $id= $result->id;
                $votes=$result->votes;

                $data['can_id']=$can_id;
                $data['event_id']=$event_id;
                $data['votes']=$votes+(1);
                $this->db->where('id',$id);
                $this->db->update('count_votes',$data);
            }
        }else{

        }
    }

    public function editCandidateInfo($id)
    {
        $data = array();
        $data['category'] = $this->Admin_model->get_all_category();
        $data['candidate'] = $this->WebSite->get_candidate($id);
        $this->load->view('website/header');
        $this->load->view('website/pages/editCandidateInfo', $data);
        $this->load->view('website/footer');
    }

    public function updateCandidate()
    {
        if (isset($_POST) && count($_POST) > 0) {
            $id = $this->input->post('candidate_id');
            $params = array(
                'candidate_name' => $this->input->post('name'),
                'candidate_age' => $this->input->post('age'),
                'candidate_gender' => $this->input->post('gender'),
                'candidate_phoneNo' => $this->input->post('phoneNumber'),
                'candidate_email' => $this->input->post('email'),
                'candidate_password' => md5($this->input->post('password')),
                'candidate_category' => $this->input->post('category'),
                'candidate_qualifaction' => $this->input->post('qualification'),
                'candidate_noCase' => $this->input->post('nlcp'),
                'candidate_acNumber' => $this->input->post('acNumber')

            );
            if ($this->WebSite->updateCandidateInfo($id, $params)) {
                $sdata['message'] = 'Update sucessfully';
                $this->session->set_userdata($sdata);
                redirect('WebAction');
            }
        } else {
            return false;
            redirect('welcome');
        }
    }

    public function editVoterInfo($id)
    {
        $data = array();
        $data['category'] = $this->Admin_model->get_all_category();
        $data['voter'] = $this->WebSite->get_voter($id);
        $this->load->view('website/header');
        $this->load->view('website/pages/editVoterInfo', $data);
        $this->load->view('website/footer');
    }

    public function updateVoter()
    {
        if (isset($_POST) && count($_POST) > 0) {
            $id = $this->input->post('id');
            $params = array(
                'voter_name' => $this->input->post('name'),
                'voter_age' => $this->input->post('age'),
                'voter_gender' => $this->input->post('gender'),
                'voter_phnNumber' => $this->input->post('phoneNumber'),
                'voter_email' => $this->input->post('email'),
                'voter_password' => md5($this->input->post('password')),
                'voter_location' => $this->input->post('location'),
                'voter_qualification' => $this->input->post('qualification'),
                'voter_acNumber' => $this->input->post('acNumber')
            );

            if ($this->WebSite->updateVoterInfo($id, $params)) {
                $sdata['message'] = 'Update sucessfully';
                $this->session->set_userdata($sdata);
                redirect('WebAction/voterAction');
            }

        } else {
            $this->load->view('welcome');
        }
    }

    public function updateEvent($currentDate){
        $date=strtotime($currentDate);
        $this->db->select('*');
        $this->db->from('events');
        $query = $this->db->get();
        foreach ($query->result() as $event){
            $eventDate = strtotime($event->event_endDate);
            if($eventDate<=$date){
                $data['event_status']="end";
                $this->db->where('event_id', $event->event_id);
                $this->db->update('events', $data);
            }
        }
    }


    public function logOut()
    {
        $this->session->unset_userdata('id');
        $this->session->sess_destroy();
        redirect('welcome', 'refresh');
    }

        public function report(){

        $data   = array();
        $data['result'] = $this->WebSite->get_event();
        $this->load->view('website/header');
        $this->load->view('website/pages/report',$data);
        $this->load->view('website/footer');
    }

        public function result(){

        if (isset($_POST) && count($_POST) > 0) {
            $id = $this->input->post('event');
            $data['result'] = $this->WebSite->get_result($id);
            

            $this->load->view('website/header');
            $this->load->view('website/pages/result',$data);
            $this->load->view('website/footer');

        } else {
            return false;
            redirect('website/pages/report');
        }
        
    }
}