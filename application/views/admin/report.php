<style>
 @media only screen and (max-width: 576px) {
		.enableScroll{
			 	position: relative; 
				overflow-x: scroll;
		}

	} 
</style>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Report <small >Control panel</small> </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Report</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">



                        <!-- form start -->

                            <div class="box-footer">
                  

                                                   
                        <div  class="box-header with-border" >
                                <h3 class="box-title">Find Report:</h3>
                        </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <input type="text" name="name" class="form-control" id="search" placeholder="Type to search...">

                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-6 col-sm-2">
                                            <a href="<?php echo site_url('report/createReport') ?>"><button type="button" class="btn btn-primary btn-block">Create</button></a>

                                        </div>                                    
                                    </div>
                                </div>
                              <div class="enableScroll">
                            <table class="table table-striped" id="table" width="80%">
                                <thead>
                                    <tr>
                                        <th> Name</th>
 <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach($data['report'] as $item) {
                                        echo 
                                            '<tr>
                                                <td> <a href="'. site_url('report/viewReport?id=' . $item->id ) .'">'. $item->name .' </a></td><td> 
                                           <a href="Report/delete?id='.$item->id.'" > <span class="glyphicon glyphicon-trash"></span></a>
                                         </td>
                                            </tr>';

                                    }
                                ?>                                
                                </tbody>
                            </table> 
                              </div>

<!-- /.box-body -->
                             </div> 
                            <div class="box-footer">
                                
                            </div><!-- /.box-footer -->
                    </div><!-- /.box -->

                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
                </div>

            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div>
</div>

