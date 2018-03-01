                        <div class="col-md-6 majalisBox"  style="display:none;">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    
                                    <div for="" class="col-sm-4 "><h3 class="box-title">list of Festival</h3></div>
                                    <div for="" class="col-sm-8 "><h3 id="selectedMajalisDate" class="box-title"> Selected Date is : </h3></div>

                                </div>

                                    <div class="col-sm-12" style="top: 20px;">
                                        <div class="col-sm-3" >
                                        </div>
                                       <!--  <div class="col-sm-6" >
                                            <button class="btn btn-primary btn-block " onclick="addDutyForDay()">Add Waara</button>
                                        </div> -->
                                    </div>
                 
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div>
                                    <form action="<?php echo site_url('Festival/assignDuty') ?>" method="post" >
                                        
                                        <div class="col-sm-12">
                                     </br>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6">

                                            <input type="hidden" name="festivalDate" id="festivalDate"/>

                                            <input type="hidden" name="selectedFestivalUser" id="selectedFestivalUser"/>
                                            <input type="hidden" name="selectedFestivalDuty" id="selectedFestivalDuty"/>
                                            <input type="hidden" name="fromViewDuties" value="false"/>                                               
                                            </div>
                                        </div>

                                    </div>
                                   
                                    <div class="col-sm-12">
                                     </br>
                                        <!--Dynamicly duty table added  -->
                                        <div id="festivalDuty" name="festivalDuty" >

                                        </div>
                                    </div>


                                        <!-- Modal -->
                                        <div class="modal fade" id="festivalUserHistoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Festival User History</h4>
                                              </div>
                                              <div class="modal-body">
                                                <div id="userHistoryForFestival">

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


<script>

// $(function(){

//   ajaxGetFestivalDuties();
// })

function setAssignFestivalDutyId(id,stars) {
    
    console.log('setAssignFestivalDutyId', id);

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

                    sortFestivalDuties(duty_id, date);
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

   $('#festivalUserHistoryModal').modal('toggle');
   $('#selectedFestivalDuty').val(dutyId);

   var state = $('#selectedFestivalUser').val();

    $.post('<?php echo site_url('Admin/ajaxUserHistory') ?>', {
        state:state
    }, function(data) {

        $('#userHistoryForFestival').show().html(data);

    }); 

}

function sortFestivalDuties(duty_id, selectedDate) {

  console.log(selectedDate);

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



</script>    
