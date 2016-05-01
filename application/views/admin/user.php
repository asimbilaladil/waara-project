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
                                <h3 class="box-title">Users</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <input type="text" name="name" class="form-control" id="search" placeholder="Type to search...">
                                    </div>
                                </div>
                                </br> </br>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                    </div>
                                </div>
                                <table class="table table-striped" id="table" width="80%">
                                    <thead>
                                        <tr>
                                            <th> Name</th>
                                            <th> Email</th>
                                            <th> Type</th>
                                            <th> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($data['user'] as $item) {
                                                echo 
                                                    '<tr>
                                                        <td> <a href="#">'. $item->first_name .' </a></td>
                                                        <td> <a href="#">'. $item->email .' </a></td>
                                                        <td> <a href="#">'. $item->type .' </a></td>
                                                        <td> 
                                                            <a href="'. site_url('admin/edituser?uid=' . $item->user_id ) .'" ><span class="glyphicon glyphicon-pencil"></span> </a>
                                                            <span>&nbsp;&nbsp;</span>
                                                           <a href="deleteUser?id='.$item->user_id.'" > <span class="glyphicon glyphicon-trash"></span></a>
                                                           <span>&nbsp;&nbsp;</span>
                                                            <a onClick="getId(' . $item->user_id .')" data-toggle="modal" data-target="#myModal" > <span  class="glyphicon glyphicon-user"></span></a>
                                                         </td>
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
    <script type="text/javascript">
        var getId = function (id){
            console.log("id",id);
            document.getElementById("userId").value = id;
        
        }
        var showJK = function (){
            var role = document.getElementById("role").value;
            if(role == "JK Admin"){
                document.getElementById("jkList").style.display = "block";
                document.getElementById("jkdiv").style.display = "block";
                
        
            } else {
                document.getElementById("jkList").style.display = "none";
                document.getElementById("jkdiv").style.display = "none";
                document.getElementById("jkList").value = "0";
            }
        
        }
        
    </script>