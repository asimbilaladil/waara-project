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
  document.getElementById('date').value = formatDate(new Date());

  $('#calendar').fullCalendar({
    		header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek'
			},events: events,
// 		events:  [
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

							$('#date').val( formatedDate );

							ajaxCallDuty();


        },
        dayClick: function(date, allDay, jsEvent, view) {

        var formatedDate = formatDate(date);

        document.getElementById('selectedDate').innerHTML = 'Selected Date is ' + formatedDate;

        $('#date').val( formatedDate );

        ajaxCallDuty();


    }
  });

})
function getBody(element) {
    var divider = 2;
    var originalTable = element.clone();
    var tds = $(originalTable).children('tbody').children('tr').children('td').length;
    return tds;
}
</script>
<style type="text/css">
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
    width: 25%;
    text-align: left;
    }
    
.fc-header-center {
    text-align: center;
    }
    
.fc-header-right {
    width: 25%;
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
    margin-right: -1px;
    }
    
.fc-header .fc-corner-right,  /* non-theme */
.fc-header .ui-corner-right { /* theme */
    margin-right: 0; /* back to normal */
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.3/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.3/js/star-rating.js" type="text/javascript"></script>
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
                    <li class="active">Global Sort</li>
                </ol>
                </br>
                 </br>
            </section>
            <!-- Main content -->
            <section class="content">

				
								<div class="row">
                    <div class="col-md-12">
     
                        <div class="col-md-12">
                            <div class="box box-success">
                                
                 
                                <!-- /.box-header -->
                                <div class="box-body">
                                
                                   
                                    <div class="col-sm-12">
                                     </br>
                                  <input type="hidden" name="selectDate" id="date" value="<?php echo date('Y-m-d');?>"/>
                                        <!--Dynamicly duty table added  -->
                                        <div id="duty" name="duty" >

                                        </div>
                                    </div>


                                        <!-- Modal -->




                                        <!-- Modal -->




                                        <!-- Modal -->


                                       
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                </div>
                                <!-- /.box-footer -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </section>
            <!-- /.content -->
        </div>
    </div>

<script>
function ajaxCallDuty() {

   var state=$('#jk').val();

   var date = $('#date').val(); 

    $.ajax({
        url: "<?php echo site_url('Admin/getGlobalSortDutyFromJk') ?>",
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
  ajaxCallDuty();
</script>






