  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
 <script type="text/javascript">

var getIndex = function  getIndex (index){

var data =  <?php  echo json_encode( $data['news']); ?> 

 document.getElementById('title').innerHTML = data[index].title;
 document.getElementById('details').innerHTML = data[index].details;

}

var updateModal = function  updateModal (index){

var data =  <?php  echo json_encode( $data['news']); ?> 

 document.getElementById('editTitle').value = data[index].title;
 document.getElementById('editDetails').innerHTML = data[index].details;

}
    </script>
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
                            <h3 class="box-title">Add Latest News</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('Admin/news') ?>" method="post" >
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="title" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Details</label>
                                    <div class="col-sm-6">
                                    <textarea name="details" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">

                                        <button  type="submit" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>
                        </form>
                                                        
                                </br> </br>
                        <div class="box-header with-border">
                                <h3 class="box-title">List Of Latest News:</h3>
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
                                        <th> Created Date</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                            foreach( $data["news"]  as $key =>  $item) {
                                echo 
                                    '<tr>
                                        <td><a style="cursor: pointer;" onClick="getIndex(' . $key.')" data-toggle="modal" data-target="#viewModal" >  '. $item->title .' </a></td>
                                        <td> '. $item->created_date .' </td>
                                         <td> <a href="deleteNews?id='.$item->id.'" > <span class="glyphicon glyphicon-trash"></span></a>
                                          <span>&nbsp;&nbsp;</span>
                                         <a style="cursor: pointer;" href = "'. site_url('Admin/editNews') .'?id='.$item->id . '">   <span class="glyphicon glyphicon-pencil"></span></a>
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
    <div class="modal fade" id="viewModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">  Latest News </h4>
                </div>
                    <div class="container col-sm-12 ">
                        <div  class="col-sm-12 ">
                            <div class="form-group col-sm-12">
                                </br>
                                <label for="email">Title:</label>   <label id="title" for="email"></label>
                                    </br>
                            <label for="email">Details:</label>   <p id="details" for="email"></p>

                
                </div>
                </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    
