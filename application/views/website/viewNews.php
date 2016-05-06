                     <?php $data = $data['result'][0]; ?>

 <div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="cs-page-title center">
                        <h1>News / Events</h1>
    
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
                    </ul>
                       <h5> Publish Date: <?php echo $data->created_date; ?></h5>

                </div>
            </div>
        </div>
    </div>
    <!-- Main Start -->
    <div class="main-section"> 
        <div class="page-section">
          <div class="container">
            <div class="row">
         
           

                <!--Element Section Start-->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="cs-signup-form">
                    <div class="container-fluid">
  <h1><?php echo $data->title; ?></h1>
  <div class="row">
    <div class="col-sm-12" ><?php echo $data->details; ?></div>

  </div>
</div>

                    </div>
                </div>
    
                <!--Element Section End-->
            </div>
        </div>
    </div>

    </div>