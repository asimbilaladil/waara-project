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
                            <h3 class="box-title">Add new JK</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('Admin/addJK') ?>" method="post" >
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Location</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="location" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">

                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>
                                                        </form>
                                                        
                                </br> </br>
                        <div class="box-header with-border">
                                <h3 class="box-title">List Of JK:</h3>
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
                                        <th> Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                            foreach($data['JK'] as $item) {
                                echo 
                                    '<tr>
                                        <td> <a href="#">'. $item->name .' </a></td>
                                        <td> <a href="#">'. $item->location .' </a></td>
                                        <td> 
                                            <span class="glyphicon glyphicon-pencil"></span>
                                            <span>&nbsp;&nbsp;</span>
                                           <a href="deleteJK?id='.$item->id.'" > <span class="glyphicon glyphicon-trash"></span></a>
                                         </td>
                                    </tr>';

                            }
                        ?>                                
                                </tbody>
                            </table>                                    
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                
                            </div><!-- /.box-footer -->
                    </div><!-- /.box -->
                                            
                        
                        

                    </div>
                    
                </div>

            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div>
</div>
