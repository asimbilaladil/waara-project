


   <div class="main-section">
    <div class="page-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="cs-breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Waara</a></li>
                    </ul>
                </div>
                <div class="page-sidebar col-lg-1 col-md-1 col-sm-12 col-xs-12">
                </div>
                <!--Element Section Start-->
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <div class="cs-signup-form">
                        <div class="row">
                                </br>  </br>
                            <?php $data = $data['result'][0]; ?>
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">JK Title</label>
                                    <div class="col-sm-6">
                                    <label for="" class="col-sm-4 control-label"><?php echo $data->jk_name; ?></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Waara Title</label>
                                    <div class="col-sm-6">
                                    <label for="" class="col-sm-4 control-label"><?php echo $data->duty_name; ?></label>
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Waara Description</label>
                                    <div class="col-sm-6">
                                    <label for="" class="col-sm-4 control-label"><?php echo $data->duty_description; ?></label>
                                    </div>
                                </div>    
                                  <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Date</label>
                                    <div class="col-sm-6">
                                    <label for="" class="col-sm-4 control-label"><?php echo $data->start_date; ?></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Assign Person</label>
                                    <div class="col-sm-6">
                                    <label for="" class="col-sm-4 control-label"><?php echo $data->first_name . " " . $data->last_name; ?></label>
                                    </div>
                                </div>                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>