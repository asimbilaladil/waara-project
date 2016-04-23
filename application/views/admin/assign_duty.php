

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

        <?php
            if( isset($data['message']) ) {
                echo '<script>alert("DATA")</script>';
                echo "<div style='text-align: center;' class='alert alert-success alert-dismissable'>
                                                         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>"
                                                               .$data['message'].
                                                        "</div>";                
            } 
        ?>

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Assign Duty</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('Admin/assign_duty') ?>" method="post" >
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="" class="col-sm-1 control-label">Duty:</label>
                                    <div class="col-sm-2">
                                    <!-- Select for Duty -->
                                    <select class="btn btn-default dropdown-toggle" id="duty" name="duty" onchange="selctcity()">
                                        <option value="0"> Select Duty </option>
                                        <?php
                                            foreach($data['duty'] as $row) {

                                                echo '
                                                <option value="'. $row->duty_id .'" > '. $row->name .' </option>';

                                            }
                                        ?>
                                    </select> <!-- Select end for Duty -->

                                    <!-- Select for Jk -->
                                    <select class="btn btn-default dropdown-toggle" name="jk" id="jk" class="option3" >
                                    <option value=""> Select Jamatkhana  - </option>
                                     <!-- Select end for JK -->

                                    </div>
                                </div>
                            </div><!-- /.box-body -->


                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="name" class="form-control" id="search" placeholder="Type to search...">

                                </div>
                            </div>
                            <table class="table table-striped" id="table" width="80%">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php

                        
                            foreach($data['users'] as $item) {
                                echo 
                                    '<tr>
                                        <td> <a href="assignment?id='. $item->user_id .'">'. $item->first_name .' </a></td> 
                                        <td> <a href="#">'. $item->last_name .' </a></td>
                                        <td> <a href="#">'. $item->email .' </a></td>
                                        <td> <a href="#">'. $item->phone .' </a></td>
                                        <td> <input type="hidden" name="userid" value="'.$item->user_id.'" />  <input  type="submit" value ="Assign" class="btn btn-info"  /> </a></td>
                                    </tr>';

                            }
                        ?>                                
                                </tbody>
                            </table>
                    </div>
                            <div class="box-footer">

                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
                </div>

            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div>
</div>


<script>
    function selctcity() {
   var state=$('#duty').val();

        $.post('<?php echo site_url('Admin/ajaxJk') ?>', {
            state:state
        }, function(data) {
        
            $('#jk').html(data);

        }); 

}
</script>