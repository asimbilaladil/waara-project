<style>
  .labelAlign{
     text-align:  left;
    padding-left: 20px;

  }

</style>
<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
      
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
                                            <label for="" class="col-sm-2  labelAlign">Date</label>
                                            <div class="col-sm-3">
                                                <input type="date" name="date" class="form-control"  placeholder="" required>
                                            </div>
                                         <div class=" col-sm-2">
                                                <button type="submit" class="btn btn-primary btn-block">Add</button>
                                            </div>                                            
                                        </div>

                                 

                                        <input type="hidden" id="token" name="token" value="<?php echo $this->input->get('token', TRUE); ?>"/>

                                    </div>
                                </form>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Override evening JK schedule</label>
                                <div class="col-sm-6">
                                    <input type="checkbox" id="override" name="override" value="1" <?php echo !empty($data[0]->override) ? 'checked' : '' ?> >
                                </div>
                            </div>  

                          
                            <div class="box-header with-border">
                  </br> </br>
                            </br> </br>                                
                                <h3 class="box-title">List Of Festival Date:</h3>
                            </div>

                        

                            <table class="table table-striped" id="table" width="80%">
                                <thead>
                                    <tr>
                                        <th style="width: 35%;"> Date </th>
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
                                        <td> <a href="deleteFestivalDate?token=' . $item->festivalDateToken . '" onclick="return confirm(`Are you sure you want to Delele?`);" > <span class="glyphicon glyphicon-trash"></span></a>
                                        &nbsp;&nbsp;
                                        <a href="#" id="date_'.$key.'" name="editDate"  data-type="date" data-pk="'. $item->dateId .'" data-url="'. site_url("majalis/editFestivalDate") .'" data-title="Select date" data-value="'. $item->date .'" ><span class="glyphicon glyphicon-pencil"></span></a> 
                                        
                                        
                                        </td>


                                                                               
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

$('#override').click(function(){
        if($(this).is(':checked')){
            override(1);
        } else {
            override(0);
        }
    });


function override(override) {

    var token = $('#token').val();

    $.ajax({
        url: "<?php echo site_url('Festival/editFestival') ?>",
        type: "POST",
        data: {
            'override': override,
            'token': token
    },
    success: function(response) {
    }

    });
}


$(function(){
    $("[name='editDate']").editable({
        format: 'yyyy-mm-dd',    
        viewformat: 'yyyy-mm-dd',
        display: false,    
        datepicker: {
            weekStart: 1
        },
        success: function (data, config) {
            location.reload();
        }
    });
});

</script>       