<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class AdminModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function admin_login_check_info( $data ){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $data['email']);
        $this->db->where('password', $data['password']);
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        return $result;
    }


    /**
     * Insert Method
     * @param tableName
     * @param dataObject
     */
    public function insertSamar( $tableName ,$data ){

        if ($this->db->insert($tableName, $data) ) {
                        $insert_id = $this->db->insert_id();
            return $insert_id;

        } 

        return false;

    } 
    /**
     * Insert Method
     * @param tableName
     * @param dataObject
     */
    public function insert( $tableName ,$data ){

        if ($this->db->insert($tableName, $data) ) {

            return true;

        } 

        return false;

    }

    /**
     * Add New JK Method
     * @param data [ 
     *      name : string 
     *      location : string    
     *      ]
     */
    public function addJK( $data ){

        if ($this->db->insert('jk', $data) ) {

            return true;

        } 

        return false;
    }


    /**
     * Get JK
     */

    public function getJamatKhana (){
        $this->db->select('*');
        $this->db->from('jk');
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;
    }

    public function getAllfromTable( $tableName ) {
        $this->db->select('*');
        $this->db->from( $tableName );
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;        
    }

    public function delete ( $whereParam1, $whereParam2, $tableName ){

        $this->db->delete( $tableName , array( $whereParam1 => $whereParam2) ); 
    }    

        /*
        SELECT jk.name 
        FROM duty, duty_jk, jk
        WHERE duty.duty_id = '1' AND 
        duty.duty_id = duty_jk.duty_id AND
        duty_jk.jk_id = jk.id
        */

    public function getJkFromDuty( $id ) {

        $query = $this->db->query('SELECT jk.name, jk.id 
                        FROM duty, duty_jk, jk
                        WHERE duty.duty_id = '. $id .' AND 
                        duty.duty_id = duty_jk.duty_id AND
                        duty_jk.jk_id = jk.id');
        
        $query->result();

        return $query->result();

    }


    public function get_calendar_duties() {

        $query = $this->db->query('CALL get_calendar_duties()');
        $query->result();

        return $query->result();

    }
    public function get_calendar_duties_by_user($user_id) {

        $query = $this->db->query('CALL get_calendar_duties_by_user('.$user_id.')');
        $query->result();

        return $query->result();

    }   

    /**
     * Insert Method
     * @param tableName
     * @param whereParam1
     * @param whereParam2
     * @param dataObject
     */
    public function update( $tableName, $whereParam1, $whereParam2 ,$data ){

        $this->db->where( $whereParam1, $whereParam2 );
        $result = $this->db->update( $tableName ,$data);
        if ( $result ) {

            return true;

        } 

        return false;

    }

        /**
     * Insert Method
     * @param tableName
     * @param whereParam1
     * @param whereParam2
     * @param whereParam3
     * @param whereParam4
     * @param dataObject
     */
    public function updateWhere( $tableName, $whereParam1, $whereParam2, $whereParam3, $whereParam4 ,$data ){

        $this->db->where( $whereParam1, $whereParam2 );
        $this->db->where( $whereParam1, $whereParam2 );
        $result = $this->db->update( $tableName ,$data);
        if ( $result ) {

            return true;

        } 

        return false;

    }


  public function checkGlobalSortRecord(){
            $query = $this->db->query('SELECT * from globalWaaraSort');

        $query->result();

        return $query->result();
    }
    
    public function checkSpecificSortRecord($date){
            $query = $this->db->query('SELECT * from waaraSort where date = "'.$date.'"');

        $query->result();

        return $query->result();
    }
    

    /*
        SELECT duty.name, duty.duty_id 
        FROM duty, duty_jk, jk
        WHERE jk.id = '1' AND 
        duty.duty_id = duty_jk.duty_id AND
        duty_jk.jk_id = jk.id
    */
    public function getDutyByJk( $id ) {

        $query = $this->db->query('SELECT duty.name, duty.duty_id 
                        FROM duty, duty_jk, jk
                        WHERE jk.id = ' . $id . ' AND 
                        duty.duty_id = duty_jk.duty_id AND
                        duty_jk.jk_id = jk.id AND
                        duty.isEnable = 1 
                        order by duty.priority asc');

        $query->result();

        return $query->result();

    }
    public function getDutyByJkandDate( $id, $date ) {

        $query = $this->db->query(' (SELECT  duty.Monday, duty.Tuesday, duty.Wednesday , duty.Thursday, duty.Friday, duty.Saturday, duty.Sunday , duty.priority as unionsorting, duty.priority , duty.name, duty.duty_id 
                        FROM duty, duty_jk, jk
                        WHERE jk.id = ' . $id . '  AND 
                        duty.duty_id = duty_jk.duty_id AND
                                                duty.duty_id  IN (select duty_id from assign_duty where start_date = "'. $date .'" OR 
                                                duty.duty_id  in (SELECT duty_id FROM `waara_global_template`) ) AND
                        duty_jk.jk_id = jk.id AND
                        duty.isEnable = 1 AND
                                                duty.Monday != DAYNAME("'. $date .'") And 
                                                duty.Tuesday != DAYNAME("'. $date .'") And 
                                                duty.Wednesday != DAYNAME("'. $date .'") And 
                                                duty.Thursday != DAYNAME("'. $date .'") And 
                                                duty.Friday != DAYNAME("'. $date .'") And 
                                                duty.Saturday != DAYNAME("'. $date .'") And 
                                                duty.Sunday != DAYNAME("'. $date .'") And                                               
                                                FIND_IN_SET( "all" , duty.for_day))
                                                
            
            UNION DISTINCT  (SELECT  duty.Monday, duty.Tuesday, duty.Wednesday , duty.Thursday, duty.Friday, duty.Saturday, duty.Sunday , duty.priority as unionsorting, duty.priority , duty.name, duty.duty_id 
                        FROM duty, duty_jk, jk
                        WHERE jk.id = ' . $id . '  AND 
                        duty.duty_id = duty_jk.duty_id AND
                        duty_jk.jk_id = jk.id AND
                        duty.isEnable = 1 AND 
                                                FIND_IN_SET( "' . $date . '" , duty.for_day) 
                                                ) ORDER BY unionsorting');

       
                
                $query->result();

        return $query->result();

    }
    public function checkGlobalSpecificSortRecord($date){
            $query = $this->db->query('SELECT * from globalWaaraSort where date = "'.$date.'"');

        $query->result();

        return $query->result();
    }   
    public function getSpecificGlobalDayDutyByJkandDate( $id, $date ) {

    $quert= $this->db->query(' (select (select sort_number from globalWaaraSort where date = "'. $date .'" and duty_id = duty.duty_id) as sn, duty.name, duty.duty_id from duty, duty_jk, jk 
                    WHERE jk.id = ' . $id . '  AND 
                    duty.duty_id = duty_jk.duty_id AND

                    duty.duty_id  in (SELECT duty_id FROM `waara_global_template` ) AND
                    duty_jk.jk_id = jk.id AND
                    duty.isEnable = 1 AND
                    duty.Monday != DAYNAME("'. $date .'") And 
                    duty.Tuesday != DAYNAME("'. $date .'") And 
                    duty.Wednesday != DAYNAME("'. $date .'") And 
                    duty.Thursday != DAYNAME("'. $date .'") And 
                    duty.Friday != DAYNAME("'. $date .'") And 
                    duty.Saturday != DAYNAME("'. $date .'") And 
                    duty.Sunday != DAYNAME("'. $date .'") And
                    
                    duty.for_day =  "all"
                    
                    ) UNION (SELECT (select sort_number from globalWaaraSort where date = "'. $date .'" and duty_id = duty.duty_id) as sn, duty.name, duty.duty_id 
                         FROM duty, duty_jk, jk WHERE jk.id = ' . $id . '  AND 
                         duty.duty_id = duty_jk.duty_id AND
                         duty_jk.jk_id = jk.id AND
                         duty.isEnable = 1 AND 
                                                FIND_IN_SET( "' . $date . '" , duty.for_day) ) ORDER BY sn ');
//         $query = $this->db->query(' (SELECT globalWaaraSort.sort_number as sn, duty.priority as unionsorting, duty.priority , duty.name, duty.duty_id 
//                         FROM duty, duty_jk, jk, globalWaaraSort
//                         WHERE jk.id = ' . $id . '  AND 
//                         duty.duty_id = duty_jk.duty_id AND
//                                              duty.duty_id  IN (select duty_id from assign_duty where start_date = "'. $date .'" OR 
//                                              duty.duty_id  in (SELECT duty_id FROM `waara_global_template`) ) AND
//                         duty_jk.jk_id = jk.id AND
//                         duty.isEnable = 1 AND 
//                                              duty.duty_id = globalWaaraSort.duty_id And
//                                              globalWaaraSort.date = "'. $date .'" And
//                                              duty.Monday != DAYNAME("'. $date .'") And 
//                                              duty.Tuesday != DAYNAME("'. $date .'") And 
//                                              duty.Wednesday != DAYNAME("'. $date .'") And 
//                                              duty.Thursday != DAYNAME("'. $date .'") And 
//                                              duty.Friday != DAYNAME("'. $date .'") And 
//                                              duty.Saturday != DAYNAME("'. $date .'") And 
//                                              duty.Sunday != DAYNAME("'. $date .'") And                                               
//                                              duty.for_day =  "all")
                                                
            
//             UNION DISTINCT  (SELECT globalWaaraSort.sort_number as sn, duty.priority as unionsorting, duty.priority , duty.name, duty.duty_id 
//                         FROM duty, duty_jk, jk, globalWaaraSort
//                         WHERE jk.id = ' . $id . '  AND 
//                         duty.duty_id = duty_jk.duty_id AND
//                         duty_jk.jk_id = jk.id AND
//                         duty.isEnable = 1 AND 
//                                              FIND_IN_SET( "' . $date . '" , duty.for_day) And
//                                              globalWaaraSort.date = "'. $date .'" And
//                                              duty.duty_id = globalWaaraSort.duty_id
//                                              ) ORDER BY sn');

       
                
                $query->result();

        return $query->result();

    }  

    public function getGlobalSortDutyByTodayDate( $id, $date, $flag ) {
                if($flag){
                    $query = $this->db->query('
                    select  (select sort_number from globalWaaraSort where duty_id = duty.duty_id and date = (select date from globalWaaraSort order by date desc limit 1) )as sn , duty.Monday, duty.Tuesday, duty.Wednesday , duty.Thursday, duty.Friday, duty.Saturday, duty.Sunday , duty.name, duty.duty_id FROM duty, duty_jk, jk, waara_global_template  
                        where
                        jk.id = ' . $id . '  AND 
                        duty.isEnable = 1 AND
                        duty.duty_id = duty_jk.duty_id And
                        duty.duty_id = waara_global_template.duty_id
                        order by sn asc');      
                    
//                  $query = $this->db->query('
//                                  SELECT DISTINCT  duty.Monday, duty.Tuesday, duty.Wednesday , duty.Thursday, duty.Friday, duty.Saturday, duty.Sunday , duty.enableDays, globalWaaraSort.sort_number as sn, duty.priority as unionsorting, duty.priority , duty.name, duty.duty_id 
//                         FROM duty, duty_jk, jk, globalWaaraSort
//                                              where 
//                                              duty.for_day =  "all" AND                                       
//                                              jk.id = ' . $id . '  AND 
//                                              duty.duty_id = duty_jk.duty_id And
//                                              duty.duty_id = globalWaaraSort.duty_id And
//                                              duty.isEnable = 1 AND 
//                                              globalWaaraSort.date = (select date from globalWaaraSort order by date desc limit 1)
//                                              order by sn 
//                                              ');
                } else {
        
//                          $query = $this->db->query('SELECT DISTINCT  duty.Monday, duty.Tuesday, duty.Wednesday , duty.Thursday, duty.Friday, duty.Saturday, duty.Sunday , duty.enableDays, globalWaaraSort.sort_number as sn, duty.priority as unionsorting, duty.priority , duty.name, duty.duty_id 
//                         FROM duty, duty_jk, jk, globalWaaraSort
//                                              where 
//                                              duty.for_day =  "all" AND                                       
//                                              jk.id = ' . $id . '  AND 
//                                              duty.duty_id = duty_jk.duty_id And
//                                              duty.duty_id = globalWaaraSort.duty_id And
//                                               duty.isEnable = 1 AND
//                                              duty.Monday != DAYNAME("'. $date .'") And 
//                                              duty.Tuesday != DAYNAME("'. $date .'") And 
//                                              duty.Wednesday != DAYNAME("'. $date .'") And 
//                                              duty.Thursday != DAYNAME("'. $date .'") And 
//                                              duty.Friday != DAYNAME("'. $date .'") And 
//                                              duty.Saturday != DAYNAME("'. $date .'") And 
//                                              duty.Sunday != DAYNAME("'. $date .'") And                                                
//                                              "'.$date.'"  >= globalWaaraSort.date
//                                              order by sn 
//                                              ');
                    
                            $query = $this->db->query('
                                                    (select (select sort_number from globalWaaraSort where duty_id = duty.duty_id and date = (select date from globalWaaraSort where "'.$date.'"  >= globalWaaraSort.date order by date desc limit 1) )as sn , duty.Monday, duty.Tuesday, duty.Wednesday , duty.Thursday, duty.Friday, duty.Saturday, duty.Sunday , duty.name, duty.duty_id FROM duty, duty_jk, jk, waara_global_template  
                        where
                        jk.id = ' . $id . '  AND 
                        duty.isEnable = 1 AND
                        duty.duty_id = duty_jk.duty_id And
                        duty.duty_id = waara_global_template.duty_id And
                        duty.Monday != DAYNAME("'. $date .'") And 
                        duty.Tuesday != DAYNAME("'. $date .'") And 
                        duty.Wednesday != DAYNAME("'. $date .'") And 
                        duty.Thursday != DAYNAME("'. $date .'") And 
                        duty.Friday != DAYNAME("'. $date .'") And 
                        duty.Saturday != DAYNAME("'. $date .'") And 
                        duty.Sunday != DAYNAME("'. $date .'")                                                
                                                
                        order by sn asc) UNION (SELECT (select sort_number from globalWaaraSort where date = "'. $date .'" and duty_id = duty.duty_id) as sn, duty.Monday, duty.Tuesday, duty.Wednesday , duty.Thursday, duty.Friday, duty.Saturday, duty.Sunday , duty.name, duty.duty_id 
                         FROM duty, duty_jk, jk WHERE jk.id = ' . $id . '  AND 
                         duty.duty_id = duty_jk.duty_id AND
                         duty_jk.jk_id = jk.id AND
                         duty.isEnable = 1 AND 
                                                FIND_IN_SET( "' . $date . '" , duty.for_day) )  order by sn asc


                                                ');                 
                    
                }
        


       
                
                $query->result();

        return $query->result();

    }  
    public function getGlobalSortDutyByJkandDate( $id, $date ) {

        $query = $this->db->query(' (SELECT globalWaaraSort.sort_number as sn, duty.priority as unionsorting, duty.priority , duty.name, duty.duty_id 
                        FROM duty, duty_jk, jk, globalWaaraSort
                        WHERE jk.id = ' . $id . '  AND 
                        duty.duty_id = duty_jk.duty_id AND
                                                duty.duty_id  IN (select duty_id from assign_duty where start_date = (select date from globalWaaraSort order by date desc limit 1)  OR 
                                                duty.duty_id  in (SELECT duty_id FROM `waara_global_template`) ) AND
                        duty_jk.jk_id = jk.id AND
                        duty.isEnable = 1 AND 
                                                duty.duty_id = globalWaaraSort.duty_id And
                                                globalWaaraSort.date = (select date from globalWaaraSort order by date desc limit 1) And
                                                duty.Monday != DAYNAME("'. $date .'") And 
                                                duty.Tuesday != DAYNAME("'. $date .'") And 
                                                duty.Wednesday != DAYNAME("'. $date .'") And 
                                                duty.Thursday != DAYNAME("'. $date .'") And 
                                                duty.Friday != DAYNAME("'. $date .'") And 
                                                duty.Saturday != DAYNAME("'. $date .'") And 
                                                duty.Sunday != DAYNAME("'. $date .'") And                                               
                                                duty.for_day =  "all")
                                                
            
            UNION DISTINCT  (SELECT globalWaaraSort.sort_number as sn, duty.priority as unionsorting, duty.priority , duty.name, duty.duty_id 
                        FROM duty, duty_jk, jk, globalWaaraSort
                        WHERE jk.id = ' . $id . '  AND 
                        duty.duty_id = duty_jk.duty_id AND
                        duty_jk.jk_id = jk.id AND
                        duty.isEnable = 1 AND 
                                                FIND_IN_SET( (select date from globalWaaraSort order by date desc limit 1)  , duty.for_day) And
                                                globalWaaraSort.date = (select date from globalWaaraSort order by date desc limit 1)  And
                                                duty.duty_id = globalWaaraSort.duty_id
                                                ) ORDER BY sn');

       
                
                $query->result();

        return $query->result();

    }  
    public function checkSpecificDayDutyByJkandDate ($id, $date ){
            $query = $this->db->query('select sort_number from waaraSort where date = "'. $date .'"');
            $query->result();
            return $query->result();            
    }
    public function getSpecificDayDutyByJkandDate( $id, $date ) {

            $query = $this->db->query(' (select (select sort_number from waaraSort where date = "'. $date .'" and duty_id = duty.duty_id) as sn, duty.name, duty.duty_id from duty, duty_jk, jk 
                    WHERE jk.id = ' . $id . '  AND 
                    duty.duty_id = duty_jk.duty_id AND

                    duty.duty_id  in (SELECT duty_id FROM `waara_global_template` ) AND
                    duty_jk.jk_id = jk.id AND
                    duty.isEnable = 1 AND
                    duty.Monday != DAYNAME("'. $date .'") And 
                    duty.Tuesday != DAYNAME("'. $date .'") And 
                    duty.Wednesday != DAYNAME("'. $date .'") And 
                    duty.Thursday != DAYNAME("'. $date .'") And 
                    duty.Friday != DAYNAME("'. $date .'") And 
                    duty.Saturday != DAYNAME("'. $date .'") And 
                    duty.Sunday != DAYNAME("'. $date .'") And
                    
                    duty.for_day =  "all"
                    
                    ) UNION (SELECT (select sort_number from waaraSort where date = "'. $date .'" and duty_id = duty.duty_id) as sn, duty.name, duty.duty_id 
                         FROM duty, duty_jk, jk WHERE jk.id = ' . $id . '  AND 
                         duty.duty_id = duty_jk.duty_id AND
                         duty_jk.jk_id = jk.id AND
                         duty.isEnable = 1 AND 
                                                 FIND_IN_SET( "' . $date . '" , duty.for_day) ) ORDER BY sn ');
//         $query = $this->db->query(' (SELECT waaraSort.sort_number as sn, duty.priority as unionsorting, duty.priority , duty.name, duty.duty_id 
//                         FROM duty, duty_jk, jk, waaraSort
//                         WHERE jk.id = ' . $id . '  AND 
//                         duty.duty_id = duty_jk.duty_id AND
//                                              duty.duty_id  IN (select duty_id from assign_duty where start_date = "'. $date .'" OR 
//                                              duty.duty_id  in (SELECT duty_id FROM `waara_global_template`) ) AND
//                         duty_jk.jk_id = jk.id AND
//                         duty.isEnable = 1 AND 
//                                              duty.duty_id = waaraSort.duty_id And
//                                              waaraSort.date = "'. $date .'" And
//                                              duty.Monday != DAYNAME("'. $date .'") And 
//                                              duty.Tuesday != DAYNAME("'. $date .'") And 
//                                              duty.Wednesday != DAYNAME("'. $date .'") And 
//                                              duty.Thursday != DAYNAME("'. $date .'") And 
//                                              duty.Friday != DAYNAME("'. $date .'") And 
//                                              duty.Saturday != DAYNAME("'. $date .'") And 
//                                              duty.Sunday != DAYNAME("'. $date .'") And 
//                                              duty.for_day =  "all")
                                                
            
//             UNION DISTINCT  (SELECT waaraSort.sort_number as sn, duty.priority as unionsorting, duty.priority , duty.name, duty.duty_id 
//                         FROM duty, duty_jk, jk, waaraSort
//                         WHERE jk.id = ' . $id . '  AND 
//                         duty.duty_id = duty_jk.duty_id AND
//                         duty_jk.jk_id = jk.id AND
//                         duty.isEnable = 1 AND 
//                                              FIND_IN_SET( "' . $date . '" , duty.for_day) And
//                                              waaraSort.date = "'. $date .'" And
//                                              duty.duty_id = waaraSort.duty_id
//                                              ) ORDER BY sn');

        
       
                
                $query->result();

        return $query->result();

    }  

    function getUsers($q){

       // $query = $this->db->query("SELECT * FROM user WHERE  CONCAT(first_name, ' ', last_name) LIKE '".$q."%'");
              $query = $this->db->query("SELECT * FROM user WHERE  first_name LIKE '%" . $q . "%'  OR  last_name LIKE '%" .$q. "%'");

            
        $query->result();

        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $name = $row['first_name'] . " " . $row['last_name'];
                $new_row['label']= $name;
                $new_row['value']=htmlentities(stripslashes($row['user_id']));
                $row_set[] = $new_row; //build an array
            }
            echo json_encode($row_set); //format the array into json data
        } else {
            $new_row['label']= 'No user found. Add it';
            $new_row['value']=htmlentities(stripslashes('NOUSER'));
            $row_set[] = $new_row; //build an array
            echo json_encode($row_set); //format the array into json data
        }
    }

    public function getJkById( $id ) {

        $this->db->select('*');
        $this->db->from('jk');
        $this->db->where('id', $id);
        $quary_result=$this->db->get();
        $result=$quary_result->result();

        return $result;        
    }


    public function getUserById( $id ) {
            
              $query = $this->db->query("SELECT *, (select age_group from age_group where id = u.age_group) as age  from user as u where user_id = " . $id );

        return $query->row();

    }

    /*
    SELECT customfields.field_lable, customfields.field_name, customfields.input_type
    FROM customfields, user_custom_data
    WHERE user_custom_data.customField_id = customfields.customField_id
    AND user_custom_data.user_id = 10   
    */
    public function getCustomFieldByUserId( $id ) {

        $query = $this->db->query('SELECT customfields.field_lable, customfields.field_name, customfields.input_type, user_custom_data.value
            FROM customfields, user_custom_data
            WHERE user_custom_data.customField_id = customfields.customField_id
            AND user_custom_data.user_id = ' . $id );

        $query->result();

        return $query->result();

    }
    /*
    * Get record from table using single condition
    */
    function getrecordById( $tableName, $whereParam1, $whereParam2  ) {

        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->where($whereParam1, $whereParam2 );
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;;
    }
   
    /*
    * Check record if already exists with same data or not 
    */
    function checkForExists( $tableName,$data  ) {

        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->where($data);
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        return $result;;
    }
    
    /*
    SELECT user.first_name, duty.name, assign_duty.start_date, assign_duty.reason
    FROM user, duty, assign_duty
    WHERE user.user_id = assign_duty.user_id 
    AND assign_duty.duty_id = duty.duty_id
    ANd user.user_id = 10 limit 10
    */
   function getUserHistory( $userId ) {

        $query = $this->db->query(
            'SELECT CONCAT( user.first_name," ", user.last_name ) as first_name, duty.name, assign_duty.start_date, assign_duty.reason
            FROM user, duty, assign_duty
            WHERE user.user_id = assign_duty.user_id 
            AND assign_duty.duty_id = duty.duty_id
            AND user.user_id =' . $userId . ' limit 10');

        $query->result();

        return $query->result();

   }
   function getUserHistoryLog( $userId ) {

        $query = $this->db->query(
            'SELECT user.first_name, duty.name, assign_duty_logs.start_date, assign_duty_logs.reason
            FROM user, duty, assign_duty_logs
            WHERE user.user_id = assign_duty_logs.user_id 
            AND assign_duty_logs.duty_id = duty.duty_id
            AND user.user_id =' . $userId );

        $query->result();

        return $query->result();

   }


   /*
            SELECT user.first_name 
            FROM user, assign_duty
            WHERE assign_duty.start_date='2016-05-01' 
            AND assign_duty.user_id = user.user_id
            AND assign_duty.duty_id = 17  
   */

   function getUserOfDutyByDate( $startDate, $dutyId ) {

         $query = $this->db->query(
            "SELECT user.user_id, user.first_name,user.last_name, assign_duty.assign_id,  IFNULL((select stars from rating where assign_duty_id =  assign_duty.assign_id order by date desc limit 1), 'not exists') as rating
            FROM user, assign_duty
            WHERE assign_duty.start_date= '" . $startDate .  "' 
            AND assign_duty.user_id = user.user_id
            AND assign_duty.duty_id =" . $dutyId );


        $query->result();

        return $query->result();

   }


    /*
    SELECT duty.name as dutyname, user.first_name, jk.name as jkname, assign_duty.start_date
    FROM duty, user, jk, assign_duty
    WHERE assign_duty.duty_id = duty.duty_id AND 
    assign_duty.jk_id = jk.id AND 
    assign_duty.user_id = user.user_id AND 
    assign_duty.start_date = '05-01-2016'
    */

   function getAssignDutyDetailByStartDate( $date ) {

        $query = $this->db->query(
        "SELECT duty.name as dutyname, user.first_name, jk.name as jkname, assign_duty.start_date, assign_duty.assign_id, assign_duty.shift
        FROM duty, user, jk, assign_duty
        WHERE assign_duty.duty_id = duty.duty_id AND 
        assign_duty.jk_id = jk.id AND 
        assign_duty.user_id = user.user_id AND 
        assign_duty.start_date = '" . $date . "' ");

        $query->result();

        return $query->result();

   }

   /*
    SELECT user.first_name 
    FROM user, assign_duty
    WHERE assign_duty.user_id = user.user_id 
    AND assign_duty.assign_id = '1'
   */

   function getUserByAssignedDuty( $id ) {

        $query = $this->db->query(
            "SELECT user.first_name, user.last_name, user.user_id
            FROM user, assign_duty
            WHERE assign_duty.user_id = user.user_id 
            AND assign_duty.assign_id = " . $id);

        $query->result();

        return $query->row();


   }

   //http://stackoverflow.com/questions/6333623/mysql-syntax-for-inserting-a-new-row-in-middle-rows
   function updateDutyByOrder( $priority, $name, $description, $day ) {

        $query = $this->db->query('UPDATE duty SET priority = priority + 1 WHERE priority >= ' . $priority . ' order by priority DESC;');

        $query = $this->db->query("INSERT INTO duty ( priority, name, description, for_day) VALUES ( ". $priority .", '". $name ."', '". $description ."', '". $day ."' )");

   }

   function updatePriority( $priority, $name, $description, $id ) {

        $query = $this->db->query('UPDATE duty SET priority = priority + 1 WHERE priority >= ' . $priority . ' order by priority DESC;');    

        $query = $this->db->query("UPDATE duty SET priority=". $priority ." ,name='". $name ."' ,description='". $description . "' WHERE duty_id=". $id );
   }
    
     //Sort dutys by home page using JS sortable
     function sortDuty( $priority, $id ) {

        $query = $this->db->query('UPDATE duty SET priority = priority + 1 WHERE priority >= ' . $priority . ' order by priority DESC;');    

        $query = $this->db->query("UPDATE duty SET priority=". $priority ." WHERE duty_id=". $id );
   }
    
         //Sort dutys by home page using JS sortable
     function sortDutyNumbers( $sort_number, $id, $date, $admin_id ) {

            $query = $this->db->query('UPDATE waaraSort SET sort_number = sort_number + 1 WHERE date = "'.$date.'" and sort_number >= ' . $sort_number . ' order by sort_number DESC;');

        $query = $this->db->query("INSERT INTO waaraSort ( sort_number, duty_id, date, priority, admin_id) VALUES ( ". $sort_number .", ". $id .", '". $date ."', (select priority from duty where duty_id = $id ) , $admin_id  )");

         
        //$query = $this->db->query('UPDATE duty SET sort_number = sort_number + 1 WHERE date = "'.$date.'" and sort_number >= ' . $sort_number . ' order by sort_number DESC;');    

        //$query = $this->db->query("UPDATE duty SET sort_number=". $sort_number ." WHERE date = '$date' and duty_id=". $id );
   }
         //Sort dutys by home page using JS sortable
     function globalSortDutyNumbers( $sort_number, $id, $date, $admin_id ) {

            $query = $this->db->query('UPDATE globalWaaraSort SET sort_number = sort_number + 1 WHERE date = "'.$date.'" and sort_number >= ' . $sort_number . ' order by sort_number DESC;');

        $query = $this->db->query("INSERT INTO globalWaaraSort ( sort_number, duty_id, date, priority, admin_id) VALUES ( ". $sort_number .", ". $id .", '". $date ."', (select priority from duty where duty_id = $id ) , $admin_id  )");

         
        //$query = $this->db->query('UPDATE duty SET sort_number = sort_number + 1 WHERE date = "'.$date.'" and sort_number >= ' . $sort_number . ' order by sort_number DESC;');    

        //$query = $this->db->query("UPDATE duty SET sort_number=". $sort_number ." WHERE date = '$date' and duty_id=". $id );
   }    

      public function getHighestSortNumber( $date ) {

              $query = $this->db->query("SELECT max(sort_number) as max_sort_number from waaraSort where date ='".$date."' limit 1");
        return $query->result();       
    }
    

      public function getHighestGlobalSortNumber( $date ) {

              //$query = $this->db->query("SELECT max(sort_number) as max_sort_number, date from globalWaaraSort order by date desc limit 1");
        $query = $this->db->query("SELECT max(sort_number) as max_sort_number, date from globalWaaraSort where date = (SELECT date from globalWaaraSort ORDER BY `date` DESC limit 1 ) order by date desc limit 1");

                return $query->result();       
    }   
         public function deleteDutyIfEnable( $table , $date, $duty_id ) {
            
                        $this->db->delete( $table , 
                                                            array( 'date' => $date,
                                                                         'duty_id' => $duty_id
                                                                     ) 
                                                         ); 
//                      $this->db->where_in('duty_id', '(select duty_id from duty where isEnable = 1)');
//                      $this->db->where('date', $date);
//                      $this->db->delete('waaraSort');
            // echo $query = $this->db->query("DELETE FROM `waaraSort` WHERE date = '$date' and duty_id in (select duty_id from duty where isEnable = 1)");
       // return $query->result();       
    }
    
    public function getAllfromTableOrderBy( $tableName, $field, $orderBy ) {

        $this->db->select('*');
        $this->db->from( $tableName );
        $this->db->order_by($field, $orderBy );
        $quary_result=$this->db->get();
        $result = $quary_result->result();
        return $result;        
    }
      public function getAllSortedUser( ) {
            
                    $query = $this->db->query("SELECT *, (select age_group from age_group where id = u.age_group) as age , (select colorCode from color where id = u.color_id) as color from user as u order by first_name asc");

       return $query->result();

        //return $query->row();
    }


    public function getRequest (){

        $query = $this->db->query('CALL get_request()');
        $query->result();

        return $query->result();


     }

    //genrate token for user verification
    public function generateToken($length = 15) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }   

    public function getWaaraFromdate ($date){
        
        $query = $this->db->query('CALL get_waara_info("'.$date.'")');
        $query->result();

        return $query->result();

    }
    public function getReportDetails ($duties , $start_date , $end_date){
        
        $ids = implode(',', $duties);
        $query = $this->db->query("select * from assign_duty where start_date >= '". $start_date . "' AND start_date <= '" . $end_date . "' AND duty_id IN (". $ids .") " );

        $query->result();

        return $query->result();

    }  

    public function getReportData ($start_date, $end_date, $duties){
        $ids = implode(',', $duties);
        // $query = $this->db->query("SELECT user.first_name, user.last_name, assign_duty.assign_id
        //                             FROM user
        //                             LEFT JOIN assign_duty
        //                             ON user.user_id=assign_duty.user_id AND assign_duty.start_date = '". $date ."'; ");
        $query = $this->db->query("select user_id, (select age_group from age_group where id = age_group) as age, ( SELECT phone FROM user where user.user_id = assign_duty.user_id) as phone, ( SELECT email FROM user where user.user_id = assign_duty.user_id) as email, ( SELECT CONCAT( user.first_name, ' ',user.last_name ) FROM user where user.user_id = assign_duty.user_id) as name , start_date from assign_duty where start_date >= '". $start_date . "' AND start_date <= '" . $end_date . "' AND duty_id IN (". $ids .")  ORDER BY `assign_duty`.`start_date` DESC" );
            //  die("select user_id, ( SELECT phone FROM user where user.user_id = assign_duty.user_id) as phone, ( SELECT email FROM user where user.user_id = assign_duty.user_id) as email, ( SELECT CONCAT( user.first_name, ' ',user.last_name ) FROM user where user.user_id = assign_duty.user_id) as name , start_date from assign_duty where start_date >= '". $start_date . "' AND start_date <= '" . $end_date . "' AND duty_id IN (". $ids .")  ORDER BY `assign_duty`.`start_date` DESC" );

                $query->result();
        return $query->result();
    } 
    
    public function getReportDataWithoutRange ($start_date, $end_date, $duties){
        $ids = implode(',', $duties);
        // $query = $this->db->query("SELECT user.first_name, user.last_name, assign_duty.assign_id
        //                             FROM user
        //                             LEFT JOIN assign_duty
        //                             ON user.user_id=assign_duty.user_id AND assign_duty.start_date = '". $date ."'; ");
        $query = $this->db->query("SELECT u.user_id, (select age_group from age_group where id = u.age_group) as age, ( SELECT email FROM user where user.user_id = u.user_id) as email, ( SELECT phone FROM user where user.user_id = u.user_id) as phone, (select start_date from assign_duty as a where user_id=u.user_id AND start_date >= '". $start_date . "' AND start_date <= '" . $end_date . "' AND duty_id IN (". $ids .") order by start_date DESC limit 1 ) as udate, CONCAT( u.first_name, ' ',u.last_name ) as name FROM user as u where u.user_id in (select user_id from assign_duty where start_date >= '". $start_date . "' AND start_date <= '" . $end_date . "' AND duty_id IN (". $ids .") ORDER BY `assign_duty`.`start_date` DESC )" );
            //  die("select user_id, ( SELECT phone FROM user where user.user_id = assign_duty.user_id) as phone, ( SELECT email FROM user where user.user_id = assign_duty.user_id) as email, ( SELECT CONCAT( user.first_name, ' ',user.last_name ) FROM user where user.user_id = assign_duty.user_id) as name , start_date from assign_duty where start_date >= '". $start_date . "' AND start_date <= '" . $end_date . "' AND duty_id IN (". $ids .")  ORDER BY `assign_duty`.`start_date` DESC" );

                $query->result();
        return $query->result();
    } 
    public function getUserDataWithoutWaara ($start_date, $end_date, $duties){
        $ids = implode(',', $duties);
        $query = $this->db->query("SELECT user_id, (select age_group from age_group where id = age_group) as age , CONCAT( user.first_name, ' ',user.last_name ) as name, email, phone from user where user_id NOT IN (select user_id from assign_duty where start_date >= '". $start_date . "' AND start_date <= '" . $end_date . "' AND duty_id IN (". $ids .") ) and user_id not in (SELECT user_id FROM `assign_duty`)" );
//        die("SELECT user_id, CONCAT( user.first_name, ' ',user.last_name ) as name, email, phone from user where user_id NOT IN (select user_id from assign_duty where start_date >= '". $start_date . "' AND start_date <= '" . $end_date . "' AND duty_id IN (". $ids .") ) and user_id not in (SELECT user_id FROM `assign_duty`)" );
                $query->result();
        return $query->result();
    } 

    
        public function getUserDataWithWaaraNotByDate($start_date, $end_date, $duties){
                $ids = implode(',', $duties);
                $query = $this->db->query("SELECT user_id , (select age_group from age_group where id = age_group) as age  from user where user_id NOT IN (SELECT user_id from user where user_id NOT IN (select user_id from assign_duty where start_date >= '". $start_date . "' AND start_date <= '" . $end_date . "' AND duty_id IN (". $ids .") ) and user_id not in (SELECT user_id FROM `assign_duty`))");
            //die("SELECT user_id from user where user_id NOT IN (SELECT user_id from user where user_id NOT IN (select user_id from assign_duty where start_date >= '". $start_date . "' AND start_date <= '" . $end_date . "' AND duty_id IN (". $ids .") ) and user_id not in (SELECT user_id FROM `assign_duty`))");
                $query->result();
        return $query->result();
        }
    
    function getReportById( $id ) {

        $this->db->select('*');
        $this->db->from('report');
        $this->db->where('id', $id );
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;;
    }
    public function getWaarabyIds( $duties ) {

        
        $query = $this->db->query("select * from duty where duty_id IN (". $duties .")");
        $query->result();
        return $query->result();
    } 

    function checkAssignWaara( $duty, $date ) {

        
        $query = $this->db->query("select * from assign_duty where duty_id = ". $duty ." AND start_date = '". $date . "'");
        $query->result();
        return $query->result();
    }        

    function getWaaraExcludebyIds( $duties ) {

        
        $query = $this->db->query("select * from duty where duty_id Not IN (". $duties .")");
        $query->result();
        return $query->result();
    } 


    public function waaraNotificationEmail($user_id, $jk_id, $duty_id, $date, $content ){

        $user = $this->getUserById($user_id);
        $jk = $this->getJkById($jk_id);
        $duty = $this->getWaarabyIds($duty_id);

        $name = $user->first_name . " " . $user->last_name;
        $jk_name = $jk[0]->name;
        $duty_name = $duty[0]->name;
        $user_email = $user->email;

        $message = str_ireplace("USER-FULLNAME",$name ,$content);
        $message = str_ireplace("JK-NAME",$jk_name ,$message);
        $message = str_ireplace("WAARA-NAME",$duty_name ,$message);
        $message = str_ireplace("ASSIGN-DATE",$date ,$message);
      
      
        //$message = "Ya Ali madat $name \r\n\r\nYou have been registered for $duty_name on $date at $jk_name Should you wish to change the waara assigned to you or are unable to attend, please reply to this email \r\nThank you  \r\n$jk_name  waara team";
        $emailNotification = $this->getEmailNotification();
        if($emailNotification[0]->notification == 'true'){
           mail($user_email, 'Waara Notification', $message);
        }
       

    }
    public function getLastInserted() {
        return $this->db->insert_id();
    }

    public function getAssignUserData( $id ) {

        $query = $this->db->query(
            "SELECT *
            FROM  assign_duty
            WHERE assign_id = " . $id);

        $query->result();

        return $query->row();


   } 
   public function getEmailNotification( ){
      
        $query = $this->db->query('SELECT * from emailNotification ORDER BY id DESC LIMIT 1');
        
        $query->result();

        return $query->result();
    }
       public function getDisableUserCount(){
      
        $query = $this->db->query('SELECT count(user_id) as users from user where status != "false"');
        
        $query->result();

        return $query->result();
    }
    
  public function getDutyDetails( $name ) {

//         $this->db->select('*');
//         $this->db->from( 'duty' );
//         $this->db->like('LOWER(name)', strtolower($name));
//              $this->db->where('LENGTH(name)=','LENGTH('.$name.')');

//         $quary_result=$this->db->get();
                  $query = "SELECT * from duty where LENGTH(name) = length('$name') and  LOWER(name) LIKE LOWER('%$name%')";

                    $query = $this->db->query($query);      
                    return $query->result();
//              $result = $quary_result->result();
//       return $result;        
    }   
    public function getRating($user_id, $date, $title){
        $query = "SELECT *, ( select  CONCAT( first_name, '  ' , last_name )  from user where user_id = r.admin_id ) as admin_name  FROM `rating` as r  where `assign_duty_id` = (SELECT `assign_id` FROM `assign_duty` where `user_id` = $user_id and `start_date` = '$date' and `duty_id` = (SELECT `duty_id` FROM `duty` where `name` LIKE '%$title%' ))";
        $query = $this->db->query($query);


        return $query->result();
    }
    public function getAllSamarMayat(){
        $query = "SELECT *, (select name from jk where id = sm.jk_id) as jkName from samarMayat as sm ";
        $query = $this->db->query($query);


        return $query->result();
    }
    public function getAllSamar(){
        $query = "SELECT *, (select name from jk where id = s.jk_id) as jkName from Samar as s ";
        $query = $this->db->query($query);


        return $query->result();
    }   
    
    public function getAllSamarMayatByType($type){
        $date = date('Y-m-d');
        if($type == 'samar'){
                $query = "SELECT *, (select name from jk where id = sm.jk_id) as jkName from Samar as sm where status = 'approved' and type = '".$type."' and sm.on >= '".$date."'";
        } else {
                $query = "SELECT *, (select name from jk where id = sm.jk_id) as jkName from samarMayat as sm where status = 'approved' and type = '".$type."' and funeral_date >= '".$date."'";

        }
        $query = $this->db->query($query);


        return $query->result();
    }   
    
  function getWaaraidByPriority( $priority ) {

        $this->db->select('duty_id');
        $this->db->from('duty');
        $this->db->where('priority', $priority );
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;;
    }   
  function getWaaraSortNumber( $duty_id, $date ) {

        $this->db->select('sort_number');
        $this->db->from('waaraSort');
        $this->db->where('duty_id', $duty_id );
                $this->db->where('date', $date );
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;;
    }
  function getGlobalSortNumber( $duty_id ) {

            $query = $this->db->query('SELECT sort_number, date from globalWaaraSort where duty_id = '.$duty_id.' ORDER BY date DESC LIMIT 1');
        
        $query->result();

        return $query->result();
    }   
    
  function getMayatById( $id ) {

        $this->db->select('*');
        $this->db->from('samarMayat');
        $this->db->where('id', $id );
        $quary_result=$this->db->get();
        $result=$quary_result->row();
        
        return $result;;
    }   
    function getUrlByType ($type){
        
            $query = $this->db->query('SELECT * from samarMayatURL where type = "'.$type.'" ORDER BY id DESC LIMIT 1');
        
        $query->result();

        return $query->result();
    }
    
        
    function getMayatTableHeaders($type){
        
            $query = $this->db->query('SELECT * from samarMayatTableHide where type = "'.$type.'" ORDER BY id DESC LIMIT 1');
        
        $query->result();

        return $query->result();        
    }
    function getUsersByWaaraDays($date){
        
            $query = $this->db->query("select *, (select age_group from age_group where id = u.age_group) as age , IFNULL( (datediff('$date', (SELECT start_date FROM `assign_duty` WHERE user_id = u.user_id ORDER by start_date desc limit 1) ) ), '0' ) as daysCount from user as u where user_id = (SELECT user_id FROM `assign_duty` WHERE user_id = u.user_id ORDER by start_date desc limit 1)");
        
        $query->result();

        return $query->result();        
    }   
    function getTableData($type, $name){
        
            $query = $this->db->query('SELECT * from  `tableSettingsData` where type = "'.$type.'" and controller_name = "'.$name.'" ORDER BY id DESC LIMIT 1');
        
        $query->result();

        return $query->result();        
    }
    function getGlobalDuty(){
        
            $query = $this->db->query('SELECT * from  `duty` where duty_id not in (select duty_id from waara_global_template) and  FIND_IN_SET( "all" ,for_day)  ');
        
        $query->result();

        return $query->result();        
    }
    function getDutyPriority($id){
        
            $query = $this->db->query('SELECT * from  `duty` where duty_id ='.$id);
        
        $query->result();

        return $query->result();        
    }   
    
}