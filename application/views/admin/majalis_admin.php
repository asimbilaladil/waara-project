<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <!-- <h1>
                    Dashboard
                    <small >Control panel</small>
                </h1> -->
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- TABLE DIV -->
                      <div class="col-md-1"></div>

                        <div class="col-md-4">

                            <div class="box box-success">
                               <div class="col-md-12">
                              <h4 id="majalisNameHeading">CHAANDRAAT MAJALIS</h4>
                              </div>
                            <div class="col-md-6">
                            <!-- Year dropdown Start -->                                    
                                <select required="" name="years" id="yearDropdown" onchange="onYearChange(this)" class="form-control">
                                    <?php
                                        $years = $data["years"];
                                        foreach ($years as $key => $value) {
                                            echo '<option value"'. $value->year .'"> '.$value->year.' </option>';
                                        }
                                    ?>
                                </select>
                              </div>

                                <input type="hidden" value="<?php echo $years ? $years[0]->year : 0 ?>" id="selectedYear"/>
                            <!-- Year dropdown End -->

                                <div id="majalisDates">

                                </div>

                            </div>  
                        </div>
                        <!-- START -->
                        

                            <div class="col-md-6 majalisBox" id="majalisDuty">

                            </div>

                            <form action="<?php echo site_url('AdminMajalis/assignDuty') ?>" method="post" >

                            <input type="hidden" name="selectedMajalisUser" id="selectedMajalisUser"/>
                            <input type="hidden" name="selectedMajalisDuty" id="selectedMajalisDuty"/>
                            <input type="hidden" id="majalisDate" name="majalisDate"  />

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
                            <!-- Modal End -->

                        </form>    

                        <!-- END -->
                    </div>
                </div>
        </div>
    </div>
    </section>
    </div>
    </div>

<!-- MAJALIS DUTY RATING START -->
<div id="userMajalisDutyRating" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">User Rating</h4>
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


<!-- ADD DUTY MODAL START -->
<div id="addDutyModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Duty</h4>
            </div>
            <div class="modal-body">
                <div class="form-group col-sm-12">
                    <label for="" class="col-sm-2 control-label">Duty</label>
                    <div class="col-sm-6">
                        <input type="text" name="dutyname" class="form-control" id="dutyname">
                    </div>
                </div>
            </div>      
        <div class="modal-footer"> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="onDutyAdd()">Save</button>
        </div>
        </div>

    </div>
</div>
<!-- ADD DUTY MODAL END -->



</body>



<script>

    //ajaxGetMajalisDuties();

function ajaxGetMajalisDuties(date) {

    //var date = $('#majalisDate').val();

    $.ajax({
        url: "<?php echo site_url('AdminMajalis/ajaxGetMajalisDutiesV2') ?>",
        type: "POST",
        data: {
            'date' : date
        },
        success: function(response){
            $('#majalisDuty').html(response);
            $('#majalisDate').val(date);
            //isEditAllowed();

            var selectedDate = $("#selectedDate").val()

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

function ajaxCallUserHistoryForMajalis(dutyId) {

   $('#majalisUserHistoryModal').modal('toggle');
   $('#selectedMajalisDuty').val(dutyId);

   var state = $('#selectedMajalisUser').val();

    $.post('<?php echo site_url('Admin/ajaxUserHistory') ?>', {
        state:state
    }, function(data) {

        $('#userHistoryForMajalis').show().html(data);

    }); 

} 


function onYearChange() {
    
    var year = $('#yearDropdown').val();
    $('#selectedYear').val(year);
    getYearDates();
}

getYearDates();

function getYearDates() {

    var year = $('#yearDropdown').val();

    $.ajax({
        url: "<?php echo site_url('AdminMajalis/getMajalisDatesByYear') ?>",
        type: "GET",
        data: {
            'year': year
        },
        success: function(response){

            $('#majalisDates').html(response);

            var majalisName = $('#majalisName').val();

            $('#majalisNameHeading').html(majalisName + " Majalis");

            // $.fn.editable.defaults.mode = 'inline';

            // $("[name='editMajalis']").editable({
            //     display: false,
            //     success: function(data, config) {
            //         location.reload();
            //     }
            // });


            // isEditAllowed();


        }, error: function(){
            
        }
    });        
}

var setAssignMajalisDutyId = function setAssignMajalisDutyId(id,stars){

    console.log('stars', stars);

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

var currentMajalisId;
var currentDate;

function onDutyAdd() {
    var duty = $('#dutyname').val();
    $('#addDutyModal').modal('toggle');

    $.ajax({
        url: "<?php echo site_url('Majalis/addDuty') ?>",
        type: "POST",
        data: {
            'id': currentMajalisId,
            'duty': duty,
            'date': currentDate
        },
        success: function(response){

            ajaxGetMajalisDuties(currentDate);

        }, error: function(err){
            ajaxGetMajalisDuties(currentDate);
        }
    }); 

}

function addDutyModal(majalisId, date) {
    console.log('date',date);
    $('#addDutyModal').modal('toggle');
    currentMajalisId = majalisId;
    currentDate = date

}

</script>