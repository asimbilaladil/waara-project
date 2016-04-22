

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
                echo '<script>alert("DATA")</script>';
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
                            <h3 class="box-title">Assign Duty</h3>
                        </div><!-- /.box-header -->




                    <div class="row large-centered">
                            <input type="text" id="search" placeholder="Type to search..." />
                            <table id="table" width="80%">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                            foreach($data['users'] as $item) {
                                echo 
                                    '<tr>
                                        <td> <a href="assignment?id='. $item->user_id .'">'. $item->first_name .' </a></td> 
                                        <td> <a href="#">'. $item->last_name .' </a></td>
                                        <td> <a href="#">'. $item->email .' </a></td>
                                        <td> <a href="#">'. $item->phone .' </a></td>
                                    </tr>';

                            }
                        ?>                                

                                </tbody>
                            </table>
                        </div>
                        

                    </div><!-- /.box -->
                </div>

            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div>
</div>
