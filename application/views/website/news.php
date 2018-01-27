 <div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="cs-page-title center">
                        <h1>Welcome to waaranet.</h1>
    
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
            <aside class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="cs-find-search">
                  <?php 
                   if ( $this->session->userdata('fullName') !== null ){
                  echo "<h6>Welcome ". $this->session->userdata('fullName') ."  to Waaranet </h6>"; } else { ?>

                    <h6>Login</h6>

                    <span>Login with your email and password</span>
                    <form action="<?php echo site_url('Welcome/user_login_check') ?>" method="post">
                       
                        <div class="cs-input-area">
                            <div class="cs-field-holder">
                           
                            <input name="email" type="text" placeholder="Enter Your Email Address"></div>
                           
                        </br>
                
                            <div class="cs-field-holder">
                                
                                <input name="password" type="password" placeholder="Enter Your Password">
                            </div>
                           
                        </div>
<a href="http://waaranet.ca/index.php/Welcome/signup" ><label style="
    color: white;
    margin-top: 5px;
    margin-left: 17px;
    font-size: medium;
"> Signup</label></a>
                        <button type="submit" style="width: 113px;"> Login</button>
<br>
<span style="margin-top: 20px;">For questions and support, email waara coordinator at coordinator@waaranet.ca </span>
                    </form>
                    <?php }?>
                </div>
           
            </aside>
            <div class="page-content col-lg-9 col-md-9 col-sm-12 col-xs-12">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="cs-sorting-list">
                    <div class="cs-left-side col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     
                        <input type="text" name="name" class="form-control" id='txtList' onkeyup="filter(this)" placeholder="Type to search...">
                     
                  </div>
                </div>
                <ul id="fromList" class="cs-courses courses-listing">
                <?php
                    foreach($data['result'] as $key =>  $item) {
                ?>
                                             
                                     
                  <li  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  
                    <div class="cs-text">
                        <div class="cs-post-title">
                          <h2><a href="/index.php/welcome/viewNews?id=<?php echo $item->id; ?>" ><?php echo  $item->title; ?></a></h2>
                        </div>
                        <div class="cs-price-sec">
                        
                        </div>
                        
                        <p><?php echo  substr($item->details,0 , 250 ); ?> <a style="color: blue;" href="/index.php/welcome/viewNews?id=<?php echo $item->id; ?>" >readmore</a></p>
                        <div class="cs-post-options">
                          <span><i class="icon-user"></i>Super Admin</span>
                          <span><i class="icon-calendar"></i><?php echo  $item->created_date; ?></span>

                        </div>
                    </div>
                  </li>
                        
                <?php   } ?>     
                
                </ul>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="cs-pagination">
                       
                    </div>
                </div>
              </div>
            </div>
          </div>

        </div>
    </div>

    </div>

    <script type="text/javascript">

        function filter(element) {
          var value = $(element).val();
          $("#fromList li").each(function() {
            if ($(this).text().search(new RegExp(value, "i")) > -1) {
              $(this).show();
            } else {
              $(this).hide();
            }
          });
        }

    </script>
  