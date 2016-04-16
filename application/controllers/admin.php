<?php
class Admin extends CI_Controller {

	function index()
	{

		$this->load->view('/admin/index');

	}


	function home()
	{
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/admin_home');
        $this->load->view('admin/common/footer');
	}
}
?>