

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
                        <form name="assignDuty" id="defaultForm" class="form-horizontal" action="<?php echo site_url('Admin/assign_duty') ?>" method="post" onsubmit="return validateForm()">
                            <div class="box-body">
                        <div class="col-sm-12">

  <div class="form-group">
                                  <div class="col-sm-4">

    <label >Duty:</label>
                           <select id="duty" name="duty" onchange="selctcity()"  class="form-control">
                                        <option value="0"> Select Duty </option>
                                        <?php
                                            foreach($data['duty'] as $row) {

                                                echo '
                                                <option value="'. $row->duty_id .'" > '. $row->name .' </option>';

                                            }
                                        ?>
                                    </select> 
                                    </div>
                                  <div class="col-sm-4">

    <label >Jamatkhana:</label>
           <select name="jk" id="jk"  class="form-control" >
                                    <option value=""> Select Jamatkhana  - </option>
                                    </select>    </div>
  </div>
 
</div>
                          


                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-sm-4">

                                    <input type="text" name="name" class="form-control" id="search" placeholder="Type to search...">

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
                                        <td> <input type="hidden" name="userid" value="'.$item->user_id.'" />  <input type="submit" value ="Assign"/> </a></td>
                                    </tr>';

                            }
                        ?>                                
                                </tbody>
                            </table>
                    </div>
                      </div><!-- /.box-body -->
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
   var validateForm =  function () {
        var duty = document.forms["assignDuty"]["duty"].value;
        var jk = document.forms["assignDuty"]["jk"].value;
        if (duty == 0 || jk == "") {
            return false;
        }
    }
    function selctcity() {
   var state=$('#duty').val();

        $.post('<?php echo site_url('Admin/ajaxJk') ?>', {
            state:state
        }, function(data) {
        
            $('#jk').html(data);

        }); 

}
</script>