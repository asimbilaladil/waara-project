<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">


            <?php if($_SESSION['type'] == 'Super Admin') {
                $homeUrl = 'admin';
            } else if ($_SESSION['type'] == 'Majalis') {
                $homeUrl = 'AdminMajalis';
            } else if ($_SESSION['type'] == 'User') {
                $homeUrl = 'home';
            }
            ?>
             <li class="treeview">

                <a href="<?php echo site_url($homeUrl); ?>">
                 <i class="fa fa-home"></i> <span>Home</span></a>  
                           
            </li>

            <li class="treeview">
                <a href="<?php echo site_url('admin/logout'); ?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a>                
            </li>



        </ul>
    </section>
    <!-- /.sidebar -->
</aside>