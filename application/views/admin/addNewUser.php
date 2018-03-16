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
                            <h3 class="box-title">Add new User</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('Admin/createNewUser') ?>" method="post" >
                            <div class="box-body">
          
                                        <input type="hidden" name="waara_id" class="form-control" id="" placeholder="" value="<?php echo $_COOKIE['waara_id']; ?>" >
                                        <input type="hidden" name="assign_date" class="form-control" id="" placeholder="" value="<?php echo $_COOKIE['date']; ?>" >


                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">First Name</label>
                                    <div class="col-sm-6">
                                        <input style="text-transform:capitalize;" type="text" name="firstName" class="form-control" id="" placeholder="" value="<?php echo $_COOKIE['first_name'] == undefined ? "": $_COOKIE['first_name']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Last Name</label>
                                    <div class="col-sm-6">
                                        <input style="text-transform:capitalize;" type="text" name="lastName" class="form-control" id="" placeholder="" value="<?php echo $_COOKIE['last_name'] == undefined ? "": $_COOKIE['last_name']; ?>" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email" class="form-control" id="" placeholder="" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Phone</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="phone" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Age Group</label>
                                    <div class="col-sm-6">
                                        <select name="age_group" class="form-control">
                                          <?php foreach($data['ageGroup'] as $item) { ?>
                                          <option  value="<?php echo $item->id ; ?>" > <?php echo $item->age_group ; ?></option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="password" class="form-control" id="" placeholder="" >
                                    </div>
                                </div>
                                                                                             

                                <div class="form-group">
                                  <label for="" class="col-sm-2 control-label">Jamatkhana</label>
                                    <div class="col-sm-6" >

                                        <select name="jks[]" id="jks" multiple="multiple" class="form-control">
                                            <?php
                                                foreach ($data['jks'] as $key => $value) {
                                                    echo '<option value="'. $key .'"> '. $value .' </option>';
                                                }
                                            ?>
                                        </select>   

                                    

                                   
                                    </div>
                                </div> 
                              <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">

                                        <input class="btn btn-primary" type="button" value="Get JamatKhanas" id="getjk" onclick="getDuties();" />        
                                    </div>
                                </div>

                                <div  class="form-group" >
                                     <div class="col-sm-2" >
                                     </div>
                                     <div class="col-sm-6" id="duties">

                                    </div>
                                </div>                              
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">

                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>
                        </form>

                    </div>
                    
                </div>

            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div>
</div>
    <script type="text/javascript">

function getDuties() {
    var jks = $('#jks').val();


    $.post('<?php echo site_url('Welcome/getDuties') ?>', {
        state: jks
    }, function(data) {

        $('#duties').show().html(data);

    });     
}

    </script>