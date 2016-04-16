<div class="product-big-title-area"
     style="background: url(<?php echo base_url("includes/website/img/crossword.png") ?>) repeat scroll 0 0 #1ABC9C">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>My Profile </h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">

                <h3 class="sidebar-title">WELCOME</h3>

                <p>Name: <span><?php echo $candidate_name; ?></span></p>

                <p>Email: <span><?php echo $candidate_email; ?></span></p>

                <p>Phone NO: <span><?php echo $candidate_phoneNo; ?></span></p>
                <a href="<?php echo site_url("WebAction/editCandidateInfo") . "/" . $candidate_id ?>">Edit Account
                    Information</a>


            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <?php
                    $message = $this->session->userdata('message');
                    if ($message) {

                        echo "<div class='alert alert-success alert-dismissable'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                         $message
                                      </div>";
                        $this->session->unset_userdata('message');
                    }
                    ?>
                    <!--                    <div class="woocommerce">-->
                    <!--                        <div class="woocommerce-info">Who is the best Football Player in the World !?<a class="showlogin" data-toggle="collapse" href="#login-form-wrap" aria-expanded="false" aria-controls="login-form-wrap"> Click here for vote now</a>-->
                    <!--                        </div>-->
                    <!---->
                    <!--                        <form id="login-form-wrap" class="login collapse" method="post">-->
                    <!---->
                    <!---->
                    <!--                            <p>We are survey for find out "Who is the best  Football player  in the world" </p>-->
                    <!---->
                    <!--                            <div class="radio">-->
                    <!--                                <label>-->
                    <!--                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" >-->
                    <!--                                    Option one is this and that&mdash;be sure to include why it's great-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!---->
                    <!--                            <div class="radio">-->
                    <!--                                <label>-->
                    <!--                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" >-->
                    <!--                                    Option one is this and that&mdash;be sure to include why it's great-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                            <p class="form-row">-->
                    <!--                                <button type="submit" class="btn btn-default ">Sign in</button>-->
                    <!--                            </p>-->
                    <!---->
                    <!--                            <div class="clear"></div>-->
                    <!--                        </form>-->
                    <!--                    </div>-->

                </div>
            </div>
        </div>
    </div>
</div>
