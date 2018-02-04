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
                <h3 class="box-title">Add new Festival</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('Festival/addFestival') ?>" method="post" >
                <div class="box-body">

                    <!-- 1st Page -->
                    <div id="page1">

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" name="festivalName" class="form-control"  placeholder="" required>
                            </div>
                        </div>
                        <div id="dutiesDiv">
                            <div id="dutyDiv_1" class="form-group">
                                <label for="" class="col-sm-2 control-label">Duty 1</label>
                                <div class="col-sm-6">
                                    <input type="text" name="duties[0]" class="form-control" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-2">
                                <button type="button" onclick="removeDuty();" class="btn btn-primary btn-block">Remove Duty</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-2">
                                <button type="button" onclick="addDutyClick();" class="btn btn-primary btn-block">Add Duty</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-2">
                                <button type="button" onClick="next()" class="btn btn-primary btn-block">Next</button>
                            </div>
                        </div>                        

                    </div>

                    <div id="page2" style="display: none;">


                        <div id="datesDiv" >
                            <div class="form-group" id="dateDiv_1">
                                <label for="" class="col-sm-2 control-label">Date 1</label>
                                <div class="col-sm-6">
                                    <input type="date" name="festivalDate[1]" class="form-control"  placeholder="" required>
                                </div>
                            </div>
                        </div>                     

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-2">
                                <button type="button" onclick="removeDate();" class="btn btn-primary btn-block">Remove Date</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-2">
                                <button type="button" onclick="addDate();" class="btn btn-primary btn-block">Add Date</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-2">
                                <button type="button" onClick="prev()" class="btn btn-primary btn-block">Previous</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-2">
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </div>                        

                    </div>

                </div>    
            </form>
            </br> </br>
            </div>
    
                <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
    </div>
    </div>
<script type="text/javascript">

    var dutyCount = 1;
    var dateCount = 1;

    function test() {
      console.log('inside');
    }
    
    function removeDuty() {
      
      if(dutyCount > 0) {
        $("#dutyDiv_" + dutyCount).remove();
        dutyCount--;
      }
    }
    
    function addDutyClick() {
    
      dutyCount++;
    
      var dutyHtml = `<div id="dutyDiv_` + dutyCount + `" class="form-group">
                        <label for="" class="col-sm-2 control-label">Duty ` + dutyCount + `</label>
                        <div class="col-sm-6">
                          <input type="text" name="duties[` + dutyCount + `]" class="form-control" placeholder="" required>
                        </div>
                      </div>`;
    
      $('#dutiesDiv').append(dutyHtml);
      
    }
    
    function addDate() {

        dateCount++;

        var dateHtml = `<div class="form-group" id="dateDiv_` + dateCount + `">
                            <label for="" class="col-sm-2 control-label">Date ` + dateCount + `</label>
                            <div class="col-sm-6">
                                <input type="date" name="festivalDate[` + dateCount + `]" class="form-control"  placeholder="" required>
                            </div>
                        </div>`;

        $('#datesDiv').append(dateHtml);

    }

    function removeDate() {
      if(dateCount > 0) {
        $("#dateDiv_" + dateCount).remove();
        dateCount--;
      }        
    }

    function next() {
      $("#page1").hide();
      $("#page2").show();
    }

    function prev() {
      $("#page1").show();
      $("#page2").hide();        
    }
    
    
</script>