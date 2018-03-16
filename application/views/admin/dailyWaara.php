<html><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Waara| Daily Waara</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <!-- Font Awesome -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <!-- DataTables -->
        <link rel="stylesheet" href="http://waaranet.ca/includes/plugins/datatables/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="http://waaranet.ca/includes/dist/css/AdminLTE.css">


        <link rel="stylesheet" href="http://waaranet.ca/includes/jquery-ui.css">        


        <link rel="stylesheet" href="http://waaranet.ca/includes/plugins/formValidation/css/formValidation.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="http://waaranet.ca/includes/dist/css/skins/skin-green.css">

        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="http://waaranet.ca/includes/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <!-- jQuery 2.1.4 -->
        <script src="http://waaranet.ca/includes/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="https://rawgit.com/padolsey/jQuery-Plugins/master/sortElements/jquery.sortElements.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery UI -->

<script type="text/javascript" src="http://waaranet.ca/includes/jquery.js"></script> 

<script type="text/javascript" src="http://waaranet.ca/includes/jquery-ui.js"></script>   
      
        <script src="http://waaranet.ca/includes/plugins/jQueryUI/jquery-ui.min.js"></script>

        <script type="text/javascript" src="http://waaranet.ca/includes/plugins/formValidation/js/formValidation.js"></script>
        <script type="text/javascript" src="http://waaranet.ca/includes/plugins/formValidation/js/framework/bootstrap.js"></script>


    </head>
    <body class="skin-green sidebar-collapse" style=""><header class="main-header" style="display: none;">
        <!-- Logo -->
        <a href="http://waaranet.ca/index.php/Admin" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>W</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">Waara</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">



                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-cogs"></span></a>
                        <ul class="dropdown-menu">


                            <li><a href="http://waaranet.ca/admin/admin_detail"><span class="fa fa-user"></span>View Profile</a></li>
                            <li><a href="http://waaranet.ca/index.php/Admin/updatePassword"><span class="fa fa-unlock"></span>Change Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="http://waaranet.ca/index.php/Admin/logout"><span class="fa fa-sign-out"></span>LogOut</a></li>
                        </ul>
                    </li>



                </ul>
            </div>
        </nav>
    </header>
<div class="wrapper">
    <div class="content-wrapper" style="min-height: 49px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Daily<small>Waara</small>
            </h1>

           
        </section>
        <!-- Main content -->
        <section class="content">

   

            <!-- Main row -->
            <div class="row">
              
                <div class="col-md-12">

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Jamatkhana : South</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                      
                            <div class="box-body">
                              <div class="col-sm-12" style="text-align:  center;"> 
                                <label id="selectedDate" for="datepicker"></label>
                                <input style="display:none;" type="text" id="date" name="datepicker" value="<?php echo date('m/d/Y'); ?>">

                              </div>
                                <ul class="pager">
                                    <li><a href="#" class="prev-day">Previous</a></li>
                                    <li><a href="#" class="next-day">Next</a></li>
                                  </ul>
                                    
                             

                                    <div class="col-md-4"></div> 
                                    <div class="col-md-4" id="waaraList"></div>
                                    <div class="col-md-12"></div>
                                 <div class="col-md-4"></div> <div class="col-md-4 majalisBox" id="majalisDuty" name="majalisDuty" style="display:none;" ></div>
                            </div><!-- /.box-body -->

                    </div><!-- /.box -->
                                      
                        
                        

                    </div>
                    
                </div>

            </section></div><!-- /.row (main row) -->

        <!-- /.content -->
    </div>

<script>
$('.main-header').hide();
$( "body" ).removeClass( "sidebar-mini" ).addClass( "sidebar-collapse" );
$('#date').datepicker();
$('#selectedDate').text('Selected Date: ' +  $('#date').val());
$('.next-day').on("click", function () {
    var date = $('#date').datepicker('getDate');
    date.setDate(date.getDate() +1)
    $('#date').datepicker("setDate", date);
    $('#selectedDate').text('Selected Date: ' +  $('#date').val());
  ajaxCallDuty()
  ajaxGetMajalisDuties();
});

$('.prev-day').on("click", function () {
    var date = $('#date').datepicker('getDate');
    date.setDate(date.getDate() -1)
    $('#date').datepicker("setDate", date);
    $('#selectedDate').text('Selected Date: ' +  $('#date').val());
  ajaxCallDuty()
  ajaxGetMajalisDuties();
});
  function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
function ajaxCallDuty() {

   var state=1;

   var date = formatDate( $('#date').val() ); 
  
    $.ajax({
        url: "<?php echo site_url('DailyWaara/ajaxGetDutyFromJk') ?>",
        type: "POST",
        data: {
            'state' : state,
            'date' : date
        },
        success: function(response){

            $('#waaraList').html(response);

            


        },
        error: function(){
            
        }
    });


} 
  ajaxCallDuty()
  ajaxGetMajalisDuties();
function ajaxGetMajalisDuties() {

    var date = formatDate( $('#date').val() ); 

    $.ajax({
        url: "<?php echo site_url('DailyWaara/ajaxGetMajalisDuties') ?>",
        type: "POST",
        data: {
            'date' : date
        },
        success: function(response){
            $('#majalisDuty').html(response);

            $( "#majalisDutyTable tbody" ).sortable( {
                update: function( event, ui ) {

                    // $(this).children().each(function(index) {                    
                    //     $(this).find('td').last().html(index + 1);
                    // });
                    var duty_id = [];
                    $("#majalisDutyTable tbody tr").each(function() {
                        var counter = 0;
                        $.each(this.cells, function(){
                            if(counter == 0 ){
                                duty_id.push($(this).text());
                            }
                            counter++;
                        });
                        
                    });  
                    sortMajalisDuties(duty_id, date);
              }

            });

        },
        error: function(){
            
        }
    });
}
</script>
<footer class="main-footer clearfix">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.1.0
    </div>
    
</footer>




<script type="text/javascript" src="http://waaranet.ca/includes/search.js"></script>   



<script type="text/javascript" src="http://waaranet.ca/includes/typeahead.min.js"></script> 

<!-- DataTables -->
<script src="http://waaranet.ca/includes/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="http://waaranet.ca/includes/plugins/datatables/dataTables.bootstrap.min.js"></script>


<!-- Bootstrap 3.3.5 -->
<script src="http://waaranet.ca/includes/bootstrap/js/bootstrap.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="http://waaranet.ca/includes/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- AdminLTE App -->
<script src="http://waaranet.ca/includes/dist/js/app.min.js"></script>

<script type="text/javascript">


</script>


</body></html>