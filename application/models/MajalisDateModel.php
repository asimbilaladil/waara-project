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

        $query = $this->db->query("SELECT majalis_id, date from majalis_date where majalis_date.id = ". $id);

        return $query->result()[0];

    }

    public function updateMajalisDate($id, $data) {
        $this->db->where('id', $id );
        $result = $this->db->update( 'majalis_date', $data);
        if ($result) {
            return true;
        } 
        return false;        
    }    

    public function updateMajalisSpecficDate($id, $data) {
        $this->db->where('id', $id );
        $result = $this->db->update( 'specfic_date_duties', $data);
        if ($result) {
            return true;
        } 
        return false;        
    }    


    public function getDatesByMajalisIds($ids, $year) {

        $query = $this->db->query("Select majalis_date.id, majalis_date.date, majalis_date.token, majalis.name 
            FROM majalis_date, majalis
            WHERE majalis_id IN (". $ids .")
            AND majalis_date.majalis_id = majalis.id
            AND majalis_date.date LIKE '". $year ."-%'");

        return $query->result();
        
    }


    public function getSpecificDate($date, $majalisId) {

        $query = $this->db->query("select specfic_date_duties.id, specfic_date_duties.date
        FROM specfic_date_duties, majalis_duties
        WHERE specfic_date_duties.date = '". $date ."'
        AND specfic_date_duties.duty_id = majalis_duties.id
        AND majalis_duties.majalis_id = " . $majalisId);

        return $query->result();
        
    }


    

}