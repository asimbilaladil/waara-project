<?php
class Admin extends CI_Controller {

	function index()
	{
		$this->load->view('admin/common/header');
		$this->load->view('admin/common/sidebar');
		$this->load->view('admin/index');
        $this->load->view('admin/common/footer');

	}


	function login()
	{
		$this->load->view('admin/login');
	}


	function admin_login_check() {
		$admin_email = $this->input->post('email', true);
        $admin_password = $this->input->post('password', true);
 		$this->load->view('admin/login/',$admin_email);
	}

}
?>