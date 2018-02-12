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

        $query = $this->db->query("SELECT majalis_duties.id, majalis_duties.name, majalis_duties.token
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

    public function updateMajalisDate($id, $data) {
        $this->db->where('id', $id );
        $result = $this->db->update( 'majalis_date', $data);
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

    /**
     * Delete Majlis date by token
     * Created By: Moiz     
     */
    public function deleteMajalisDateByToken($token) {
        $this->db->delete( 'majalis_date' , array( 'token' => $token) ); 
    }

    /**
     * Delete Duty date by token
     * Created By: Moiz     
     */
    public function deleteMajalisDutyByToken($token) {
        $this->db->delete( 'majalis_duties' , array( 'token' => $token) ); 
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

        $query = $this->db->query("SELECT id, token, name, majalis_id 
                FROM majalis_duties
                WHERE majalis_id = " . $id);

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
}