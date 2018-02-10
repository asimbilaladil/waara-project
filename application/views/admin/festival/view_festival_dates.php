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
                                <h3 class="box-title"><?php echo !empty($data) ? $data[0]->festival : '' ?> </h3>
                            </div>
                            <!-- /.box-header -->

                                <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('festival/addFestivalDate') ?>" method="post" >
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Date</label>
                                            <div class="col-sm-6">
                                                <input type="date" name="date" class="form-control"  placeholder="" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-2">
                                                <button type="submit" class="btn btn-primary btn-block">Add</button>
                                            </div>
                                        </div>

                                        <input type="hidden" name="token" value="<?php echo $this->input->get('token', TRUE); ?>"/>

                                    </div>
                                </form>


                            </br> </br>
                            <div class="box-header with-border">
                                <h3 class="box-title">List Of Festival Date:</h3>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-4">
                                    <input type="text" name="name" class="form-control" id="search" placeholder="Type to search...">
                                </div>
                            </div>

                            <table class="table table-striped" id="table" width="80%">
                                <thead>
                                    <tr>
                                        <th> Date </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                <?php 
                                
                                // foreach ($data as $key => $item) {
                                //     echo '<tr>
                                //         <td> <a href="#" id="date" name="editDate" data-type="date" data-pk="' . $item->dateId .'" data-url="editMajalisDate" data-title="Select date">' . $item->date . '</a> </td>
                                //         <td> <a href="deleteMajalidDate?token=' . $item->festivalDateToken . '" onclick="return confirm(`Are you sure you want to Delele?`);" > <span class="glyphicon glyphicon-trash"></span></a> </td>
                                //     </tr>';

                                foreach ($data as $key => $item) {
                                    echo '<tr>
                                        <td> <a href="'. site_url('festival/viewFestivalDuties?token=' . $item->token .'&date=' . $item->date) .'">' . $item->date . '</a> </td>
                                        <td> <a href="deleteFestivalDate?token=' . $item->festivalDateToken . '" onclick="return confirm(`Are you sure you want to Delele?`);" > <span class="glyphicon glyphicon-trash"></span></a> </td>
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
                </form>
        </div>
        <!-- /.box -->
    </div>
    </div><!-- /.row (main row) -->
    </section><!-- /.content -->
    </div>
    </div>

<script>
// $(function(){
//     $("[name='editDate']").editable({
//         format: 'yyyy-mm-dd',    
//         viewformat: 'yyyy-mm-dd',    
//         datepicker: {
//                 weekStart: 1
//            }
//         });
// });

</script>       