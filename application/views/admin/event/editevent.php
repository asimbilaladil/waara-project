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

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit event information</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form name="defaultForm" id="defaultForm" class="form-horizontal" action="<?php echo site_url('Admin/updateEvent') ?>" method="post" >
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="event_title" class="form-control" id="" placeholder="" value="<?php echo $events['event_title']?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" rows="3" name="event_description"><?php echo $events['event_description']?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="category_id">
                                            <option value="">Select</option>
                                            <?php foreach($category as $cat):?>
                                                <option value="<?php echo $cat['cat_id']?>"><?php echo $cat['cat_name']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Start Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="event_startDate" class="form-control datepicker" value="<?php echo $events['event_startDate']?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">End Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="event_endDate" class="form-control datepicker"value="<?php echo $events['event_endDate']?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">
                                        <input type="hidden" name="id" value="<?php echo $events['event_id']?>">
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
<script>
    $(function() {
        $( ".datepicker" ).datepicker();
    });
    document.forms['defaultForm'].elements['category_id'].value= "<?php echo $events['category_id'];?>";

</script>
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
                event_title: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'The title is required and can\'t be empty'
                        }
                    }
                },
                event_description: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'The description is required and can\'t be empty'
                        }
                    }
                },
                category_id: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'The category is required and can\'t be empty'
                        }
                    }
                },
                event_startDate: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'The start date is required and can\'t be empty'
                        }
                    }
                },
                event_endDate: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'The end date is required and can\'t be empty'
                        }
                    }
                }

            }
        });
    });
</script>