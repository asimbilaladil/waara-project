<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small >Control panel</small>
            </h1>

            <?php  echo $this->breadcrumbs->show(); ?>
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add new Duty</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('admin/addNewDuty') ?>" method="post" >
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="duty_name" class="form-control" id="duty_name" placeholder="" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Add Before</label>
                                    <div class="col-sm-6">
                                        
                                        <select id="beforeDuty" name="beforeDuty" class="form-control">
                                            
                                            <?php
                                                $lastPriority = end($data['duty'])->priority + 1 ;

                                                //$lastPriority = array_pop($data['duty'])->priority + 1;

                                                echo '<option value="'. $lastPriority  .'" selected> </option>'; 

                                                foreach( $data['duty'] as $row ) {
                                                    echo '<option value="'. $row->priority .'" > '. $row->name .' </option>';
                                                }



                                            ?>

                                        </select>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-6">
                                        <textarea type="text" name="description" class="form-control" id="" placeholder="" required >  
                                        </textarea>
                                    </div>
                                </div>   

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Select JK</label>
                                    <div class="col-sm-6">
                                      <select name="jk[]" multiple id="jk" class="form-control">                              
                                      <?php foreach($data['jkDb'] as $category):?>                                              
                                          <?php $selected = in_array($category->id,$jkArray) ? " selected " : null;?>
                                              <option value="<?=$category->id?>"
                                                  <?=$selected?> ><?=$category->name?>
                                              </option>
                                      <?php endforeach?>
                                      </select>                                   
                                    </div>
                                </div>
                                <input type="hidden" name="addDutyDate" value="<?php echo isset( $_COOKIE['addDutyDate'] ) ?  $_COOKIE['addDutyDate']  : 'all' ?>"/>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-2">

                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">




                                </br> </br>
                        <div class="box-header with-border">
                                <h3 class="box-title">List Of DUTY:</h3>
                            </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <input type="text" name="name" class="form-control" id="search" placeholder="Type to search...">

                                    </div>
                                </div>
                      <div class="col-md-6">
                        <h4>Every Day Waara</h4>
                               <div style="overflow-x:auto;">
                            <table class="table table-striped" id="table" width="80%" s>
                                <thead>
                                    <tr>
                                        <th> Name</th>

                                        <th> Status</th>

                                       <th> Duty Type</th> 
                                      <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                            foreach($data['duty'] as $key => $item) {
                              if($item->for_day == 'all'){
                            $modalClass =  'data-toggle="modal" data-target="#waara-date-modal"  ';     
                            $template =  '<tr id="dutyRow_' . $item->duty_id.'">
                            
                                        <td style="text-transform: uppercase;" class="nameRow_'. $key .'"> <a '. ($item->for_day == 'all' ? "" : 'onclick="autofill('. $key .')"' ). '>'. $item->name .'</a></td>
                                        <td class="beforeRow_'. $key .'" style="display:none;" >'. $item->priority .'</td>

                                        <td id="dutyStatus_' . $item->duty_id.'"> <a style="cursor:  pointer;" onclick="changeDutyStatus('.$item->duty_id.','. $item->isEnable.')" >'. ( $item->isEnable == 1 ? "Disable": "Enable")  .' </a></td>
                                        <td> '. ($item->for_day == 'all' ? ' <button id="changeDuty_'.$item->duty_id.'" type="button" onclick="changeDutyType( &#39;specific&#39;,'. $item->duty_id. ' )" class="btn btn-primary" style="padding: 7px 19px; ">Specific</button>' : ' <button id="changeDuty_'.$item->duty_id.'" type="button" onclick="changeDutyType( &#39;global&#39;,'. $item->duty_id. ' )" class="btn btn-primary" style="padding: 7px 23px; ">Global</button>') . ' </td>';
                                        
                                      if($_SESSION['type'] == 'Super Admin'){
                                        $template =   $template .' <td > 
                                            <a href="'. site_url('admin/editDuty?id=' . $item->duty_id ) .'" ><span class="glyphicon glyphicon-pencil"></span> </a>
                                            <span>&nbsp;&nbsp;</span>
                                           <a style="cursor:  pointer;" onclick="removeDuty('.$item->duty_id.')"  > <span class="glyphicon glyphicon-trash"></span></a>
                                         </td>
                                         ';
                                        }
                                              
                              echo $template =   $template . '</tr>';
                                
                              }

                            }
                        ?>                                
                                </tbody>
                            </table>    
                      </div>
                      </div>
                      <div class="col-md-6">
                         <h4>Specific Day Waara</h4>
                               <div style="overflow-x:auto;">
                            <table class="table table-striped" id="table" width="80%" s>
                                <thead>
                                    <tr>
                                        <th> Name</th>

                                        <th> Status</th>
                                      <th> Type</th>
                                       <th> Duty Type</th> 
                                      <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                            foreach($data['duty'] as $key => $item) {
                              if($item->for_day != 'all'){
                            $modalClass =  'data-toggle="modal" data-target="#waara-date-modal"  ';     
                            $template =  '<tr id="dutyRow_' . $item->duty_id.'">
                            
                                        <td style="text-transform: uppercase;" class="nameRow_'. $key .'"> <a '. ($item->for_day == 'all' ? "" : 'onclick="autofill('. $key .')"' ). '>'. $item->name .'</a></td>
                                        <td class="beforeRow_'. $key .'" style="display:none;" >'. $item->priority .'</td>

                                        <td id="dutyStatus_' . $item->duty_id.'"> <a style="cursor:  pointer;" onclick="changeDutyStatus('.$item->duty_id.','. $item->isEnable.')">'. ( $item->isEnable == 1 ? "Disable": "Enable")  .' </a></td>
                                        <td id="type_'.$item->duty_id.'"> <a  '. ($item->for_day == 'all' ? "" : $modalClass .  'onclick="setData('. $item->duty_id. ', &#39;'. $item->name .'&#39;,&#39;'. $item->for_day .'&#39;)"'   ) . ' href="#">'. ($item->for_day == 'all' ? "All Days" : "Specific Days") .' </a></td>
                                        <td > '. ($item->for_day == 'all' ? ' <button id="changeDuty_'.$item->duty_id.'" type="button" onclick="changeDutyType( &#39;specific&#39;,'. $item->duty_id. ' )" class="btn btn-primary" style="padding: 7px 19px; ">Specific</button>' : ' <button id="changeDuty_'.$item->duty_id.'" type="button" onclick="changeDutyType( &#39;global&#39;,'. $item->duty_id. ' )" class="btn btn-primary" style="padding: 7px 23px; ">Global</button>') . ' </td>';
                                        
                                      if($_SESSION['type'] == 'Super Admin'){
                                        $template =   $template .' <td > 
                                            <a href="'. site_url('admin/editDuty?id=' . $item->duty_id ) .'" ><span class="glyphicon glyphicon-pencil"></span> </a>
                                            <span>&nbsp;&nbsp;</span>
                                           <a style="cursor:  pointer;" onclick="removeDuty('.$item->duty_id.')" > <span class="glyphicon glyphicon-trash"></span></a>
                                         </td>
                                         ';
                                        }
                                              
                              echo $template =   $template . '</tr>';                         
                              }
       

                            }
                        ?>                                
                                </tbody>
                            </table>    
                      </div>
                      </div>
               
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                
                            </div><!-- /.box-footer -->
                    </div><!-- /.box -->

                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
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
            
                <div class="container col-sm-12 ">
                    <div class="form-group col-sm-12">
                      <div class="col-sm-12 ">
                      <div  class="col-sm-4 col-sm-offset-8">
                        <br>
                        <button type="button" onclick="addDates()"  class="btn btn-primary" style="width: 100%;">Add Date</button>
                      </div>
                      </div>
                      <form method="Post" action="<?php echo site_url('admin/saveDutyDates') ?>">
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
var globalCount = 1;  
var changeDutyStatus = function changeDutyStatus(duty_id, status){
        $.ajax({
          url: "<?php echo site_url('Admin/enableDisableWaara') ?>",
          type: "GET",
          data: {
            'id' : duty_id,
            'status' : status, 
          },
          success: function(response){
            var statusText =  (status == 1 ? "Enable": "Disable");
            status =  (status == 1 ? 0: 1);
            $('#dutyStatus_'+duty_id).html('<a  style="cursor:  pointer;" onclick="changeDutyStatus('+duty_id+','+status+')" >'+ statusText  +' </a>')
            

          },
          error: function(){

          }
     });
}  
var changeDutyType = function changeDutyType(type, id){
      var day = '';
      var buttonHTML = '<button id="changeDuty_'+id+'" type="button" onclick="changeDutyType( &#39;global&#39;,'+id+' )" class="btn btn-primary" style="width: 60%;">Global</button>';
      if(type == 'global'){
        day = 'all'
        buttonHTML = '<button id="changeDuty_'+id+'" type="button" onclick="changeDutyType( &#39;specific&#39;,'+id+' )" class="btn btn-primary" style="width: 60%;">Specific</button>';

      } 
      $.ajax({
          url: "<?php echo site_url('Admin/changeDutyType') ?>",
          type: "POST",
          data: {
            'for_day' : day,
            'duty_id' : id, 
          },
          success: function(response){
            //$('#changeDuty_'+id).replaceWith(buttonHTML)
            location.reload();

          },
          error: function(){

          }
     });  
}
var addDates = function addDates(){
  var i = globalCount - 1;
  globalCount = globalCount + 1;
   $('#waara-dates-table tbody').append('<tr id="row_'+i+'" class="child"><td>'+ globalCount +'</td><td>  <input required type="date" name="duty_date[]" class="form-control" value="" ></td><td><a onclick="deleteRow('+i+')" > <span class="glyphicon glyphicon-trash"></span></a></td></tr>');

}
var removeDuty = function removeDuty(duty_id){
    $.ajax({
        url: "<?php echo site_url('Admin/deleteDuty') ?>",
        type: "GET",
        data: {
          'id' : duty_id 
        },
        success: function(response){
          $("#dutyRow_" + duty_id).remove();
        },
        error: function(){

        }
    });

}
var deleteRow = function deleteRow(id){
  $("#row_" + id).remove();
}  
var setData =  function  setData( id, name, dates ){
   $( ".modal-title" ).text(name + " Dates");
   $( "#dutyid" ).val(id);
   $("#waara-dates-table tbody").empty();

   var date = dates.split(',');
   for( var i = 0; i< date.length; i++ ){
     var count = i + 1;
     globalCount = count;
     if(date[i] != 'all'){
       $('#waara-dates-table tbody').append('<tr id="row_'+i+'" class="child"><td>'+ count +'</td><td>  <input required type="date" name="duty_date[]" class="form-control" value="'+ date[i] +'" ></td><td><a onclick="deleteRow('+i+')" > <span class="glyphicon glyphicon-trash"></span></a></td></tr>');
     }
   }
   

} 
function eraseCookie(name) {
    createCookie(name,"",-1);
}
function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}  
eraseCookie("addDutyDate");
var autofill = function autofill(key){

 $('#duty_name').val( $.trim($('.nameRow_'+key).text()));
 $('#beforeDuty').val( $('.beforeRow_'+key).text());
}
</script>