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


            <section class="content">
                
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">


                              <div class="box-body">

                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Date</label>
                                        <div class="col-sm-3">
                                            <input type="date" id="date" name="date" class="form-control"  placeholder="" required>
                                        </div>
                                        <div class=" col-sm-2">
                                            <button type="button" onclick="updateDays()" class="btn btn-primary btn-block">Add</button>
                                        </div>                                      
                                    </div>



                                </div>
                        </div>

                            <!-- <div class="box-header with-border">
                                <h3 class="box-title">List Of Duties:</h3>
                            </div> -->
                        <div class="box box-success" id="daysTable">                            

                        </div>
                    </div>
                </div>
            </section>


        </div>
    </div>
</body>
 
<script>

    $('#date').change(function(val) {
       
        $.ajax({
            url: "<?php echo site_url('WaaraRequest/getDays') ?>",
            type: "GET",
            data: {
                'date': this.value
            },
            success: function(response){

                $('#daysTable').html(response);

            }, error: function(){
                
            }
        });  

    });

    function updateDays() {

        var dates = [];
        var uncheckedDays = [];
        var selectedDate = $('#date').val();

        $("input:checkbox[name=day]:checked").each(function(){
            dates.push($(this).val());
        }); 

        // $("input:checkbox[name=day]:not(:checked)").each(function(){
        //     uncheckedDays.push($(this).val());
        // });         

        $.ajax({
            url: "<?php echo site_url('WaaraRequest/addDays') ?>",
            type: "POST",
            data: {
                'dates': dates,
                'selectedDate': selectedDate
            },
            success: function(response){

                console.log(response);

            }, error: function(){
                
            }
        });

        
    }

</script>