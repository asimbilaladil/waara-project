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
                                <h3 class="box-title">Majalis/Festival</h3>
                            </div>
                            <!-- /.box-header -->
                            <br>
                            <div class="form-group majalisForm">
                                <div class="col-sm-offset-0 col-sm-2">
                                    <button type="button" onclick="location.href='<?php echo site_url("majalis/add") ;?>'" class="btn btn-primary btn-block">Add Majalis</button>
                                </div>
                            </div>

                            </br> </br>
                            <div class="box-header with-border">
                                <h3 class="box-title">List Of Majalis:</h3>
                            </div>
  <div class="form-group">
                                <div class="col-sm-4">
                                    <select required="" name="years" id="yearDropdown" onchange="onYearChange(this)" class="form-control">
                                        <?php
                                            $years = $data["years"];
                                            foreach ($years as $key => $value) {
                                                echo '<option value"'. $value->year .'"> '.$value->year.' </option>';
                                            }
                                        ?>
                                    </select>

                                    <input type="hidden" value="<?php echo $years ? $years[0]->year : 0 ?>" id="selectedYear"/>

                                </div>
    </div>
              
 <br> <br> <br>
 <div style="overflow-x:auto;">
                            <table class="table table-striped" id="table" width="80%">
                                <thead>
                                    <tr>
                                        <th> Majalis Name </th>
                                        <th> January </th>
                                        <th> February </th>
                                        <th> March </th>
                                        <th> April </th>
                                        <th> May </th>
                                        <th> June </th>
                                        <th> July </th>
                                        <th> August </th>
                                        <th> September </th>
                                        <th> October </th>
                                        <th> November </th>
                                        <th> December </th>
                                        <th> Actions </th>

                                    </tr>
                                </thead>
                                <tbody id="majalisData">
                                                                        
                                </tbody>
                            </table>
                  </div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.box-footer -->




                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">
<!--                             <div class="box-header with-border">
                                <h3 class="box-title">View Festival</h3>
                            </div> -->
                            <!-- /.box-header -->

                            <br>
                            <div class="form-group">
                                <div class="col-sm-offset-0 col-sm-2">
                                    <button type="button" onclick="location.href='<?php echo site_url("Festival/add") ;?>'" class="btn btn-primary btn-block">Add Festival</button>
                                </div>
                            </div>


                            </br> </br>
                            <div class="box-header with-border">
                                <h3 class="box-title">List of Festival:</h3>
                            </div>
                            <div class="col-sm-4">
                                <select required="" name="festivalYears" id="festivalYearDropdown" onchange="onFestivalYearChange(this)" class="form-control">
                                    <?php
                                        $festivalYears = $data["festivalYears"];
                                        foreach ($festivalYears as $key => $value) {
                                            echo '<option value"'. $value->year .'"> '.$value->year.' </option>';
                                        }
                                    ?>
                                </select> 
                                    <input type="hidden" value="<?php echo $years ? $years[0]->year : 0 ?>" id="selectedFestivalYear"/>

                           </div>
                            <!-- <div class="form-group">
                                <div class="col-sm-4">
                                    <input type="text" name="name" class="form-control" id="search" placeholder="Type to search...">
                                </div>
                            </div> -->
                  <br> <br>
                   <div style="overflow-x:auto;">
                            <table class="table table-striped" id="table" width="80%">
                                <thead>
                                    <tr>
                                        <th> Festival Name </th>
                                        <th> Dates (Month-Day) </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody id="festivalData">
                                    

                                  
                                </tbody>
                            </table>
                  </div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>



        </div>
        <!-- /.box -->
    </div>
    </div><!-- /.row (main row) -->
    </section><!-- /.content -->
    </div>
    </div>


<script>

getYearDates();
onFestivalYearChange();

function onFestivalYearChange() {
    var year = $('#festivalYearDropdown').val();
    $('#selectedFestivalYear').val(year);
    getFestivalDates();

}

function getFestivalDates() {

    var year = $('#festivalYearDropdown').val();

    $.ajax({
        url: "<?php echo site_url('Festival/getFestivalByYearV2') ?>",
        type: "POST",
        data: {
            'year': year
        },
        success: function(response){

            $('#festivalData').html(response);

            $.fn.editable.defaults.mode = 'inline';

            $("[name='editFestival']").editable({
                display: false,
                success: function(data, config) {
                    location.reload();
                }
            });

        }, error: function(){
            
        }
    });     

}

function onYearChange() {
    
    var year = $('#yearDropdown').val();
    $('#selectedYear').val(year);
    getYearDates();
}

function getYearDates() {

    var year = $('#yearDropdown').val();

    $.ajax({
        url: "<?php echo site_url('Majalis/getMajalisByYear') ?>",
        type: "POST",
        data: {
            'year': year
        },
        success: function(response){

            $('#majalisData').html(response);

            $.fn.editable.defaults.mode = 'inline';

            $("[name='editMajalis']").editable({
                display: false,
                success: function(data, config) {
                    location.reload();
                }
            });


            isEditAllowed();


        }, error: function(){
            
        }
    });        
}

</script>