<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

             <li class="treeview">

                <a href="<?php echo site_url('admin'); ?>">
                 <i class="fa fa-home"></i> <span>Home</span></a>  
               
               
               
     
               
            </li>
             <li class="treeview">

                <a href="<?php echo site_url('admin'); ?>">
                 <i class="fa  fa-gear"></i> <span>Settings</span>
                   <span class="pull-right-container">
                      <i class="fa fa-angle-down pull-right"></i>
                   </span>
                 </a>  
               
               
               
               <ul class="treeview-menu" style="display: none;">
            <li><a href="<?php echo site_url('EmailNotification'); ?>"><i class="fa fa-envelope-o"></i> <span>Email Notification</span></a>   </li>
            <li class="active"><a href="<?php echo site_url('admin/addNewCustomField'); ?>"><i class="fa  fa-list-alt"></i> <span>Add New Custom Field</span></a> </li>
            <li class="active"> <a href="<?php echo site_url('admin/addJK'); ?>"><i class="fa  fa-list-alt"></i> <span>Add JK</span></a></li>
            <li class="active"> <a href="<?php echo site_url('admin/addDuty'); ?>"><i class="fa  fa-list-alt"></i> <span>Add Duty</span></a>   </li>
            <li class="active"> <a href="<?php echo site_url('admin/news'); ?>"><i class="fa  fa-newspaper-o"></i> <span>Latest News</span></a> </li>
            <li class="active">  <a href="<?php echo site_url('admin/exportPDF'); ?>"><i class="fa fa-database"></i> <span>Export</span></a>  </li>
            <li class="active"><a href="<?php echo site_url('admin/ageGroup'); ?>"><i class="fa  fa-list-alt"></i> <span> Age Group </span></a>  </li>
            <li class="active">  <a href="<?php echo site_url('admin/assignedDuties'); ?>"><i class="fa fa-credit-card"></i> <span>Assigned Duties</span></a> </li>
            <li><a href="<?php echo site_url('admin/globalSort'); ?>"><i class="fa fa-gear"></i> <span>Waara Global Sorting</span></a>   </li>

               </ul>
               
            </li>

      
         
          <?php if($_SESSION['type'] == 'Super Admin'){ ?>
             <li class="treeview">
                <a href="<?php echo site_url('majalis'); ?>"><i class="fa  fa-list-alt"></i> <span>View Majalis</span></a>                
            </li>
          
          <?php } ?>


          <?php if($_SESSION['type'] == 'Super Admin'){ ?>
             <li class="treeview">
                <a href="<?php echo site_url('majalis/add'); ?>"><i class="fa  fa-list-alt"></i> <span> Add Majalis</span></a>                
            </li>
          
          <?php } ?>


          <?php if($_SESSION['type'] == 'Super Admin'){ ?>
             <li class="treeview">
                <a href="<?php echo site_url('Administrator/samar'); ?>"><i class="fa  fa-list-alt"></i> <span>Samar</span></a>                
            </li>
            <li class="treeview">
                <a href="<?php echo site_url('Administrator/mayat'); ?>"><i class="fa  fa-list-alt"></i> <span>Mayat</span></a>                
            </li>          
          <?php } ?>          
             <li class="treeview">
                <a href="<?php echo site_url('admin/userList'); ?>"><i class="fa fa-users"></i> <span>User</span></a>                
            </li>
      

            <li class="treeview">
                <a href="<?php echo site_url('admin/request'); ?>"><i class="fa fa-commenting-o"></i> <span>User Requests</span></a>                
            </li>
                   
            <li class="treeview">
                <a href="<?php echo site_url('Report'); ?>"><i class="fa fa-bar-chart-o"></i> <span>Report</span></a>                
            </li> 
          
            <li class="treeview">
                <a href="<?php echo site_url('admin/assignMultipleWaara'); ?>"><i class="fa  fa-list-alt"></i> <span>Assign Multiple Waara</span></a>                
            </li> 
   
          <?php if($_SESSION['type'] == 'Super Admin'){ ?>
             <li class="treeview">
                <a href="<?php echo site_url('color'); ?>"><i class="fa fa-pencil-square-o"></i> <span>Color</span></a>                
            </li>
          
          <?php } ?>
            <li class="treeview">
                <a href="<?php echo site_url('admin/logout'); ?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a>                
            </li>



        </ul>
    </section>
    <!-- /.sidebar -->
</aside>