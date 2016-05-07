<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class AdminModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function admin_login_check_info( $data ){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $data['email']);
        $this->db->where('password', $data['password']);
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;
    }



    /**
     * Insert Method
     * @param tableName
     * @param dataObject
     */
    public function insert( $tableName ,$data ){

        if ($this->db->insert($tableName, $data) ) {

            return true;

        } 

        return false;

    }

    /**
     * Add New JK Method
     * @param data [ 
     *      name : string 
     *      location : string    
     *      ]
     */
    public function addJK( $data ){

        if ($this->db->insert('jk', $data) ) {

            return true;

        } 

        return false;
    }


    /**
     * Get JK
     */

    public function getJamatKhana (){
        $this->db->select('*');
        $this->db->from('jk');
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
    public function delete ( $whereParam1, $whereParam2, $tableName ){

        $this->db->delete( $tableName , array( $whereParam1 => $whereParam2) ); 
    }    

        /*
        SELECT jk.name 
        FROM duty, duty_jk, jk
        WHERE duty.duty_id = '1' AND 
        duty.duty_id = duty_jk.duty_id AND
        duty_jk.jk_id = jk.id
        */

    public function getJkFromDuty( $id ) {

        $query = $this->db->query('SELECT jk.name, jk.id 
                        FROM duty, duty_jk, jk
                        WHERE duty.duty_id = '. $id .' AND 
                        duty.duty_id = duty_jk.duty_id AND
                        duty_jk.jk_id = jk.id');
        
        $query->result();

        return $query->result();

    }


    public function get_calendar_duties() {

        $query = $this->db->query('CALL get_calendar_duties()');
        $query->result();

        return $query->result();

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
        SELECT duty.name, duty.duty_id 
        FROM duty, duty_jk, jk
        WHERE jk.id = '1' AND 
        duty.duty_id = duty_jk.duty_id AND
        duty_jk.jk_id = jk.id
    */
    public function getDutyByJk( $id ) {

        $query = $this->db->query('SELECT duty.name, duty.duty_id 
                        FROM duty, duty_jk, jk
                        WHERE jk.id = ' . $id . ' AND 
                        duty.duty_id = duty_jk.duty_id AND
                        duty_jk.jk_id = jk.id');

        $query->result();

        return $query->result();

    }

    function getUsers($q){
        $this->db->select('*');
        $this->db->like('first_name', $q);
        $query = $this->db->get('user');
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $new_row['label']=htmlentities(stripslashes($row['first_name']));
                $new_row['value']=htmlentities(stripslashes($row['user_id']));
                $row_set[] = $new_row; //build an array
            }
            echo json_encode($row_set); //format the array into json data
        }
    }

    function getJkById( $id ) {

        $this->db->select('*');
        $this->db->from('jk');
        $this->db->where('id', $id);
        $quary_result=$this->db->get();
        $result=$quary_result->result();

        return $result;        
    }


    function getUserById( $id ) {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id', $id );
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;;
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
    /*
    * Get record from table using single condition
    */
    function getrecordById( $tableName, $whereParam1, $whereParam2  ) {

        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->where($whereParam1, $whereParam2 );
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;;
    }
   
    /*
    SELECT user.first_name, duty.name, assign_duty.start_date
    FROM user, duty, assign_duty
    WHERE user.user_id = assign_duty.user_id 
    AND assign_duty.duty_id = duty.duty_id
    ANd user.user_id = 10 limit 10
    */
   function getUserHistory( $userId ) {

        $query = $this->db->query(
            'SELECT user.first_name, duty.name, assign_duty.start_date
            FROM user, duty, assign_duty
            WHERE user.user_id = assign_duty.user_id 
            AND assign_duty.duty_id = duty.duty_id
            ANd user.user_id =' . $userId . ' limit 10');

        $query->result();

        return $query->result();

   }
    /*
    SELECT duty.name as dutyname, user.first_name, jk.name as jkname, assign_duty.start_date
    FROM duty, user, jk, assign_duty
    WHERE assign_duty.duty_id = duty.duty_id AND 
    assign_duty.jk_id = jk.id AND 
    assign_duty.user_id = user.user_id AND 
    assign_duty.start_date = '05-01-2016'
    */

   function getAssignDutyDetailByStartDate( $date ) {

        $query = $this->db->query(
        'SELECT duty.name as dutyname, user.first_name, jk.name as jkname, assign_duty.start_date
        FROM duty, user, jk, assign_duty
        WHERE assign_duty.duty_id = duty.duty_id AND 
        assign_duty.jk_id = jk.id AND 
        assign_duty.user_id = user.user_id AND 
        assign_duty.start_date =' . $date );

        $query->result();

        return $query->result();

   }


}