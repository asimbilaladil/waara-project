<!-- DataTables -->
<link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<body class="hold-transition skin-green sidebar-mini">
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
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <?php
                    if( isset($data['message']) ) {
                        echo "<div style='text-align: center;' class='alert alert-success alert-dismissable'>
                                                                 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>"
                                                                       .$data['message'].
                                                                "</div>";                
                    } 
                    ?>
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Users</h3>
                              
                            </div>
                          
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="box-body">
                                <div class="form-group">

                                     
                                      
                                       <div class="form-group col-sm-6">
                                          <label class="control-label col-sm-6" >Filter By Age Group:</label>
                                          <div class="col-sm-6"> 
                                             <select id="filterByAge" class="form-control">
                                              <option  value="select">Select</option>  
                                              <?php foreach($data['ageGroup'] as $item) { ?>
                                                <option  value="<?php echo $item->age_group ; ?>" > <?php echo $item->age_group ; ?></option>
                                              <?php } ?>
                                           </select>
                                          </div>
                                       </div> 
                                   <div class="form-group col-sm-6">
                                        <label class="control-label col-sm-2" >Search: </label>
                                          <div class="col-sm-10"> 
                                            <input type="text" name="name" class="form-control" id="search" placeholder="Type to search...">
                                          </div>
                                        </div>
                                      <div class="form-group col-sm-6">
                                        <label class="control-label col-sm-6" >Last Say Waara Search: </label>
                                          <div class="col-sm-6"> 
                                            <input type="number" name="name" class="form-control" id="lastWaaraSearch" placeholder="Type to search...">
                                          </div>
                                        </div>                                  
                                    <div class="form-group col-sm-6">
                                         <label id="totalUser" class="control-label col-sm-6" ></label>
                                      </div>
                                    <div class="form-group col-sm-4">
                                       <button onclick="addNewUser()" type="button" class="btn btn-primary"> Add New User</button>
<!--                                        <button type="button" class="btn btn-primary toggle-vis"  data-column="0" > Merge User</button> --> 
                                    <form action="<?php echo site_url('User/mergeUser') ?>" method="POST">

                                        <input type="hidden" id="mergeUserList" name="mergeUserList"/>

                                        <button type="submit" onclick="mergeUsers()" class="btn btn-primary"> Merge User</button>

                                        

                                    </form>    

                                  </div>       
                                
                                                      
                                </div>
                                </br> </br>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                      <button id="showHideTable" type="button" class="btn btn-primary" style="display:none;"> Waara List </button>
                                    </div>
                                </div>
                     
                                <table  class="table table-bordered table-hover" id="table" width="100%">
                                    <thead>
                                        <tr>
                                            <th> Merge</th>
                                            <th> Full Name</th>
                                            <th> Days Count</th>
                                            <th> Email</th>
                                            <th> Age Group</th>
                                            <th> Assign Waara</th>
                                            <th> Type</th>
                                            <th> Status</th>
                                            <th> Approval</th>   
                                            <th> Action</th>
                                            <th style="display:none;"> </th>
                                            


                             
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <?php
                                            foreach($data['user'] as $item) {
                                              $showColor = ( $item->type != 'User' ) ?  '<button onClick="getColorUserId(' . $item->user_id .')"type="button" data-toggle="modal" data-target="#colorModal" class="btn btn-primary btn-block" style="opacity: 1; background-color:'. $item->color .'; width: 6%;"></button>' : '' ;
                                                $template =   
                                                    '<tr>
                                                        <td> <input type="checkbox" class="mergeUserList" name="mergeUsers[]" onclick="mergeCheck(this)" value="'.$item->user_id.'"> </td>
                                                        <td> <a href="'. site_url('profile/index?id=' . $item->user_id ) .'" >'. $item->first_name.' '. $item->last_name.' </a></td>
                                                        
                                                        <td> <a href="#">'. $item->daysCount .'
                                                        <td> <a href="#">'. $item->email .' </a></td>
                                                        <td> <a href="#">'.  $item->age.' </a></td>
                                                        <td> <button data-toggle="modal" data-target="#assignWaara"  onclick="setId('. $item->user_id .')" class="btn btn-primary"> Assign Waara</button></td>
                                                        <td> <a href="#">'. $item->type .' </a></td>
                                                        <td> <a href="updateStatus?id='.$item->user_id.'&status='.$item->status.'" >'. ( $item->status == 'true' ? 'Active' : 'Inactive')   .' </a></td>
                                                        <td> <a href="updateVerify?id='.$item->user_id.'&verified='.$item->verified.'" >'. ( $item->verified == 'true' ? 'Approved' : 'Pending')   .' </a></td>
                                                        <td>'; 
                                                           if($_SESSION['type'] == 'Super Admin'){
                                                             $template =   $template .'            <a href="'. site_url('admin/edituser?uid=' . $item->user_id ) .'" ><span class="glyphicon glyphicon-pencil"></span> </a>
                                                                        <span>&nbsp;&nbsp;</span>
                                                                       <a href="deleteUser?id='.$item->user_id.'" > <span class="glyphicon glyphicon-trash"></span></a>';
                                                           }
                                                           $template =   $template . '<span>&nbsp;&nbsp;</span>
                                                            <a onClick="getId(' . $item->user_id .')" data-toggle="modal" data-target="#myModal" > <span  class="glyphicon glyphicon-user"></span></a>
                                                        </td>
                                                        <td style="display:none;">'. ( $item->type == "Super Admin" ? "admin0admin" : ( $item->type == "JK Admin" ? "jk0jk": "usr0usr") ).' </td>

                                                       
                                                      
                                                    </tr>';
                                             echo $template ;
                                            }
                                            ?>                                
                                    </tbody>
                                </table>
                   
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                            </div>
                            <!-- /.box-footer -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
        </div>
        <!-- /.row (main row) -->
        </section><!-- /.content -->
    </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">  User Role</h4>
                </div>
                <form method="Post" action="<?php echo site_url('admin/addUserRole') ?>">
                    <div class="container col-sm-12 ">
                        <div  class="col-sm-12 ">
                            <div class="form-group col-sm-12">
                                </br>
                                <label for="email">Select User Role:</label>
                                <div  class="col-sm-12 ">
                                    <select id="role" name="type"   class="form-control" onchange="showJK()" >
                                        <option value="Super Admin"> Super Admin </option>
                                        <option value="JK Admin"> JK Admin </option>
                                        <option value="User"> User </option>
                                        <option value="Majalis"> Majalis </option>
                                    </select>
                                    </br>

                                    <div style="display:none" id="majalisDiv">
                                        <select name="majalis"  class="form-control">
                                        <?php
                                            foreach($data['majalis'] as $item) {
                                                echo '<option value="'. $item->id.'"> '. $item->name. '</option>';
                                            }
                                        ?> 
                                        </select>
                                        <br>

                                    </div>


                                    <div style="display:none" id="jkdiv">
                                    <select style="display:none" id="jkList" name="jk_id"  class="form-control">
                                    <?php
                                        foreach($data['jk'] as $item) {
                                            echo '<option value="'. $item->id.'"> '. $item->name. '</option>';
                                        }
                                        ?> 
                                    </select> 
                                    </br>
                                 <select style="display:none" id="shiftList" name="shift_id"  class="form-control">
                                        
                                        <option value="1">Evening</option>
                                        <option value="2">Morning</option>
                            
                                    </select> 
                                    </br>                                    
                                      </div>
                                    <input name="userId"  type="hidden" id="userId">                                         
                                    <button type="submit"  class="btn btn-primary btn-block">Save</button>
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
 
    </div>


    <!-- Modal -->
    <div id="colorModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form onsubmit="return validateColorForm()" method="Post" action="<?php echo site_url('color/assignColor') ?>">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Assign Color</h4>
                    </div>
                    <div class="modal-body">
                        <div  class="col-sm-12 ">
                            <div class="form-group col-sm-12">
                                </br>
                                <label for="email">Select Color:</label>
                                <div  class="col-sm-12 ">
                                    <select id="assignColor" name="colorCode"   class="form-control">
                                        <option value="select">Select Color</option>
                                        <?php  foreach($data['color'] as $item) { ?>
                                        <option value="<?php echo $item->id; ?>"><?php echo $item->colorName; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <input name="user_id"  type="hidden" id="color_userId">                                         
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"  class="col-sm-2 btn btn-primary btn-block">Save</button>
                    </div>
                </div>
            </form>
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
                       
                        <?php foreach ($data['duties'] as $key => $value) {
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
           <input id="jk" type="hidden" name="jk" value="1">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="assignWaara()">Save</button>
        </div>
      </div>
      
    </div>
  </div>

    <script type="text/javascript">
      

        function setId(id){
        $('#user').val(id); 
    }
//   function mergeUser(){
//     //$('.mergeUserList').
//   }  
      
  function assignWaara(){
        var user_id = $('#user').val(); 
        var date =  $('#date').val(); 
        var waara = $('#waara').val(); 
        var jk = $('#jk').val();

        $.ajax({
            url: "<?php echo site_url('Admin/assignWaaraToUser') ?>",
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
      var addNewUser = function addNewUser() {

        eraseCookie("first_name");
        eraseCookie("last_name");
        eraseCookie("date");
        eraseCookie("waara_id");
        
        window.location = "<?php echo site_url('admin/addNewUser') ?>";

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

        var rowCount = ( $('#table tr').length ) - 1;
        $('#totalUser').text( 'Total Users: ' +  rowCount  );

        var getId = function (id){
            document.getElementById("userId").value = id;
        
        }
       var getColorUserId = function (id){
            document.getElementById("color_userId").value = id;
        
        }
        var showJK = function (){
            var role = document.getElementById("role").value;
            if(role == "JK Admin"){
                document.getElementById("jkList").style.display = "block";
                document.getElementById("jkdiv").style.display = "block";
                document.getElementById("shiftList").style.display = "block";
                
        
            } else if (role == "Majalis") {

                document.getElementById("majalisDiv").style.display = "block";
                //hideUserRoleDiv();

            } else {
                hideUserRoleDiv();
            }
        
        }

        function hideUserRoleDiv() {
            document.getElementById("jkList").style.display = "none";
            document.getElementById("jkdiv").style.display = "none";
            document.getElementById("shiftList").style.display = "none";
            document.getElementById("jkList").value = "0";
            document.getElementById("shiftList").value = "0";            
        }

       var validateColorForm =  function validateColorForm(){
          var e = document.getElementById("assignColor");
          var assignColor = e.options[e.selectedIndex].value; 
          return (assignColor != 'select')

        }
       $(document).ready(function() {

   var table = $('#table').DataTable({ drawCallback: function(){
   
       $('.paginate_button', this.api().table().container())          
         .on('click', function(){
              console.log("hit")
             $( "li" ).removeClass( "paginate_button" );
         }); 
   }, "scrollX": true  <?php echo $data['tableData'][0]->script; ?>  , fixedHeader: true   });
//     $('#table').on('page', function () {
//       console.log("PAGE CHANGE")
//       $( "li" ).removeClass( "paginate_button" );
//     } );
         
        $( "li" ).removeClass( "paginate_button" );
        $('#lastWaaraSearch').on( 'keyup', function () {
          table
              .columns( 2 )
              .search( this.value )
              .draw();
        });
        $('#search').on( 'keyup', function () {
            table
                .columns( 1 )
                .search( this.value )
                .draw();
        } );         
        var visible = true;
        var tableContainer = $(table.table().container());

        $('#showHideTable').on( 'click', function () {
      
            tableContainer.css( 'display', visible ? 'none' : 'block' );
           // table.fixedHeader.adjust();
            visible = ! visible;
        });

        
    //Merge user    
    // $('button.toggle-vis').on( 'click', function (e) {
    //     e.preventDefault();

    //     // Get the column API object
    //     var column = table.column( $(this).attr('data-column') );

    //     // Toggle the visibility
    //     column.visible( ! column.visible() );
    // });




} );

    var selected = [];

    function mergeCheck(checkbox) {
        if (checkbox.checked) {

            if (selected.indexOf(checkbox.value) == -1) {
                selected.push(checkbox.value);
            }

            $("#mergeUserList").val( JSON.stringify(selected) );

        }
    }

    // function mergeUsers() {
    //     var selected = [];
    //     $("#table input:checked").each(function() {
    //          selected.push($(this).attr('value'));
    //     });

    //     // var obj = {
    //     //     'list': selected
    //     // };

    //     $("#mergeUserList").val( JSON.stringify(selected) );

  
    // }


    </script>

<style>
  .dataTables_filter {
display: none; 
    
  }
  .dataTables_length {
display: none; 
}
  
  
</style>