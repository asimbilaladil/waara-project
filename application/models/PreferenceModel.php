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

}