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
                            <h3 class="box-title">Add new Duty</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('majalis/addWaara') ?>" method="post" >
                            <div class="box-body">
                                <input type="hidden" name="majalis_token" value="<?php echo $data['majalis_token']; ?>" class="form-control" id="" placeholder="" required>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="duty_name" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Add Before</label>
                                    <div class="col-sm-6">
                                        
                                        <select id="beforeDuty" name="beforeDuty" class="form-control">
                                            
                                            <?php
                                                $lastPriority = end($data['waara'])->priority + 1 ;

                                                //$lastPriority = array_pop($data['duty'])->priority + 1;

                                                echo '<option value="'. $lastPriority  .'" selected> </option>'; 

                                                foreach( $data['waara'] as $row ) {
                                                    echo '<option value="'. $row->priority .'" > '. $row->name .' </option>';
                                                }



                                            ?>

                                        </select>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-6">
                                        <textarea type="text" name="description" class="form-control" id="" placeholder="" required >  
                                        </textarea>
                                    </div>
                                </div>   

                                <input type="hidden" name="addDutyDate" value="<?php echo isset( $_COOKIE['addDutyDate'] ) ?  $_COOKIE['addDutyDate']  : 'all' ?>"/>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">

                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">




                                </br> </br>
                        <div class="box-header with-border">
                                <h3 class="box-title">List Of Waara:</h3>
                            </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <input type="text" name="name" class="form-control" id="search" placeholder="Type to search...">

                                    </div>
                                </div>
                            <table class="table table-striped" id="table" width="80%">
                                <thead>
                                    <tr>
                                        <th> Name</th>
                                        <th> Description</th>
                                        <th> Status</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                            foreach($data['waara'] as $item) {
                                
                            $template =  '<tr>
                                        <td> <a href="#">'. $item->name .' </a></td>
                                        <td> <a href="#">'. $item->description .' </a></td>';
                                              
                              echo $template =   $template . '</tr>';

                            }
                        ?>                                
                                </tbody>
                            </table>                                    
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                
                            </div><!-- /.box-footer -->
                    </div><!-- /.box -->

                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
                </div>

            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div>
</div>
