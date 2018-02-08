<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class FestivalModel extends CI_Model {

  function __construct() {
      parent::__construct();
  }


    /**
     * Insert
     * Created By: Moiz
     */
    private function insert( $table, $data ){
        if ($this->db->insert($table, $data) ) {
            return $this->db->insert_id();
        } 
        return -1;
    }


    /**
     * Insert
     * Created By: Moiz
     */
    public function insertFestival($data){
        return $this->insert('festival', $data);
    }

    /**
     * Insert Festival Duties
     * Created By: Moiz     
     */
    public function insertFestivalDuties($data) {
        return $this->insert('festival_duties', $data);
    }      

    /**
     * Insert Festival Dates
     * Created By: Moiz     
     */
    public function insertFestivalDates($data) {
        return $this->insert('festival_date', $data);
    } 


    /**
     * Get festival by token
     * Created By: Moiz     
     */
    public function getFestivalByToken($token) {
        $this->db->select('*');
        $this->db->from('festival');
        $this->db->where('token', $token);
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        return $result;
    }

    /**
     * Get All Festival Duty
     */
    public function getDutyByToken($token){
      
        $this->db->select('*');
        $this->db->from('festival_duties');
        $this->db->where('token', $token);
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        return $result;
    }      

    /**
     * Get duties for festival 
     * Created By: Moiz     
     */
    public function getDutiesForFestival($festivalToken) {

        $query = $this->db->query("SELECT festival_duties.duty, festival_duties.id, festival_duties.token
            FROM festival_duties, festival
            WHERE festival.token = '". $festivalToken ."'
            AND festival.id = festival_duties.festival_id");

        $query->result();
        return $query->result();
    }


    /**
     * get duties for specfic date
     * Created By: Moiz     
     */
    public function getDutiesForSpecticDate($date, $type) {

        $query = $this->db->query("SELECT festival_duties.id, festival_duties.duty, festival_duties.token
                FROM festival_duties, specfic_date_duties
                WHERE specfic_date_duties.date = '". $date ."'
                AND specfic_date_duties.duty_id = festival_duties.id
                AND specfic_date_duties.type = '". $type ."'");

        $query->result();
        return $query->result();

    }

    /**
     * insert duty for specfic date
     * Created By: Moiz     
     */
    public function insertDutyOnSpecfic($data) {
        if ($this->db->insert('specfic_date_duties', $data) ) {
            return $this->db->insert_id();
        } 
        return false;
    }

    /*
     * Delete Duty date by token
     * Created By: Moiz     
     */
    public function deletFestivalDutyByToken($token) {
        $this->db->delete( 'festival_duties' , array( 'token' => $token) ); 
    }

    public function deleteDutyForSpecficDate($dutyId, $type) {
        $this->db->delete( 'specfic_date_duties' , array(
            'duty_id' => $dutyId,
            'type' => $type
        ));    
    }      

}