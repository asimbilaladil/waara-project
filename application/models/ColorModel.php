<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class ColorModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }



    public function insert( $data ){

        if ($this->db->insert('color', $data) ) {
            return $this->db->insert_id();
        } 
        return false;
    }
    
    /**
     * Get All Color
     */

    public function getAllColor(){
      
        $this->db->select('*');
        $this->db->from('color');
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;
    }
  
    /**
     * Get All Color
     */

    public function getColor($id){
      
        $this->db->select('*');
        $this->db->from('color');
        $this->db->where('id', $id);
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;
    }  
    /**
     * Get All Color
     */

    public function getUnassignColors(){

        $query = $this->db->query('select * from color where id not in (select color_id from user)');
        
        $query->result();

        return $query->result();
    }
  
    /**
     * Get All Color
     */

    public function getAssignColors(){

        $query = $this->db->query('select * , (select first_name from user where color_id = c.id) as username from color as c  where c.id in (select color_id from user where color_id !=0 ) ');
        
        $query->result();

        return $query->result();
    }
    /**
     * Delete Color using color id
     * @param 1 : data : array
     */
    public function delete ($data){

        $this->db->delete( 'color' , $data ); 
    }  
    /**
     * Update Method
     * @param whereParam1
     * @param dataObject
     */
    public function update( $whereParam1 ,$data ){

        $this->db->where( 'id', $whereParam1 );
        $result = $this->db->update( 'color' ,$data);
        if ( $result ) {

            return true;

        } 

        return false;

    }  
}