
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

 // document.getElementById('selectedDate').innerHTML = 'Selected Date is ' + formatDate(new Date());        
 // document.getElementById('date').value = formatDate(new Date());

  $('#calendar').fullCalendar({
    		header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek'
			},events: events,
			defaultView: 'basicWeek',
		  eventClick: function (calEvent, jsEvent, view) {

							var formatedDate = formatDate(calEvent.start);
              
							//document.getElementById('selectedDate').innerHTML = 'Selected Date is ' + formatedDate;
             
							getRating(formatedDate, calEvent.title);



        },
        dayClick: function(date, allDay, jsEvent, view) {

        var formatedDate = formatDate(date);

       // document.getElementById('selectedDate').innerHTML = 'Selected Date is ' + formatedDate;

       // $('#date').val( formatedDate );




    }
  });

})
var getRating = function getRating(date, title){
	    $.ajax({
        url: "<?php echo site_url('Profile/getRatingLogs') ?>",
        type: "POST",
        data: {
            'user_id' : <?php echo $_GET['id']; ?>,
            'date' : date,
            'title' : title
        },
        success: function(response){

          $("#ratingModal").modal('show');
          $("#ratingModalBody").html(response);
            $('.rating-system').rating({displayOnly: true});

        },
        error: function(){
            
        }
    });
}

</script>
<style type="text/css">
  .rating-container{
    font-size: xx-large !important ; 
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
            <h1> User <small >Profile</small> </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Profile</li>
            </ol>
        </section>
        <!-- Main content -->
<section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo  ($data['user_info']->user_image == '' ? ' https://upload.wikimedia.org/wikipedia/commons/2/26/Simpleicons_Interface_user-male-outline.svg': base_url() .'uploads/'. $data['user_info']->user_image ); ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo  $data['user_info']->first_name . ' '.$data['user_info']->last_name; ?></h3>



              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right editEmail"><?php echo  $data['user_info']->email; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Phone</b> <a class="pull-right editPhone"><?php echo  $data['user_info']->phone; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Age Group</b> <a class="pull-right"><?php echo  $data['user_info']->age; ?></a>
                </li>
                <li class="list-group-item">
									<b>Status</b> <a class="pull-right" onclick="changeUserStatus(<?php echo  ($data['user_info']->status == 'true' ? 'true' : 'false'); ?>,<?php echo $data['user_info']->user_id;?>)" ><span class="editStatus"><?php echo   ($data['user_info']->status == 'true' ? 'Active' : 'Inactive'); ?></span></a>
                </li>
                <li class="list-group-item">
									
									<b>Approval</b> <span class="editVerify"> <a class="pull-right " onclick="changeUserVerifyStatus(<?php echo  ($data['user_info']->verified == 'true' ? 'true' : 'false'); ?>,<?php echo $data['user_info']->user_id;?>)" ><?php echo  ($data['user_info']->verified == 'true' ? 'Approved' : 'Pending' ); ?></a></span>
                </li> 
                <li class="list-group-item">
                  <b>Type</b> <a class="pull-right"><?php echo  $data['user_info']->type; ?></a>
                </li>                
                
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->

          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
							<li class="active"><a href="#history" data-toggle="tab" aria-expanded="false">History</a></li>
              <li class=""><a href="#activity" data-toggle="tab" aria-expanded="true">Activity</a></li>
							

              <li class=""><a href="#imageUpload" data-toggle="tab" aria-expanded="false">Image Upload</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane " id="activity">
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Activity Logs</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane " id="imageUpload">
                 <div class="row">
                <form  method="post" enctype="multipart/form-data"  action="<?php echo site_url('Profile/uploadImage'); ?>">
                  <div class="form-group">
                    
                    <input name="set_img_name" class="col-sm-4" type="file" id="myFile" size="50">
                    <input name="userId" type="hidden" value="<?php echo $_GET['id']; ?>" />
                    <div class="col-sm-6">
                     <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                  </div>
                  
                  
                </form>
                </div>

              </div>
               <div class="tab-pane active" id="history">
                 <div class="row">
								 	<table class="table table-striped">
										<thead>
											<tr>
													<th> Name </th>
													<th> Duty </th>
													<th> Reason </th>
													<th> Date </th>
											</tr>
										</thead>
										<tbody>

														<?php
																	foreach($data['userHistory'] as $row) { 

																			echo '<tr>
																													<td> '. $row->first_name .' </td>
																													<td> '. $row->name .' </td>
																													<td> '. $row->reason .' </td>
																													<td> '. $row->start_date .' </td>
																											</tr>';

																	}
																?>                                
												</tbody>
										</table>
                </div>

              </div>
							<!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

  </section>
    </div>
</div>
  
<div id="ratingModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Rating Logs</h4>
      </div>
      <div class="modal-body" id="ratingModalBody">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
	
	<script>
		setTimeout(function(){
				$('.editEmail').editable({
				type: 'text',

				title: 'Enter Email',
				success: function(response, newValue) {
					updateData( <?php echo $_GET['id']; ?>,'email', newValue)
           
        }
		});
		$('.editPhone').editable({
				type: 'text',

				title: 'Enter Phone',
				success: function(response, newValue) {
					updateData( <?php echo $_GET['id']; ?>,'phone', newValue)
           
        }
		});		
			
			
}, 1000);
	
	function changeUserVerifyStatus(status, user_id) {

            $.ajax({
                url: "<?php echo site_url('Admin/updateVerify') ?>",
                type: "GET",
                data: {
                    'id': user_id,
                    'verified': status
                },
                success: function(response) {
									var statusText = (status == false ? 'Approved' : 'Pending');
                    
                    var updatedStatus = (status == false ? true : false);
									 $('.editVerify').html('')
                    $('.editVerify').html(' <a class="pull-right" style="cursor: pointer;" onclick="changeUserStatus(' + updatedStatus + ',' + user_id + ')"  >' + statusText + ' </a>')

                },
                error: function() {

                }
            });
        }
	function changeUserStatus(status, user_id) {

			$.ajax({
					url: "<?php echo site_url('Admin/updateStatus') ?>",
					type: "GET",
					data: {
							'id': user_id,
							'status': status
					},
					success: function(response) {
							var statusText = (status == false ? 'Active' : 'Inactive');
							var updatedStatus = (status == false ? true : false);
						 	$('.editStatus').html('')
							$('.editStatus').html(' <a style="cursor: pointer;" onclick="changeUserStatus(' + updatedStatus + ',' + user_id + ')"  >' + statusText + ' </a>')

					},
					error: function() {

					}
			});
	}		
	var updateData = function updateData(id, field, value){
	    $.ajax({
        url: "<?php echo site_url('Admin/editProfileFields') ?>",
        type: "POST",
        data: {
					'user_id' : id,
					'field' : field,
					'value' : value
        },
        success: function(response){


        },
        error: function(){
            
        }
    });
}
	
	</script>
