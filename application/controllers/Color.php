<?php
class Color extends CI_Controller {

    public function __construct(){
        parent::__construct();

            $this->load->model('ColorModel'); 
            $this->load->model('AdminModel'); 
    }

    function index(){
        
        $data['color'] = $this->ColorModel->getAllColor();
        $this->loadView('admin/color', $data );
    }
  
    /**
     * Add Color
     */  
    function addColor() {   
      
        if($this->input->post()) {

            $data = array (
                'colorName' => $this->input->post('colorName', true),
                'colorCode' => $this->input->post('colorCode', true)
            );
            $this->ColorModel->insert( $data );
            redirect("Color");
        }

    }
  
    /**
     * Add Color
     */  
    function editColor() {   
      
        if($this->input->get()) {
             
            $id = $this->input->get('color_id');
            $data['color'] = $this->ColorModel->getColor($id);
            $this->loadView('admin/editColor', $data );

        } else if($this->input->post()) {
          
            $id = $this->input->post('id', true);
            $data = array (
                'colorName' => $this->input->post('colorName', true),
                'colorCode' => $this->input->post('colorCode', true)
            );

            $this->ColorModel->update( $id, $data );
            redirect("Color");
        }

    }
    /**
     * Delete Color
     */  
    function deleteColor() {   
      
        if($this->input->get()) {

            $data = array (
                'id' => $this->input->get('color_id', true)
            );
            $this->ColorModel->delete( $data );
            redirect("Color");
        }

    }
    /**
     * Assign Color
     */  
    function assignColor() {   
      
        if($this->input->post()) {
            $user_id =  $this->input->post('user_id', true);
            $data = array (
                'color_id' => $this->input->post('colorCode', true)
            );
            $this->AdminModel->update( 'user', 'user_id', $user_id, $data );
            redirect("admin/user");
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