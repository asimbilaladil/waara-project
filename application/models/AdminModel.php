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

        if ($this->db->insert('JK', $data) ) {

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

    public function getJkbyId( $id ) {

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

}