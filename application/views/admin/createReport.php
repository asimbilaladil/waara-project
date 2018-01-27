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

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Report</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('admin/addDuty') ?>" method="post" >
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Select JK</label>
                                    <div class="col-sm-6">
                                    <select onchange="getAllDuty()" name="jk[]"  id="jk" class="form-control">  
                                    <option value="select"> Select JK</option>
                                    <?php foreach($data['jk'] as $item) { ?>   
                                        <option value="<?php echo $item->id; ?>" > <?php echo $item->name; ?> </option>
                                    <?php } ?>
                                    </select>                                                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Select Waara</label>
                                    <div class="col-sm-6">
                                    <select onchange="setReportName()" multiple name="duty[]"  id="duty" class="form-control">  
                                    </select>                                   
                                    </div>
                                </div>  
                                <div  class="form-group"  >
                                    <label for="" class="col-sm-2 control-label">Report Name</label>
                                    <div class="col-sm-6">
                                        <input id="report_name" type="text" name="report_name" class="form-control" >
                                    </div>
                                </div>                                                              
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">

                                        <button type="button" onclick="saveReport()" class="btn btn-primary btn-block">Create</button>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->

                    </div><!-- /.box -->

                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
                </div>

            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div>
</div>
<script type="text/javascript">
    var selectedDuties = [];
    function getAllDuty() {

       var state = $('#jk').val();

        $.ajax({
            url: "<?php echo site_url('Report/getDutyFromJk') ?>",
            type: "POST",
            data: {
                'state' : state
            },
            success: function(response){
               $('#duty').html(response);
            },
            error: function(){
                
            }
        });
    }
    function getReportData(){
        var reportDate = $('#reportDate').val();
        if( reportDate != 'select' ){
            $.ajax({
                url: "<?php echo site_url('Report/getReport') ?>",
                type: "POST",
                data: {
                    'duties' : selectedDuties,
                    'date' : reportDate
                },
                success: function(response){
                    $('#reportResult').show();
                    $('#tableData').html(response);

                },
                error: function(){
                    
                }
            });            
        } else {
            $('#reportResult').hide();
        }
    }
    function createReport() {

       var jk = $('#jk').val();
       var duties = $('#duty').val();
       var start_date = $('#start_date').val();
       var end_date = $('#end_date').val();
       if( (duties !== null) && (start_date !== '') && (end_date !== '') ){
            $.ajax({
                url: "<?php echo site_url('Report/addReport') ?>",
                type: "POST",
                data: {
                    'jk' : jk,
                    'duties' : duties,
                    'start_date' : start_date,
                    'end_date' : end_date
                },
                success: function(response){
                    $('#reportDate').html(response);
                    var length = $('#reportDate > option').length;
                    if(length > 0){
                        $('#reportAfterResult').show();
                    }
                    selectedDuties = duties;
                },
                error: function(){
                    
                }
            });
       } else {
            $('#reportAfterResult').hide();
       }
    } 
    function setReportName(){
        var name = "";    
        $("#duty option:selected").each(function () {    
            name += $(this).text() + "_";    
        }); 
        var name_length = name.length;
        name = name.substring(0, name_length-1);
        $('#report_name').val(name);
    }

    function saveReport(){
        
        var reportName = $('#report_name').val();
        var duties = $('#duty').val();
        var jk = $('#jk').val();

        if( (reportName !== null ) && ( reportName !== '' ) ){
            $.ajax({
                url: "<?php echo site_url('Report/saveReport') ?>",
                type: "POST",
                data: {
                    'duties' : duties,
                    'name' : reportName,
                    'jk' : jk
                },
                success: function(response){
                    alert("Report save successfully");
                },
                error: function(){
                    
                }
            });  
        }      

    }   
</script>