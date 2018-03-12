<script >



var events =  <?php  echo json_encode( $data['events']); ?> ;
    $.getScript('http://waaranet.ca/includes/plugins/fullcalendar/1.6.4/fullcalendar.min.js',function(){

  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();


function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

  document.getElementById('selectedDate').innerHTML = 'Selected Date is ' + formatDate(new Date());        
  document.getElementById('selectDate').value = formatDate(new Date());

  $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek'
            },events: events,

            defaultView: 'basicWeek',
        dayClick: function(date, allDay, jsEvent, view) {

        var formatedDate = formatDate(date);

        document.getElementById('selectedDate').innerHTML = 'Selected Date is ' + formatedDate;

        $('#selectdate').val( formatedDate );
                document.getElementById('selectDate').value = formatedDate;
        ajaxCallDuty();
                

    }
  });

})
    

    setTimeout(function(){

        $( ".fc-button-month" ).after( "<br>" );

}, 2000);
    
</script>
<style type="text/css">
    @media only screen and (max-width: 576px) {
        #duty{
                position: relative; 
                overflow-x: scroll;
        }


    } 

    .fc {
    direction: ltr;
    text-align: left;
    }
    
.fc-state-highlight {background:red;}   

.fc table {
    border-collapse: collapse;
    border-spacing: 0;
    }
    
html .fc,
.fc table {
    font-size: 1em;
    }
    
.fc td,
.fc th {
    padding: 0;
    vertical-align: top;
    }



/* Header
------------------------------------------------------------------------*/

.fc-header td {
    white-space: nowrap;
    }

.fc-header-left {
    width: 20%;
    text-align: left;
    }
    
.fc-header-center {
    text-align: center;
    }
    
.fc-header-right {
    width: 20%;
    text-align: right;
    }
    
.fc-header-title {
    display: inline-block;
    vertical-align: top;
    }
    
.fc-header-title h2 {
    margin-top: 0;
    white-space: nowrap;
    }
    
.fc .fc-header-space {
    padding-left: 10px;
    }
    
.fc-header .fc-button {
    margin-bottom: 1em;
    vertical-align: top;
    }
    
/* buttons edges butting together */

.fc-header .fc-button {
    margin-right: -7px;
    }
    
.fc-header .fc-corner-right,  /* non-theme */
.fc-header .ui-corner-right { /* theme */
    padding-left: 15px;
    margin-right: -6px; /* back to normal */
    }
    
/* button layering (for border precedence) */
    
.fc-header .fc-state-hover,
.fc-header .ui-state-hover {
    z-index: 2;
    }
    
.fc-header .fc-state-down {
    z-index: 3;
    }

.fc-header .fc-state-active,
.fc-header .ui-state-active {
    z-index: 4;
    }
    
    
    
/* Content
------------------------------------------------------------------------*/
    
.fc-content {
    clear: both;
    zoom: 1; /* for IE7, gives accurate coordinates for [un]freezeContentHeight */
    }
    
.fc-view {
    width: 100%;
    overflow: hidden;
    }
    
    

/* Cell Styles
------------------------------------------------------------------------*/

.fc-widget-header,    /* <th>, usually */
.fc-widget-content {  /* <td>, usually */
    border: 1px solid #ddd;
    }
    
.fc-state-highlight { /* <td> today cell */ /* TODO: add .fc-today to <th> */
    background: #fcfcfc;
    }
    
.fc-cell-overlay { /* semi-transparent rectangle while dragging */
    background: #bcccbc;
    opacity: .3;
    filter: alpha(opacity=30); /* for IE */
    }
    


/* Buttons
------------------------------------------------------------------------*/

.fc-button {
    position: relative;
    display: inline-block;
    padding: 0 .6em;
    overflow: hidden;
    height: 1.9em;
    line-height: 1.9em;
    white-space: nowrap;
    cursor: pointer;
}


.fc-text-arrow {
    margin: 0 .1em;
    font-size: 2em;
    font-family: "Courier New", Courier, monospace;
    vertical-align: baseline; /* for IE7 */
    }


    
/*
  button states
  borrowed from twitter bootstrap (http://twitter.github.com/bootstrap/)
*/

.fc-state-default {
    background-color: #f5f5f5;
    }

.fc-state-hover,
.fc-state-down,
.fc-state-active,
.fc-state-disabled {
    color: #333333;
    background-color: #e6e6e6;
    }

.fc-state-hover {
    color: #333333;
    text-decoration: none;
    background-position: 0 -15px;
    -webkit-transition: background-position 0.1s linear;
       -moz-transition: background-position 0.1s linear;
         -o-transition: background-position 0.1s linear;
            transition: background-position 0.1s linear;
    }

.fc-state-down,
.fc-state-active {
    background-color: #cccccc;
    background-image: none;
    outline: 0;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
    }

.fc-state-disabled {
    cursor: default;
    background-image: none;
    opacity: 0.55;
    filter: alpha(opacity=65);
    box-shadow: none;
    }

    

/* Global Event Styles
------------------------------------------------------------------------*/

.fc-event-container > * {
    z-index: 8;
    }

.fc-event-container > .ui-draggable-dragging,
.fc-event-container > .ui-resizable-resizing {
    z-index: 9;
    }
     
.fc-event {
    border: 1px solid #3a87ad; /* default BORDER color */
    background-color: #3a87ad; /* default BACKGROUND color */
    color: #fff;               /* default TEXT color */
    font-size: .85em;
    cursor: default;
    }

a.fc-event {
    text-decoration: none;
    }
    
a.fc-event,
.fc-event-draggable {
    cursor: pointer;
    }
    
.fc-rtl .fc-event {
    text-align: right;
    }

.fc-event-inner {
    width: 100%;
    height: 100%;
    overflow: hidden;
    }
    
.fc-event-time,
.fc-event-title {
    padding: 0 1px;
    }
    
.fc .ui-resizable-handle {
    display: block;
    position: absolute;
    z-index: 99999;
    overflow: hidden; /* hacky spaces (IE6/7) */
    font-size: 300%;  /* */
    line-height: 50%; /* */
    }
    
    
    
/* Horizontal Events
------------------------------------------------------------------------*/

.fc-event-hori {
    border-width: 1px 0;
    margin-bottom: 1px;
    }

.fc-ltr .fc-event-hori.fc-event-start,
.fc-rtl .fc-event-hori.fc-event-end {
    border-left-width: 1px;
    }

.fc-ltr .fc-event-hori.fc-event-end,
.fc-rtl .fc-event-hori.fc-event-start {
    border-right-width: 1px;
    }
    
/* resizable */
    
.fc-event-hori .ui-resizable-e {
    top: 0           !important; /* importants override pre jquery ui 1.7 styles */
    right: -3px      !important;
    width: 7px       !important;
    height: 100%     !important;
    cursor: e-resize;
    }
    
.fc-event-hori .ui-resizable-w {
    top: 0           !important;
    left: -3px       !important;
    width: 7px       !important;
    height: 100%     !important;
    cursor: w-resize;
    }
    
.fc-event-hori .ui-resizable-handle {
    _padding-bottom: 14px; /* IE6 had 0 height */
    }
    

table.fc-border-separate {
    border-collapse: separate;
    }
    
.fc-border-separate th,
.fc-border-separate td {
    border-width: 1px 0 0 1px;
    }
    
.fc-border-separate th.fc-last,
.fc-border-separate td.fc-last {
    border-right-width: 1px;
    }
    
.fc-border-separate tr.fc-last th,
.fc-border-separate tr.fc-last td {
    border-bottom-width: 1px;
    }
    
.fc-border-separate tbody tr.fc-first td,
.fc-border-separate tbody tr.fc-first th {
    border-top-width: 0;
    }
    
    

/* Month View, Basic Week View, Basic Day View
------------------------------------------------------------------------*/

.fc-grid th {
    text-align: center;
    }

.fc .fc-week-number {
    width: 22px;
    text-align: center;
    }

.fc .fc-week-number div {
    padding: 0 2px;
    }
    
.fc-grid .fc-day-number {
    float: right;
    padding: 0 2px;
    }
    
.fc-grid .fc-other-month .fc-day-number {
    opacity: 0.3;
    filter: alpha(opacity=30); /* for IE */
    /* opacity with small font can sometimes look too faded
       might want to set the 'color' property instead
       making day-numbers bold also fixes the problem */
    }
    
.fc-grid .fc-day-content {
    clear: both;
    padding: 2px 2px 1px; /* distance between events and day edges */
    }
    
/* event styles */
    
.fc-grid .fc-event-time {
    font-weight: bold;
    }
    
/* right-to-left */
    
.fc-rtl .fc-grid .fc-day-number {
    float: left;
    }
    
.fc-rtl .fc-grid .fc-event-time {
    float: right;
    }
    
    

/* Agenda Week View, Agenda Day View
------------------------------------------------------------------------*/

.fc-agenda table {
    border-collapse: separate;
    }
    
.fc-agenda-days th {
    text-align: center;
    }
    
.fc-agenda .fc-agenda-axis {
    width: 50px;
    padding: 0 4px;
    vertical-align: middle;
    text-align: right;
    white-space: nowrap;
    font-weight: normal;
    }

.fc-agenda .fc-week-number {
    font-weight: bold;
    }
    
.fc-agenda .fc-day-content {
    padding: 2px 2px 1px;
    }
    
/* make axis border take precedence */
    
.fc-agenda-days .fc-agenda-axis {
    border-right-width: 1px;
    }
    
.fc-agenda-days .fc-col0 {
    border-left-width: 0;
    }
    
/* all-day area */
    
.fc-agenda-allday th {
    border-width: 0 1px;
    }
    
.fc-agenda-allday .fc-day-content {
    min-height: 34px; /* TODO: doesnt work well in quirksmode */
    _height: 34px;
    }
    
/* divider (between all-day and slots) */
    
.fc-agenda-divider-inner {
    height: 2px;
    overflow: hidden;
    }
    
.fc-widget-header .fc-agenda-divider-inner {
    background: #eee;
    }
    
/* slot rows */
    
.fc-agenda-slots th {
    border-width: 1px 1px 0;
    }
    
.fc-agenda-slots td {
    border-width: 1px 0 0;
    background: none;
    }
    
.fc-agenda-slots td div {
    height: 20px;
    }
    
.fc-agenda-slots tr.fc-slot0 th,
.fc-agenda-slots tr.fc-slot0 td {
    border-top-width: 0;
    }

.fc-agenda-slots tr.fc-minor th,
.fc-agenda-slots tr.fc-minor td {
    border-top-style: dotted;
    }
    
.fc-agenda-slots tr.fc-minor th.ui-widget-header {
    *border-top-style: solid; /* doesn't work with background in IE6/7 */
    }
    


/* Vertical Events
------------------------------------------------------------------------*/

.fc-event-vert {
    border-width: 0 1px;
    }

.fc-event-vert.fc-event-start {
    border-top-width: 1px;
    }

.fc-event-vert.fc-event-end {
    border-bottom-width: 1px;
    }
    
.fc-event-vert .fc-event-time {
    white-space: nowrap;
    font-size: 10px;
    }

.fc-event-vert .fc-event-inner {
    position: relative;
    z-index: 2;
    }
    
.fc-event-vert .fc-event-bg { /* makes the event lighter w/ a semi-transparent overlay  */
    position: absolute;
    z-index: 1;
    top: 0;
    left: 0;
    width: 80%;
    height: 100%;
    background: #fff;
    opacity: .25;
    filter: alpha(opacity=25);
    }
    
.fc .ui-draggable-dragging .fc-event-bg, /* TODO: something nicer like .fc-opacity */
.fc-select-helper .fc-event-bg {
    display: none\9; /* for IE6/7/8. nested opacity filters while dragging don't work */
    }
    
/* resizable */
    
.fc-event-vert .ui-resizable-s {
    bottom: 0        !important; /* importants override pre jquery ui 1.7 styles */
    width: 100%      !important;
    height: 8px      !important;
    overflow: hidden !important;
    line-height: 8px !important;
    font-size: 11px  !important;
    font-family: monospace;
    text-align: center;
    cursor: s-resize;
    }
    
    

</style>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small >Control panel</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Assign Multiple Waara</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">


            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Assign Multiple Waara</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('admin/addDuty') ?>" method="post" >
                            <div class="box-body">
                                                            <div class="col-sm-6">
                                                                
                                                                    <div style="text-align: right;" class="col-sm-4">
                                    <label > Select JK: </label>
                                                                    </div>
                                                                    <div class="col-sm-3">

                                    <select  class="form-control" name="jk" id="selectJK">
                                                                        <?php
                                                                                foreach($data['jk'] as $jk) {
                                                                                    
                                                                                        echo '<option value="'. $jk->id .'"> '. $jk->name .' </option>';
                                                                                }
                                                        
                                     ?>   
                                                                        </select>
                                                                    </div>
                                                                
                                                                </div>
                                                            <div for="" class="col-sm-6 "><h3 id="selectedDate" class="box-title"> Selected Date is : </h3></div>
                                                            </div>

                                                             <div class="col-sm-6">
                                                                 <div id="calendar"></div>
                                                            

                                                                

                                    <input type='hidden' class="form-control" id='selectDate' name="selectDate" />

                                                                

                             
                      
                            </div>
                                                     <div class="col-sm-6">
                                     </br>
                                        <!--Dynamicly duty table added  -->
                                        <div id="duty" name="duty" >

                                        </div>
                                    </div><!-- /.box-body -->
                            <div class="box-footer">




                            
                             


                            </div><!-- /.box-body -->
                                            <div class="col-sm-12">    
                                            <button class="btn btn-primary" style="display:none;" id="assignWaaraButton" onclick="assignWaara()">
                            Assign All Waara
                          </button>
                                            </div>
                            <div class="box-footer">
                                
                            </div><!-- /.box-footer -->
                    </div><!-- /.box -->

                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
                </div>

            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div>
</div>
<div role="dialog" class="modal fade in" id="modal-addNewUser" style="padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add New User</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <input type="hidden" name="waara_id" class="form-control" id="waara_id" placeholder=""  >
                    <input type="hidden" name="assign_date" class="form-control" id="assign_date" placeholder=""  >
                    
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">First Name</label>
                        <div class="col-sm-6">
                            <input style="text-transform:capitalize;" type="text" name="firstName" class="form-control" id="firstName" placeholder=""  required>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">Last Name</label>
                        <div class="col-sm-6">
                            <input style="text-transform:capitalize;" type="text" name="lastName" class="form-control" id="lastName" placeholder=""  required>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-6">
                            <input type="email" name="email" class="form-control" id="email" placeholder="" >
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">Phone</label>
                        <div class="col-sm-6">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="" required>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">Age Group</label>
                        <div class="col-sm-6">
                            <select name="age_group" class="form-control" id="age_group">
                                <?php foreach($data['ageGroup'] as $item) { ?>
                                <option  value="<?php echo $item->id ; ?>" > <?php echo $item->age_group ; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-6">
                            <input type="text" name="password" class="form-control" id="password" placeholder="" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="saveUser()" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<script>

    
function ajaxCallDuty() {

   var state= $('#selectJK').val();


var date = $('#selectDate').val();

    $.ajax({
        url: "<?php echo site_url('Admin/ajaxGetMultipleAssignDutyFromJk') ?>",
        type: "POST",
        data: {
            'state' : state,
            'date' : date
        },
        success: function(response){
                        
            $('#duty').html(response);
                        $('#assignWaaraButton').show();
            $("[name=users]").autocomplete({

                source : '<?php echo site_url('admin/getUsers') ?>',
                                minLength:2,
                select: function(event, ui) {

                    if(ui.item.value == 'NOUSER') {
                        $('#modal-addNewUser').modal('toggle');
                        waaraData.push(this.id);
                        createCookie("input_id",  this.id , 1 );
                       
                    }

                    event.preventDefault();
                    $('#' + this.id).val(ui.item.label);
                                        var userid = this.id.split("_");
                                        $('#userid_' +userid[1] ).val(ui.item.value);
                                        waaraData.push(this.id);
                },
                focus: function(event, ui) {
                    event.preventDefault();
                    $('#' + this.id).val(ui.item.label);
                }
            });


        },
        error: function(err){
            
        }
    });


}
var getCookie = function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}    
    var waaraData = [];
function getUserName(arg) {

var id = arg.getAttribute('id');

var waara = id.split("_");
waara = 'waara_' + waara[1];
var waara_id = $('#' + waara).val();
var date = $('#date').val();
    
var d = new Date();
d.setTime(d.getTime() + (24*60*60*1000));
var expires =  d.toUTCString();

var value = $('#' + id).val();
var name = value.split(" ");
    $('#firstName').val(name[0]);
    $('#lastName').val(name[1]);
    $('#waara_id').val(waara_id);
    $('#assign_date').val(date);
//  createCookie("first_name",  name[0] , 1 );
//  createCookie("last_name",  name[1] , 1 );
//  createCookie("waara_id", waara_id , 1 );
//  createCookie("date", date , 1 );
    

}
    function assignWaara(){


            for(var i = 0; i < waaraData.length; i++){

                var id = waaraData[i].split("_");
                var waara_id = 'waara_' + id[1];
                var user_id = 'userid_' + id[1];

                waara_id =  $('#'+waara_id).val();
                user_id =  $('#'+user_id).val();
                
                var date = $('#selectDate').val();
                var state = $('#selectJK').val();;

                $.ajax({
            url: "<?php echo site_url('Admin/assign_multiple_duty') ?>",
            type: "POST",
            data: {
            'jk' : state,
            'startDate' : date,
                        'endDate' : date,
                        'duty' : waara_id,
                        'userid' : user_id
                        
            },
            success: function(response){
                    },
                    error: function( err ){
                    }
                    
        });
        }
            alert("All Waara Assigned Successfully");
            //location.reload();
            ajaxCallDuty();
  }
function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}
var saveUser = function saveUser() {
    var firstName = $('#firstName').val();
    var lastName = $('#lastName').val();
    var waara_id = $('#waara_id').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var password = $('#password').val();
    var age_group = $('#age_group').val();

        $.ajax({
            url: "<?php echo site_url('Admin/saveUser') ?>",
            type: "POST",
            data: {
                'firstName' : firstName,
                'lastName' : lastName,
                'email' : email,
                'phone' : phone,
                'password' : password,
                'age_group' : age_group
                
            },
            success: function(response){
               var id = getCookie('input_id');
               var userid = id.split("_");
             
               $('#users_' + userid[1]).val(firstName + " " +  lastName);
               $('#userid_' + userid[1]).val(response);

               $('#email').val("");
               $('#phone').val("");
               $('#password').val("");
               $('#age_group').val("");                
               $('#modal-addNewUser').modal('hide');
               
            },
            error: function( err ){
                console.log(err)
            }
                    
        });    
}
setTimeout(function(){  ajaxCallDuty(); }, 1000);



</script>

