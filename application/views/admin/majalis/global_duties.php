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
                <input type="hidden" value="<?php echo $this->input->get('token'); ?>" id="majalisToken"/>
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">

                            <div class="box-header with-border">
                                <h3 class="box-title">List Of Duties:</h3>
                            </div>

                            <table class="table table-striped" id="table" width="80%">
                                <thead>
                                    <tr>
                                        <th> Duty </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody id="globalDuties">
                                    <?php
                                        // foreach ($data as $row) {
                                        //     $deleteUrl = site_url('Majalis/deleteMajalisDutyById' . $row->dutyid);
                                        //     $editMajalisUrl = '';
                                        //     echo '<tr>
                                        //         <td> '. $row->name .' </td>
                                        //         <td class="majalisId_'. $row->dutyid .'" > <a href="'. $deleteUrl .'" onclick="return confirm(`Are you sure you want to Delele?`);" > <span class="glyphicon glyphicon-trash"></span></a> </td>

                                        //         <td class="majalisId_'. $row->dutyid .'" > <a href="#" name="editMajalis" data-type="text" data-pk="'. $row->dutyid .'" data-value="'. $row->name .'" data-url="'. $editMajalisUrl .'"> EDIT  </a> </td>                                                

                                        //     </tr>';    
                                        // } 
                                    ?>
                                    
                                </tbody>


                            </table>

                            
                        </div>
                    </div>
                </div>
            </section>


        </div>
    </div>
</body>

<script>

    getGlobalDuties();

    function getGlobalDuties() {

        var token = $('#majalisToken').val();

        $.ajax({
            url: "<?php echo site_url('Majalis/getGlobalDuties') ?>",
            type: "GET",
            data: {
                'token': token
            },
            success: function(response){

                $('#globalDuties').html(response);

                $("[name='editDuty']").editable({
                    format: 'yyyy-mm-dd',    
                    viewformat: 'yyyy-mm-dd',
                    display: false,    
                    datepicker: {
                        weekStart: 1
                    },
                    success: function (data, config) {
                        getGlobalDuties();
                        
                    }
                });


            }, error: function(){
                
            }
        });   
    }

</script>