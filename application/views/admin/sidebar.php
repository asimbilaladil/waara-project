<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
        	 <li class="treeview">
                <a href="<?php echo site_url('welcome'); ?>"><i class="fa fa-desktop"></i> <span>Home</span></a>

            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-code-o"></i> <span>Category</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('Admin/categoryList'); ?>"><i class="fa fa-eye"></i> <span>Category List</span></a></li>
                    <li><a href="<?php echo site_url('Admin/addCategory'); ?>"><i class="fa fa-plus"></i> <span> Add New</span></a></li>

                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i> <span>Events</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('Admin/eventList'); ?>"><i class="fa fa-eye"></i> <span>Event List</span></a></li>
                    <li><a href="<?php echo site_url('Admin/addEvent'); ?>"><i class="fa fa-plus"></i> <span> Add New Event</span></a></li>

                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Admin</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('Admin/admin_list'); ?>"><i class="fa fa-eye"></i> <span>Admin List</span></a></li>
                    <li><a href="<?php echo site_url('Admin/newAdmin'); ?>"><i class="fa fa-plus"></i> <span> Add New</span></a></li>

                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-plus"></i> <span>Clients</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('Admin/candidateList'); ?>"><i class="fa fa-eye"></i> <span>Candidate List</span></a></li>
                    <li><a href="<?php echo site_url('Admin/voterList'); ?>"><i class="fa fa-eye"></i> <span> Voter List </span></a></li>

                </ul>

            </li>


            <li class="treeview">
                <a href="<?php echo site_url('Admin/message'); ?>"><i class="fa fa-envelope-o"></i> <span>Message</span></a>

            </li>


          <li class="treeview">
                <a href="<?php echo site_url('Admin/report'); ?>"><i class="fa fa-newspaper-o"></i> <span>Report</span></a>

            </li>





        </ul>
    </section>
    <!-- /.sidebar -->
</aside>