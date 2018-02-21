<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class FestivalMajalisModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getFestivalWithDates() {

        $query = $this->db->query('SELECT festival.id, festival.token, festival.festival, festival_date.id as dateId, festival_date.token as dateToken, festival_date.date as date 
                FROM festival, festival_date
                WHERE festival.id = festival_date.festival_id');

        $query->result();

        return $query->result();
    }

    public function getFestivalForYears($year) {

        $query = $this->db->query("SELECT festival.id, festival.token, festival.festival, festival_date.id as dateId, festival_date.token as dateToken, festival_date.date as date 
                FROM festival, festival_date
                WHERE festival.id = festival_date.festival_id
                AND festival_date.date LIKE '". $year ."-%'");

        $query->result();

        return $query->result();
    }    

    public function getFestivalForTable($year) {
        
        $festivalWithDates = $this->getFestivalForYears($year);

        $festivalArray = array();

        foreach ($festivalWithDates as $festival) {

            $index = getIndexOf($festivalArray, 'id', $festival->id);
            $festivalMonth = getMonthFromDate($festival->date);
            $date = date("d",strtotime($festival->date));
            $completeDate = $festival->date;
            $dateToken = $festival->dateToken;

            $dateItem = array(
                'date' => $date,
                'completeDate' => $completeDate,
                'dateToken' => $dateToken
            );

            if ($index > -1) {
                                
                if (!isset($festivalArray[$index][$festivalMonth])) {
                    $festivalArray[$index][$festivalMonth] = array();
                }

                array_push($festivalArray[$index][$festivalMonth], $dateItem);

            } else {
                $dateArray = array();
                $item['id'] = $festival->id;
                $item['festivalName'] = $festival->festival;
                $item['token'] = $festival->token;

                array_push($dateArray, $dateItem);
                $item[$festivalMonth] = $dateArray;

                array_push($festivalArray, $item);
                $item = null;
            }

        }

        return $festivalArray;
    }

    public function getMajalisWithDates() {

        $query = $this->db->query('SELECT majalis.id, majalis.token, majalis.name, majalis_date.id as dateId, majalis_date.token as dateToken, majalis_date.date as date 
                FROM majalis, majalis_date
                WHERE majalis.id = majalis_date.majalis_id');

        return $query->result();

    }


    public function getMajalisForYear($year) {

        $query = $this->db->query("SELECT majalis.id, majalis.token, majalis.name, majalis_date.id as dateId, majalis_date.token as dateToken, majalis_date.date as date 
                FROM majalis, majalis_date
                WHERE majalis.id = majalis_date.majalis_id
                AND majalis_date.date LIKE '". $year ."-%' ");

        return $query->result();

       
    }

    public function getMajalisForTable($year) {
        
        $majalisWithDates = $this->getMajalisForYear($year);
        $majalisArray = array();        

        foreach ($majalisWithDates as $majalis) {

            $index = getIndexOf($majalisArray, 'id', $majalis->id);
            $majalisMonth = getMonthFromDate($majalis->date);
            $date = date("d",strtotime($majalis->date));
            $completeDate = $majalis->date;
            $dateToken = $majalis->dateToken;

            $dateItem = array(
                'date' => $date,
                'completeDate' => $completeDate,
                'dateToken' => $dateToken
            );

            if ($index > -1) {

            if (!isset($majalisArray[$index][$majalisMonth])) {
                $majalisArray[$index][$majalisMonth] = array();
            }

            array_push($majalisArray[$index][$majalisMonth], $dateItem);

            } else {
                $dateArray = array();
                $item['id'] = $majalis->id;
                $item['majalisName'] = $majalis->name;
                $item['token'] = $majalis->token;

                array_push($dateArray, $dateItem);
                $item[$majalisMonth] = $dateArray;

                array_push($majalisArray, $item);

                $item = null;
            }
        }

        return $majalisArray;         
    }
    
    /**
     * Get All Festival by token
     */
    public function getFestivalByToken($token){

        $this->db->select('*');
        $this->db->from('festival');
        $this->db->where('token', $token);
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        return $result;
    }
    public function updateFestival($token, $data) {
        $this->db->where('token', $token );
        $result = $this->db->update( 'festival', $data);
        if ($result) {
            return true;
        } 
        return false;        
    }
  
    public function deleteFestivalWithDutiesAndDates($id) {

        $this->db->delete( 'festival' , array( 'id' => $id) );
        $this->db->delete( 'festival_date' , array( 'festival_id' => $id) );

        $query = $this->db->query("DELETE specfic_date_duties
            FROM specfic_date_duties
            INNER JOIN festival_duties
            ON festival_duties.id = specfic_date_duties.duty_id
            WHERE festival_duties.festival_id = " . $id);

        

//         $query = $this->db->query("DELETE  festival_duty_assign
//             FROM festival_duty_assign
//             INNER JOIN festival_duties
//             ON festival_duties.id = festival_duty_assign.duty_id
//             WHERE festival_duties.festival_id = " . $id);

        

        $this->db->delete( 'festival_duties' , array( 'festival_id' => $id) );

    }  

}