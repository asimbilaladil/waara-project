<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class WaaraRequestDisableDatesModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    public function insert($data) {
        if ($this->db->insert('waara_request_disable_dates', $data) ) {
            return $this->db->insert_id();
        } 
        return -1;
    }

    public function update() {

    }

    public function delete($id) {
        $this->db->delete( 'waara_request_disable_dates' , array( 'id' => $id) ); 
    }

    public function getAll() {
        $this->db->select('*');
        $this->db->from( 'waara_request_disable_dates' );
        $quary_result=$this->db->get();
        return $quary_result->result();
    }

    public function getById($id) {
        $this->db->select('*');
        $this->db->from('waara_request_disable_dates');
        $this->db->where('id', $id);
        $quary_result=$this->db->get();
        return $quary_result->result();
    }

    public function getByDate($date) {
        $this->db->select('*');
        $this->db->from('waara_request_disable_dates');
        $this->db->where('date', $date);
        $quary_result=$this->db->get();
        return $quary_result->result();
    }


    public function deleteDates($dates) {
        
        $query = $this->db->query('DELETE FROM waara_request_disable_dates WHERE date IN (' . $dates . ')');
    }

    public function getByDateRange($dates) { 
        $query = $this->db->query("SELECT * FROM waara_request_disable_dates WHERE date IN ( ". $dates ." )");

        return $query->result();

    }


}