<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class PreferenceModel extends CI_Model
{

	private $tableName = 'preference';

    function __construct()
    {
        parent::__construct();
    }

    public function insert( $data ){
        if ($this->db->insert($this->tableName, $data) ) {
            return $this->db->insert_id();
        } 
        return -1 ;
    }

    public function updateShift( $userId, $dutyId ,$data ){
        $this->db->where( 'user_id', $userId );
        $this->db->where( 'duty_Id', $dutyId );
        $result = $this->db->update( $this->tableName, $data);
        if ( $result ) {
            return true;
        } 
        return false;
    }

    public function deletePreferenceByUserId( $userId ){
        $this->db->where( 'user_id', $userId );
        $result = $this->db->delete($this->tableName);
        if ( $result ) {
            return true;
        } 
        return false;
    }

}