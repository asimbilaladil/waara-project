 <div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="cs-page-title center">
                        <h1>Create Request</h1>
    
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
                        <li><a href="#">Request</a></li>
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
            if ( $data['result'] ) {

                echo "<div style='text-align: center;' class='alert alert-success alert-dismissable'>
                                                         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                                               Your request has been created successfully!
                                                        </div>";
            } 
                  else if ( $data['result'] == -1) {

                echo "<div style='text-align: center;' class='alert alert-danger alert-dismissable'>
                                                         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                                               Something went wrong try again!
                                                        </div>";
            } 
        ?>
            <div class="row">
                 <div class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        
                    </div>


                <!--Element Section Start-->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="cs-signup-form">
                        <h6>Create Request</h6>
                        <form action="<?php echo site_url('Welcome/request') ?>" method="post">
                            <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <input name="title" type="text" placeholder="Title *" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-field-holder">
                                    <textarea name="request" placeholder="Your request *"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-btn-submit">
                                    <input type="submit" value="Request">
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