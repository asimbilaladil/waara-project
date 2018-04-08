<?php $data = $data[0]; ?>
<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <?php echo $data->festival ?>
                    <!-- <small >Majalis Duty Details</small> -->
                </h1>
            </section>            

            <section class="content">
                <div class="row">
                        
                    <div class="col-md-12">
                        <div class="box box-success">
                            <table width="70%"> 
<!--                                 <tr>
                                    <td> <h3> Festival </h3>  </td>
                                    <td> <h3> <?php echo $data->festival; ?> </h3> </td>
                                </tr> -->
                                <tr>
                                    <td> <h3> Duty </h3>  </td>
                                    <td> <h3> <?php echo $data->dutyName; ?> </h3> </td>
                                </tr>
                                <tr>
                                    <td> <h3> Duty Date </h3>  </td>
                                    <td> <h3> <?php echo $data->date; ?> </h3> </td>
                                </tr>
                                <tr>
                                    <td> <h3> Assign Person </h3>  </td>
                                    <td> <h3> <?php  echo $data->first_name . " " . $data->last_name;?> </h3> </td>
                                </tr>                                                                        
                            </table>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    </div>

</body>