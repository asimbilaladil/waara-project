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
                            <h3 class="box-title">Add Majalis Dates</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('Majalis/addMajalisDate') ?>" method="post" >
                            <div class="box-body">


                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Date</label>
                                    <div class="col-sm-6">
                                        <input type="date" name="majalisDate" class="form-control" id="" placeholder="" required>
                                        <input type="hidden" name="majalis" class="form-control" id="" placeholder="" value="<?php echo $data['token'] ;?>" >
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
                                <h3 class="box-title">List Of Majalis Dates:</h3>
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
                                        <th> Date</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                            foreach($data['majalis'] as $item) {
                                echo 
                                    '<tr>
                                        <td> <a href="#">'. $item->name .' </a></td>
                                        <td> <a href="#">'. $item->date .' </a></td>
                                        <td> 
                                           
                                           <a href="Majalis/deleteMajalisDate?majalis_id='.$item->id.'" > <span class="glyphicon glyphicon-trash"></span></a>
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
