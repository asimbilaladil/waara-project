<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class EmailModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }



    public function insert( $data ){

        if ($this->db->insert('email', $data) ) {
            return $this->db->insert_id();
        } 
        return false;
    }
    
    public function setNotification( $data ){

        if ($this->db->insert('emailNotification', $data) ) {
            return $this->db->insert_id();
        } 
        return false;
    }
  
    public function getEmailContent( ){
      
        $query = $this->db->query('SELECT * from email where type = "assignWaara"  ORDER BY id DESC LIMIT 1');
        
        $query->result();

        return $query->result();
    }
    public function getEmailContentByType( $type ){
      
        $query = $this->db->query('SELECT * from email where type = "'.$type.'" ORDER BY id DESC LIMIT 1');
        
        $query->result();

        return $query->result();
    }  
  
    public function getEmailNotification( ){
      
        $query = $this->db->query('SELECT * from emailNotification  where type = "assignWaara"   ORDER BY id DESC LIMIT 1');
        
        $query->result();

        return $query->result();
    }
    public function getEmailNotificationByType( $type ){
      
        $query = $this->db->query('SELECT * from emailNotification where type = "'.$type.'" ORDER BY id DESC LIMIT 1');
        
        $query->result();

        return $query->result();
    }  

}