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
     * Get Custom fields Method
     */

    public function getCustomFields (){
        $this->db->select('*');
        $this->db->from('customfields');
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;
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
}