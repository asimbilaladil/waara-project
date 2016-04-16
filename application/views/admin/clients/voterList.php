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

                    <?php
                    $message = $this->session->userdata('sucess_message');
                    if ($message) {

                        echo "<div class='alert alert-success alert-dismissable'>
                                                             <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                                              <h4>	<i class='icon fa fa-check'></i> Alert!</h4>
                                                                   $message
                                                            </div>";
                        $this->session->unset_userdata('sucess_message');
                    }
                    $message = $this->session->userdata('error_message');
                    if ($message) {

                        echo "<div class='alert alert-danger alert-dismissable'>
                                                             <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                                              <h4>	<i class='icon fa fa-check'></i> Alert!</h4>
                                                                   $message
                                                            </div>";
                        $this->session->unset_userdata('error_message');
                    }
                    ?>

                    <div class="box box-success ">
                        <div class="box-header">
                            <h3 class="box-title">All voter Information</h3>

                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID No.</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Location</th>
                                    <th>Qualification</th>
                                    <th>Aadhar card number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($voter as $v):?>
                                <tr>
                                    <td><?= $v['voter_id'];?></td>
                                    <td><?= $v['voter_name'];?></td>
                                    <td><?= $v['voter_age'];?></td>
                                    <td>
                                    <?php if($v['voter_gender']==1){
                                        echo "Male";
                                    }
                                    else{
                                        echo "Female";
                                    }
                                    ?>
                                    </td>
                                    <td><?= $v['voter_phnNumber'];?></td>
                                    <td><?= $v['voter_email'];?></td>
                                    <td><?= $v['voter_location'];?></td>
                                    <td><?= $v['voter_qualification'];?></td>
                                    <td><?= $v['voter_acNumber'];?></td>
                                    <td>
                                    <?php if($v['voter_status']=="Active"){?>
                                        <a href="<?php echo site_url('Admin/voterIdBlock/'.$v['voter_id'])?>" class="btn btn-success" title="Click for make this ID Block">Active</a>

                                    <?php } else{?>
                                        <a href="<?php echo site_url('Admin/voterIdActive/'.$v['voter_id'])?>" class="btn btn-danger" title="Click for make this ID Active">Block</a>
                                        <?php }?>
                                    </td>

                                    <td>
                                        <a href="<?php echo site_url('Admin/voter_delete/'.$v['voter_id'])?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                        <div class="box-footer no-padding">

                        </div>
                    </div><!-- /. box -->
                </div>

            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div>
</div>