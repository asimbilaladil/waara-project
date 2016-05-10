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
                            <h3 class="box-title">Request</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                                      </br> </br>   
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <input type="text" name="name" class="form-control" id="search" placeholder="Type to search...">

                                    </div>
                                </div>
                                  </br> </br>
                            <table class="table table-striped" id="table" width="80%">
                                <thead>
                                    <tr>
                                        <th> User Name</th>
                                        <th> Request Title</th>
                                         <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                            foreach($data['result'] as $key=> $item) {
                                echo 
                                    '<tr>
                                        <td> <a href="#">'. $item->first_name . ' ' . $item->last_name . ' </a></td>
                                        <td> <a href="#">'. $item->title .' </a></td>
                                        <td> 

                                           <a href="deleteRequest?id='.$item->id.'" > <span class="glyphicon glyphicon-trash"></span></a>
                                         </td>
                                    </tr>';

                            }
                        ?>                                
                                </tbody>
                            </table>    
                            </br>                                
                            </div><!-- /.box-body -->
                 
                    </div><!-- /.box -->
                                            
                        
                        

                    </div>
                    
                </div>

            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div>
</div>
