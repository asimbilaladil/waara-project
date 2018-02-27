<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class FestivalSortModel extends CI_Model {


    function __construct() {
        parent::__construct();
    }


    public function insert( $data ){

        if ($this->db->insert('festival_sort', $data) ) {
            return $this->db->insert_id();
        } 
        return false;
    }    


    public function getSortCountByDate($date) {
        $query =  $this->db->query("SELECT count(id) as count
            FROM festival_sort
            where date = '". $date ."'");
        return $query->result();   
    }

    public function getMaxSort($date) {

        $query =  $this->db->query("SELECT MAX(sort) max
            FROM festival_sort
            where date = '". $date ."'");

        return $query->row()->max;   
    }


    public function deleteSortByDate($date) {
        $this->db->delete( 'festival_sort' , array( 'date' => $date) );   
    }


}