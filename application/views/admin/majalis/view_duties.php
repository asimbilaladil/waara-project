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
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <!-- <h3 class="box-title"><?php echo !empty($data) ? $data[0]->name : '' ?> </h3>
 -->                            </div>
                            <!-- /.box-header -->

                            <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('majalis/addDuty') ?>" method="post" >
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Duty</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="duty" class="form-control"  placeholder="" required>
                                        </div>
                                    </div>

                                    <input type="hidden" name="token" value="<?php echo $this->input->get('token', TRUE); ?>"/>

                                    <input type="hidden" name="date" value="<?php echo $this->input->get('date', TRUE); ?>"/> 

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-2">
                                            <button type="submit" class="btn btn-primary btn-block">Add</button>
                                        </div>
                                    </div>


                                </div>
                            </form>


                            </br> </br>
                            <div class="box-header with-border">
                                <h3 class="box-title">List Of Duties:</h3>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-4">
                                    <input type="text" name="name" class="form-control" id="search" placeholder="Type to search...">
                                </div>
                            </div>

                            <table class="table table-striped" id="table" width="80%">
                                <thead>
                                    <tr>
                                        <th> Duty </th>
                                        <th> User Fullname </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                <?php 
                                
                                foreach ($data['duties'] as $key => $item) {
                                    echo '<tr>
                                            <td> ' . $item->name . ' </td>
                                            <td> <input type="text" id="users_'. $key .'" name="users" class="form-control  ui-autocomplete-input"> </td>

                                            <td> <button class="btn btn-primary" onclick="openConfirmModal('.$key.', '.$item->id.')">SAVE</button> </td>
                                        </form>
                                    </tr>';
                                }
                                ?> 
<!-- 
                                 <td> <a href="deleteMajalisDuty?token=' . $item->token . '" onclick="return confirm(`Are you sure you want to Delele?`);" > <span class="glyphicon glyphicon-trash"></span></a> </td> -->

                                </tbody>
                            </table>
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

                                        <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirm</h4>
      </div>
          <form action="<?php echo site_url('majalis/assginMajalisDuty') ?>" method="POST">
              <div class="modal-body">
                <p> Are you sure you want to assign this duty? </p>
              </div>
              <input type="hidden" id="selectedUser" name="selectedUser" />
              <input type="hidden" id="selectedDuty" name="selectedDuty" />
              <input type="hidden" id="token" name="token" value="<?php echo $this->input->get('token') ?>"/>
              <input type="hidden" id="date" name="date" value="<?php echo $this->input->get('date') ?>"/>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" />
              </div>
          </form>
    </div>
  </div>
</div>


<script>

    function openConfirmModal(key, dutyId) {
        if($("#users_" + key).val() && $("#selectedUser").val() ) {
            $("#selectedDuty").val(dutyId);
            $('#myModal').modal('toggle');
        }
        
    }

$("[name=users]").autocomplete({

    source : '<?php echo site_url('admin/getUsers') ?>',
    select: function(event, ui) {

        // if(ui.item.value == 'NOUSER') {
        //     $('#addNewUser').modal('toggle');
        //     window.location.href = '<?php echo site_url('admin/addNewUser') ?>';
        // }

        event.preventDefault();
        $('#' + this.id).val(ui.item.label);
        $("#selectedUser").val(ui.item.value);
    },
    focus: function(event, ui) {
        event.preventDefault();
        $('#' + this.id).val(ui.item.label);
    }
});

</script>