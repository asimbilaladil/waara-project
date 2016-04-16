<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $id = $this->session->userdata('id');
        if ($id != NULL) {
            redirect('WebAction', 'refresh');
        }
        $this->load->model('WebSite');
    }

    public function index(){
        $this->load->view('website/header');
        $this->load->view('website/login');
        $this->load->view('website/footer');
    }

    public function candidate_login_check(){

        $candidate_email = $this->input->post('email', true);
        $candidate_password = $this->input->post('password', true);
        $result = $this->WebSite->candidate_login_check_info($candidate_email, $candidate_password);

        if($result) {
            if($result->candidate_status !=="Active"){
                $sdata['message'] = 'Login failed,This user is not Active.';
                $this->session->set_userdata($sdata);
                redirect('login/index');
            }
            else{
                $sdata['id'] = $result->candidate_id;
                $sdata['type']="candidate";
                $sdata['message'] = 'Your are successfully Login && your session has been start';
                $this->session->set_userdata($sdata);
                redirect('WebAction');
            }
        }else{
            $sdata['message'] = ' Your Email ID or Password is invalid  !!!!! ';
            $this->session->set_userdata($sdata);
            redirect('login/index');

        }
    }

    public function loginAsvoter(){
        $this->load->view('website/header');
        $this->load->view('website/login_voter');
        $this->load->view('website/footer');
    }

    public function voter_login_check(){

        $voter_email = $this->input->post('email', true);
        $voter_password = $this->input->post('password', true);
        $result = $this->WebSite->voter_login_check_info($voter_email, $voter_password);

        if($result) {
            if($result->voter_status !=="Active"){
                $sdata['message'] = 'Login failed,This user is not Active.';
                $this->session->set_userdata($sdata);
                redirect('Login/loginAsvoter');
            }
            else{
                $sdata['id'] = $result->voter_id;
                $sdata['type']="voter";

                $sdata['message'] = 'Your are successfully Login && your session has been start';
                $this->session->set_userdata($sdata);
                redirect('WebAction/voterAction');
            }
        }else{
            $sdata['message'] = ' Your Email ID or Password is invalid  !!!!! ';
            $this->session->set_userdata($sdata);
            redirect('Login/loginAsvoter');

        }
    }
}