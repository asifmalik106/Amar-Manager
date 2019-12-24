<body>
        <?php include 'asset/includes/sidebar.php';?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><?php echo $adminIndex['dashboard']; ?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-md-12">
                   <h3>
                     Hello, 
                  </h3>
                  <h1>
                   <?php echo $_SESSION['data']['adminName']; ?>!
                  </h1>
                </div>
                 <div class="col-lg-6 col-md-12">
                     <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h1><strong>$</strong> <?php echo $data['data']['balance']; ?></h1>
                                    <h4>Balance</h4>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo BASE_URL; ?>payment/history">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-8">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-hourglass-2 fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h1>
                                        <?php
                                            echo $data['data']['trial'];
                                        ?>
                                    </h1>
                                    <h4>Trial Subscriptions</h4>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>





                <div class="col-lg-4 col-md-8">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-exclamation-triangle fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h1><?php
                                            echo $data['data']['unpaid'];
                                        ?></h1>
                                    <h4>Unpaid Subscriptions</h4>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-8">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-check fa-4x"></i>
                                    
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h1><?php
                                            echo $data['data']['paid'];
                                        ?></h1>
                                    <h4>Paid Subscription</h4>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
            <!-- /.row -->
            <div class="row">
               
              <div class="col-lg-12">
                    <h2 class="page-header">Demo List</h2>
                </div>
              
                              <div class="col-lg-12">
                    <table class="table table-striped table-bordered" cellspacing="0" id="dStock">
                        <thead>
                            <tr>
                                <td>S_ID</td>
                                <td>Demo Name</td>
                                <td>Username</td>
                                <td>Password</td>
                                <td>Expiry Date</td>
                                <td>Validity</td>
                                <td>SMS</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $i = 1;
                                while($row = $data['data']['demo']->fetch_assoc()){
                                    $date1=date_create("now");
                                    $date2=date_create($row['dateExpiration']);
                                    $diff=date_diff($date1,$date2);
                                    echo "<tr>";
                                    echo "<td>".$row['businessID']."</td>";
                                    echo "<td>".$row['businessName']."</td>";
                                    echo "<td>".$row['username']."</td>";
                                    echo "<td>".$row['password']."</td>";
                                    echo "<td>".date("d/m/Y", strtotime($row['dateExpiration']))."</td>";
                                    echo "<td>".$diff->m." Month(s) ".$diff->d." Day(s)</td>";
                                    echo "<td>".$row['sms']."</td>";
                                    echo "</tr>";
                                    $i++;
                                }
                            ?>
                        </tbody>
                    </table>

                </div>
              
                <div class="col-lg-12">
                    <h2 class="page-header">Subscribers List</h2>
                </div>

                <div class="col-lg-12 custom-table-height">
                    <table class="table table-striped table-bordered" cellspacing="0" id="dStock">
                        <thead>
                            <tr>
                                <td>S_ID</td>
                                <td>Subscriber</td>
                                <td>Status</td>
                                <td>Subscribing Date</td>
                                <td>Expiry Date</td>
                                <td>Validity</td>
                                <td>SMS</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $i = 1;
                                while($row = $data['data']['subscribers']->fetch_assoc()){
                                    $date1=date_create("now");
                                    $date2=date_create($row['dateExpiration']);
                                    $diff=date_diff($date1,$date2);
                                    echo "<tr>";
                                    echo "<td>".$row['businessID']."</td>";
                                    echo "<td>".$row['businessName']."</td>";
                                    echo "<td>".ucfirst($row['businessStatus'])."</td>";
                                    echo "<td>".date("d/m/Y", strtotime($row['dateSubscription']))."</td>";
                                    echo "<td>".date("d/m/Y", strtotime($row['dateExpiration']))."</td>";
                                    echo "<td>".$diff->m." Month(s) ".$diff->d." Day(s)</td>";
                                    echo "<td>".$row['sms']."</td>";
                                    echo "</tr>";
                                    $i++;
                                }
                            ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
        <!-- /#page-wrapper -->
</body>