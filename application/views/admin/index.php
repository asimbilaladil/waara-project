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
  document.getElementById('selectedMajalisDate').innerHTML = 'Selected Date is ' + formatDate(new Date());        
  document.getElementById('date').value = formatDate(new Date());
  document.getElementById('majalisDate').value = formatDate(new Date());

  $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek'
            },events: events,
//      events:  [
//         {
//             title  : 'event1',
//             start  : '2017-01-01',
//           end    : '2017-01-01'
//         },{
//             title  : 'event2',
//             start  : '2017-01-01',
//           end    : '2017-01-01'
//         },{
//             title  : 'event3',
//             start  : '2017-01-01',
//           end    : '2017-01-01'
//         },{
//             title  : 'event4',
//             start  : '2017-01-01',
//           end    : '2017-01-01'
//         },{
//             title  : 'event5',
//             start  : '2017-01-01',
//           end    : '2017-01-01'
//         },{
//             title  : 'event6',
//             start  : '2017-01-01',
//           end    : '2017-01-01'
//         }
//    ],
            defaultView: 'basicWeek',
          eventClick: function (calEvent, jsEvent, view) {

                            var formatedDate = formatDate(calEvent.start);

                            document.getElementById('selectedDate').innerHTML = 'Selected Date is ' + formatedDate;

                            document.getElementById('selectedMajalisDate').innerHTML = 'Selected Date is ' + formatedDate;

                            $('#date').val( formatedDate );

                            $('#majalisDate').val( formatedDate );

                            ajaxCallDuty();

                            ajaxGetMajalisDuties();


        },
        dayClick: function(date, allDay, jsEvent, view) {

        var formatedDate = formatDate(date);

        document.getElementById('selectedDate').innerHTML = 'Selected Date is ' + formatedDate;
        document.getElementById('selectedMajalisDate').innerHTML = 'Selected Date is ' + formatedDate;

        $('#date').val( formatedDate );

        $('#majalisDate').val( formatedDate );

        ajaxCallDuty();

        ajaxGetMajalisDuties();


    }
  });

})
function getBody(element) {
    var divider = 2;
    var originalTable = element.clone();
    var tds = $(originalTable).children('tbody').children('tr').children('td').length;
    return tds;
}
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
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.3/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.3/js/star-rating.js" type="text/javascript"></script> -->
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

                                                  <li id="selectJKList">  <select required name="jkselect" id="jk" onchange="ajaxCallDuty()"  id="jk" class="form-control">
                                                    <?php
                                                        foreach($data['jk'] as $jk) {
                                                            echo '<option value="'. $jk->id .'"> '. $jk->name .' </option>';
                                                        }
                                                        
                                                    ?>   
                                                    </select >
                                                    </li>
                           
                  <li id="selectJKList">  
                  <?php
                    if(isset($data['type']) && $data['type'] == 'Super Admin' ) {
                        echo '
                          <select name="shift" id="shift" class="form-control">
                                <option value="1">Evening</option>
                                <option value="2">Morning</option>

                          </select >
                        ';

                    }
                  ?>


                    </li> 
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
                </br>
                 </br>
            </section>
            <!-- Main content -->
            <section class="content">
                            <?php if($data['user_count'][0]->users != 0) { ?>
                            <div class="row">
                                <div style="padding: 20px 30px;background: #dd4b39;z-index: 999999;font-size: 16px;font-weight: 600;">
                                    
                                    <a href="https://themequarry.com" style="color: rgba(255, 255, 255, 0.9); display: inline-block; margin-right: 7px; text-decoration: none;">
                                        New Notification ! There are total <?php echo $data['user_count'][0]->users; ?> new users signup. Waiting for your approval.</a>
                                    <a class="btn btn-default btn-sm" href="<?php echo site_url('Admin/user') ?>" style="margin-top: -5px; border: 0px; box-shadow: none; color: rgb(243, 156, 18); font-weight: 600; background: rgb(255, 255, 255);">
                                        Let's Do It!</a>
                                </div>
                            </div>
                            <?php  } ?>
                            <br>
                                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title">ASSIGNED WAARA</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                
                                    <div class="box-body">
                                                                            <div>
                                                                                <p>
                                                                                    Default <button   style="opacity: 1; background-color:#3a87ad; width: 3%; height: 15px;"></button>
                                                                                  <?php foreach($data['color'] as $item) { ?>
                                                                                <?php echo $item->username; ?> <button   style="opacity: 1; background-color:<?php echo $item->colorCode; ?>; width: 3%; height: 15px;"></button>
                                                                                
                                                                                <?php } ?>
                                                                            </p>
                                                                            </div>
                                      <div id="calendar"></div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                    </div>
                                    <!-- /.box-footer -->
                                
                            </div>
                            <!-- /.box -->
                        </div>
                        <div class="col-md-6 regularWaaraBox" style="display:none;">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    
                                    <div for="" class="col-sm-4 "><h3 class="box-title">REGULAR WAARA</h3></div>
                                    <div for="" class="col-sm-8 "><h3 id="selectedDate" class="box-title"> Selected Date is : </h3></div>


                                </div>
                                                            <div class="col-sm-12" style="top: 20px;">
                                                                <div class="col-sm-3" >
                                                                </div>
                                                                <div class="col-sm-6" >
                                                                    <button class="btn btn-primary btn-block " onclick="addDutyForDay()">Add Waara</button>
                                                                </div>
                                                            </div>
                 
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div>
                                    <form id="defaultForm" action="<?php echo site_url('Admin/index') ?>" method="post" >
                                        
                                        <div class="col-sm-12">
                                     </br>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <input type="hidden" name="selectedShift" id="selectedShift">
                                                <input type="hidden" name="selectedUser" id="selectedUser"/>
                                                <input type="hidden" name="selectedDuty" id="selectedDuty"/>
                                                <input type="hidden" id="jkId" name="jk">
                                                <input type="hidden" id="date" name="date"  />                                                
                                            </div>
                                        </div>

                                    </div>
                                   
                                    <div class="col-sm-12">
                                     </br>
                                        <!--Dynamicly duty table added  -->
                                        <div id="duty" name="duty" >

                                        </div>
                                    </div>


                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">User History</h4>
                                              </div>
                                              <div class="modal-body">
                                                <div id="userHistory">

                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#confirmModal" >Save</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>



                                        <!-- Modal -->
                                        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">How do you want to notify user?</h4>
                                              </div>
                                              <div class="modal-body">

                                                <label class="checkbox-inline"><input id="byEmail" name="byEmail" value="email" type="checkbox" value="">By Email</label>
                                                <label class="checkbox-inline"><input id="bySms" name="bySms" value="sms" type="checkbox" value="">By Message</label>
                                                

                                              </div>
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>



                                        <!-- Modal -->
                                        <div class="modal fade" id="preferences" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Alert</h4>
                                              </div>
                                              <div class="modal-body">

                                              <p> Preferences does not match </p>

                                              </div>
                                              
                                            </div>
                                          </div>
                                        </div>

                                       
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                </div>
                                <!-- /.box-footer -->
                            </div>
                            <!-- /.box -->
                        </div>

                    </form>


                        <!-- MAJALIS START -->
                        <div class="col-md-6 majalisBox"  style="display:none;">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    
                                    <div for="" class="col-sm-4 "><h3 class="box-title">list of Majalis</h3></div>
                                    <div for="" class="col-sm-8 "><h3 id="selectedMajalisDate" class="box-title"> Selected Date is : </h3></div>

                                </div>

                                    <div class="col-sm-12" style="top: 20px;">
                                        <div class="col-sm-3" >
                                        </div>
                                        <div class="col-sm-6" >
                                            <button class="btn btn-primary btn-block " onclick="addDutyForDay()">Add Waara</button>
                                        </div>
                                    </div>
                 
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div>
                                    <form action="<?php echo site_url('AdminMajalis/assignDuty') ?>" method="post" >
                                        
                                        <div class="col-sm-12">
                                     </br>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6">

                                                <input type="hidden" name="selectedMajalisUser" id="selectedMajalisUser"/>
                                                <input type="hidden" name="selectedMajalisDuty" id="selectedMajalisDuty"/>
                                                <input type="hidden" id="majalisDate" name="majalisDate"  />                                               
                                            </div>
                                        </div>

                                    </div>
                                   
                                    <div class="col-sm-12">
                                     </br>
                                        <!--Dynamicly duty table added  -->
                                        <div id="majalisDuty" name="majalisDuty" >

                                        </div>
                                    </div>


                                        <!-- Modal -->
                                        <div class="modal fade" id="majalisUserHistoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Majalis User History</h4>
                                              </div>
                                              <div class="modal-body">
                                                <div id="userHistoryForMajalis">

                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                    </form>

                                        <!-- Modal -->
<!--                                         <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">How do you want to notify user?</h4>
                                              </div>
                                              <div class="modal-body">

                                                <label class="checkbox-inline"><input id="byEmail" name="byEmail" value="email" type="checkbox" value="">By Email</label>
                                                <label class="checkbox-inline"><input id="bySms" name="bySms" value="sms" type="checkbox" value="">By Message</label>
                                                

                                              </div>
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div> -->



                                        <!-- Modal -->
<!--                                         <div class="modal fade" id="preferences" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Alert</h4>
                                              </div>
                                              <div class="modal-body">

                                              <p> Preferences does not match </p>

                                              </div>
                                              
                                            </div>
                                          </div>
                                        </div> -->

                                       
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                </div>
                                <!-- /.box-footer -->
                            </div>
                            <!-- /.box -->
                        </div>

                        <!-- MAJALIS END -->


                    <?php
                      $this->load->view('admin/festival/festival_duties');
                    ?>

                    </div>
                </div>
                <!-- /.row (main row) -->
            </section>
            <!-- /.content -->
        </div>
    </div>

<!-- MAJALIS DUTY RATING START -->
<div id="userMajalisDutyRating" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">User Rating 1</h4>
            </div>
        <div class="modal-body">
            <div class="form-group" style="text-align: center;">
                <input type="text" id="assignMajalisDutyId" name="assignDuty"/>
                <input id="majalis-duty-rating-system"  value="0"  name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1">
            </div>
        </div>
        <div class="modal-footer"> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" onclick="addRatingForMajalisDuty()" class="btn btn-primary">Save</button>
        </div>
        </div>

    </div>
</div>
<!-- MAJALIS DUTY RATING END -->


<div id="userRating" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User Rating</h4>
      </div>
      <div class="modal-body">
                 <div class="form-group" style="text-align: center;">

                            <input type="hidden" id="assignDutyId" name="assignDuty"/>
                            <input id="rating-system"  value="0"  name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1">


                
            </div>
      </div>
      <div class="modal-footer">
                 
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button"  onclick="addRating()" class="btn btn-primary " >Save</button>
      </div>
    </div>

  </div>
</div>
<script>
function addRating(){
            var rating = $('#rating-system').val()
            var assignDutyId = $('#assignDutyId').val()

        $.ajax({
        url: "<?php echo site_url('Admin/addRating') ?>",
        type: "POST",
        data: {
            'rating' : rating,
            'assign_duty_id' : assignDutyId
        },
        success: function(response){

                        $('[id=rating_'+assignDutyId+']').hide();
                        $( '<button id="rating_'+assignDutyId+'" data-toggle="modal" onclick="setAssignDutyId('+assignDutyId+','+rating+')" data-target="#userRating" type="button" class="btn btn-primary btn-block"  >Edit Rating</button>' ).insertAfter( '#rating_'+assignDutyId );

                      $('#userRating').modal('toggle');

        },
        error: function(){
            
        }
    });
}

</script>
<script>
var type =  <?php echo json_encode($data['users'][0]->type); ?>;
if(type == 'JK Admin'){
    var selectJKList = document.getElementById("selectJKList").style.display= "none";
}
var getJK = function getJK (){
        var jk = document.getElementById("jk").value;
        var jkHidden = document.getElementById("jkId");
        jkHidden.value = jk;


}

$(function(){

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

  document.getElementById('date').value = formatDate(new Date());
   ajaxCallDuty();
   ajaxGetMajalisDuties();
   ajaxGetFestivalDuties();
});

function ajaxCallDuty() {

   var state=$('#jk').val();

   var date = $('#date').val(); 

    $.ajax({
        url: "<?php echo site_url('Admin/ajaxGetDutyFromJk') ?>",
        type: "POST",
        data: {
            'state' : state,
            'date' : date
        },
        success: function(response){

            $('#duty').html(response);

            $("[name=users]").autocomplete({

                source : '<?php echo site_url('admin/getUsers') ?>',
                select: function(event, ui) {

                    if(ui.item.value == 'NOUSER') {
                        $('#addNewUser').modal('toggle');
                        window.location.href = '<?php echo site_url('admin/addNewUser') ?>';
                    }

                    event.preventDefault();
                    $('#' + this.id).val(ui.item.label);
                    $("#selectedUser").val(ui.item.value);
                    $("#selectedMajalisUser").val(ui.item.value);
                    
                },
                focus: function(event, ui) {
                    event.preventDefault();
                    $('#' + this.id).val(ui.item.label);
                }
            });


        },
        error: function(){
            
        }
    });

getJK();
}

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
    createCookie("first_name",  name[0] , 1 );
    createCookie("last_name",  name[1] , 1 );
    createCookie("waara_id", waara_id , 1 );
    createCookie("date", date , 1 );


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
    
function ajaxCallUserHistory(dutyId) {

   preferenceAjaxCall(dutyId);

   var state=$('#selectedUser').val();

   $('#selectedDuty').val(dutyId);
   
    $.post('<?php echo site_url('Admin/ajaxUserHistory') ?>', {
        state:state
    }, function(data) {
        console.log('userHistory', data);
        $('#userHistory').show().html(data);

    }); 

}


function preferenceAjaxCall(dutyId) {

    var userId = $('#selectedUser').val();
    var jkId = $('#jkId').val();
    var duty = dutyId

    var state = {
        'userId': userId,
        'jkId': jkId,
        'duty': dutyId
    }
   
    $.post('<?php echo site_url('Admin/getUser') ?>', {
        state: state
    }, function(data) {
        /*
         *   0 = NO PREFERENCES SET
         *  -1 = PREFERENCES NOT MATCH
         *   1 = PREFERENCES MATCHED
         */

        if(data == "0") {
            $('#myModal').modal('toggle');
        } else if( data == "-1") {
            $('#preferences').modal('toggle');
        } else if( data == "1" ) {
            $('#myModal').modal('toggle');
        }
    });     

}


var shift = $('#shift').val();

$('#selectedShift').val(shift);

$('#shift').on('change', function() {
    $('#selectedShift').val(this.value);  
});
var addDutyForDay = function addDutyForDay (){
    var date = $('#date').val();
    createCookie("addDutyDate",  date , 1 );
    window.location = "/index.php/admin/addDuty";
}
var eventClick = function eventClick(formatedDate){


        var formatedDate = formatDate(date);

        document.getElementById('selectedDate').innerHTML = 'Selected Date is ' + formatedDate;

        document.getElementById('selectedMajalisDate').innerHTML = 'Selected Date is ' + formatedDate

        $('#date').val( formatedDate );

        $('#majalisDate').val( formatedDate );

        ajaxCallDuty();

        ajaxGetMajalisDuties();


    
}
function convertDate(d) {
  var p = d.split("-");

  return (p[0]+p[1]+p[2]);
}

function sortByDate() {

  var tbody = document.querySelector("#userHistoryt tbody");
  // get trs as array for ease of use
  var rows = [].slice.call(tbody.querySelectorAll("tr"));
  
  rows.sort(function(a,b) {
    return convertDate(b.cells[3].innerHTML) - convertDate(a.cells[3].innerHTML);
  });
  
  rows.forEach(function(v) {

    tbody.appendChild(v); // note that .appendChild() *moves* elements
  });
}

    var setAssignDutyId = function setAssignDutyId(id,stars){
        $('#assignDutyId').val(id);
        $('#rating-system').rating('update', stars);
        //$('#rating-system').val(stars);
        
    }




function ajaxGetMajalisDuties() {

    var date = $('#date').val();

    $.ajax({
        url: "<?php echo site_url('AdminMajalis/ajaxGetMajalisDuties') ?>",
        type: "POST",
        data: {
            'date' : date
        },
        success: function(response){
            $('#majalisDuty').html(response);

            $( "#majalisDutyTable tbody" ).sortable( {
                update: function( event, ui ) {

                    // $(this).children().each(function(index) {                    
                    //     $(this).find('td').last().html(index + 1);
                    // });
                    var duty_id = [];
                    $("#majalisDutyTable tbody tr").each(function() {
                        var counter = 0;
                        $.each(this.cells, function(){
                            if(counter == 0 ){
                                duty_id.push($(this).text());
                            }
                            counter++;
                        });
                        
                    });  
                    sortMajalisDuties(duty_id, date);
              }

            });

        },
        error: function(){
            
        }
    });
}


function sortMajalisDuties(duty_id, selectedDate){

    console.log('inside')

  $.ajax({
     url: <?php echo '"' . site_url('Majalis/sortMajalisDuties') . '"' ?>,
     type: "POST",
     data: {
         "duties" : duty_id,
         "selectedDate" : selectedDate
     },
     success: function(response){
        
     },
     error: function(){  
     }
 });
}    

function ajaxCallUserHistoryForMajalis(dutyId) {

   //preferenceAjaxCall(dutyId);

   $('#majalisUserHistoryModal').modal('toggle');
   $('#selectedMajalisDuty').val(dutyId);

   var state = $('#selectedMajalisUser').val();

   console.log(state);

    $.post('<?php echo site_url('Admin/ajaxUserHistory') ?>', {
        state:state
    }, function(data) {

        $('#userHistoryForMajalis').show().html(data);

    }); 

}


var setAssignMajalisDutyId = function setAssignMajalisDutyId(id,stars){

    $('#assignMajalisDutyId').val(id);
    $('#majalis-duty-rating-system').rating('update', stars);
    //$('#rating-system').val(stars);
}

function addRatingForMajalisDuty(){
    var rating = $('#majalis-duty-rating-system').val()
    var assignDutyId = $('#assignMajalisDutyId').val()

    $.ajax({
        url: "<?php echo site_url('AdminMajalis/addRating') ?>",
        type: "POST",
        data: {
            'rating' : rating,
            'assign_duty_id' : assignDutyId
        },
        success: function(response){

            $('[id=dutyRating_'+assignDutyId+']').hide();
            $( '<button id="dutyRating_'+assignDutyId+'" data-toggle="modal" onclick="setAssignMajalisDutyId('+assignDutyId+','+rating+')" data-target="#userMajalisDutyRating" type="button" class="btn btn-primary btn-block"> Edit Rating</button>' ).insertAfter('#dutyRating_'+assignDutyId );

            $('#userMajalisDutyRating').modal('toggle');

        },
        error: function(){
            
        }
    });
}


</script>