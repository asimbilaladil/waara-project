<?php

class EditProfile extends CI_Controller {

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
            $data['result'] = $this->UserModel->getCustomFieldByUserId($this->input->get('id'));

            $result = $this->UserModel->getUserById($this->input->get('id'));
        	
	        if($result) {
	            $data['user_id'] = $result->user_id;
	            $data['first_name'] = $result->first_name;
	            $data['last_name'] = $result->last_name;
	            $data['email'] = $result->email;
	            $data['phone'] = $result->phone;
	            $data['pref_duty'] = $result->pref_duty;
	            $data['pref_jk'] = $result->pref_jk;
	            $data['type'] = $result->type;
	        }

			$this->load->view('common/header');
			$this->load->view('website/editProfile', $data);
			$this->load->view('common/footer');
    	
	}

	public function save(){

		if($this->input->post()) {

            $duties = $this->input->post('duties', true);
            $jks = $this->input->post('jks', true);
            $userid = $this->input->post('userid', true);


            $dutiesStr = "";
            $jksStr = "";

            if($duties != null){
	            foreach( $duties as $value ) {

	                $dutiesStr = $dutiesStr . explode('_', $value)[1] . "," ;
	            }
	            $dutiesStr = rtrim($dutiesStr, ',');  //remove last comma 
			}
			else{
				$dutiesStr = '';
			}

			if($jks != null){
				foreach( $jks as $value ) {
                	$jksStr = $jksStr . $value . "," ;
	            }
	            $jksStr = rtrim($jksStr, ',');  //remove last comma 
			}
			else{
				$jksStr = '';
			}
            

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
                'verified' => "true",
                'token' => $token,
                'pref_duty' => $dutiesStr,
                'pref_jk'=> $jksStr
                );
        	/*
            $emailMessage = "Please verify your waaranet user" . $data['first_name'] . " " . $data['last_name'] . " by using this link \n".base_url()."index.php/Welcome/verify?token=".$token;
			*/

			$userDuties = $this->UserModel->getDutiesByUserId($userid);
            $userDutiesArray = array();
            
            foreach( $userDuties as $row ){
            	array_push($userDutiesArray, $row->duty_id);
            }

            $insertedArray = array();            

            //get inserted id of the user
            if($this->UserModel->update('user', 'user_id', $userid,  $data)){

            	/* Updating duties of this user */

            	if($this->PreferenceModel->deletePreferenceByUserId($userid)){
            	           	
		            //add duty id in preference with inserted user id
		            if($duties != null){
			        	foreach( $duties as $item ) {

				            $shift = explode('_', $item)[0];
				            $dutyId = explode('_', $item)[1];


			            	//check if duty id and user inserted id is already present in array. Then update the shift to both
				            if (in_array($dutyId, $insertedArray)) {

				                $this->PreferenceModel->updateShift($userid, $dutyId, array('shift' => 'both'));

				            } else {

				                $data = array(
				                    'user_id' => $userid,
				                    'duty_id' => $dutyId,
				                    'shift' => $shift
				                );

				                $insertedPreference = $this->PreferenceModel->insert($data);

				            }

				            array_push($insertedArray, $dutyId);
				        }
			    	}
		        	//iterate every custom field and check if the key exist in posted data. If exist insert it in user custom data
		    		
		            foreach( $customFields['result'] as $value ) {

		                if( array_key_exists( $value->field_name, $this->input->post() ) ) {

		                    $userCustomData = array (
		                        'user_id' => $userid,
		                        'customField_id' => $value->customField_id,
		                        'key' => $value->field_name,
		                        'value' => $this->input->post( $value->field_name , true)
		                        );

		                    $this->UserModel->updateCustomFieldsByUserId($userid, $userCustomData);

		                }     

		            }

			        echo 'updated';
				}
				else{

	             	echo 'error while deleting';
				}
            
        	}
        	else{
        			echo 'error while updating';
        		//redirect('/editProfile/?id='.$userid);
        	}

		}
	}

	public function getDuties() {

        $jks=$this->input->post('state');
        $uid = $this->input->post('userid');

        $jksStr = '';

        foreach($jks as $item) {
            $jksStr = $jksStr . $item . ',';            
        }

        $jksStr = rtrim($jksStr, ',');

        $duties = $this->UserModel->getDuties( $jksStr );
        $userDuties = $this->UserModel->getDutiesByUserId($uid);

        
        $userDtArray = array();
		
		$html = '<table>';
        foreach($duties as $value) {
        	
        	foreach($userDuties as $row){
        		
        		 if($value->duty_id == $row->duty_id){
                    
        			if($row->shift == 'both'){
        				$html = $html . '<tr>';
			            $html = $html . '<td>' . $value->name . '</td>';
			            $html = $html . '<td> <input checked name="duties[]" type="checkbox" value="morning_'.$value->duty_id.'"> Morning </input>';
			            $html = $html . '<input checked name="duties[]" type="checkbox" value="evening_'. $value->duty_id .'"> Evening </input> </td>';
			            $html = $html . '<tr>';
			            array_push($userDtArray, $row->duty_id);
        			}
        			else if($row->shift == 'morning'){
        				$html = $html . '<tr>';
			            $html = $html . '<td>' . $value->name . '</td>';
			            $html = $html . '<td> <input checked name="duties[]" type="checkbox" value="morning_'.$value->duty_id.'"> Morning </input>';
			            $html = $html . '<input name="duties[]" type="checkbox" value="evening_'. $value->duty_id .'"> Evening </input> </td>';
			            $html = $html . '<tr>';
			            array_push($userDtArray, $row->duty_id);
        			}
        			else if($row->shift == 'evening'){
        				$html = $html . '<tr>';
			            $html = $html . '<td>' . $value->name . '</td>';
			            $html = $html . '<td> <input name="duties[]" type="checkbox" value="morning_'.$value->duty_id.'"> Morning </input>';
			            $html = $html . '<input checked name="duties[]" type="checkbox" value="evening_'. $value->duty_id .'"> Evening </input> </td>';
			            $html = $html . '<tr>';
			            array_push($userDtArray, $row->duty_id);
        			}
        			
        		}
    		}
    	}
		foreach($duties as $value){
			if(!in_array($value->duty_id,$userDtArray)){
	            $html = $html . '<tr>';
	            $html = $html . '<td>' . $value->name . '</td>';
	            $html = $html . '<td> <input name="duties[]" type="checkbox" value="morning_'.$value->duty_id.'"> Morning </input>';
	            $html = $html . '<input name="duties[]" type="checkbox" value="evening_'. $value->duty_id .'"> Evening </input> </td>';
	            $html = $html . '<tr>';
			}
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