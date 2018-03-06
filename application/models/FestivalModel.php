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
        $query = $this->db->query("SELECT festival.id, festival.token, festival.festival, festival.override, festival_date.id as dateId, festival_date.token as festivalDateToken, festival_date.date as date 
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


    public function deleteFestival($id) {
        $this->db->delete( 'festival' , array( 'id' => $id) );
        $this->db->delete( 'festival_date' , array( 'festival_id' => $id) );

        $query = $this->db->query("DELETE specfic_date_duties
            FROM specfic_date_duties
            INNER JOIN festival_duties
            ON festival_duties.id = specfic_date_duties.duty_id
            WHERE festival_duties.festival_id = " . $id . " 
            AND specfic_date_duties.type = 'FESTIVAL'");

        
        $query = $this->db->query("DELETE festival_duty_assign
            FROM festival_duty_assign
            INNER JOIN festival_duties
            ON festival_duties.id = festival_duty_assign.duty_id
            WHERE festival_duties.festival_id = " . $id);

        $query = $this->db->query("DELETE festival_sort
            FROM festival_sort
            INNER JOIN festival_duties
            ON festival_duties.id = festival_sort.duty_id
            WHERE festival_duties.festival_id = " . $id );

        $this->db->delete( 'festival_duties' , array( 'festival_id' => $id) );        
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


    public function updateFestival($token, $data) {
        $this->db->where('token', $token );
        $result = $this->db->update( 'festival', $data);
        if ($result) {
            return true;
        } 
        return false;        
    }  


    public function getDutiesByDate($date) {

        $query = $this->db->query("SELECT festival.id as festivalId, festival.festival as festivalName, festival_duties.id, festival_duties.token, festival_duties.duty, festival_duty_assign.user_id, festival_duty_assign.id as assignId, festival_sort.sort
            FROM festival
            INNER JOIN festival_date ON festival.id = festival_date.festival_id 
            LEFT JOIN festival_duties ON festival_duties.festival_id = festival.id AND festival_duties.type = 'GLOBAL'
            LEFT JOIN festival_duty_assign ON festival_duties.id = festival_duty_assign.duty_id
            LEFT JOIN festival_sort ON festival_duties.id = festival_sort.duty_id
            WHERE festival_date.date = '". $date ."' ");
        $query->result();

        return $query->result();     
    }


    public function getDutiesFromSpecficTable($date) {

        $query =  $this->db->query("SELECT festival_duties.id, festival_duties.token, festival_duties.duty, festival_duties.festival_id, specfic_date_duties.date, festival_duty_assign.user_id, festival_duty_assign.id as assignId, festival_sort.sort
            FROM specfic_date_duties, festival_duties
            LEFT JOIN festival_duty_assign ON festival_duties.id = festival_duty_assign.duty_id
            LEFT JOIN festival_sort ON festival_sort.duty_id = festival_duties.id
            WHERE specfic_date_duties.date = '". $date ."'
            AND festival_duties.id = specfic_date_duties.duty_id");

        $query->result();

        return $query->result();     
    }    


    public function insertFestivalDutyRating($data) {
        return $this->CommonModel->insertIntoTable('festival_duty_rating', $data);
    }    




}