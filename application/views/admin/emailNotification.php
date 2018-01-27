<body class="hold-transition skin-green sidebar-mini">
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>

    <!-- Just be careful that you give correct path to your tinymce.min.js file, above is the default example -->
    <script>
        tinymce.init({selector:'textarea'});

    </script>
  <div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small >Control panel</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Email Notification</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Email Notification Content</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('EmailNotification/add') ?>" method="post" >
                            <div class="box-body">
                               <div class="form-group">
                                  <input type="hidden" value="<?php echo $data['emailNotificationSwitch'][0]->notification; ?>" id="currentEmailNotification" > 
                                 <label for="" class="col-sm-2 control-label">Email Notification:</label>
                                 <div class="col-sm-8">
                                   
                                  <label class="switch">
                                    <input id="emailNotificationSwitch" type="checkbox" onChange="toggleEmailNotification()">
                                      <div class="slider round"></div>
                                  </label>
                                 </div>
                               </div>
                             

                               <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Keywords</label>
                                    <div class="col-sm-8">
                                    <label for="" class="col-sm-8 control-label" style="text-align: left;"> ASSIGN-DATE,&nbsp;&nbsp; JK-NAME,&nbsp;&nbsp; WARRA-NAME,&nbsp;&nbsp; USER-FULLNAME </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Content</label>
                                    <div class="col-sm-8">
                                      <textarea name="content"><?php echo $data['emailNotification'][0]->content; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">

                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">

                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
                </div>

            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div>
</div>
  <script>
   var currentEmailNotification =document.getElementById("currentEmailNotification").value;

    document.getElementById("emailNotificationSwitch").checked = (currentEmailNotification == 'true');

    var toggleEmailNotification = function toggleEmailNotification(){

      var emailNotification = document.getElementById("emailNotificationSwitch").checked;

      $.ajax({
          url: "<?php echo site_url('EmailNotification/setNotification') ?>",
          type: "POST",
          data: {
              'emailNotification' : emailNotification
          },
          success: function(response){

          },
          error: function(){

          }
      });

    }
    
  </script>
  <style>
  /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
  </style>
