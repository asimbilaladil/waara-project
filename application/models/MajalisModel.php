<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class MajalisModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('CommonModel'); 
    }

    /**
     * Insert Majalis
     * Created By: Moiz
     */
    public function insert( $data ){

        if ($this->db->insert('majalis', $data) ) {
            return $this->db->insert_id();
        } 
        return false;
    }

    /**
     * Insert Majalis Duties
     * Created By: Moiz     
     */
    public function insertMajalisDuties($data) {
        if ($this->db->insert('majalis_duties', $data) ) {
            return $this->db->insert_id();
        } 
        return false;
    }

    public function insertDutyOnSpecfic($data) {
        if ($this->db->insert('specfic_date_duties', $data) ) {
            return $this->db->insert_id();
        } 
        return false;
    }

    public function getDutiesForSpecticDate($date, $type) {

        $query = $this->db->query("SELECT majalis_duties.id, UPPER(majalis_duties.name) as name, majalis_duties.token
                FROM majalis_duties, specfic_date_duties
                WHERE specfic_date_duties.date = '". $date ."'
                AND specfic_date_duties.duty_id = majalis_duties.id
                AND specfic_date_duties.type = '". $type ."'");

        $query->result();
        return $query->result();

    }

    public function insertAssignMajalisDuty($data) {
        return $this->CommonModel->insertIntoTable('majalis_duty_assign', $data);
    }
    

    /**
     * Insert Majalis Dates
     * Created By: Moiz     
     */
    public function insertMajalisDates($data) {
        if ($this->db->insert('majalis_date', $data) ) {
            return $this->db->insert_id();
        } 
        return false;        
    }




    public function updateAssignedMajalisDuty($id, $data) {
        $this->db->where('id', $id );
        $result = $this->db->update( 'majalis_duty_assign', $data);
        if ($result) {
            return true;
        } 
        return false;        
    }    


    public function updateFestivalDuty($token, $data) {
        $this->db->where('token', $token );
        $result = $this->db->update( 'festival_duties', $data);
        if ($result) {
            return true;
        } 
        return false;        
    }


    public function updateFestivalDate($id, $data) {
        $this->db->where('id', $id );
        $result = $this->db->update( 'festival_date', $data);
        if ($result) {
            return true;
        } 
        return false;        
    }


    public function updateFestival($token, $data) {
        $this->db->where('token', $token );
        $result = $this->db->update( 'festival', $data);
        if ($result) {
            return true;
        } 
        return false;        
    }    

    public function updateMajalisDuty($id, $data) {
        $this->db->where('id', $id );
        $result = $this->db->update( 'majalis_duties', $data);
        if ($result) {
            return true;
        } 
        return false;        
    }


    public function updateMajalis($token, $data) {
        $this->db->where('token', $token );
        $result = $this->db->update( 'majalis', $data);
        if ($result) {
            return true;
        } 
        return false;        
    }

    /**
     * Get Majalis and their dates by token
     * Created By: Moiz     
     */
    public function getMajlisAndDatesByToken($token) {
        $query = $this->db->query("SELECT majalis.id, majalis.token, majalis.name, majalis_date.id as dateId, majalis_date.token as majalisDateToken, majalis_date.date as date 
                FROM majalis, majalis_date
                WHERE majalis.token = '" . $token . "'
                AND majalis.id = majalis_date.majalis_id");

        $query->result();

        return $query->result();
    }

    public function getMajalisDatesByYear($token, $year) {

        $query = $this->db->query("SELECT majalis.id, majalis.token, majalis.name, majalis_date.id as dateId, majalis_date.token as majalisDateToken, majalis_date.date as date 
                FROM majalis, majalis_date
                WHERE majalis.token = '". $token ."'
                AND majalis.id = majalis_date.majalis_id
                AND majalis_date.date LIKE '". $year ."-%' ");
    
        return $query->result();
    }


    /**
     * Get Majalis dates group by date year
     * Created By: Moiz     
     */
    public function getDutiesYear($token) {

        $query = $this->db->query("SELECT majalis.name, majalis.override, majalis_date.id, majalis_date.date as date, YEAR(STR_TO_DATE(majalis_date.date, '%Y-%m-%d')) as year
                FROM majalis, majalis_date
                WHERE majalis.token = '". $token ."'
                AND majalis.id = majalis_date.majalis_id
                GROUP BY YEAR(STR_TO_DATE(majalis_date.date, '%Y-%m-%d'))
                ORDER BY year desc ");

        $query->result();

        return $query->result();

    }


    public function getDutiesByYear() {

        $query = $this->db->query("SELECT  majalis_date.date as date, YEAR(STR_TO_DATE(majalis_date.date, '%Y-%m-%d')) as year
                FROM majalis_date
                GROUP BY YEAR(STR_TO_DATE(majalis_date.date, '%Y-%m-%d'))
                ORDER BY year desc");

        return $query->result();
    }


    public function getFestivalDutiesByYear() {

        $query = $this->db->query("SELECT  festival_date.date as date, YEAR(STR_TO_DATE(festival_date.date, '%Y-%m-%d')) as year
                FROM festival_date
                GROUP BY YEAR(STR_TO_DATE(festival_date.date, '%Y-%m-%d'))
                ORDER BY year desc");

        return $query->result();
    }


    public function getMajalisIdFromDate($token) {

        $query = $this->db->query("SELECT majalis_id from majalis_date where majalis_date.token = '". $token ."'");

        return $query->result()[0];

    }

    /**
     * Delete Majlis date by token
     * Created By: Moiz     
     */
    public function deleteMajalisDateByToken($token) {
        $this->db->delete( 'majalis_date' , array( 'token' => $token) ); 
    }

    /**
     * Delete Assigned Majalis Duty
     * Created By: Moiz     
     */
    public function deleteAssignedMajalisDuty($id) {
        $this->db->delete( 'majalis_duty_assign' , array( 'id' => $id) ); 
    }

    /**
     * Delete Festival duty
     * Created By: Moiz     
     */
    public function deleteFestivalDuty($token) {
        $this->db->delete( 'festival_duties' , array( 'token' => $token) ); 
    }
    
    public function deleteMajalisWithDutiesAndDates($id) {

        $this->db->delete( 'majalis' , array( 'id' => $id) );
        $this->db->delete( 'majalis_date' , array( 'majalis_id' => $id) );

        $query = $this->db->query("DELETE specfic_date_duties
            FROM specfic_date_duties
            INNER JOIN majalis_duties
            ON majalis_duties.id = specfic_date_duties.duty_id
            WHERE majalis_duties.majalis_id = " . $id . " 
            AND specfic_date_duties.type = 'MAJALIS'");

        
        $query = $this->db->query("DELETE majalis_duty_assign
            FROM majalis_duty_assign
            INNER JOIN majalis_duties
            ON majalis_duties.id = majalis_duty_assign.duty_id
            WHERE majalis_duties.majalis_id = " . $id);

        $query = $this->db->query("DELETE majalis_sort
            FROM majalis_sort
            INNER JOIN majalis_duties
            ON majalis_duties.id = majalis_sort.duty_id
            WHERE majalis_duties.majalis_id = " . $id );

        $this->db->delete( 'majalis_duties' , array( 'majalis_id' => $id) );

    }

    /**
     * Delete Duty date by token
     * Created By: Moiz     
     */
    public function deleteMajalisDutyByToken($token) {
        $this->db->delete( 'majalis_duties' , array( 'token' => $token) ); 
    }

    /**
     * Delete Duty date by id
     * Created By: Moiz     
     */
    public function deleteMajalisDuty($id) {
        $this->db->delete( 'majalis_duties' , array( 'id' => $id) ); 
    }    

    public function deleteDutyForSpecficDate($dutyId, $type) {
        $this->db->delete( 'specfic_date_duties' , array(
            'duty_id' => $dutyId,
            'type' => $type
        ));    
    }

    /**
     * Get Duties by majalis or local dates
     * Created By: Moiz     
     */
    public function getDutiesForMajalis($id, $date) {

        $query = $this->db->query("SELECT id, token, UPPER(name), majalis_id 
                FROM majalis_duties
                WHERE majalis_id = " . $id . " AND type = 'GLOBAL'");

        $query->result();
        return $query->result();
    }


    
    public function getAssignMajalisUser($id) {

        $query = $this->db->query("SELECT user.first_name, user.last_name, majalis_duty_assign.id, majalis_duty_assign.duty_id, majalis_duty_assign.user_id, majalis_duty_assign.token, majalis_duty_assign.date
            FROM user, majalis_duty_assign
            WHERE majalis_duty_assign.user_id = user.user_id
            AND majalis_duty_assign.id = " . $id);

        $query->result();
        return $query->result();        
    }
    
    /**
     * Get All Majalis
     */
    public function getAllMajalis(){
      
        $this->db->select('*');
        $this->db->from('majalis');
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;
    }
  
    /**
     * Get Majalis by id
     */

    public function TId($id){
      
        $this->db->select('*');
        $this->db->from('majalis');
        $this->db->where('id',$id);
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;
    } 
  
    /**
     * Get Majalis by id
     */

    public function getMajalisWaara($id){
      
        $query =  $this->db->query('SELECT *, (select date from majalis_data where id = mw.majalis_data_id) as  maja_date FROM `majalis_waara` as mw WHERE majalis_data_id in (SELECT id from majalis_data )');
        $query->result();

        return $query->result();
    } 
  
  
    /**
     * Get All Majalis Dates
     */
    public function getMajalisByToken($token){
      
        $this->db->select('*');
        $this->db->from('majalis');
        $this->db->where('token', $token);
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        return $result;
    } 

    /**
     * Get All Majalis Duty
     */
    public function getDutyByToken($token){
      
        $this->db->select('*');
        $this->db->from('majalis_duties');
        $this->db->where('token', $token);
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        return $result;
    }    


    /**
     * Delete Majalis using majalis id
     * @param 1 : data : array
     */
    public function delete($data){

        $this->db->delete( 'majalis' , $data ); 
    }  


    public function getSortCountByDate($date) {

        $query =  $this->db->query("SELECT count(id) as count
            FROM majalis_sort
            where date = '". $date ."'");

        return $query->result()[0]->count;   

    }

    public function getGlobalDuties($majalisToken) {

        $query =  $this->db->query("SELECT majalis_duties.name, majalis_duties.id as dutyid, majalis.name as majalisName, majalis.id as majalisId 
                FROM majalis_duties, majalis
                WHERE majalis.token = '". $majalisToken ."'
                AND majalis_duties.type = 'GLOBAL'");

        return $query->result();

    }

    public function getDutiesByDate($date) {

        //if($this->getSortCountByDate($date) > 0) {

        $query =  $this->db->query("SELECT majalis.id as majalisId, majalis.name as majalisName, majalis_duties.id, majalis_duties.token as dutyToken, majalis_duties.name, majalis_duty_assign.user_id, majalis_duty_assign.id as assignId, majalis_sort.sort, majalis_date.date
            FROM majalis
            INNER JOIN majalis_date ON majalis.id = majalis_date.majalis_id 
            LEFT JOIN majalis_duties ON majalis_duties.majalis_id = majalis.id AND majalis_duties.type = 'GLOBAL'
            LEFT JOIN majalis_duty_assign ON majalis_duties.id = majalis_duty_assign.duty_id
            LEFT JOIN majalis_sort ON majalis_duties.id = majalis_sort.duty_id
            WHERE majalis_date.date = '". $date ."' ");

        return $query->result();
            
        // } else {

        //     $query =  $this->db->query("SELECT majalis_duties.id, majalis_duties.token, majalis_duties.name, majalis_duties.majalis_id, majalis_date.date, majalis_duty_assign.user_id, majalis_duty_assign.id as assignId
        //         FROM majalis_date, majalis_duties
        //         LEFT JOIN majalis_duty_assign ON majalis_duties.id = majalis_duty_assign.duty_id
        //         WHERE majalis_duties.majalis_id = majalis_date.majalis_id
        //         AND majalis_date.date = '". $date ."'
        //         AND majalis_duties.type = 'GLOBAL'");

        //     return $query->result();     

        // }


    }

    public function getDutiesFromSpecficTable($date) {

        //if ($this->getSortCountByDate($date) > 0) {

        $query =  $this->db->query("SELECT majalis_duties.id, majalis_duties.token as dutyToken, majalis_duties.name, majalis_duties.majalis_id as majalisId, specfic_date_duties.date, majalis_duty_assign.user_id, majalis_duty_assign.id as assignId, majalis_sort.sort
            FROM specfic_date_duties, majalis_duties
            LEFT JOIN majalis_duty_assign ON majalis_duties.id = majalis_duty_assign.duty_id
            LEFT JOIN majalis_sort ON majalis_duties.id = majalis_sort.duty_id
            WHERE specfic_date_duties.date = '". $date ."'
            AND majalis_duties.id = specfic_date_duties.duty_id");

        return $query->result(); 

        // } else {
            
        //     $query =  $this->db->query("SELECT majalis_duties.id, majalis_duties.token, majalis_duties.name, majalis_duties.majalis_id, specfic_date_duties.date, majalis_duty_assign.user_id, majalis_duty_assign.id as assignId
        //         FROM specfic_date_duties, majalis_duties
        //         LEFT JOIN majalis_duty_assign ON majalis_duties.id = majalis_duty_assign.duty_id
        //         WHERE specfic_date_duties.date = '". $date ."'
        //         AND majalis_duties.id = specfic_date_duties.duty_id");

        //     return $query->result();     

        // }

    }    

    public function getAssignMajalisDutyDetail($dutyId, $date) {

        $query =  $this->db->query("SELECT majalis.name, majalis_duties.name as dutyName, majalis_date.date, majalis_duty_assign.id, user.first_name, user.last_name
            FROM majalis, majalis_duties, majalis_date, majalis_duty_assign, user
            WHERE majalis_duties.majalis_id = majalis.id
            AND majalis.id = majalis_date.majalis_id
            AND majalis_duties.id = majalis_duty_assign.duty_id
            AND majalis_duty_assign.user_id = user.user_id
            AND majalis_duties.id = " . $dutyId);

            //." AND majalis_date.date = '". $date ."'"        

        $query->result();

        return $query->result();     
    }    


    function allowEditDelete($majalisId) {

        $type = $this->session->userdata('type');
        $exist = in_array($majalisId, $this->session->userdata('majalisId'));

        if ($exist || $type == 'Super Admin') {
          return true;
        } else {
          return false;
        }
    }

    public function insertMajalisDutyRating($data) {
        return $this->CommonModel->insertIntoTable('majalis_duty_rating', $data);
    }



}