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
                                <h3 class="box-title">View Festival</h3>
                            </div>
                            <!-- /.box-header -->

                            <br>
                            <div class="form-group">
                                <div class="col-sm-offset-0 col-sm-2">
                                    <button type="button" onclick="location.href='<?php echo site_url("Festival/add") ;?>'" class="btn btn-primary btn-block">Add Festival</button>
                                </div>
                            </div>


                            </br> </br>
                            <div class="box-header with-border">
                                <h3 class="box-title">List of Festival:</h3>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <input type="text" name="name" class="form-control" id="search" placeholder="Type to search...">
                                </div>
                            </div>
                            <table class="table table-striped" id="table" width="80%">
                                <thead>
                                    <tr>
                                        <th> Festival Name </th>
                                        <th> January </th>
                                        <th> February </th>
                                        <th> March </th>
                                        <th> April </th>
                                        <th> May </th>
                                        <th> June </th>
                                        <th> July </th>
                                        <th> August </th>
                                        <th> September </th>
                                        <th> October </th>
                                        <th> November </th>
                                        <th> December </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                <?php 
                                foreach ($data['festival'] as $item) {
                                    echo '<tr>
                                        <td> <a href="' . site_url("majalis/detail?token=" . $item["token"]) . '">' . $item["festivalName"] . '</a> </td>
                                        <td> ' . printMonth($item, "January") . ' </td>
                                        <td> ' . printMonth($item, "February") . ' </td>
                                        <td> ' . printMonth($item, "March") . ' </td>
                                        <td> ' . printMonth($item, "April") . ' </td>
                                        <td> ' . printMonth($item, "May") . ' </td>
                                        <td> ' . printMonth($item, "June") . ' </td>
                                        <td> ' . printMonth($item, "July") . ' </td>
                                        <td> ' . printMonth($item, "August") . ' </td>
                                        <td> ' . printMonth($item, "September") . ' </td>
                                        <td> ' . printMonth($item, "October") . ' </td>
                                        <td> ' . printMonth($item, "November") . ' </td>
                                        <td> ' . printMonth($item, "December") . ' </td>
                                    </tr>';
                                }

                                function printMonth($item, $month) {
                                    $str = '';
                                    if (isset($item[$month])) {
                                        foreach($item[$month] as $m) {
                                            $dutyUrl = site_url('majalis/viewMajalisDuties?token=' . $item["token"] .'&date='. $m['completeDate']);
                                            $str = $str . '<a href="'. $dutyUrl .'">'. $m['date'] .'</a> <br>';        
                                        }
                                    } else {
                                        $str =  ' - ';
                                    }
                                    return $str;
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