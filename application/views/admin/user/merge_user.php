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
                                <h3 class="box-title">Users</h3>
                            </div>
                            <!-- /.box-header -->
                            <br>
                            <div class="form-group">
                                <div class="col-sm-offset-0 col-sm-2">
                                    <!-- <button type="button" onclick="location.href='<?php echo site_url("majalis/add") ;?>'" class="btn btn-primary btn-block">Add Majalis</button> -->
                                </div>
                            </div>

                            </br> </br>
                            <div class="box-header with-border">
                                <h3 class="box-title">List Of Users:</h3>
                            </div>

                            <table class="table table-striped" id="table" width="80%">
                                <thead>
                                    <tr>
                                        <th> Username </th>
                                        <th>  </th>
                                        <th> Firstname </th>
                                        <th>  </th>
                                        <th> Lastname </th>
                                        <th>  </th>
                                        <th> Email </th>
                                        <th>  </th>
                                        <th> Phone </th>
                                        <th>  </th>
                                        

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        foreach ($data as $row) {
                                            echo '<tr>
                                                <td>'. $row->username .' </td> 
                                                <td> <input type="radio" name="username"/> </td>
                                                <td>'. $row->first_name .' </td>
                                                <td> <input type="radio" name="firstname"/> </td>
                                                <td>'. $row->last_name .'</td>
                                                <td> <input type="radio" name="lastname"/> </td>
                                                <td>'. $row->email . '</td>
                                                <td> <input type="radio" name="email"/> </td>
                                                <td>'. $row->phone .' </td>
                                                <td> <input type="radio" name="phone"/> </td>
                                            </tr>';
                                        }
                                    ?>
                                                                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.box-footer -->


        </div>
        <!-- /.box -->
    </div>
    </div><!-- /.row (main row) -->
    </section><!-- /.content -->
    </div>
    </div>


