<script src="http://tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://dbrekalo.github.io/fastselect/dist/fastselect.min.css">

<script src="https://dbrekalo.github.io/fastselect/dist/fastselect.standalone.js"></script>

 <script>
        tinymce.init({selector:'textarea'});

    </script>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small >Samar Mayat</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Samar Mayat</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">

      <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#samarMayat" data-toggle="tab" aria-expanded="true">Samar</a></li>
							<li class=""><a href="#emailNotification" data-toggle="tab" aria-expanded="false">Email Notification</a></li>
              <li class="" onclick="addForm()"><a href="#add" data-toggle="tab" aria-expanded="false">Add Samar</a></li>
            </ul>
        </div>
      </div>
          <div class="tab-content">
            <div class="tab-pane active" id="samarMayat"> 
            
              <div class="row">
                <div class="col-md-12">

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Samar</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('admin/addDuty') ?>" method="post" >
                            <div class="box-body">

                            </div><!-- /.box-body -->
                            <div class="box-footer">

                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <input type="text" name="name" class="form-control" id="search" placeholder="Type to search...">

                                    </div>
                                </div>
                            <table class="table table-striped" id="table" width="80%">
                                <thead>
                                    <tr>
                                        <th> Name</th>
                                        <th> Original From</th>
                                        <th> Age</th>
                                        <th> On</th>
                                        <th> Observed By</th>
                                        <th> Family Name</th>
                                        <th> Family Phone </th>
                                        <th> Submitted By</th>
                                        <th> Position</th>
                                        <th> Phone</th>
                                        <th> Jamatkhana Name</th>
                                        <th> Status</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                            foreach($data['samarMayat'] as $item) {
                            $modalClass =  'data-toggle="modal" data-target="#waara-date-modal"  ';     
                            $template =  '<tr>
                                
                                        <td> '. $item->title . ' ' . $item->first_name . ' ' . $item->last_name .'</td>
                                        <td> '. $item->original_from .'</td> 
                                        <td> '. $item->age .'</td> 
                                        <td> '. $item->on .'</td>                                         
                                        <td> '. $item->observedBy .'</td> 
                                        <td> '. $item->familyName .'</td> 
                                        <td> '. $item->familyPhone .'</td>
                                        <td> '. $item->submittedBy .'</td>
                                        <td> '. $item->position .'</td>
                                        <td> '. $item->phone .'</td>
                                        <td> '. $item->jkName .'</td> 
                                        <td style="cursor:  pointer;" onclick="changeStatus('. $item->id .', this)">'.$item->status.'</td> 
                                        <td><a href="' .site_url('SamarMayat/delete?type='.$item->type.'&id='.$item->id) . '" > <span class="glyphicon glyphicon-trash"></span></a></td>
 
                                           
                                        
                                        </tr>';
                                        
                                              
                              echo $template =   $template . '</tr>';

                            }
                        ?>     
                                </tbody>
                            </table>                                    
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                
                            </div><!-- /.box-footer -->
                    </div><!-- /.box -->

                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
            </div>
            <div class="tab-pane " id="emailNotification">
            
             <div class="row">
                <div class="col-md-12">

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Email Notification Content</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                      
                            <div class="box-body">
                               <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Users</label>
                                    <div class="col-sm-10">
                                      <select class="control-label multipleSelect" name="users" multiple>
                                        <?php  foreach($data['users'] as $item) { ?>
                                        <option <?php echo ($item->status == 0 ? '' : 'selected'); ?>  value="<?php echo $item->user_id; ?>"><?php echo $item->name; ?></option>
                                        <?php } ?>
                                      </select>
                                     
                                      <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">
                                        <br>
                                        <button onclick="saveUsers()" type="button" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>
                                      <br><br><br>
                                    </div>
                                </div>
                              
                               <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('SamarMayat/addNotification') ?>" method="post" >

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
                                    <label for="" class="col-sm-10 control-label" style="text-align: left;"> TITLE,&nbsp;&nbsp; FIRST-NAME,&nbsp;&nbsp; LAST-NAME,&nbsp;&nbsp; JK-NAME,&nbsp;&nbsp; SAMAR-ON,&nbsp;&nbsp; ORIGINAL-FROM, &nbsp;&nbsp; OBSERVED-BY,&nbsp;&nbsp; FAMILY-NAME,&nbsp;&nbsp; FAMILY-PHONE, &nbsp;&nbsp; SUBMITTED-BY, &nbsp;&nbsp; POSITION, &nbsp;&nbsp; AGE, &nbsp;&nbsp; PHONE </label>
                                    </div>
                                </div>
                                <input name="type" type="hidden" class="col-sm-4 " value="samar">

                               <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Subject</label>
                                    <div class="col-sm-8">
                                      <input name="subject" type="text" class="col-sm-4 " value="<?php echo $data['emailNotification'][0]->subject; ?>">
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
            </div>
          </div>
            <!-- Main row -->
            
                </div>

            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div>
</div>


<div class="modal fade" id="waara-date-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> </h4>
            </div>
            <form method="Post" action="<?php echo site_url('admin/saveDutyDates') ?>">
                <div class="container col-sm-12 ">
                    <div  class="col-sm-12 ">
                        <div class="form-group col-sm-12">
                            </br>
                            <div  class="col-sm-12 ">
                                <table class="table" id="waara-dates-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Dates</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                    </tbody>
                                </table>
                                <input name="dutyid"  type="hidden" id="dutyid">                                         
                               
                              <button type="submit"  class="btn btn-primary pull-right" style="width: 30%;">Save</button>
                               
                            </div>
              </form>
            </div>
            </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
  <script>
  var addForm = function addForm (){
    
    window.location.href = "http://waaranet.ca/index.php/announcement/samar";

  }  
  $('.multipleSelect').fastselect();
    var saveUsers = function saveUsers(){
    var users = $('.multipleSelect').val();

     
         $.ajax({
              url: "<?php echo site_url('SamarMayat/saveUsers') ?>",
              type: "POST",
              data: {
                  'users' : users.join(",")
              },
              success: function(response){

              },
              error: function(){

              }
          });    
  }
    
   var currentEmailNotification =document.getElementById("currentEmailNotification").value;

    document.getElementById("emailNotificationSwitch").checked = (currentEmailNotification == 'true');

    var toggleEmailNotification = function toggleEmailNotification(){

      var emailNotification = document.getElementById("emailNotificationSwitch").checked;

      $.ajax({
          url: "<?php echo site_url('SamarMayat/setSwitchNotification') ?>",
          type: "POST",
          data: {
              'samarMayatEmailNotification' : emailNotification
          },
          success: function(response){

          },
          error: function(){

          }
      });

    }
    
  </script>
<script>
var changeStatus = function  changeStatus(samarMayat_id, obj){
      var status = '';
      if($(obj).text() == 'approved'){
         status = 'pending';
      } else {
         status = 'approved';
      } 
    $.post('<?php echo site_url('SamarMayat/changeStatus') ?>', {
        id: samarMayat_id,
        type: 'samar',
        status :status
    }, function(data) {

        $(obj).text(status);

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
                            