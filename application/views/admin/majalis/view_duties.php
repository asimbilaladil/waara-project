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
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    
                                <?php 
                                
                                foreach ($data['duties'] as $key => $item) {
                                    echo '<tr>
                                        <td> <a href="#" name="editDuty" data-type="text" data-pk="'. $item->id .'" data-url="editMajalisDuty" > ' . $item->name . '</a> </td>
                                        <td> <a href="deleteMajalis?token=' . $item->token . '" onclick="return confirm(`Are you sure you want to Delele?`);" > <span class="glyphicon glyphicon-trash"></span></a> </td>
                                    </tr>';
                                }
                                ?> 

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

<script>
$(function(){
    $.fn.editable.defaults.mode = 'inline';

    $("[name='editDuty']").editable({
        // success: function(data, config) {
        //     location.reload();
        // }
    });

});
</script>