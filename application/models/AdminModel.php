<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class AdminModel extends CI_Model
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

}