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
 <form action="<?php echo site_url('Admin/result') ?>" method="POST">
        <select name="event">

          <?php foreach($result  as $data) { ?>
          <option value= "<?php echo $data->event_id; ?> "><?php echo $data->event_title; ?>  </option>
          <?php } ?>

        </select>
        </br></br>
        <button type="submit">See The Result</button>

        </section><!-- /.content -->
    </div>
</div>

