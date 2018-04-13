<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.css">

<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">

            <section class="content">

                <!-- Report box div start -->
                <div class="row" style="padding: 2%;">  

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <br>
                                <h2>Users</h2>
                                <br>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="<?php //echo site_url('Admin/userList') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <br>
                                <h2>Reports</h2>
                                <br>
                            </div>
                            <div class="icon">
                                <i class="fa fa-bar-chart-o"></i>
                            </div>
                            <a href="<?php //echo site_url('Report') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <br>
                                <h2>Add</h2>
                                <br>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user-plus"></i>
                            </div>
                            <a href="<?php //echo site_url('Admin/addNewUser') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <br>
                                <h2>Duty</h2>
                                <br>
                            </div>
                            <div class="icon">
                                <i class="fa  fa-list-alt"></i>
                            </div>
                            <a href="<?php //echo site_url('Admin/addDuty') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- Report box div end -->


                <div class="row">

                    <!-- Main div start -->
                    <div class="col-md-12">
                        <!-- Calender Box Start -->
                        <div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title">ASSIGNED WAARA</h3>
                                </div>

                                <div class="box-body">

                                    <div id="calendar"></div>

                                </div>
                                <div class="box-footer"> </div>

                            </div>


                        </div>
                        <!-- Calender Box End -->

                        <!-- Waara duties box start -->
                        <div class="col-md-6">
                            <div class="box box-success">

                                <div class="box-header with-border">
                                    <div for="" class="col-sm-4 ">
                                        <h3 class="box-title">REGULAR WAARA</h3>
                                    </div>
                                    <div for="" class="col-sm-8 ">
                                        <h3 id="selectedDate" class="box-title"> Selected Date is : </h3>
                                    </div>
                                </div>

                                <input type="hidden" id="date" name="date"  />

                                <div class="box-body">

                                    <div id="duty" name="duty" >

                                    </div>


                                </div>

                            </div>
                        </div>
                        <!-- Waara duties box end -->

                    </div>
                    <!-- Main div end -->

                </div>

            </section>

        </div>
    </div>
</body>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="confirm-modal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Do you want to request for this duty?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="confirmModalNo()">No</button>
        <button type="button" class="btn btn-primary" onclick="confirmModalYes()">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="alert-modal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="alertModalLabel">This date is disabled for request</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="confirmModalNo()">Ok</button>
      </div>
    </div>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.js"></script>

<script>

var dutyId = 0;
getCalendarData();

function getCalendarData() {
    $.ajax({
        url: "<?php echo site_url('home/getCalendarData') ?>",
        type: "GET",
        data: {
        },
        success: function(response){

            response = JSON.parse(response);
            events = response;
            initCalendar(events);
        },
        error: function(){
            
        }
    });    
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

$('#date').val( formatDate(new Date()) );
$('#selectedDate').html('Selected Date is : ' + formatDate(new Date()) );

function initCalendar(events) {

    $('#calendar').html('');

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek'
        }, events: this.events,
        defaultView: 'basicWeek',
          eventClick: function (calEvent, jsEvent, view) {

            $('#date').val( formatDate(calEvent.start) );

            $('#selectedDate').html('Selected Date is : ' + formatDate(calEvent.start) );

        },
        dayClick: function(date, allDay, jsEvent, view) {

            $('#date').val( formatDate(date) );
            $('#selectedDate').html('Selected Date is : ' + formatDate(date) );
            ajaxCallDuty();

        }
    });

}


ajaxCallDuty();

function ajaxCallDuty() {

   var state = 1; //$('#jk').val();

   var date = $('#date').val(); 

    $.ajax({
        url: "<?php echo site_url('home/ajaxGetDutyFromJk') ?>",
        type: "POST",
        data: {
            'state' : state,
            'date' : date
        },
        success: function(response){

            $('#duty').html(response);

        },
        error: function(){
            
        }
    });

 //getJK();
}    

function onRequestClick(dutyId) {

    $('#confirm-modal').modal('show');
    this.dutyId = dutyId;
    
}   

function confirmModalNo() {
    $('#confirm-modal').modal('hide');
    $('#alert-modal').modal('hide');
    this.dutyId = 0; 
}

function confirmModalYes() {
    $('#confirm-modal').modal('hide');
    var date = $('#date').val(); 

    $.ajax({
        url: "<?php echo site_url('home/waaraRequest') ?>",
        type: "POST",
        data: {
            'dutyId' : this.dutyId,
            'date' : date
        },
        success: function(response){
            response = JSON.parse(response);
            if (response.success) {
                $('#alertModalLabel').html(response.message);
            } else {
                $('#alertModalLabel').html(response.message);
            }
            $('#alert-modal').modal('show');
            getCalendarData();
        },
        error: function(){
            
        }
    });

}

</script>
