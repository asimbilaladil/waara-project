<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo $data['type']; ?>
                <small >Add New</small>
            </h1>

           
        </section>
        <!-- Main content -->
        <section class="content">

   

            <!-- Main row -->
            <div class="row">
              
                <div class="col-md-12">

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add New</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                      
                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('SamarMayat/SaveMayat') ?>" method="post" >
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-4">
                                      <select class="form-control" name="title">
                                        <option value="Mr" >Mr</option>
                                        <option value="Mrs" >Mrs</option>
                                        <option value="Ms" >Ms</option>
                                        <option value="Miss" >Miss</option>
                                        <option value="Master" >Master</option>
                                        <option value="Dr" >Dr</option>
                                      </select>
                                    </div>
                                </div>   
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">First Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="fName" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Last Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="lName" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Original From</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="originallyFrom" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Age</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="age" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Funeral Date</label>
                                    <div class="col-sm-4">
                                        <input type="date" name="funeralDate" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Date</label>
                                    <div class="col-sm-4">
                                        <input type="date" name="date" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Time</label>
                                    <div class="col-sm-4">
                                        <input type="time" name="time" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>  
                               <input value="<?php echo $data['type']; ?>" type="hidden" name="type"> 
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Samar & Ziyarat at</label>
                                    <div class="col-sm-4">
                                      <select class="form-control" name="jk_id">
                                        <?php foreach( $data['jk'] as $row ) {
                                                    echo '<option value="'. $row->id .'" > '. $row->name .' </option>';
                                                }
                                        ?>
                                      </select>
                                    </div>
                                </div>                               

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">

                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>
                        </form>
                                                        
                               


                                  
                            </div><!-- /.box-body -->

                    </div><!-- /.box -->
                                      
                        
                        

                    </div>
                    
                </div>

            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div>
</div>
<script>
$('.main-header').hide();
$( "body" ).removeClass( "sidebar-mini" ).addClass( "sidebar-collapse" );

 
</script>
