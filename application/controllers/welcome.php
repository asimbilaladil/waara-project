<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class Welcome extends CI_Controller {
    public function __construct(){
        parent::__construct();

        $this->load->model('WebSite');
        $this->load->model('Admin_model');
        $currentDate = date("Y-m-d");
    }
        
    public function index()
	{
		$this->load->view('website/header');
		$this->load->view('website/pages/index');
        $this->load->view('website/footer');
	}


}