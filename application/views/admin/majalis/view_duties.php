<style>
    @media only screen and (max-width: 576px) {
        #majalisDuty{
                position: relative; 
                overflow-x: scroll;
        }


    } 

</style>

<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                
          
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                 <h3 class="box-title"><?php echo $data['majalis']->name ? $data['majalis']->name : '' ?> </h3>
                             </div>


                            <!-- /.box-header -->

                            <input type="hidden" value="<?php print_r($data['majalis']->id) ?>" id="majalisId" name="majalisId"/>

                            <form id="defaultForm" class="form-horizontal majalisForm" action="<?php echo site_url('majalis/addDuty') ?>" method="post" >
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Duty</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="duty" class="form-control"  placeholder="" required>
                                        </div>
                                        <div class=" col-sm-2">
                                            <button type="submit" class="btn btn-primary btn-block">Add</button>
                                        </div>                                      
                                    </div>

                                    <input type="hidden" name="token" value="<?php echo $this->input->get('token', TRUE); ?>"/>

                                    <input type="hidden" id="selectedDate" name="date" value="<?php echo $this->input->get('date', TRUE); ?>"/> 



                                </div>
                            </form>


                            </br> </br>
                            <!-- <div class="box-header with-border">
                                <h3 class="box-title">List Of Duties:</h3>
                            </div> -->

                            <div class="box box-success">
                 
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div>
                                    <!-- <form action="<?php echo site_url('AdminMajalis/assignDuty') ?>" method="post" > -->
                                        
                                        <div class="col-sm-12">
                                     </br>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6">

                                            <input type="hidden" name="majalisDate" value="<?php echo $this->input->get('date') ?>" id="majalisDate"/>

                                            <input type="hidden" name="selectedMajalisUser" id="selectedMajalisUser"/>
                                            <input type="hidden" name="selectedMajalisDuty" id="selectedMajalisDuty"/>
                                            <input type="hidden" name="fromViewDuties" value="true"/>                                                                  
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
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">User History</h4>
                                              </div>
                                              <div class="modal-body">
                                                <div id="userHistoryForMajalis">

                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" onclick="assignDuty()" class="btn btn-primary">Save</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                    </form>

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
                <input type="hidden" id="assignMajalisDutyId" name="assignDuty"/>
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




<script>

ajaxGetMajalisDuties();

function ajaxGetMajalisDuties() {

    var date = $('#majalisDate').val();


    $.ajax({
        url: "<?php echo site_url('AdminMajalis/ajaxGetMajalisDuties') ?>",
        type: "POST",
        data: {
            'date' : date
        },
        success: function(response){
            $('#majalisDuty').html(response);

            isEditAllowed();

            var selectedDate = $("#selectedDate").val()

            $( "#majalisDutyTable tbody" ).sortable( {

                update: function( event, ui ) {
                    $(this).children().each(function(index) {                    
                        $(this).find('td').last().html(index + 1);
                    });

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

                    sortDuties(duty_id, selectedDate);
              }

            });

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
}    


function assignDuty() {

    var selectedMajalisUser = $('#selectedMajalisUser').val();
    var selectedMajalisDuty = $('#selectedMajalisDuty').val();
    var majalisDate = $('#majalisDate').val();

      $.ajax({
         url: <?php echo '"' . site_url('AdminMajalis/assignDuty') . '"' ?>,
         type: "POST",
         data: {
             "selectedMajalisUser" : selectedMajalisUser,
             "selectedMajalisDuty" : selectedMajalisDuty,
             "majalisDate"         : majalisDate
         },
         success: function(response){
            ajaxGetMajalisDuties();
            $('#myModal').modal('toggle');
         },
         error: function(){  

            $('#myModal').modal('toggle');
         }
     });


}


function ajaxCallUserHistoryForMajalis(dutyId) {

   //preferenceAjaxCall(dutyId);

   $('#myModal').modal('toggle');
   $('#selectedMajalisDuty').val(dutyId);

   var state = $('#selectedMajalisUser').val();

    $.post('<?php echo site_url('Admin/ajaxUserHistory') ?>', {
        state:state
    }, function(data) {

        $('#userHistoryForMajalis').show().html(data);

    }); 

}

function sortDuties(duty_id, selectedDate){

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


$(function() {
    $.fn.editable.defaults.mode = 'inline';

    $("[name='editDuty']").editable({
        // success: function(data, config) {
        //     location.reload();
        // }
    });

});


function deleteDuty(token) {

    if (confirm("Are you sure you want to delete this Duty")) {

        console.log(token);

        $.ajax({
            url: "<?php echo site_url('Majalis/deleteMajalisDuty') ?>",
            type: "GET",
            data: {
                'token': token
            },
            success: function(response){

                ajaxGetMajalisDuties();

            }, error: function(){
                
            }
        });   

    } else {

    }

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