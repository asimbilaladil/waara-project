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
                            <h3 class="box-title">All Candidate Information</h3>
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
                                    <th>Catagory</th>
                                    <th>Qualification</th>
                                    <th>No.Case</th>
                                    <th>Aadhar card number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($candidate as $can):?>
                                <tr>
                                    <td><?= $can['candidate_id'];?></td>
                                    <td><?= $can['candidate_name'];?></td>
                                    <td><?= $can['candidate_age'];?></td>
                                    <td><?= $can['candidate_gender'];?></td>
                                    <td><?= $can['candidate_phoneNo'];?></td>
                                    <td><?= $can['candidate_email'];?></td>
                                    <td><?= $can['cat_name'];?></td>
                                    <td><?= $can['candidate_qualifaction'];?></td>
                                    <td><?= $can['candidate_noCase'];?></td>
                                    <td><?= $can['candidate_acNumber'];?></td>
                                    <td>
                                        <?php if($can['candidate_status']=="Active"){?>
                                            <a href="<?php echo site_url('Admin/candidateBlock/'.$can['candidate_id'])?>" class="btn btn-success" title="Click for make this ID Block">Active</a>

                                        <?php } else{?>
                                            <a href="<?php echo site_url('Admin/candidateActive/'.$can['candidate_id'])?>" class="btn btn-danger" title="Click for make this ID Active">Block</a>
                                        <?php }?>
                                    </td>

                                    <td>
                                        <a href="<?php echo site_url('Admin/candidateDelete/'.$can['candidate_id'])?>" class="btn btn-danger">Delete</a>
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