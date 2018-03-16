<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class CommonModel extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    /**
     * Get all from table
     */
    public function getAllFromTable($table, $key, $value){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($key, $value);
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        return $result;
    } 
    /**
     * Insert into table
     */
    public function insertIntoTable($table, $data) {
        if ($this->db->insert($table, $data) ) {
            return $this->db->insert_id();
        } 
        return false;        
    }    
}