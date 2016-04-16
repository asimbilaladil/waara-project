<div class="product-big-title-area"style="background: url(<?php echo base_url("includes/website/img/crossword.png") ?>) repeat scroll 0 0 #1ABC9C">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Contact with us</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3 registration">
                <h3>Send your message</h3>
                <form class="form-horizontal" id="defaultForm" action="<?php echo site_url('welcome/saveMessage')?>" method="post">
                    <div class="form-group">
                        <label for="inputEmail3" >Your Email Address</label>

                            <input type="email" class="form-control" name="messages_from">

                    </div>

                    <div class="form-group">
                        <label for="inputEmail3">Subject</label>

                            <input type="text" class="form-control" name="messages_subject">

                    </div>

                    <div class="form-group">
                        <label for="inputEmail3">Message</label>

                            <textarea class="form-control" rows="6" name="messages_details"></textarea>

                    </div>


                    <div class="form-group">

                            <button type="submit" class="btn btn-default btn-block">Send</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        // Generate a simple captcha
     $('#defaultForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                messages_from: {

                    validators: {
                        notEmpty: {
                            message: 'The name is required and can\'t be empty'
                        }
                    }
                },

                messages_subject: {
                    validators: {
                        notEmpty: {
                            message: 'The category is required and can\'t be empty'
                        }
                    }
                },

                messages_details: {
                    validators: {
                        notEmpty: {
                            message: 'The aadhar card number is required and can\'t be empty'
                        }
                    }
                }


            }
        });
    });
</script>