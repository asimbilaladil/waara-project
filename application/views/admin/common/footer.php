<footer class="main-footer clearfix">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.1.0
    </div>
    <strong>Designed & Developed By - <a href="www.facebook.com/shubhandu.sharma">Shubhandu</a>.</strong>
</footer>

  
    <script type="text/javascript">
        function check_delete(){
            var chk = confirm('Are you sure to delete data');
            if(chk){
                return true;
            }else{
                return false;
            }
        }
        </script>


<!-- DataTables -->
<script src="<?php echo base_url(); ?>includes/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>includes/plugins/datatables/dataTables.bootstrap.min.js"></script>


<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url(); ?>includes/bootstrap/js/bootstrap.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>includes/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>includes/dist/js/app.min.js"></script>

<script type="text/javascript">
    $(function () {
        $('#example1').dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true
        });
    });

</script>
</body>
</html>