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
                                <h3 class="box-title">Users History</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="box-body">
                             <table class="table table-striped">
                                <thead>
                                  <tr>
                                      <th> Name </th>
                                      <th> Duty </th>
                                      <th> Reason </th>
                                      <th> Date </th>
                                  </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php
                                              foreach($data as $row) { 

                                                  echo '<tr>
                                                                      <td> '. $row->first_name .' </td>
                                                                      <td> '. $row->name .' </td>
                                                                      <td> '. $row->reason .' </td>
                                                                      <td> '. $row->start_date .' </td>
                                                                  </tr>';

                                              }
                                            ?>                                
                                    </tbody>
                                </table>
                            </div>
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
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">  User Role</h4>
                </div>
                <form method="Post" action="<?php echo site_url('admin/addUserRole') ?>">
                    <div class="container col-sm-12 ">
                        <div  class="col-sm-12 ">
                            <div class="form-group col-sm-12">
                                </br>
                                <label for="email">Select User Role:</label>
                                <div  class="col-sm-12 ">
                                    <select id="role" name="type"   class="form-control" onchange="showJK()" >
                                        <option value="Super Admin"> Super Admin </option>
                                        <option value="JK Admin"> JK Admin </option>
                                        <option value="User"> User </option>
                                    </select>
                                    </br>
                                    <div style="display:none" id="jkdiv">
                                    <select style="display:none" id="jkList" name="jk_id"  class="form-control">
                                    <?php
                                        foreach($data['jk'] as $item) {
                                            echo '<option value="'. $item->id.'"> '. $item->name. '</option>';
                                        }
                                        ?> 
                                    </select> 
                                    </br>
                                 <select style="display:none" id="shiftList" name="shift_id"  class="form-control">
                                        
                                        <option value="1">Evening</option>
                                        <option value="2">Morning</option>
                            
                                    </select> 
                                    </br>                                    
                                      </div>
                                    <input name="userId"  type="hidden" id="userId">                                         
                                    <button type="submit"  class="btn btn-primary btn-block">Save</button>
                                </div>
                </form>
                </div>
                </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
   