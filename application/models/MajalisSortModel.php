<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class MajalisSortModel extends CI_Model {


    function __construct() {
        parent::__construct();
    }


    public function insert( $data ){

        if ($this->db->insert('majalis_sort', $data) ) {
            return $this->db->insert_id();
        } 
        return false;
    }    


    public function getSortCountByDate($date) {

        $query =  $this->db->query("SELECT count(id) as count
            FROM majalis_sort
            where date = '". $date ."'");

        return $query->result();   

    }

    public function deleteSortByDate($date) {
        $this->db->delete( 'majalis_sort' , array( 'date' => $date) );   
    }


}