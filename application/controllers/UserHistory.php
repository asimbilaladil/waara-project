<?php
class UserHistory extends CI_Controller {

    public function __construct(){
        parent::__construct();

        
        // if( $id != NULL  && $type != 'User' ) {
            $this->load->model('AdminModel');

        // } else {

        //    redirect('Login/');

        // }        
    }

    function index(){

        
        $id = $this->input->get('id', TRUE);
        $userHistory = $this->AdminModel->getUserHistory( $id );
        $userHistoryLog = $this->AdminModel->getUserHistoryLog( $id );
        $result = array_merge($userHistory, $userHistoryLog);
        $this->loadView('admin/userHistory', $result );
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