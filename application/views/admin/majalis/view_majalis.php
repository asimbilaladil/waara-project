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
                            <div class="form-group">
                                <div class="col-sm-offset-0 col-sm-2">
                                    <button type="button" onclick="location.href='<?php echo site_url("majalis/add") ;?>'" class="btn btn-primary btn-block">Add Majalis</button>
                                </div>
                            </div>

                            </br> </br>
                            <div class="box-header with-border">
                                <h3 class="box-title">List Of Majalis:</h3>
                            </div>

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
<!--                             <div class="form-group">
                                <div class="col-sm-4">
                                    <input type="text" name="name" class="form-control" id="search" placeholder="Type to search...">
                                </div>
                            </div> -->
                            <table class="table table-striped" id="table" width="80%">
                                <thead>
                                    <tr>
                                        <th> Festival Name </th>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                <?php 
                                foreach ($data['festival'] as $item) {
                                    $deleteUrl = site_url('majalis/deleteFestival?token=' . $item["token"]);
                                    $editMajalisUrl = site_url("majalis/editFestival");
                                    echo '<tr>
                                        <td> <a href="' . site_url("festival/viewFestivalDates?token=" . $item["token"]) . '">' . $item["festivalName"] . '</a> </td>
                                        <td> ' . printMonthFestival($item, "January") . ' </td>
                                        <td> ' . printMonthFestival($item, "February") . ' </td>
                                        <td> ' . printMonthFestival($item, "March") . ' </td>
                                        <td> ' . printMonthFestival($item, "April") . ' </td>
                                        <td> ' . printMonthFestival($item, "May") . ' </td>
                                        <td> ' . printMonthFestival($item, "June") . ' </td>
                                        <td> ' . printMonthFestival($item, "July") . ' </td>
                                        <td> ' . printMonthFestival($item, "August") . ' </td>
                                        <td> ' . printMonthFestival($item, "September") . ' </td>
                                        <td> ' . printMonthFestival($item, "October") . ' </td>
                                        <td> ' . printMonthFestival($item, "November") . ' </td>
                                        <td> ' . printMonthFestival($item, "December") . ' </td>
                                        <td> <a href="'. $deleteUrl .'" onclick="return confirm(`Are you sure you want to Delele?`);" > <span class="glyphicon glyphicon-trash"></span></a> </td>

                                        <td> <a href="#" name="editFestival" data-type="text" data-pk="'. $item["token"] .'" data-value="'. $item["festivalName"] .'" data-url="'. $editMajalisUrl .'"> EDIT  </a> </td>
                                        
                                    </tr>';
                                }

                                function printMonthFestival($item, $month) {
                                    $str = '';
                                    if (isset($item[$month])) {
                                        foreach($item[$month] as $m) {
                                            $dutyUrl = site_url('Festival/viewFestivalDates?token=' . $item["token"] .'&date='. $m['completeDate']);
                                            $str = $str . '<a href="'. $dutyUrl .'">'. $m['date'] .'</a> <br>';        
                                        }
                                    } else {
                                        $addUrl = site_url('Festival/viewFestivalDates?token=' . $item["token"]);
                                        $str = '<a href="'. $addUrl .'"> ADD </a>';
                                    }
                                    return $str;
                                }

                                ?>
                                    
                                </tbody>
                            </table>
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

function onYearChange() {
    
    var year = $('#yearDropdown').val();
    $('#selectedYear').val(year);
    getYearDates();
}

function getYearDates() {

    var year = $('#yearDropdown').val();

    console.log(year);

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

        }, error: function(){
            
        }
    });        
}

</script>