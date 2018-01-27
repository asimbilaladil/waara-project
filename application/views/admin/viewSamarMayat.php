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
              <li class="active"><a href="#samarMayat" data-toggle="tab" aria-expanded="true">Mayat</a></li>
							<li class=""><a href="#emailNotification" data-toggle="tab" aria-expanded="false">Email Notification</a></li>
							<li onclick="addForm()" class=""><a href="#addMayat" data-toggle="tab" aria-expanded="false">Add Mayat</a></li>
							<li class=""><a href="#redirectUrl" data-toggle="tab" aria-expanded="false">Redirect Url</a></li>
							<li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Settings</a></li>

						</ul>
        </div>
      </div>
          <div class="tab-content">
            <div class="tab-pane active" id="samarMayat"> 
            
              <div class="row">
                <div class="col-md-12">

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Mayat</h3>
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
																			<?php if(in_array('title',$data['mayatTableValues']) || in_array('first_name',$data['mayatTableValues']) || in_array('last_name',$data['mayatTableValues'])){ ?>
																					<th> Name</th>
																			<?php } ?>
																			<?php if(in_array('original_from',$data['mayatTableValues'])){ ?>
																					 <th> Original From</th>
																			<?php } ?>
																			<?php if(in_array('age',$data['mayatTableValues'])){ ?>
																					<th> Age</th>
																			<?php } ?>
																			<?php if(in_array('funeral_date',$data['mayatTableValues'])){ ?>
																					 <th> Funeral Date</th>
																			<?php } ?>
																			<?php if(in_array('date',$data['mayatTableValues'])){ ?>
																					 <th> Date</th>
																			<?php } ?>
																			<?php if(in_array('time',$data['mayatTableValues'])){ ?>
																					<th> Time</th>
																			<?php } ?>
																			<?php if(in_array('jk_id',$data['mayatTableValues'])){ ?>
																					 <th> Jamatkhana Name</th>
																			<?php } ?>																			
                                        <th> Status</th>
																				<th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                            foreach($data['samarMayat'] as $item) {
                            $modalClass =  'data-toggle="modal" data-target="#waara-date-modal"  ';     
                              
															$title = in_array('title',$data['mayatTableValues']) ? $item->title : '';
															$first_name = in_array('first_name',$data['mayatTableValues']) ? $item->first_name : '';
															$last_name = in_array('last_name',$data['mayatTableValues']) ? $item->last_name : '';
															$original_from = in_array('original_from',$data['mayatTableValues']) ? $item->original_from : '';
															$age = in_array('age',$data['mayatTableValues']) ? $item->age : '';
															$funeral_date = in_array('funeral_date',$data['mayatTableValues']) ? $item->funeral_date : '';
															$date = in_array('date',$data['mayatTableValues']) ? $item->date : '';
															$time = in_array('time',$data['mayatTableValues']) ? $item->time : '';
															$jkName = in_array('jk_id',$data['mayatTableValues']) ? $item->jkName : '';

															
															$template =  '<tr>'; 
                                				if( !empty($title) || !empty($first_name) || !empty($last_name) ){
																					$template = $template . '<td> '. $title . ' ' . $first_name . ' ' . $last_name .'</td>';
																				}
                                        if(!empty($original_from)){
																					$template = $template . '<td> '. $original_from .'</td>'; 
																				}
                                        if(!empty($age)){
																					$template = $template . '<td> '. $age .'</td>'; 
																				}
																				if(!empty($funeral_date)){
																										$template = $template . '<td> '. $funeral_date .'</td>'; 
																									}
																				if(!empty($date)){
																										$template = $template . '<td> '. $date .'</td>'; 
																									}
																				if(!empty($time)){
																										$template = $template . '<td> '. $time .'</td>'; 
																									}
																				if(!empty($jkName)){
																										$template = $template . '<td> '. $jkName .'</td>'; 
																									}
															
   
                                        $template = $template . '<td style="cursor:  pointer;" onclick="changeStatus('. $item->id .', this)">'.$item->status.'</td> 
                                        <td><a href="' .site_url('SamarMayat/delete?type='.$item->type.'&id='.$item->id) . '" > <span class="glyphicon glyphicon-trash"></span></a> <a href="' .site_url('SamarMayat/editMayat?id='.$item->id) . '" > <span class="glyphicon glyphicon-pencil"></span></a></td>
                                        
                                           
                                        
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
                                    <label for="" class="col-sm-10 control-label" style="text-align: left;"> TITLE,&nbsp;&nbsp; FIRST-NAME,&nbsp;&nbsp; LAST-NAME,&nbsp;&nbsp; JK-NAME,&nbsp;&nbsp; FUNERAL-DATE, &nbsp;&nbsp; MAYAT-DATE,&nbsp;&nbsp; MAYAT-TIME,&nbsp;&nbsp; TYPE, &nbsp;&nbsp; ORIGINAL-FROM, &nbsp;&nbsp; PERSON-AGE </label>
                                    </div>
                                </div>
                               <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Subject</label>
                                    <div class="col-sm-8">
                                      <input name="subject" type="text" class="col-sm-4 " value="<?php echo $data['emailNotification'][0]->subject; ?>">
                                    </div>
                                </div>                                 
                                      <input name="type" type="hidden" class="col-sm-4 " value="mayat">

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
						<div class="tab-pane " id="redirectUrl">
            
            <div class="row">
									<div class="col-md-12">

											<div class="box box-success">
													<div class="box-header with-border">
															<h3 class="box-title">Mayat Redirect URL</h3>
													</div><!-- /.box-header -->
													<!-- form start -->

															<div class="box-body">
  															<div class="form-group">
                                    <label for="" class="col-sm-2 control-label">URL</label>
                                    <div class="col-sm-8">
                                      <input value="<?php  echo ( !empty($data['url'][0]->url) ? $data['url'][0]->url : '' ); ?>" id="url" name="url" type="text" class="col-sm-4 " >
																			<input id="type" name="type" type="hidden" class="col-sm-4 " value="mayat" >
																			
																			<br><br>
                                    </div>
                                </div>
                      					<div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">

                                        <button onclick="saveURL()" type="button" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>																
															</div>
											</div>
								</div>	
							</div>
						</div>						
						<div class="tab-pane " id="settings">
            
            <div class="row">
									<div class="col-md-12">

											<div class="box box-success">
													<div class="box-header with-border">
															<h3 class="box-title">Settings</h3>
													</div><!-- /.box-header -->
													<!-- form start -->
														<form action="<?php echo site_url('SamarMayat/saveMayatHeader') ?>" method="post" >
															
											
															<div class="box-body">
																<?php foreach($data['tableHeaders'] as $item) { ?>
																		
																<div class="form-group">
                                    <label style="text-transform:capitalize" for="" class="col-sm-2 control-label"><?php echo str_replace( '_' , ' ', $item); ?></label>
                                    <div class="col-sm-10">
                                      <input <?php echo in_array($item, $data['mayatTableValues']) ? 'checked' : ''; ?> name="tableHeader[]" value="<?php echo $item; ?>" type="checkbox" class="col-sm-4 " >
																			
																			<br><br>
                                    </div>
                                </div>
															
																<?php } ?>

                      					<div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">

                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>																
															</div>
																</form>
											</div>
								</div>	
							</div>
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
    var saveURL = function saveURL(){

		var type = $('#type').val();
    var url = $('#url').val();
         $.ajax({
              url: "<?php echo site_url('SamarMayat/saveURL') ?>",
              type: "POST",
              data: {
                  'type' : type,
									'url'  : url
              },
              success: function(response){

              },
              error: function(){

              }
          });    
  }
		
		
		var addForm = function addForm (){
    
    window.location.href = "http://waaranet.ca/index.php/announcement/mayat";

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
        status :status,
				type : 'mayat'
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
                            