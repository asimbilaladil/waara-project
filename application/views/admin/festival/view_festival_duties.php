<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
<!--             <section class="content-header">
                <h1>
                    Dashboard
                    <small >Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section> -->
            <!-- Main content -->
            <section class="content">
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                               <h3 class="box-title"> <?php echo $data->festival ? $data->festival : '' ?> </h3>
                             </div>
                            <!-- /.box-header -->

                            <div class="form-horizontal">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Duty</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="duty" name="duty" class="form-control"  placeholder="" required>
                                        </div>
                                    </div>

                                    <input type="hidden" id="token" name="token" value="<?php echo $this->input->get('token', TRUE); ?>"/>

                                    <input type="hidden" name="date" id="date" value="<?php echo $this->input->get('date', TRUE); ?>"/> 

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-2">
                                            <button type="submit" onclick="addDuty()" class="btn btn-primary btn-block">Add</button>
                                        </div>
                                    </div>


                                </div>
                            </div>


                            </br> </br>
<!--                             <div class="box-header with-border">
                                <h3 class="box-title">List Of Duties:</h3>
                            </div> -->

  <!--                           <div class="form-group">
                                <div class="col-sm-4">
                                    <input type="text" name="name" class="form-control" id="search" placeholder="Type to search...">
                                </div>
                            </div> -->

                            <div class="box box-success">
                 
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div>
                                    <!-- <form action="<?php echo site_url('Festival/assignDuty') ?>" method="post" > -->
                                        
                                        <div class="col-sm-12">
                                     </br>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6">

                                            <input type="hidden" name="festivalDate" value="<?php echo $this->input->get('date') ?>" id="festivalDate"/>

                                            <input type="hidden" name="selectedFestivalUser" id="selectedFestivalUser"/>
                                            <input type="hidden" name="selectedFestivalDuty" id="selectedFestivalDuty"/>
                                            <input type="hidden" name="fromViewDuties" value="true"/>
                                                                  
                                            </div>
                                        </div>

                                    </div>
                                   
                                    <div class="col-sm-12">
                                     </br>
                                        <!--Dynamicly duty table added  -->
                                        <div id="festivalDuty"  >

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
                                                <div id="userHistoryForFestival">

                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="assignDuty()" class="btn btn-primary">Save</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                    <!-- </form> -->

            <!-- MAJALIS DUTY RATING START -->
            <div id="userFestivalDutyRating" class="modal fade" role="dialog">
                <div class="modal-dialog">
                <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">User Rating 1</h4>
                        </div>
                    <div class="modal-body">
                        <div class="form-group" style="text-align: center;">
                            <input type="hidden" id="assignFestivalDutyId" name="assignDuty"/>
                            <input id="festival-duty-rating-system"  value="0"  name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1">
                        </div>
                    </div>
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="addRatingForFestivalDuty()" class="btn btn-primary">Save</button>
                    </div>
                    </div>

                </div>
            </div>
            <!-- MAJALIS DUTY RATING END -->


                            
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.box-footer -->
                </form>
        </div>
        <!-- /.box -->
    </div>
    </div><!-- /.row (main row) -->
    </section><!-- /.content -->
    </div>
    </div>



<script>

ajaxGetFestivalDuties();


function setAssignFestivalDutyId(id,stars) {
    
    $('#assignFestivalDutyId').val(id);
    $('#festival-duty-rating-system').rating('update', stars);
    //$('#rating-system').val(stars);
}


function addRatingForFestivalDuty(){
    var rating = $('#festival-duty-rating-system').val()
    var assignDutyId = $('#assignFestivalDutyId').val()

    $.ajax({
        url: "<?php echo site_url('Festival/addRating') ?>",
        type: "POST",
        data: {
            'rating' : rating,
            'assign_duty_id' : assignDutyId
        },
        success: function(response){

            $('[id=dutyRating_'+assignDutyId+']').hide();
            $( '<button id="dutyRating_'+assignDutyId+'" data-toggle="modal" onclick="setAssignFestivalDutyId('+assignDutyId+','+rating+')" data-target="#userFestivalDutyRating" type="button" class="btn btn-primary btn-block"> Edit Rating</button>' ).insertAfter('#dutyRating_'+assignDutyId );

            $('#userFestivalDutyRating').modal('toggle');

        },
        error: function(){
            
        }
    });
}

function ajaxGetFestivalDuties() {

    var date = $('#date').val();

    $.ajax({
        url: "<?php echo site_url('festival/ajaxGetFestivalDuties') ?>",
        type: "POST",
        data: {
            'date' : date
        },
        success: function(response){

            $('#festivalDuty').html(response);


            $( "#festivalDutyTable tbody" ).sortable( {

                update: function( event, ui ) {
                    $(this).children().each(function(index) {                    
                        $(this).find('td').last().html(index + 1);
                    });

                    var duty_id = [];

                    $("#festivalDutyTable tbody tr").each(function() {
                        var counter = 0;

                        $.each(this.cells, function(){

                            if(counter == 0 ){
                                duty_id.push($(this).text());
                            }

                            counter++;
                        });
                        
                    });  

                    sortDuties(duty_id, date);
              }

            });


            $("[name=festivalUsers]").autocomplete({

                source : '<?php echo site_url('admin/getUsers') ?>',
                select: function(event, ui) {

                    // if(ui.item.value == 'NOUSER') {
                    //     $('#addNewUser').modal('toggle');
                    //     window.location.href = '<?php echo site_url('admin/addNewUser') ?>';
                    // }

                    event.preventDefault();
                    $('#' + this.id).val(ui.item.label);
                    $("#selectedFestivalUser").val(ui.item.value);
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
}    

function ajaxCallUserHistoryForFestival(dutyId) {

   //preferenceAjaxCall(dutyId);

   $('#myModal').modal('toggle');
   $('#selectedFestivalDuty').val(dutyId);

   var state = $('#selectedFestivalUser').val();

    $.post('<?php echo site_url('Admin/ajaxUserHistory') ?>', {
        state:state
    }, function(data) {

        $('#userHistoryForFestival').show().html(data);

    }); 

}

function sortDuties(duty_id, selectedDate){

      $.ajax({
         url: <?php echo '"' . site_url('Festival/sortFestivalDuties') . '"' ?>,
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

$(function(){
    $.fn.editable.defaults.mode = 'inline';

    $("[name='editDuty']").editable({
    });

});


function addDuty() {

    var token = $('#token').val();
    var date = $('#date').val();
    var duty = $('#duty').val();
    
    $.ajax({
        url: <?php echo "'" . site_url('Festival/addDuty') . "'" ?>,
        type: "POST",
        data: {
            "duty" : duty,
            "date" : date,
            "token": token
        },
        success: function(response) {
            ajaxGetFestivalDuties();
        },
        error: function(){ 

        }
    });    
}

function deleteDuty(dutyId) {

    if (confirm("Are you sure you want to delete this Duty")) {

        $.ajax({
            url: <?php echo "'" . site_url('Festival/deleteFestivalDuty') . "'" ?>,
            type: "GET",
            data: {
                "id" : dutyId
            },
            success: function(response) {
                ajaxGetFestivalDuties();
            },
            error: function(){ 

            }
        });     
    }

}


function assignDuty() {

    var festivalDate = $('#festivalDate').val();
    var selectedFestivalUser = $('#selectedFestivalUser').val();
    var selectedFestivalDuty = $('#selectedFestivalDuty').val();

    $.ajax({
        url: <?php echo "'" . site_url('Festival/assignDuty') . "'" ?>,
        type: "POST",
        data: {
            "festivalDate": festivalDate,
            "selectedFestivalUser": selectedFestivalUser,
            "selectedFestivalDuty": selectedFestivalDuty
        },
        success: function(response) {
            $('#myModal').modal('toggle');
            ajaxGetFestivalDuties();
        },
        error: function(){ 
            $('#myModal').modal('toggle');
        }
    });


}

</script>    
