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
                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('Admin/addNewUser') ?>" method="post" >
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">First Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="firstName" class="form-control" id="" placeholder="" value="<?php echo $_COOKIE['first_uname']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Last Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="lastName" class="form-control" id="" placeholder="" value="<?php echo $_COOKIE['last_uname']; ?>" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Phone</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="phone" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="password" class="form-control" id="" placeholder="" required>
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
