<!-- DataTables -->
<link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard
                    <small >User List Setting</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">User List Setting</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
             
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Users List Setting</h3>
                              
                            </div>
                          
                            <!-- /.box-header -->
                            <!-- form start -->
                          	<form action="<?php echo site_url('Admin/saveTableSettingsData') ?>" method="post" >
                            <div class="box-body">
                           
												          <?php foreach($data['tableData'] as $item) {
                                      $keys = explode(",",$item->key);
                                      $values = explode(",",$item->values);
                                      for($i = 0; $i < count($keys); $i++) {
                                  ?>
																		
                                  <div class="form-group">
                                      <label style="text-transform:capitalize" for="" class="col-sm-2 control-label"><?php echo str_replace( '_' , ' ', $keys[$i]); ?></label>
                                      <div class="col-sm-10">
                                        <input <?php echo in_array( $values[$i], $data['tableDataValues']) ? 'checked' : ''; ?>   name="tableData[]" value="<?php echo $values[$i]; ?>" type="checkbox" class="col-sm-4 " >

                                        <br><br>
                                      </div>
                                  </div>

                                  <?php } 
                                    } ?>

                                  <div class="form-group">
                                      <div class="col-sm-offset-2 col-sm-2">
                                          <input type="hidden" name="controller_name" value="userList" >
                                         <input type="hidden" name="type" value="client" >
                                          <button type="submit" class="btn btn-primary btn-block">Save</button>
                                      </div>
                                  </div>
                            </div>
                          </form>
                            <!-- /.box-body -->
                            <div class="box-footer">
                            </div>
                            <!-- /.box-footer -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
        </div>
        <!-- /.row (main row) -->
        </section><!-- /.content -->
    </div>
    </div>
   


  






		