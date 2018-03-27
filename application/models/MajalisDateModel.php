<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class MajalisDateModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    public function getMajalisIdFromDateByToken($token) {

        $query = $this->db->query("SELECT majalis_id from majalis_date where majalis_date.token = '". $token ."'");

        return $query->result()[0]->majalis_id;

    }


    public function getMajalisIdFromDateById($id) {

        $query = $this->db->query("SELECT majalis_id from majalis_date where majalis_date.id = ". $id);

        return $query->result()[0];

    }

    public function getDatesByMajalisIds($ids, $year) {

        $query = $this->db->query("Select majalis_date.id, majalis_date.date, majalis_date.token, majalis.name 
            FROM majalis_date, majalis
            WHERE majalis_id IN (". $ids .")
            AND majalis_date.majalis_id = majalis.id
            AND majalis_date.date LIKE '". $year ."-%'");

        return $query->result();
        
    }

}