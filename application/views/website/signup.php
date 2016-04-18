 <div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="cs-page-title center">
                        <h1>Signup</h1>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="border-bottom:1px solid #f4f4f4;" class="page-section">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="cs-breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Signup</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Start -->
    <div class="main-section"> 
        <div class="page-section">
          <div class="container">
            <div class="row">
                    <div class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        
                    </div>
                <!--Element Section Start-->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="cs-signup-form">
                        <h6>register</h6>
                        <form method="POST" action="<?php echo site_url('Welcome/signup') ?>">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-field-holder cs-success">
                                        <i class="icon-user"></i>
                                        <input name="firstName" type="text" placeholder="First Name" required >
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-field-holder cs-success">
                                        <i class="icon-user"></i>
                                        <input name="lastName" type="text" placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-field-holder cs-success">
                                        <i class="icon-envelope"></i>
                                       <input name="email" type="email" placeholder="Email Address" required >
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-field-holder cs-success">
                                        <i class="icon-lock"></i>
                                       <input name="password" type="password" placeholder="Password" required >
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                    <div class="cs-field-holder cs-success" >
                                        <i class="icon-phone3"></i>
                                       <input style="width: 100%" name="phone" type="phone" placeholder="Phone" required >
                                    </div>
                                </div>
                                <?php  foreach($result  as $data) { ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-field-holder cs-success">
                                        <i class="icon"></i>
                                        <input name="<?php echo $data->field_name; ?>" type="<?php echo $data->input_type; ?>" placeholder="<?php echo $data->field_lable; ?>" required >
                                    </div>
                                </div>
                                <?php } ?>                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-field-holder">
                                        <div class="cs-radio">
                                            <input type="radio" name="radio" value="male" id="radio1">
                                            <label for="radio1">Male</label>
                                        </div>
                                        <div class="cs-radio">
                                            <input type="radio" name="radio" value="female" id="radio2">
                                            <label for="radio2">Female</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-btn-submit">
                                        <input type="submit" value="register">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
    
                <!--Element Section End-->
            </div>
        </div>
    </div>

    </div>