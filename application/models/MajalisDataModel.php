<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class MajalisDataModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }



    public function insert( $data ){

        if ($this->db->insert('majalis_data', $data) ) {
            return $this->db->insert_id();
        } 
        return false;
    }

  
    /**
     * Get All Majalis Dates
     */

    public function getAllMajalisDates($token){
      
        $query = $this->db->query('SELECT *, (select name from majalis where token = "'.$token.'") as name from majalis_data where majalis_id = (select id from majalis where token = "'.$token.'")');
        
        $query->result();

        return $query->result();
    }
  
    /**
     * Delete Majalis using majalis id
     * @param 1 : data : array
     */
    public function delete ($data){

        $this->db->delete( 'majalis' , $data ); 
    }
  
     /**
     * Get All From Table Order By
     * @param 1 : token : string
     */ 
    public function getAllfromTableOrderBy( $token ) {

			  $query = $this->db->query("SELECT DISTINCT name, priority, description from majalis_waara where majalis_data_id in (select id from majalis_data where majalis_id = ( select id from majalis where token = '". $token ."')) order by priority asc ");
        $query->result();

        return $query->result();    
    }  
     /**
     * Get All Ids
     * @param 1 : token : string
     */ 
    public function getAllIds( $token ) {

			  $query = $this->db->query("select id from majalis_data where majalis_id = ( select id from majalis where token = '". $token ."' )");
        $query->result();

        return $query->result();    
    } 
   //http://stackoverflow.com/questions/6333623/mysql-syntax-for-inserting-a-new-row-in-middle-rows
   function updateDutyByOrder( $priority, $name, $description, $day,$admin_id, $token, $majalis_data_id ) {

        $query = $this->db->query('UPDATE majalis_waara SET priority = priority + 1 WHERE priority >= ' . $priority . ' order by priority DESC;');

        $query = $this->db->query("INSERT INTO majalis_waara ( priority, name, description, day,admin_id, token, majalis_data_id) VALUES ( ". $priority .", '". $name ."', '". $description ."', '". $day ."', ". $admin_id .", '". $token ."', ". $majalis_data_id ." )");

   }

   function updatePriority( $priority, $name, $description, $id ) {

        $query = $this->db->query('UPDATE duty SET priority = priority + 1 WHERE priority >= ' . $priority . ' order by priority DESC;');    

        $query = $this->db->query("UPDATE duty SET priority=". $priority ." ,name='". $name ."' ,description='". $description . "' WHERE duty_id=". $id );
   }  
}