<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class WebSite extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add_voter($params)
    {
        $this->db->insert('voters', $params);
        return $this->db->insert_id();
    }

    public function candidate_login_check_info($candidate_email, $candidate_password)
    {
        $this->db->select('*');
        $this->db->from('candidates');
        $this->db->where('candidate_email', $candidate_email);
        $this->db->where('candidate_password', md5($candidate_password));
        $quary_result = $this->db->get();
        $result = $quary_result->row();
        return $result;
    }

    /*
   * get a candidate by candidate_id
   */
    public function get_candidate($candidate_id)
    {
        return $this->db->get_where('candidates', array('candidate_id' => $candidate_id))->row_array();
    }

    public function updateCandidateInfo($id, $params)
    {
        $this->db->where('candidate_id', $id);
        $this->db->update('candidates', $params);
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function voter_login_check_info($voter_email, $voter_password)
    {
        $this->db->select('*');
        $this->db->from('voters');
        $this->db->where('voter_email', $voter_email);
        $this->db->where('voter_password', md5($voter_password));
        $quary_result = $this->db->get();
        $result = $quary_result->row();
        return $result;
    }

    public function get_voter($id)
    {
        return $this->db->get_where('voters', array('voter_id' => $id))->row_array();
    }

    public function updateVoterInfo($id, $params)
    {
        $this->db->where('voter_id', $id);
        $this->db->update('voters', $params);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;

    }

    public function update_store_event($voter_id,$event_id, $params){
        $this->db->where('voter_id', $voter_id);
        $this->db->where('event_id', $event_id);
        $this->db->update('store_event', $params);
    }

    public function test($id)
    {
        $this->db->select('*');
        $this->db->from('cat_voters');
        $this->db->where('cat_voters.voter_id', $id);
        $this->db->where('store_event.voter_id',$id);
        $this->db->where('store_event.status', 'false');
        $this->db->where('events.event_status', 'active');
        $this->db->join('events', 'events.category_id = cat_voters.cat_id');
        $this->db->join('category', 'category.cat_id = cat_voters.cat_id');
        $this->db->join('store_event', 'store_event.event_id = events.event_id');


        $query = $this->db->get();

        $return = array();

        foreach ($query->result() as $events) {
            $return[$events->cat_id] = $events;
            $return[$events->cat_id]->candidate = $this->get_candidate_Bycategories($events->cat_id); // Get the categories sub categories
        }

        return $return;
    }

    public function get_candidate_Bycategories($category_id)
    {
        $this->db->select('*');
        $this->db->from('candidates');
        $this->db->where('candidate_category', $category_id);
        $query = $this->db->get();
        return $query->result();
    }
public function check_cuent_votes($can_id,$event_id){
        $this->db->select('*');
        $this->db->from('count_votes');
        $this->db->where('can_id', $can_id);
        $this->db->where('event_id',$event_id);
        $quary_result = $this->db->get();
        $result = $quary_result->row();
        return $result;
    }

public function get_event(){
        $this->db->select('*');
        $this->db->from('events');
        $this->db->where('event_status', 'end');
        $quary_result = $this->db->get();
        $result = $quary_result->result();
        return $result;
    }

public function get_result($id){

        $query = $this->db->query(" SELECT (SELECT `candidate_name` FROM `candidates` WHERE `candidate_id` = count_votes.can_id) As name , votes FROM `count_votes` WHERE `event_id` = ".$id);
        $result = $query->result_array();
      
        return $result;
    }    
    


}