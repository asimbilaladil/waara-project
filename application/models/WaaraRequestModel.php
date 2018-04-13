<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class WaaraRequestModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function insert($data) {
        if ($this->db->insert('waara_request', $data) ) {
            return $this->db->insert_id();
        } 
        return -1;
    }

    public function update() {

    }

    public function delete($id) {
        $this->db->delete( 'waara_request' , array( 'id' => $id) ); 
    }

    public function deleteByDate($date) {
        $this->db->delete( 'waara_request' , array( 'date' => $date) ); 
    }    

    public function getAll() {
        $this->db->select('*');
        $this->db->from( 'waara_request' );
        $quary_result=$this->db->get();
        return $quary_result->result();
    }

    public function getById($id) {
        $this->db->select('*');
        $this->db->from('waara_request');
        $this->db->where('id', $id);
        $quary_result=$this->db->get();
        return $quary_result->result();
    }

    public function getByDate($date) {
        $this->db->select('*');
        $this->db->from('waara_request');
        $this->db->where('date', $date);
        $quary_result=$this->db->get();
        return $quary_result->result();
    }


    public function getAllRequestWaaraOnDate($dutyId, $date) {
    
        $query = $this->db->query("SELECT * FROM waara_request WHERE duty_id = ". $dutyId ." AND date = '". $date ."' ");

        return $query->result();    
    }

    // public function deleteDates($dates) {
        
    //     $query = $this->db->query('DELETE FROM waara_request_disable_dates WHERE date IN (' . $dates . ')');
    // }

    public function getRequestedWaara() { 
        $query = $this->db->query("SELECT waara_request.id, waara_request.date as start, waara_request.date as end, duty.name as title FROM waara_request, duty
            WHERE  waara_request.duty_id = duty.duty_id");

        return $query->result();

    }

}