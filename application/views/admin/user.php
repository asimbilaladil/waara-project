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
                        </div><!-- /.box-header -->
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
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                            foreach($data['user'] as $item) {
                                echo 
                                    '<tr>
                                        <td> <a href="#">'. $item->first_name .' </a></td>
                                        <td> <a href="#">'. $item->email .' </a></td>
                                        <td> 
                                            <span class="glyphicon glyphicon-pencil"></span>
                                            <span>&nbsp;&nbsp;</span>
                                           <a href="deleteJK?id=" > <span class="glyphicon glyphicon-trash"></span></a>
                                           <span>&nbsp;&nbsp;</span>
                                            <a data-toggle="modal" data-target="#myModal" > <span class="glyphicon glyphicon-user"></span></a>
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
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">  User Role</h4>

        </div>
        <div class="container col-sm-12 ">
        <div  class="col-sm-12 ">
         <div class="form-group col-sm-12">
         </br>
      <label for="email">Select User Role:</label>

<select id="duty" name="duty" onchange="selctcity()"  class="form-control">
                           <option value=""> Super Admin </option>
                           <option value=""> JK Admin </option>
                           <option value=""> User </option>
                           </select>    </div>


    </div>

   
                           
         


        </div>
        <div class="modal-footer">
        </div>
      </div>
      
    </div>
  </div>

