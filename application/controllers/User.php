<?php
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $id = $this->session->userdata('user_id');
        $type = $this->session->userdata('type');

        if( $id != NULL  && $type != 'User' ) {
            $this->load->model('AdminModel');
            $this->load->model('UserModel');
        } else {

            redirect('Login/');

        }

    }

    public function mergeUser() {
        
        if ($this->input->post() && $this->input->post('mergeUserList')) {

            $list = $this->input->post('mergeUserList');
            $list = json_decode($list);
            
            $listStr = '(';

            for ($i = 0; $i < sizeof($list); $i++) {

                $listStr = $listStr . $list[$i];

                if( $i == (sizeof($list) - 1) ) {
                    $listStr = $listStr . ')';
                } else {
                    $listStr = $listStr . ',';
                }
            }

            $result = $this->UserModel->getUsers($listStr);

            $this->loadView('admin/user/merge_user', $result);


        } else {

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