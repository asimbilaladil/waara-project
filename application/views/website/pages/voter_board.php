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

                <p>Name: <span><?php echo $voter['voter_name'] ?></span></p>

                <p>Email: <span> <?php echo $voter['voter_email'] ?></span></p>

                <p>Phone NO: <span><?php echo $voter['voter_phnNumber'] ?></span></p>
                <a href="<?php echo site_url('WebAction/editVoterInfo' . '/' . $voter['voter_id']) ?>">Edit Account
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

                    <?php foreach ($events as $e): ?>

                    <div class="woocommerce">
                        <div class="woocommerce-info">
                            <b>Category:</b><?php echo " " . $e->cat_name; ?>/<b>
                                Title:</b> <?php echo " " . $e->event_title; ?>-
                            <a class="showlogin" data-toggle="collapse" href="#<?php echo $e->event_id;?>"
                               aria-expanded="false" aria-controls="login-form-wrap">
                                Click here for vote now</a>
                        </div>

                        <form id="<?php echo $e->event_id;?>" class="login collapse login-form-wrap"
                              action="<?php echo site_url('WebAction/setVote') ?>" method="post">


                            <p><?php echo $e->event_description ?> </p>
                            <?php foreach ($e->candidate as $can): ?>

                                <div class="radio">
                                    <label>
                                        <input type="hidden" name="voter_id" value="<?php echo $e->voter_id ?>">
                                        <input type="hidden" name="event_id" value="<?php echo $e->event_id ?>">
                                        <input type="radio" name="candidate_id" id="optionsRadios1"
                                               value=" <?php echo $can->candidate_id; ?>">
                                        <?php echo $can->candidate_name; ?>
                                    </label>
                                </div>

                            <?php endforeach; ?>

                            <p class="form-row">
                                <button type="submit" disabled="disabled" class="btn btn-default">vote
                                </button>
                            </p>

                            <div class="clear"></div>
                        </form>
                    </div>
                    <script>
                        $(function () {
                            $("#<?php echo $e->event_id;?> input[type='radio']").change(function () {
                                $("#<?php echo $e->event_id?> .btn-default").prop("disabled", false);

                            });
                        });
                    </script>
                    <?php
                    endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>
