<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.css">

<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>


            <section class="content">
                
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">

                              <div class="box-body">

                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Start Date</label>
                                        <div class="col-sm-3">
                                            <input type="date" id="startDate" name="startDate" class="form-control"  placeholder="" required>
                                        </div>                                   
                                    </div>

                                </div>

                              <div class="box-body">

                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">End Date</label>
                                        <div class="col-sm-3">
                                            <input type="date" id="endDate" name="endDate" class="form-control"  placeholder="" required>
                                        </div>
                                        <div class=" col-sm-2">
                                            <button type="button" onclick="addDays()" class="btn btn-primary btn-block">ADD</button>
                                        </div>                                      
                                    </div>

                                </div>                                
                        </div>

                            <!-- <div class="box-header with-border">
                                <h3 class="box-title">List Of Duties:</h3>
                            </div> -->
                        <div class="box box-success" id="daysTable">
                            <div class="box-body">
                                <table class="table table-striped" id="table" width="80%">
                                    <tbody>
                                        <tr>
                                            <td> Monday &emsp; <input type="checkbox" name="day" value="0"/> </td>
                                            <td> Tuesday &emsp; <input type="checkbox" name="day" value="1"/> </td>
                                            <td> Wednesday &emsp; <input type="checkbox" name="day" value="2"/> </td>
                                            <td> Thursday &emsp; <input type="checkbox" name="day" value="3"/> </td>
                                            <td> Friday &emsp; <input type="checkbox" name="day" value="4"/> </td>
                                            <td> Saturday &emsp; <input type="checkbox" name="day" value="5"/> </td>
                                            <td> Sunday &emsp; <input type="checkbox" name="day" value="6"/> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> 
                        </div>

                        <div class="box box-success">
                            <div class="box-body">
                                <div class="col-sm-6">
                                    <div id="calendar">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
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
        <h4 class="modal-title" id="myModalLabel">Do you want to Delete this date?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="confirmModalNo()">No</button>
        <button type="button" class="btn btn-primary" onclick="confirmModalYes()">Yes</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.js"></script>

<script>

var selectedId = 0;

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}


function updateCalendar(events) {

    $('#calendar').html('');

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek'
        }, events: events,
        defaultView: 'basicWeek',
          eventClick: function (calEvent, jsEvent, view) {

            console.log('eventClick', calEvent.id);
            selectedId = calEvent.id;

            $('#confirm-modal').modal('show');

        },
        dayClick: function(date, allDay, jsEvent, view) {

            $('#date').val( formatDate(date) );

            


        }
    });

}

getDays();

function getDays() {

    $.ajax({
        url: "<?php echo site_url('WaaraRequest/getDaysV2') ?>",
        type: "GET",
        data: {
        },
        success: function(response) {
            var events = response;
            events = JSON.parse(events);
            updateCalendar(events)
        }, error: function(){
            
        }
    });      
}

function addDays() {

    var weekDays = [];
    var uncheckedDays = [];
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();

    if (startDate && endDate && new Date(startDate) < new Date(endDate)) {

        $("input:checkbox[name=day]:checked").each(function(){
            weekDays.push($(this).val());
        }); 
        
        $.ajax({
            url: "<?php echo site_url('WaaraRequest/addDaysV2') ?>",
            type: "POST",
            data: {
                'startDate': startDate,
                'endDate': endDate,
                'weekDays': weekDays
            },
            success: function(response){
                getDays();
                //$('#daysTable').html(response);

            }, error: function(){
                
            }
        });  

    } else {

    }
}

function confirmModalNo() {
    $('#confirm-modal').modal('hide');
}

function confirmModalYes() {
    console.log(selectedId);
    $.ajax({
        url: "<?php echo site_url('WaaraRequest/deleteDate') ?>",
        type: "POST",
        data: {
            'id': selectedId
        },
        success: function(response) {
            selectedId = 0;
            getDays();

        }, error: function(){
            
        }
    });    
    $('#confirm-modal').modal('hide');
}

</script>