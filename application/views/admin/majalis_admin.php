<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Dashboard
                    <small >Control panel</small>
                </h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- TABLE DIV -->
                        <div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Majalis Dates</h3>
                                </div>
                                <table class="table table-striped" id="table" width="80%">
                                    <thead>
                                        <tr>
                                            <th> Date </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <?php
                                        foreach ($data['majalisDates'] as $row) {
                                            echo '<tr> 
                                                <td> <a onclick="ajaxGetMajalisDuties(`'. $row->date .'`)">'. $row->date .' </a></td>
                                                
                                            </tr>';
                                        }
                                        
                                        ?>
                                </table>
                            </div>  
                        </div>
                        <!-- START -->
                        <form action="<?php echo site_url('AdminMajalis/assignDuty') ?>" method="post" >

                            <div class="col-md-6 majalisBox" id="majalisDuty">

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

                        <!-- END -->
                    </div>
                </div>
        </div>
    </div>
    </section>
    </div>
    </div>




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

   console.log(state);

    $.post('<?php echo site_url('Admin/ajaxUserHistory') ?>', {
        state:state
    }, function(data) {

        $('#userHistoryForMajalis').show().html(data);

    }); 

} 


</script>