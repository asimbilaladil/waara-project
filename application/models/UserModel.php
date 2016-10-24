<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function user_login_check_info($user_email, $user_password){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $user_email);
        $this->db->where('password', $user_password);
        $this->db->where('verified', 'true');
        $this->db->where('type', 'User');
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;
    }
    
    /**
     * Check if user exist in DB.
     */
    public function checkIfUserExist($email) {
        
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email);
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;
    }  

    /**
     * Get Custom fields Method
     */

    public function getCustomFields (){
        $this->db->select('*');
        $this->db->from('customfields');
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;
    }

    public function updateCustomFieldsByUserId($user, $data){
        $result = $this->db->query('UPDATE user_custom_data SET value=\'' . $data['value'] . '\' WHERE user_id='. $data['user_id'] . ' and customField_id='. $data['customField_id']);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Insert Method
     * @param tableName
     * @param dataObject
     */
    public function insert( $tableName ,$data ){

        if ($this->db->insert($tableName, $data) ) {

            return $this->db->insert_id();

        } 

        return -1 ;

    }   

    /**
     * Insert Method
     * @param tableName
     * @param whereParam1
     * @param whereParam2
     * @param dataObject
     */
    public function update( $tableName, $whereParam1, $whereParam2 ,$data ){

        $this->db->where( $whereParam1, $whereParam2 );
        $result = $this->db->update( $tableName ,$data);
        if ( $result ) {

            return true;

        } 

        return false;

    }

    /**
     * Get Custom fields Method
     */

    public function getWaara ($id){
        
        $query = $this->db->query('CALL get_waara('.$id.')');
        $query->result();

        return $query->result();
    }  

    public function getNews (){
        
        $this->db->select('*');
        $this->db->from('news');
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;
    }  

    public function getNewsdetails ($id){
        
        $this->db->select('*');
        $this->db->from('news');
        $this->db->where('id',$id);
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;
    } 
    public function getUserWaaraCalendar ($id) {
        
        //$query = $this->db->query('CALL get_user_waara_calendar('.$id.')');
        $query->result();

        return $query->result();
    }   

    public function changePassword ($id, $oldPassword, $newPassword){
        
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where( 'password', $oldPassword );
        $this->db->where( 'user_id', $id );
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        if( $result ){
            $data = array ( 'password' => $newPassword);
            $this->db->where( 'password', $oldPassword );
            $this->db->where( 'user_id', $id );
            $result = $this->db->update( 'user' ,$data);
            if ( $result ) {

                return true;

            } else {
                return false;
            }
        } else  {
            return 2;
        }



    }  
    public function getAllAdmin (){
        
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('type','JK Admin');
        $this->db->where('type','Super Admin');
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;
    }
    public function getAllfromTable( $tableName ) {
        $this->db->select('*');
        $this->db->from( $tableName );
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;        
    }

        /**
     * Insert Method
     * @param tableName
     * @param whereParam1
     * @param whereParam2
     * @param whereParam3
     * @param whereParam4
     * @param dataObject
     */
    public function updateWhere( $tableName, $whereParam1, $whereParam2, $whereParam3, $whereParam4 ,$data ){

        $this->db->where( $whereParam1, $whereParam2 );
        $this->db->where( $whereParam1, $whereParam2 );
        $result = $this->db->update( $tableName ,$data);
        if ( $result ) {

            return true;

        } 

        return false;

    }
    /*
    SELECT customfields.field_lable, customfields.field_name, customfields.input_type
    FROM customfields, user_custom_data
    WHERE user_custom_data.customField_id = customfields.customField_id
    AND user_custom_data.user_id = 10   
    */
    public function getCustomFieldByUserId( $id ) {

        $query = $this->db->query('SELECT customfields.field_lable, customfields.field_name, customfields.input_type, user_custom_data.value
            FROM customfields, user_custom_data
            WHERE user_custom_data.customField_id = customfields.customField_id
            AND user_custom_data.user_id = ' . $id );

        $query->result();

        return $query->result();

    } 
    
    function getUserById( $id ) {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id', $id );
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;;
    } 

    function getUserByEmail( $email ) {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email );
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;;
    }

    public function updatePassword( $token ,$data ){

        $this->db->where( "token", $token );
        $result = $this->db->update( "user" ,$data);
        if ( $result ) {

            return true;

        } 

        return false;

    }
    function getSuperAdmin() {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('type', 'Super Admin' );
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;;
    }


    /*
    SELECT duty.name, duty.duty_id, jk.name, jk.id
    FROM duty, jk, duty_jk
    WHERE duty.duty_id = duty_jk.duty_id
    AND duty_jk.jk_id = jk.id
    AND jk.id in (10,11,12,13)
    */
    public function getDuties( $jk ) {

        $query = $this->db->query('SELECT distinct duty.name, duty.duty_id
            FROM duty, jk, duty_jk
            WHERE duty.duty_id = duty_jk.duty_id
            AND duty_jk.jk_id = jk.id
            AND jk.id in (' . $jk . ')' );

        $query->result();

        return $query->result();

    }

    
    public function getDutiesByUserId( $user ) {

        // $quary_result = $this->db->query('SELECT distinct pr.duty_id, pr.user_id, pr.shift FROM preference pr  WHERE pr.user_id = ' . $user);

        $this->db->select('DISTINCT(duty_id)');
        $this->db->select('user_id');
        $this->db->select('shift');
        $this->db->from('preference');
        $this->db->where('user_id', $user);
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;

    } 
    
}