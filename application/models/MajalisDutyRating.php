<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class MajalisDutyRating extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function insert( $data ){

        if ($this->db->insert('majalis_duty_rating', $data) ) {
            return $this->db->insert_id();
        } 
        return false;
    }


    public function updateById($id, $data) {
        $this->db->where( 'id', $id );
        return $this->db->update( 'majalis_duty_rating', $data);      
    }  

    public function checkRatingExist($adminId, $assignId) {

        $this->db->select('*');
        $this->db->from('majalis_duty_rating');
        $this->db->where('admin_id', $adminId);
        $this->db->where('assign_duty_id', $assignId);
        $quary_result = $this->db->get();
        return $quary_result->result();
        
    }

}