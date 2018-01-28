<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class MajalisModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Insert Majalis
     */
    public function insert( $data ){

        if ($this->db->insert('majalis', $data) ) {
            return $this->db->insert_id();
        } 
        return false;
    }

    /**
     * Insert Majalis Duties
     */
    public function insertMajalisDuties($data) {
        if ($this->db->insert('majalis_duties', $data) ) {
            return $this->db->insert_id();
        } 
        return false;
    }

    /**
     * Insert Majalis Dates
     */
    public function insertMajalisDates($data) {
        if ($this->db->insert('majalis_date', $data) ) {
            return $this->db->insert_id();
        } 
        return false;        
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

    public function getMajalisById($id){
      
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
     * Delete Majalis using majalis id
     * @param 1 : data : array
     */
    public function delete($data){

        $this->db->delete( 'majalis' , $data ); 
    }  
}