<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * get a admin by admin_id
     */
    function get_admin($id)
    {
        return $this->db->get_where('admin',array('admin_id'=>$id))->row_array();
    }

    /*
     * get all admin
     */
    function get_all_admin()
    {
        return $this->db->get('admin')->result_array();
    }

    /*
     * function to update admin
     */
    function update_admin($id,$params)
    {
        $this->db->where('admin_id',$id);
        $this->db->update('admin',$params);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    /*
     * function to delete admin
     */
    function delete_admin($id)
    {
        $this->db->delete('admin',array('admin_id'=>$id));
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    /*
    * get a category by cat_id
    */
    function get_category($id)
    {
        return $this->db->get_where('category',array('cat_id'=>$id))->row_array();
    }

    /*
     * get all category
     */
    function get_all_category()
    {
        return $this->db->get('category')->result_array();
    }



    /*
     * function to update category
     */
    function update_category($id,$params)
    {
        $this->db->where('cat_id',$id);
        $this->db->update('category',$params);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    /*
     * function to delete category
     */
    function delete_category($id)
    {
        $this->db->delete('category',array('cat_id'=>$id));
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    function get_all_candidate(){
        return $this->db->join('category', 'category.cat_id = candidates.candidate_category')->get('candidates')->result_array();
    }
    function delete_candidate($id)
    {
        $this->db->delete('candidates',array('candidate_id'=>$id));
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    function get_all_voter(){
        return $this->db->get('voters')->result_array();
    }
    function delete_voter($id)
    {
        $this->db->delete('voters',array('voter_id'=>$id));
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    /*
  * get all messages
  */
    function get_all_messages()
    {
        return $this->db->get('messages')->result_array();
    }
    function delete_message($id)
    {
        $this->db->delete('messages',array('message_id'=>$id));
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    /*
     * get a event by event_id
     */
    function get_event($id)
    {
        return $this->db->get_where('events',array('event_id'=>$id))->row_array();
    }

    /*
     * get all events
     */
    function get_all_events()
    {
        return $this->db->join('category', 'category.cat_id = events.category_id')->get('events')->result_array();
    }


    /*
     * function to update event
     */
    function update_event($id,$params)
    {
        $this->db->where('event_id',$id);
        $this->db->update('events',$params);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    /*
     * function to delete event
     */
    function delete_event($id)
    {
        $this->db->delete('events',array('event_id'=>$id));
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    function get_all_result(){
        $this->db->select('*,count(voter_id) AS num_of_time');

        $this->db->from('votes');
        $this->db->join('candidates', 'candidates.candidate_id = votes.candidate_id');
        $this->db->join('category', 'category.cat_id = candidates.candidate_category');
        $this->db->join('events', 'events.event_id = votes.event_id');
     //   $this->db->where('store_event.voter_id',$id);
        $this->db->group_by('votes.event_id,votes.candidate_id');
        $query = $this->db->get();
        return $query->result();
    }

       function get_all_can_by_category($category_id,$event_id){
        $this->db->select('*');
        $this->db->from('candidates');
        $this->db->where('candidate_category', $category_id);
        $query = $this->db->get();
        foreach($query->result() as $data){
            $params= array();
            $params['event_id']=$event_id;
            $params['can_id']=$data->candidate_id;
            $params['votes']=0;
            $this->db->insert('count_votes',$params);
        }
    }
}