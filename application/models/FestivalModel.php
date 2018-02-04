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

}