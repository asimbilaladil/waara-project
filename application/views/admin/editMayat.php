<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Edit Mayat
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
                            <h3 class="box-title">Edit</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->

                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('SamarMayat/UpdateMayat') ?>" method="post" >
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
                                        <input value="<?php echo $data['mayat']->first_name; ?>" type="text" name="fName" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Last Name</label>
                                    <div class="col-sm-4">
                                        <input value="<?php echo $data['mayat']->last_name; ?>" type="text" name="lName" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Original From</label>
                                    <div class="col-sm-4">
                                        <input value="<?php echo $data['mayat']->original_from; ?>" type="text" name="originallyFrom" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Age</label>
                                    <div class="col-sm-4">
                                        <input value="<?php echo $data['mayat']->age; ?>"type="text" name="age" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Funeral Date</label>
                                    <div class="col-sm-4">
                                        <input value="<?php echo $data['mayat']->funeral_date; ?>" type="date" name="funeralDate" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Date</label>
                                    <div class="col-sm-4">
                                        <input value="<?php echo $data['mayat']->date; ?>"type="date" name="date" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Time</label>
                                    <div class="col-sm-4">
                                        <input value="<?php echo $data['mayat']->time; ?>" type="time" name="time" class="form-control" id="" placeholder="" required>
                                    </div>
                                </div>  
                               <input value="<?php echo $data['mayat']->id; ?>" type="hidden" name="id"> 
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Samar & Ziyarat at</label>
                                    <div class="col-sm-4">
                                      
                                      <select class="form-control" name="jk_id">
                                        <?php foreach( $data['jk'] as $row ) {
                                                    echo '<option '.  ($data['mayat']->jk_id == $row->id ? "selected" : "") .'  value="'. $row->id .'" > '. $row->name .' </option>';
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
