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

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Admin</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="defaultForm" name="admin" class="form-horizontal" action="<?php echo site_url('Admin/updateAdmin'); ?>" method="post" >
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="admin_name" class="form-control" id="" placeholder="" value="<?=$admin['admin_name']?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="admin_email" class="form-control" id="" placeholder="" value="<?=$admin['admin_email']?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">
                                        <input type="hidden" name="id" value="<?=$admin['admin_id']?>">
                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                                    </div>
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

<script type="text/javascript">
    $(document).ready(function() {
        // Generate a simple captcha



        $('#defaultForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                admin_name: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'The Name is required and can\'t be empty'
                        }
                    }
                },
                admin_email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required and can\'t be empty'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                admin_status: {
                    validators: {
                        notEmpty: {
                            message: 'The admin status is required and can\'t be empty'
                        }
                    }
                }

            }
        });
    });
</script>
<script type="text/javascript">
    document.forms['admin'].elements['admin_status'].value= "<?php echo $admin->admin_status;?>";
</script>