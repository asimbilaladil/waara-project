 <div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="cs-page-title center">
                        <h1>Reset Password</h1>
    
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
                        <li><a href="#">Reset Password</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Start -->
    <div class="main-section"> 
        <div class="page-section">
          <div class="container">
                              <?php
            if ( $data['result'] == 1) {

                echo "<div style='text-align: center;' class='alert alert-success alert-dismissable'>
                                                         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                                               Your password changed successfully!
                                                        </div>";
            } 
                  else if ( $data['result'] == 2) {

                echo "<div style='text-align: center;' class='alert alert-danger alert-dismissable'>
                                                         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                                               Invalid Password!
                                                        </div>";
            } 
        ?>
            <div class="row">
                 <div class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        
                    </div>


                <!--Element Section Start-->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="cs-signup-form">
                        <h6>Reset Password</h6>
                        <form action="<?php echo site_url('Welcome/resetPassword') ?>" method="post">
                        <input type="hidden" name="token" value="<?php echo $_GET["token"]; ?>">
                            <div class="row">
                           
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-lock2"></i>

                                    <input name="newPassword" type="password" placeholder="New Password *" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-btn-submit">
                                    <input type="submit" value="save">
                                </div>
                                
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