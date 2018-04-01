<?php 
    $years = $data['years'];
?>
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
                                <h3 class="box-title"><?php echo !empty($years[0]) ? $years[0]->name : '' ?> </h3>
                            </div>
                            <!-- /.box-header -->

                            <input type="hidden" value="<?php echo $data['majalis']->id ?>" id="majalisId" name="majalisId" />

                                <form class="form-horizontal majalisForm" action="<?php echo site_url('majalis/addMajalisDate') ?>" method="post" >
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

                                 

                                        <input id="dutyToken" type="hidden" name="token" value="<?php echo $this->input->get('token', TRUE); ?>"/>

                                    </div>
                                </form>


                                <form class="form-horizontal majalisForm" action="<?php echo site_url('majalis/addDuty') ?>" method="post" >
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="" class="col-sm-2  labelAlign">Duty</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="duty" class="form-control"  placeholder="" required>
                                            </div>
                                          
                                             <div class="col-sm-2">
                                                <button type="submit" class="btn btn-primary btn-block">Add</button>
                                            </div>                                          
                                        </div>

                                        <input type="hidden" name="token" value="<?php echo $this->input->get('token', TRUE); ?>"/>

                                        <input type="hidden" name="date" value="<?php echo $this->input->get('date', TRUE); ?>"/> 

                                      


                                </form>
<br>
                                <div class="form-group majalisForm">
                                    <label for="" class="col-sm-2 labelAlign">Override evening JK schedule</label>
                                    <div class="col-sm-3">
                                        <input type="checkbox" id="override" name="override" value="1" <?php echo !empty($years[0]->override) ? 'checked' : '' ?> >
                                    </div>
                                        <div class=" col-sm-2">
                                    <button type="button" onclick="location.href='<?php echo site_url("Majalis/viewGlobalDuties?token=" . $this->input->get('token') ) ;?>'" class="btn btn-primary btn-block">Global Duties</button>
                                </div> 
                                </div>   
                          
                                    </div>
       
                            </br> </br>
                       

                            <div class="form-group">
   
                              <div class="col-sm-2">
                                    <label for="" class=" control-label">Majalis Dates</label>
                              </div>
                                <div class="col-sm-3">
                                    <select required="" name="years" id="yearDropdown" onchange="onYearChange(this)" class="form-control">
                                        <?php
                                            foreach ($years as $key => $value) {
                                                echo '<option value"'. $value->year .'"> '.$value->year.' </option>';
                                            }
                                        ?>
                                    </select>

                                    <input type="hidden" value="<?php echo $years ? $years[0]->year : 0 ?>" id="selectedYear"/>

                                </div>

                            </div>
 <div class="box-body">
                               
                
                            <table id="dutiesDiv" class="table table-striped" id="table" width="80%">

                                    
                                </tbody>
                            </table>
                    </div>
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

        var token = $('#dutyToken').val();
        $.ajax({
            url: "<?php echo site_url('Majalis/editMajalisOverride') ?>",
            type: "POST",
            data: {
                'override': override,
                'token': token
        },
        success: function(response) {
            console.log(response);
        }

        });
    }

    getYearDates();

    function onYearChange() {
        
        var year = $('#yearDropdown').val();
        var token = $('#dutyToken').val();
        $('#selectedYear').val(year);
        getYearDates();
    }

    function getYearDates() {

        var year = $('#yearDropdown').val();
        var token = $('#dutyToken').val();

        $.ajax({
            url: "<?php echo site_url('Majalis/getMajalisDateByYear') ?>",
            type: "POST",
            data: {
                'year': year,
                'token': token
            },
            success: function(response) {

                $('#dutiesDiv').html(response);

                isEditAllowed();

                $("[name='editDate']").editable({
                    format: 'yyyy-mm-dd',    
                    viewformat: 'yyyy-mm-dd',
                    display: false,    
                    datepicker: {
                        weekStart: 1
                    },
                    success: function (data, config) {
                        getYearDates();
                    }
                });

            }, error: function(){
                
            }
        });        
    }


    function onDeleteMajalisDate(token) {

        if (confirm("Are you sure you want to delete this Date")) {

            $.ajax({
                url: "<?php echo site_url('Majalis/deleteMajalisDate') ?>",
                type: "GET",
                data: {
                    'token': token
                },
                success: function(response){

                    onYearChange();

                }, error: function(){
                    
                }
            });            

        } else {

        }
     
    }

</script>       