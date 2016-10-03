<?php
class Signup extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model('UserModel');
        $this->load->model('PreferenceModel');
        
    }
    public function index() {

            $dutyArray = $this->UserModel->getAllfromTable('duty');
            $duties = array();

            foreach($dutyArray as $item => $value) {
                $duties[$value->duty_id] = $value->name;
            }


            $jkArray = $this->UserModel->getAllfromTable('jk');
            $jks = array();

            foreach($jkArray as $item => $value) {
                $jks[$value->id] = $value->name;
            }            

            $data['duties'] = $duties;
            $data['jks'] = $jks;
            $data['result'] = $this->UserModel->getCustomFields();

            $this->load->view('common/header');
            $this->load->view('website/signup',$data);
            $this->load->view('common/footer');
        
    }

    public function save() {

        $duties = $this->input->post('duties', true);
        $jks = $this->input->post('jks', true);

        $dutiesStr = "";
        $jksStr = "";

        foreach( $jks as $value ) {
            $jksStr = $jksStr . $value . "," ;
        }
        $jksStr = rtrim($jksStr, ',');  //remove last comma 

        $customFields = array();
        $customFields['result'] = $this->UserModel->getCustomFields();

        $token = $this->generateToken(); 
        $data = array (
            'first_name' => $this->input->post('firstName', true),
            'last_name' => $this->input->post('lastName', true),
            'email' => $this->input->post('email', true),
            'password' => md5($this->input->post('password', true)),
            'phone' => $this->input->post('phone', true),
            'type' => "User",
            'verified' => "false",
            'token' => $token,
            'pref_jk'=> $jksStr
            );

        $emailMessage = "Please verify your waaranet user" . $data['first_name'] . " " . $data['last_name'] . " by using this link \n".base_url()."index.php/Welcome/verify?token=".$token;

        //get inserted id of the user
        $userInsertedId = $this->UserModel->insert('user', $data);


        //add duty id in preference with inserted user id
        foreach( $duties as $item ) {

            $shift = explode('_', $item)[0];
            $dutyId = explode('_', $item)[1];

            $data = array(
                'user_id' => $userInsertedId,
                'duty_id' => $dutyId,
                'shift' => $shift
            );

            $this->PreferenceModel->insert($data);
        }

        //iterate every custom field and check if the key exist in posted data. If exist insert it in user custom data
        foreach( $customFields['result'] as $value ) {

            if( array_key_exists( $value->field_name, $this->input->post() ) ) {

                $userCustomData = array (
                    'user_id' => $userInsertedId,
                    'customField_id' => $value->customField_id,
                    'key' => $value->field_name,
                    'value' => $this->input->post( $value->field_name , true)
                    );

                $this->UserModel->insert('user_custom_data', $userCustomData);

            }     

        }
        $adminEmails = $this->UserModel->getSuperAdmin();
        foreach ($adminEmails  as $key => $value) {

            //mail($value->email,"User Approval",$emailMessage);

        }
        
        redirect('Welcome/login');

    }

    /**
     * Ajax call method for duties
     */
    public function getDuties() {

        $jks=$this->input->post('state');

        $jksStr = '';

        foreach($jks as $item) {
            $jksStr = $jksStr . $item . ',';            
        }

        $jksStr = rtrim($jksStr, ',');

        $duties = $this->UserModel->getDuties( $jksStr );
        
        //$html = '<select name="duties[]" id="duties" multiple="multiple"  class="form-control">';
        $html = '<table>';

        foreach($duties as $value){

            //$html = $html . '<option value="'. $value->duty_id .'"> '. $value->name .'</option>';
            $html = $html . '<tr>';
            $html = $html . '<td>' . $value->name . '</td>';
            $html = $html . '<td> <input name="duties[]" type="checkbox" value="monrning_'.$value->duty_id.'"> Morning </input>';
            $html = $html . '<input name="duties[]" type="checkbox" value="evening_'. $value->duty_id .'"> Evening </input> </td>';
            $html = $html . '<tr>';
        }

        $html = $html . '</table>';

        echo $html ;

    }

    //genrate token for user verification
    public function generateToken($length = 15) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    } 

}
?>