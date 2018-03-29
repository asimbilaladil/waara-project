<?php
    $item = $data[0];
?>
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
                            <h3 class="box-title">Edit Assign Duty</h3>
                            
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('AdminMajalis/editAssignedDuty') ?>" method="post" >
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Already Assigned User:</label>
                                    <div class="col-sm-6">
                                        <input disabled type="text" value="<?php echo $item->first_name ." ". $item->last_name ?>" name="user" class="form-control" id="user" placeholder="" required>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Assign New User:</label>
                                    <div class="col-sm-6">
                                        <input  type="text" value="" name="user_name" class="form-control" id="user_name" placeholder="" required>
                                        <input type="hidden" id="selectedUser" name="selectedUser" value="<?php echo $data['user']->user_id?>" /> 
                                        <input type="hidden" id="assignId" name="assignId" value="<?php echo  $item->id ?>" />                                       
                                    </div>
                                </div>                               


<!--                                 <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Reason</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="reason" class="form-control" id="reason" placeholder="" required>
                                    </div>
                                </div> -->


                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">

                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                   <div class="col-sm-offset-2 col-sm-2">

                                        <button type="button" onclick="deleteAssignWaara(<?php echo $this->input->get('id') ?>)" class="btn btn-primary btn-block">Delete</button>
                                    </div> 
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                
                            </div><!-- /.box-footer -->
                    </div><!-- /.box -->

                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
                </div>

            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div>
</div>

<script type="text/javascript">
    
    $("#user_name").autocomplete({

    source : '<?php echo site_url('admin/getUsers') ?>',
    select: function(event, ui) {
        event.preventDefault();
        $('#' + this.id).val(ui.item.label);
        $("#selectedUser").val(ui.item.value);
    },
    focus: function(event, ui) {
        event.preventDefault();
        $('#' + this.id).val(ui.item.label);
    }
});

function deleteAssignWaara(id) {

    var assignId = id;
    $.ajax({
        url: "<?php echo site_url('AdminMajalis/deleteAssignDuty') ?>",
        type: "POST",
        data: {
            'id' : assignId
        },
        success: function(response){
          
          window.location = "";
        },
        error: function(error){
         
        }
    });


}
</script>
