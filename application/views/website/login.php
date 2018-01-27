 <div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="cs-page-title center">
                        <h1>Login</h1>
    
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
                        <li><a href="#">Login</a></li>
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
                    <?php
            $login_message = $this->session->userdata('message');
            if ($login_message) {

                echo "<div style='text-align: center;' class='alert alert-danger alert-dismissable'>
                                                         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                                               $login_message
                                                        </div>";
                $this->session->unset_userdata('message');
            }
        ?>

                <!--Element Section Start-->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="cs-signup-form">
                        <h6>login</h6>
                        <form action="<?php echo site_url('Welcome/user_login_check') ?>" method="post">
                            <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder cs-has-error">
                                    <i class="icon-user"></i>
                                    <input name="email" type="text" placeholder="Username or email address *">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <i class="icon-lock2"></i>
                                    <input name="password" type="password" placeholder="Password *">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-btn-submit">
                                    <input type="submit" value="Login">
                                </div>
                                <a data-toggle="modal" data-target="#myModal" class="cs-forgot-password" href="#">
                                    <i class="cs-color icon-help-with-circle"></i>Forgot password?
                                </a>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <div class="cs-checkbox">
                                        <input type="checkbox" id="check1">
                                        <label for="check1">Remember me</label>
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

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Forgot password</h4>
        </div>
        <div class="modal-body">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form action="<?php echo site_url('Welcome/sendPasswordLink') ?>" method="POST">
                <div class="cs-field-holder">
                 <p>Enter the email you used to register. An email will be sent to you.</p>
                    <input name="email" type="text" placeholder="email address *">
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default" >Reset</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>    