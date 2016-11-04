<?php

$session_uid = $this->session->userdata('user_id');

if($user_id != $session_uid){
	redirect("/editProfile/?id=$session_uid");
}

$jkArr = explode(',', $pref_jk);

?>

<!-- Title Start -->
<div style="background:#ebebeb; padding:50px 0 35px;" class="page-section center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cs-page-title center">
                    <h1>Edit Profile</h1>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Title End -->

<!-- Breadcrumb Start -->
<div style="border-bottom:1px solid #f4f4f4;" class="page-section">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="cs-breadcrumb">
                    <li><a href="<?php echo base_url()?>">Home</a></li>
                    <li><a href="#">Edit Profile</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
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
                        <h6>edit user info</h6>

                        <form method="POST" action="<?php echo site_url('editProfile/save') ?>" onsubmit=" return verify()">
                            <div class="row">
	                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                                    <div class="cs-field-holder cs-success">
	                                        <i class="icon-user"></i>
	                                        <input id="userid" name="userid" type="text" placeholder="ID" value="<?php echo $session_uid ?>" readonly required >
	                                    </div>
	                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-field-holder cs-success">
                                        <i class="icon-user"></i>
                                        <input name="firstName" type="text" placeholder="First Name" value="<?php echo $first_name ?>" required >
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-field-holder cs-success">
                                        <i class="icon-user"></i>
                                        <input name="lastName" type="text" placeholder="Last Name" value="<?php echo $last_name ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-field-holder cs-success">
                                        <i class="icon-envelope"></i>
                                       <input name="email" type="email" placeholder="Email Address" value="<?php echo $email ?>" required >
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                    <div class="cs-field-holder cs-success" >
                                        <i class="icon-phone3"></i>
                                       <input style="width: 100%" name="phone" type="phone" placeholder="Phone" value="<?php echo $phone ?>" required >
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                    <div class="cs-field-holder cs-success" >
                                        <select name="jks[]" id="jks" multiple="multiple" class="form-control">
                                            <?php
                                            	$arr = array();
                                                foreach ($jks as $key => $value) {
                                                	if(in_array($key, explode(',', $pref_jk))) {
                                                		echo '<option selected value="'. $key .'"> '. $value .' </option>';
                                                	}
                                                	else {
                                                		echo '<option value="'. $key .'"> '. $value .' </option>';
                                                	}
                                                }
                                                /*	
                                            	foreach ($jks as $key => $value) {
                                                	foreach(explode(',', $pref_jk) as $x){
                                            			if($x == $key){
                                            				echo '<option selected value="'. $key .'"> '. $value .' </option>';
                                            				array_push($arr, $x);
                                            				break;
                                            			}
                                                	}
                                            	}
                                            	foreach ($jks as $key => $value) {
                                            		if(!in_array($key, $arr)){
                                            			echo '<option value="'. $key .'"> '. $value .' </option>';
                                            		}
                                    			}*/
                                            ?>
                                        </select>   

                                    

                                   
                                    </div>
                                </div>   
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                    <div class="cs-field-holder cs-success" >
                                    </br>
                                    
                                        <input class="btn btn-primary" type="button" value="Refresh JamatKhanas" id="getjk" onclick="getDuties();" />        
                                    </div>
                                </div>                                                             
   </br>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                 </br>
                                    <div id="duties" class="cs-field-holder cs-success" >

                                        
                                    </div>
                                     </br>
                                </div>                                 


                                <?php  foreach($result  as $data) { ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-field-holder cs-success">
                                        <i class="icon"></i>
                                        <input name="<?php echo $data->field_name; ?>" type="<?php echo $data->input_type; ?>" placeholder="<?php echo $data->field_lable; ?>" value="<?php echo $data->value; ?>" required >
                                    </div>
                                </div>
                                <?php } ?>    
                                   </br>                            
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-field-holder">
                                        <div class="cs-radio">
                                            <input type="radio" name="radio" value="male" id="radio1">
                                            <label for="radio1">Male</label>
                                        </div>
                                        <div class="cs-radio">
                                            <input type="radio" name="radio" value="female" id="radio2">
                                            <label for="radio2">Female</label>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-btn-submit">
                                        <input type="submit" value="Update" >
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
    <script type="text/javascript">
var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ ){
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    
    document.getElementById('captchaText').innerHTML =text;

function captcha()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ ){
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }

    document.getElementById('captchaText').innerHTML =text;
     document.getElementById('captchaError').innerHTML = "";

}
function verify (){
    var userInput = document.getElementById('captchaInput').value;

    if( userInput == text ){
    } else {
        captcha()
        document.getElementById('captchaError').innerHTML ="The captcha is not valid ";
        
        return false;
    }

}

function getDuties() {
    var jks = $('#jks').val();
    var uid = $('#userid').val();


    $.post('<?php echo site_url('editProfile/getDuties') ?>', {
        state: jks,
        userid: uid
    }, function(data) {

        $('#duties').show().html(data);

    });     
}

	$(document).ready(function() {
		getDuties();
	});

    </script>
