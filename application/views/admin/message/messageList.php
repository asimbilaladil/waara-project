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
                            <h3 class="box-title">All Message</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID No.</th>
                                    <th>From</th>
                                    <th>Subject</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($messages as $val):?>
                                <tr>
                                    <td><?= $val['message_id'];?></td>
                                    <td><?= $val['messages_from'];?></td>
                                    <td><?= $val['messages_subject'];?></td>
                                    <td><?= $val['messages_details'];?></td>
                                    <td>
                                        <a href="<?php echo site_url('Admin/message_delete/'.$val['message_id'])?>" class="btn btn-danger">Delete</a>
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