<?php $data = $data['result'][0]; ?>
<div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-page-title center">
                    <h1>Waara Details</h1>
                </div>
            </div>
        </div>
    </div>
</div>
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
                                                        <h6 class="cs-color"><i class="icon-uniF119"></i>JK Title:</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                    <div class="cs-event-detail-date-time">
                                                        <div class="cs-post-title">
                                                            <h3><?php echo $data->jk_name; ?></h3>
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
                                                        <h6 class="cs-color"><i class="icon-uniF119"></i>Waara Title:</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                    <div class="cs-event-detail-date-time">
                                                        <div class="cs-post-title">
                                                            <h3><?php echo $data->duty_name; ?></h3>
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
                                                        <h6 class="cs-color"><i class="icon-uniF119"></i>Waara Description:</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                    <div class="cs-event-detail-date-time">
                                                        <div class="cs-post-title">
                                                            <h3><?php echo $data->duty_description; ?></h3>
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
                                                        <h6 class="cs-color"><i class="icon-uniF103"></i>Waara Date:</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                    <div class="cs-event-detail-date-time">
                                                        <div class="cs-post-title">
                                                            <h3><?php echo $data->start_date; ?></h3>
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