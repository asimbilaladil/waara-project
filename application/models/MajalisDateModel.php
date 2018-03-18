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

    public function getDatesByMajalisIds($ids) {

        $query = $this->db->query("Select * FROM majalis_date WHERE majalis_id IN (" . $ids . ")");

        return $query->result();
        
    }

}