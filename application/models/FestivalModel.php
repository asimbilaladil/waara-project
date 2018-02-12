<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class FestivalModel extends CI_Model {

  function __construct() {
      parent::__construct();
      $this->load->model('CommonModel'); 
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
     * Get festival by token
     * Created By: Moiz     
     */
    public function getFestivalByToken($token) {
        return $this->CommonModel->getAllFromTable('festival', 'token', $token);
    }

    public function insertFestivalDates($data) {
        return $this->CommonModel->insertIntoTable('festival_date', $data);
    }

    /**
     * Get All Festival Duty
     */
    public function getDutyByToken($token){
        $this->CommonModel->getAllFromTable('festival_duties', 'token', $token);
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
     * Get Festival and their dates by token
     * Created By: Moiz     
     */
    public function getFestivalAndDatesByToken($token) {
        $query = $this->db->query("SELECT festival.id, festival.token, festival.festival, festival_date.id as dateId, festival_date.token as festivalDateToken, festival_date.date as date 
                FROM festival, festival_date
                WHERE festival.token = '" . $token . "'
                AND festival.id = festival_date.festival_id");

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
     * Delete Majlis date by token
     * Created By: Moiz     
     */
    public function deleteFestivalDateByToken($token) {
        $this->db->delete( 'festival_date' , array( 'token' => $token) ); 
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

    public function insertAssignFestivalDuty($data) {
        return $this->CommonModel->insertIntoTable('festival_duty_assign', $data);
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