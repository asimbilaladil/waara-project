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

                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="" class="col-sm-2  labelAlign">Date</label>
                                            <div class="col-sm-3">
                                                <input type="date" id="date" name="date" class="form-control"  placeholder="" required>
                                            </div>
                                         <div class=" col-sm-2">
                                                <button type="button" onclick="addDate()" class="btn btn-primary btn-block">Add</button>
                                            </div>                                            
                                        </div>

                                 

                                        <input type="hidden" id="token" name="token" value="<?php echo $this->input->get('token', TRUE); ?>"/>

                                    </div>
                                

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
                                <tbody id="datesTable">
                                    

                                    
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

getFestivalDates();

function getFestivalDates() {

    var token = $('#token').val();

    $.ajax({
        url: "<?php echo site_url('Festival/getFestivalDates') ?>",
        type: "GET",
        data: {
            'token': token
        },
        success: function(response){
            $('#datesTable').html(response);
        },
        error: function(){
            
        }
    });

}  

function addDate() {

    var date = $('#date').val();
    var token = $('#token').val();

    $.ajax({
        url: "<?php echo site_url('Festival/addFestivalDate') ?>",
        type: "POST",
        data: {
            'date': date,
            'token': token
        },
        success: function(response){
            getFestivalDates();
        },
        error: function(){
            
        }
    });

}    

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