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
                </div>
            </div>
        </div>
    </div>
    <!-- Main Start -->
    <div class="main-section"> 
        <div class="page-section">
          <div class="container">
            <div class="row">
                 <div class="page-sidebar col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        
                    </div>
           

                <!--Element Section Start-->
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="cs-signup-form">
                    

                                       <table class="table table-striped" id="table" width="80%">
                                    <thead>
                                        <tr>
                                            <th> No</th>
                                            <th> Title</th>
                                            <th> Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($data['result'] as $key =>  $item) {
                                                echo 
                                                    '<tr>
                                                        <td> '. $key++ .'</td>
                                                        <td>  <a href="viewNews?id='.$item->id.'" >'. $item->title .' </a></td>
                                                        <td> '. $item->created_date .'</td>


                                                    </tr>';
                                            
                                            }
                                            ?>                                
                                    </tbody>
                                </table>
                    </div>
                </div>
    
                <!--Element Section End-->
            </div>
        </div>
    </div>

    </div>