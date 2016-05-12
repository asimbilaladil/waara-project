 <div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="cs-page-title center">
                        <h1>Edit User</h1>
    
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
                        <li><a href="#">Edit User</a></li>
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
                        <form action="<?php echo site_url('Welcome/editUser') ?>" method="post">
                            <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <label for="" class="col-sm-4 control-label">First Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="firstName" class="form-control" id="" value="<?php echo $data['user']->first_name; ?>" placeholder="" required>
                                    </br>
                                    </div>
                            </div>
                                
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="" class="col-sm-4 control-label">Last Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="lastName" class="form-control" id="" value="<?php echo $data['user']->last_name; ?>" placeholder="" required>
                                    </br>
                                    </div>
                            </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <label for="" class="col-sm-4 control-label">Phone</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="phone" class="form-control" id="" value="<?php echo $data['user']->phone; ?>" placeholder="" required>
                                       </br> 
                                    </div>
                            </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="" class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="email" class="form-control" id="" value="<?php echo $data['user']->email; ?>" placeholder="" required>
                                        </br>
                                    </div>
                            </div>                                                        
                          

               <input type="hidden" name="userId" value="<?php echo $data['user']->user_id; ?>"/>
                                <?php

                                    foreach($data['customFields'] as $row) {

                                        echo 
                                        '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                              <label for="" class="col-sm-4 control-label">'. $row->field_lable .'</label>
                                            <div class="col-sm-6">
                                                <input type="'. $row->input_type .'" name="'. $row->field_name .'" class="form-control" value="'. $row->value .'" placeholder="" required>
                                                 </br>
                                            </div>
                                        </div>';

                                    }

                                ?>
                              

                            


                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="cs-btn-submit">
                                    <input type="submit" value="Save">
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