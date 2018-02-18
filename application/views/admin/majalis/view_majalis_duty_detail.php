<?php $data = $data[0]; ?>
<div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-page-title center">
                    <h1>Majalis Duty Details</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-section">
    <div class="page-section">
        <div class="container">
            <div class="row">
<!--                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="cs-breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Waara</a></li>
                    </ul>
                </div> -->
                <div class="page-sidebar col-lg-1 col-md-1 col-sm-12 col-xs-12">
                </div>


                <!--Element Section Start-->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="cs-contact-fancy center">
                        <li>
                            <div class="cs-text">
                                <h5>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="cs-event-detail-holder">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="cs-event-detail-heading">
                                                        <h6 class="cs-color"><i class="icon-uniF119"></i>Majalis:</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                    <div class="cs-event-detail-date-time">
                                                        <div class="cs-post-title">
                                                            <h3><?php echo $data->name; ?></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </h5>
                            </div>
                        </li>
                        <li>
                            <div class="cs-text">
                                <h5>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="cs-event-detail-holder">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="cs-event-detail-heading">
                                                        <h6 class="cs-color"><i class="icon-uniF119"></i>Duty:</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                    <div class="cs-event-detail-date-time">
                                                        <div class="cs-post-title">
                                                            <h3><?php echo $data->dutyName; ?></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </h5>
                        </li>

                        <li>
                            <div class="cs-text">
                                <h5>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="cs-event-detail-holder">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="cs-event-detail-heading">
                                                        <h6 class="cs-color"><i class="icon-uniF103"></i>Duty Date:</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                    <div class="cs-event-detail-date-time">
                                                        <div class="cs-post-title">
                                                            <h3><?php echo $data->date; ?></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </h5>
                            </div>
                        </li>
                        <li>
                            <div class="cs-text">
                                <h5>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="cs-event-detail-holder">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="cs-event-detail-heading">
                                                        <h6 class="cs-color"><i class="cs-color icon-uniF11E"></i> Asign Person:</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                    <div class="cs-event-detail-date-time">
                                                        <div class="cs-post-title">
                                                            <h3><?php  echo $data->first_name . " " . $data->last_name;?></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </h5>
                            </div>
                        </li>
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>