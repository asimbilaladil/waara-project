
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SmartStudy.edu</title>
<link href="<?php echo base_url("includes/website/assets/css/bootstrap.css") ?>" rel="stylesheet">
<link href="<?php echo base_url("includes/website/assets/css/bootstrap-theme.css") ?>" rel="stylesheet">
<link href="<?php echo base_url("includes/website/assets/css/iconmoon.css") ?>" rel="stylesheet">
<link href="<?php echo base_url("includes/website/assets/css/chosen.css") ?>" rel="stylesheet">
<link href="<?php echo base_url("includes/website/assets/css/jquery.mobile-menu.css") ?>" rel="stylesheet">
<link href="<?php echo base_url("includes/website/assets/css/style.css" ) ?>"rel="stylesheet">
<link href="<?php echo base_url("includes/website/assets/css/cs-smartstudy-plugin.css" ) ?>"rel="stylesheet">
<link href="<?php echo base_url("includes/website/assets/css/color.css" ) ?>"rel="stylesheet">
<link href="<?php echo base_url("includes/website/assets/css/widget.css") ?>" rel="stylesheet">
<link href="<?php echo base_url("includes/website/assets/css/responsive.css") ?>" rel="stylesheet">
<!-- <link href="assets/css/bootstrap-rtl.css") ?>" rel="stylesheet"> Uncomment it if needed! -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="<?php echo base_url("includes/website/assets/scripts/jquery.js") ?> "></script>
<script src="<?php echo base_url("includes/website/assets/scripts/modernizr.js") ?> "></script>
<script src="<?php echo base_url("includes/website/assets/scripts/bootstrap.min.js") ?> "></script>
</head>
<body class="wp-smartstudy">
<div class="wrapper"> 
    <!-- Side Menu Start -->
    <div id="overlay"></div>
    <div id="mobile-menu">
        <ul>
            <li>
                <div class="mm-search">
                    <form id="search" name="search">
                        <div class="input-group">
                            <input type="text" class="form-control simple" placeholder="Search ..." name="srch-term" id="srch-term">
                       <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <li class="active"><a href="index.html">Home</a></li>
            <li><a href="#">Courses</a>
                <ul>
                    <li><a href="courses-grid.html">Courses grid view</a></li>
                    <li><a href="courses-simple.html">Courses Simple view</a></li>
                    <li><a href="courses-listing.html">Courses list view</a></li>
                    <li><a href="cs-courses-detail.html">Courses Detail</a></li>
                </ul>
            </li>
            <li><a href="#">Pages</a>
                <ul>
                    <li><a href="user-detail.html">Student Dashboard</a></li>
                    <li><a href="instructor-detail.html">instructor Dashboard</a></li>
                    <li><a href="affiliations.html">Affiliations</a></li>
                    <li><a href="typography.html">Typography</a></li>
                    <li><a href="shortcode.html">Short code</a>
                        <ul>
                            <li><a href="loop.html">Loop</a></li>
                        </ul>
                    </li>
                    <li><a href="about-us.html">About Us</a></li>
                    <li><a href="faqs.html">FAQ's</a></li>
                    <li><a href="under-construction.html">Maintenance Page</a></li>
                    <li><a href="404.html">404 Page</a></li>
                    <li><a href="signup.html">Signup / Login</a></li>
                    <li><a href="pricing.html">Price Table</a></li>
                    <li><a href="#">Team</a>
                        <ul>
                            <li><a href="team-listing.html"> Team List</a></li>
                            <li><a href="team-grid.html"> Team Grid</a></li>
                            <li><a href="team-detail.html"> Team Detail</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="#">Shop</a>
                        <ul>
                            <li><a href="shop.html"> Products</a></li>
                            <li><a href="shop-detail.html"> Detail</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#">Events</a>
                <ul>
                    <li><a href="events-grid.html">Grid View</a></li>
                    <li><a href="events-listing.html">List View</a></li>
                    <li><a href="events-detail.html">Detail</a></li>
                </ul>
            </li>
            <li><a href="#">Blog</a>
                <ul>
                    <li><a href="blog-medium.html">Medium List</a></li>
                    <li><a href="blog-large.html">Large List</a></li>
                     <li><a href="blog-grid.html">Grid</a></li>
                    <li><a href="blog-detail.html">Detail</a></li>
                    <li><a href="blog-2.html">Masonry</a></li>
                </ul>
            </li>
            <li><a href="#">Contact</a>
                <ul>
                    <li><a href="contact-us.html">Contact us 1</a></li>
                    <li><a href="contact-us-02.html">Contact us 2</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Side Menu End -->
    <!-- Header Start -->
    <header id="header" class=""> 
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="cs-user">
                            <ul>
                                <li><a data-target="#cs-login" href="remote.html" data-toggle="modal"><i class="icon-login"></i>Login</a></li>
                                <li><a data-target="#cs-signup" href="remote.html" data-toggle="modal"><i class="icon-user2"></i>Signup</a></li>
                                <li>
                                    <div class="cs-user-login">
                                        <div class="cs-media">
                                            <figure><img alt="" src="<?php echo base_url("includes/website/assets/extra-images/user-login-img-1.jpg") ?> "></figure>
                                        </div>
                                        <a href="#">Alard William</a>
                                        <ul>
                                            <li><a href="user-detail.html"><i class="icon-user3"></i> About me</a></li>
                                            <li><a href="user-courses.html"><i class="icon-graduation-cap"></i> My Courses</a></li>
                                            <li><a href="user-short-listed.html"><i class="icon-heart"></i> Favorites</a></li>
                                            <li><a href="user-statements.html"><i class="icon-text-document"></i> Statement</a></li>
                                            <li class="active"><a href="user-account-setting.html"><i class="icon-gear"></i> Profile Setting</a></li>
                                            <li><a href="#"><i class="icon-log-out"></i> Logout</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="cs-modal">
                            <div class="modal fade" id="cs-signup" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Create Account</h4>
                                            <div class="cs-login-form">
                                                <form>
                                            <div class="input-holder">
                                                <label class="has-error" for="cs-username">
                                                    <strong>USERNAME</strong>
                                                    <i class="icon-add-user"></i>
                                                    <input type="text" class="" id="cs-username" placeholder="Type desired username">
                                                </label>
                                            </div>
                                            <div class="input-holder">
                                                <label class="has-success" for="cs-email">
                                                    <strong>Email</strong>
                                                    <i class="icon-envelope"></i>
                                                    <input type="email" class="" id="cs-email" placeholder="Type desired username">
                                                </label>
                                            </div>
                                            <div class="input-holder">
                                                <label for="cs-login-password">
                                                    <strong>Password</strong>
                                                    <i class="icon-lock"></i>
                                                    <input type="password" id="cs-login-password" placeholder="******">
                                                </label>
                                            </div>
                                            <div class="input-holder">
                                                <label for="cs-confirm-password">
                                                    <strong>confirm password</strong>
                                                    <i class="icon-lock"></i>
                                                    <input type="password" id="cs-confirm-password" placeholder="******">
                                                </label>
                                            </div>
                                            
                                            <div class="input-holder">
                                                <input class="cs-color csborder-color" type="submit" value="Create Account">
                                            </div>
                                        </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a data-dismiss="modal" data-target="#cs-login" data-toggle="modal" href="javascript:;" aria-hidden="true">Already have account</a>
                                            <div class="cs-separator"><span>or</span></div>
                                            <div class="cs-user-social">
                                                <em>Signin with your Social Networks</em>
                                                <ul>
                                                    <li><a href="#" data-original-title="facebook"><i class="icon-facebook-f"></i>facebook</a></li>
                                                    <li><a href="#" data-original-title="twitter"><i class="icon-twitter4"></i>twitter</a></li>
                                                    <li><a href="#" data-original-title="google-plus"><i class="icon-google4"></i>google</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="modal fade" id="cs-login" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>User Sign in</h4>
                                            <div class="cs-login-form">
                                                <form>
                                                    <div class="input-holder">
                                                        <label for="cs-username-1">
                                                            <strong>USERNAME</strong>
                                                            <i class="icon-add-user"></i>
                                                            <input type="text" class="" id="cs-username-1" placeholder="Type desired username">
                                                        </label>
                                                    </div>
                                                    <div class="input-holder">
                                                        <label for="cs-login-password-1">
                                                            <strong>Password</strong>
                                                            <i class="icon-lock"></i>
                                                            <input type="password" id="cs-login-password-1" placeholder="******">
                                                        </label>
                                                    </div>
                                                    <div class="input-holder">
                                                        <a class="btn-forgot-pass" data-dismiss="modal" data-target="#user-forgot-pass" data-toggle="modal" href="javascript:;" aria-hidden="true"><i class=" icon-question-circle"></i> Forgot password?</a>
                                                    </div>
                                                    <div class="input-holder">
                                                        <input class="cs-color csborder-color" type="submit" value="SIGN IN">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="cs-separator"><span>or</span></div>
                                            <div class="cs-user-social">
                                                <em>Signin with your Social Networks</em>
                                                <ul>
                                                    <li><a href="#" data-original-title="facebook"><i class="icon-facebook-f"></i>facebook</a></li>
                                                    <li><a href="#" data-original-title="twitter"><i class="icon-twitter4"></i>twitter</a></li>
                                                    <li><a href="#" data-original-title="google-plus"><i class="icon-google4"></i>google</a></li>
                                                </ul>
                                            </div>
                                            <div class="cs-user-signup">
                                                <i class="icon-add-user"></i>
                                                <strong>Not a Member yet? </strong>
                                                <a class="cs-color" data-dismiss="modal" data-target="#cs-signup" data-toggle="modal" href="javascript:;" aria-hidden="true">Signup Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="user-forgot-pass" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Password Recovery</h4>
                                            <div class="cs-login-form">
                                                <form>
                                                    <div class="input-holder">
                                                        <label for="cs-email-1">
                                                            <strong>Email</strong>
                                                            <i class="icon-envelope"></i>
                                                            <input type="email" class="" id="cs-email-1" placeholder="Type desired username">
                                                        </label>
                                                    </div>
                                                    <div class="input-holder">
                                                        <input class="cs-color csborder-color" type="submit" value="Send">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="cs-user-signup">
                                                <i class="icon-add-user"></i>
                                                <strong>Not a Member yet? </strong>
                                                <a href="javascript:;" data-toggle="modal" data-target="#cs-signup" data-dismiss="modal" class="cs-color" aria-hidden="true">Signup Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
           
                    </div>
                </div>
            </div>
        </div>
        <div class="main-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <div class="cs-logo cs-logo-dark">
                            <div class="cs-media">
                                <figure><a href="index.html"><img src="<?php echo base_url("includes/website/assets/images/cs-logo.png" ) ?> "alt="" /></a></figure>
                            </div>
                        </div>
                        <div class="cs-logo cs-logo-light">
                            <div class="cs-media">
                                <figure><a href="index.html"><img src="<?php echo base_url("includes/website/assets/images/cs-logo-light.png" ) ?> "alt="" /></a></figure>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-6 col-xs-6">
                        <div class="cs-main-nav pull-right">
                            <nav class="main-navigation">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li class="menu-item-has-children"><a href="#">Courses</a>
                                        <ul>
                                            <li><a href="courses-grid.html">Courses grid view</a></li>
                                            <li><a href="courses-simple.html">Courses Simple view</a></li>
                                            <li><a href="courses-listing.html">Courses list view</a></li>
                                            <li><a href="cs-courses-detail.html">Courses Detail</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="#">Pages</a>
                                        <ul>
                                            <li><a href="user-detail.html">Student Dashboard</a></li>
                                            <li><a href="instructor-detail.html">instructor Dashboard</a></li>
                                    <li><a href="affiliations.html">Affiliations</a></li>
                                            <li><a href="typography.html">Typography</a></li>
                                            <li class="menu-item-has-children"><a href="shortcode.html">Short code</a>
                                                <ul>
                                                    <li><a href="loop.html">Loop</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="about-us.html">About Us</a></li>
                                            <li><a href="faqs.html">FAQ's</a></li>
                                            <li><a href="under-construction.html">Maintenance Page</a></li>
                                            <li><a href="404.html">404 Page</a></li>
                                            <li><a href="signup.html">Signup / Login</a></li>
                                            <li><a href="pricing.html">Price Table</a></li>
                                            <li class="menu-item-has-children"><a href="#">Team</a>
                                                <ul>
                                                    <li><a href="team-listing.html"> Team List</a></li>
                                                    <li><a href="team-grid.html"> Team Grid</a></li>
                                                    <li><a href="team-detail.html"> Team Detail</a></li>
                                                </ul>
                                            </li>
                                            
                                            <li class="menu-item-has-children"><a href="#">Shop</a>
                                                <ul>
                                                    <li><a href="shop.html"> Products</a></li>
                                                    <li><a href="shop-detail.html"> Detail</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="#">Events</a>
                                        <ul>
                                            <li><a href="events-grid.html">Grid View</a></li>
                                            <li><a href="events-listing.html">List View</a></li>
                                            <li><a href="events-detail.html">Detail</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="#">Blog</a>
                                        <ul>
                                            <li><a href="blog-medium.html">Medium List</a></li>
                                            <li><a href="blog-large.html">Large List</a></li>
                                             <li><a href="blog-grid.html">Grid</a></li>
                                            <li><a href="blog-detail.html">Detail</a></li>
                                            <li><a href="blog-2.html">Masonry</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="#">Contact</a>
                                        <ul>
                                            <li><a href="contact-us.html">Contact us 1</a></li>
                                            <li><a href="contact-us-02.html">Contact us 2</a></li>
                                        </ul>
                                    </li>
                                    <li class="cs-search-area">
                                 
                                        <div class="search-area " style="Top:13px">
                                            <a href="#"><i class="icon-search2 "></i></a>
                                            <form>
                                                <div class="input-holder">
                                                    <i class="icon-search2"></i>
                                                    <input type="text" placeholder="Enter any keyword">
                                                    <label class="cs-bgcolor">
                                                        <i class="icon-search5"></i>
                                                        <input type="submit" value="search">
                                                    </label>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                            <div class="cs-search-area hidden-md hidden-lg">
                                <div class="cs-menu-slide">
                                    <div class="mm-toggle">
                                    </div>            
                                </div>
                                <div class="search-area" style="Top:-20px">
                                    <a href="#"><i class="icon-search2 " style="bottom:5px"></i></a>
                                    <form>
                                        <div class="input-holder">
                                            <i class="icon-search2 "></i>
                                            <input type="text" placeholder="Enter any keyword">
                                            <label class="cs-bgcolor">
                                                <i class="icon-search5"></i>
                                                <input type="submit" value="search">
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

