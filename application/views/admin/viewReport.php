
<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
<script>
    webshims.setOptions('forms-ext', {types: 'date'});
    webshims.polyfill('forms forms-ext');
</script>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Report <small >Control panel</small> </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Report</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Report</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form id="defaultForm" class="form-horizontal" action="<?php echo site_url('admin/addDuty') ?>" method="post" >


                            <div class="box-footer">




                                </br> </br>
                        <div id="reportAfterResult" >        
                          
                            <div  class="form-group"  >
                                <label for="" class="col-sm-2 control-label">Report Name</label>
                                <div class="col-sm-6">
                                    <label for="" class=" control-label"><?php echo $data['name']; ?></label>
                                </div>
                            </div> 
                            <div  class="form-group"  >
                                <label for="" class="col-sm-2 control-label">Filter</label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                      <input checked id="last14" onchange="hide()" type="radio" value="14" name="filter">Last 14 Days
                                    </label>
                                    <label class="radio-inline">
                                      <input id="future14" onchange="hide()"  type="radio" value="28"  name="filter">Future 14 Days
                                    </label>
                                    <label class="radio-inline">
                                      <input id="range" onchange="hide()" type="radio"  value="range" name="filter">Date Range
                                    </label>
                                    <label class="radio-inline">
                                      <input id="all" onchange="hide()"  type="radio"  value="all" name="filter">All
                                    </label>
                                </div>
                            </div> 
                            <div  id="start_date_div"  class="form-group"  >
                                <label for="" class="col-sm-2 control-label">Start Date</label>
                                <div class="col-sm-4">
                                <input id="start_date" type="date" name="start_date" class="form-control col-sm-4">
                                </div>
                            </div>  
                            <div id="end_date_div"  class="form-group"  >
                                <label for="" class="col-sm-2 control-label">End Date</label>
                                <div class="col-sm-4">
                                    <input id="end_date" type="date" name="end_date" class="form-control col-sm-4">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-2">
                                   <input id="duties" type="hidden" name="duties" value="<?php echo $data['duties']; ?>">
                                   <input id="jk" type="hidden" name="jk" value="<?php echo $data['jk']; ?>">
                                </div>                                    
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-2">
                                    <button onclick="getReportData()" type="button" class="btn btn-primary btn-block">Go</button>
                                </div>                                    
                            </div>                                                                                       

                        </div>                          
                        <div id="reportResult">
                                                   
                        <div  class="box-header with-border" >
                                <h3 class="box-title">Report Result:</h3>
                        </div>
                                <div class="form-group col-sm-6">
                                    <div class="col-sm-4">
                                        <input type="text" name="name" class="form-control" id="search" placeholder="Type to search...">

                                    </div>
                                </div>
                                 <div class="form-group col-sm-6">
                                    <label class="control-label col-sm-6" >Filter By Age Group:</label>
                                    <div class="col-sm-6"> 
                                       <select id="filterByAgeGroup" class="form-control">
                                        <option  value="select">Select</option>  
                                        <?php foreach($data['ageGroup'] as $item) { ?>
                                          <option  value="<?php echo $item->age_group ; ?>" > <?php echo $item->age_group ; ?></option>
                                        <?php } ?>
                                     </select>
                                    </div>
                                </div> 
                            <table class="table table-striped" id="reportTable" width="80%">
                                <thead>
                                    <tr>
                                        <th id="userName"> Name</th>
                                        <th> Date</th>
                                        <th> Status</th>
                                    </tr>
                                </thead>
                                <tbody id="tableData">
                                                    
                                </tbody>
                            </table> 

                            </div><!-- /.box-body -->
                             </div> 
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

 <!-- Modal -->
  <div class="modal fade" id="assignWaara" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Assign Waara</h4>
        </div>
        <div class="modal-body">
            <div class="form-group col-sm-12">
                <label for="" class="col-sm-2 control-label">Waara</label>
                <div class="col-sm-6">
                    <select  name="waara"  id="waara" class="form-control">  
                        <option value="select"> Select waara</option>
                        <?php foreach ($data['waara_details'] as $key => $value) {
                            echo '<option value="'. $value->duty_id .'" >'. $value->name .'  </option>';
                        } ?>
                        <?php foreach ($data['excluded_waara'] as $key => $value) {
                            echo '<option value="'. $value->duty_id .'" >'. $value->name .'  </option>';
                        } ?>
                    </select>                                   
                </div>
            </div>

            <div class="form-group col-sm-12">
                <label for="" class="col-sm-2 control-label">Date</label>
                <div class="col-sm-6">
                    <input type="date" name="date" class="form-control" id="date" >
                </div>
            </div>      

            <input type="hidden" name="user" class="form-control" id="user" >

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="assignWaara()">Save</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- Modal -->
<button id="userInfoButton" style="display:none;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#userInfoModal">Open Modal</button>
<div id="userInfoModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User Information</h4>
      </div>
      <div class="modal-body">
         <div class="form-group col-sm-12">
                <label for="" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-8">
                    <label for="" class="col-sm-12 control-label" id="userInfoName"></label>
                </div>
         </div>  
         <div class="form-group col-sm-12">
                <label for="" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-8">
                    <label for="" class="col-sm-12 control-label" id="userInfoEmail"></label>
                </div>
         </div>  
         <div class="form-group col-sm-12">
                <label for="" class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-8">
                    <label for="" class="col-sm-12  control-label" id="userInfoPhone"></label>
                </div>
         </div>          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">User History</h4>
                </div>
                <div class="modal-body">
                    <div id="userHistory">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<script>
  function convertDate(d) {
  var p = d.split("-");

  return (p[0]+p[1]+p[2]);
}
function sortByDate() {

  var tbody = document.querySelector("#userHistoryt tbody");
  // get trs as array for ease of use
  var rows = [].slice.call(tbody.querySelectorAll("tr"));
  
  rows.sort(function(a,b) {
    return convertDate(b.cells[3].innerHTML) - convertDate(a.cells[3].innerHTML);
  });
  
  rows.forEach(function(v) {

    tbody.appendChild(v); // note that .appendChild() *moves* elements
  });
}

function ajaxCallUserHistory(dutyId) {


   $('#selectedDuty').val(dutyId);
   
    $.post('<?php echo site_url('Admin/ajaxUserHistory') ?>', {
        state:dutyId
    }, function(data) {
       
        $('#userHistory').show().html(data);
        $('#myModal').modal('toggle');
    }); 

}

</script>
<script type="text/javascript">
  
  var runQuery = true;
  
  function setId(id){
        $('#user').val(id); 
    }
    function assignWaara(){
        var user_id = $('#user').val(); 
        var date =  $('#date').val(); 
        var waara = $('#waara').val(); 
        var jk = $('#jk').val();

        $.ajax({
            url: "<?php echo site_url('Report/assignWaara') ?>",
            type: "POST",
            data: {
                'user_id' : user_id,
                'start_date' : date,
                'end_date' : date,
                'duty_id' : waara,
                'jk' : jk
            },
            success: function(response){
                alert(response);
            },
            error: function(){
                
            }
        });         
    }    
    function getReportData(){
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        if(start_date === ''){

         if (document.getElementById('last14').checked) {

            var currentdate = new Date();
            var todayDate = currentdate.getFullYear() + ( (currentdate.getMonth()+1) > 9 ? "-" : "-0") + (currentdate.getMonth()+1)  + ( (currentdate.getDate()) > 9 ? "-" : "-0") +  currentdate.getDate() 
            currentdate.setDate(currentdate.getDate()-14);
            var nextDate = currentdate.getFullYear() + ( (currentdate.getMonth()+1) > 9 ? "-" : "-0") + (currentdate.getMonth()+1)  + ( (currentdate.getDate()) > 9 ? "-" : "-0") +  currentdate.getDate() 
            start_date = todayDate
            end_date = nextDate

          } else if (document.getElementById('future14').checked) {

            var currentdate = new Date();
            var todayDate = currentdate.getFullYear() + ( (currentdate.getMonth()+1) > 9 ? "-" : "-0") + (currentdate.getMonth()+1)  + ( (currentdate.getDate()) > 9 ? "-" : "-0") +  currentdate.getDate() 
            currentdate.setDate(currentdate.getDate()+14);
            var nextDate = currentdate.getFullYear() + ( (currentdate.getMonth()+1) > 9 ? "-" : "-0") + (currentdate.getMonth()+1)  + ( (currentdate.getDate()) > 9 ? "-" : "-0") +  currentdate.getDate() 
            start_date = todayDate
            end_date = nextDate

          } 
        }
      if (document.getElementById('range').checked) {
            start_date = $('#end_date').val();
            end_date = $('#start_date').val();

      }           
        var duties = $('#duties').val();
        var highlight = false;
       if (document.getElementById('all').checked) {
             
            highlight = true;
        } 
     
        $.ajax({
            url: "<?php echo site_url('Report/getReport') ?>",
            type: "POST",
            data: {
                'start_date' : start_date,
                'end_date' : end_date,
                'duties' : duties,
                'highlight' : highlight,
                'runQuery' : runQuery 
            },
            success: function(response){
                //$('#reportResult').show();
               
                $('#tableData').html(response);  
                isEditAllowed();
                //sortByDate();  

            },
            error: function(){
                
            }
        });            
       
    }
    var table = $('table');
    
        $('#userName')
            .wrapInner('<span title="sort this column"/>')
            .each(function(){
                
                var th = $(this),
                    thIndex = th.index(),
                    inverse = false;
                
                th.click(function(){
                    
                    table.find('td').filter(function(){
                        
                        return $(this).index() === thIndex;
                        
                    }).sortElements(function(a, b){
                        
                        return $.text([a]) > $.text([b]) ?
                            inverse ? -1 : 1
                            : inverse ? 1 : -1;
                        
                    }, function(){
                        
                        // parentNode is the element we want to move
                        return this.parentNode; 
                        
                    });
                    
                    inverse = !inverse;
                        
                });
                
    });
var start_date_div = $('#start_date_div').hide();
var end_date_div = $('#end_date_div').hide(); 
var start_date = $('#start_date');
var end_date = $('#end_date'); 

  var hide = function hide () {
    

 if (document.getElementById('last14').checked) {
    start_date_div.hide();
    end_date_div.hide();
    var currentdate = new Date();
    var todayDate = currentdate.getFullYear() + ( (currentdate.getMonth()+1) > 9 ? "-" : "-0") + (currentdate.getMonth()+1)  + ( (currentdate.getDate()) > 9 ? "-" : "-0") +  currentdate.getDate() 
    currentdate.setDate(currentdate.getDate()-14);
    var nextDate = currentdate.getFullYear() + ( (currentdate.getMonth()+1) > 9 ? "-" : "-0") + (currentdate.getMonth()+1)  + ( (currentdate.getDate()) > 9 ? "-" : "-0") +  currentdate.getDate() 

    $('#start_date').val(nextDate);
    $('#end_date').val(todayDate);   
    runQuery = true;

  } else if (document.getElementById('future14').checked) {
    start_date_div.hide();
    end_date_div.hide();
    var currentdate = new Date();
    var todayDate = currentdate.getFullYear() + ( (currentdate.getMonth()+1) > 9 ? "-" : "-0") + (currentdate.getMonth()+1)  + ( (currentdate.getDate()) > 9 ? "-" : "-0") +  currentdate.getDate() 
    currentdate.setDate(currentdate.getDate()+14);
    var nextDate = currentdate.getFullYear() + ( (currentdate.getMonth()+1) > 9 ? "-" : "-0") + (currentdate.getMonth()+1)  + ( (currentdate.getDate()) > 9 ? "-" : "-0") +  currentdate.getDate() 


    $('#start_date').val(todayDate);
    $('#end_date').val(nextDate);    
    runQuery = true;
    
  } else if (document.getElementById('range').checked) {
    start_date_div.show();
    end_date_div.show();
    $('#start_date').val('');
    $('#end_date').val('');   
    runQuery = true;
    
  } else if (document.getElementById('all').checked) {
    start_date_div.hide();
    end_date_div.hide();
    $('#start_date').val('');
    $('#end_date').val('');     
    var currentdate = new Date();
    var todayDate = '2050-12-30' 
    var nextDate = '1990-01-01' 
    $('#start_date').val(todayDate);
    $('#end_date').val(nextDate);
    runQuery = false;

  }
  
}

  var showInfo =  function showInfo(id){

    var Cells = id.getElementsByTagName("td");
    var name = Cells[0].innerText;
    var email = Cells[2].innerText;
    var phone = Cells[3].innerText;
    document.getElementById('userInfoName').innerHTML = name;
    document.getElementById('userInfoEmail').innerHTML = email;
    document.getElementById('userInfoPhone').innerHTML = phone;
   document.getElementById("userInfoButton").click();

    
  }


    // Write on keyup event of keyword input element
    $("#filterByAgeGroup").change(function() {
        _this = this;
        // Show only matching TR, hide rest of them
        var ageGroup = $(_this).val();

        $.each($("#reportTable tbody tr"), function() {
            if ($(this).text().toLowerCase().indexOf(ageGroup.toLowerCase()) === -1) {

                if (ageGroup == 'select') {
                    $(this).show();
                } else {
                    $(this).hide();
                }

            } else
                $(this).show();
        });
            
    });




</script>