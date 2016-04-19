<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class AdminModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function admin_login_check_info( $admin_email, $admin_password ){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $admin_email);
        $this->db->where('password', $admin_password);
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
    
}