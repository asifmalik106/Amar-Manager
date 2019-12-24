<body>
    <?php include 'asset/includes/sidebar.php';?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Daily Profit Report</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
          <form class="form-inline" method="GET" action="">
            <div class="form-group">
              <label for="exampleInputName2">Select Date</label>
              <input type="text" class="form-control datepicker" name="date" placeholder="Select Date">
            </div>
            <button type="submit" class="btn btn-default">Generate Report</button>
          </form>
        </div>
      <?php 
        if(isset($data['profit'])){
          ?>
      <div class="row">
        
             <table class="table table-striped table-bordered" cellspacing="0" id="cashList">
                <thead>
                    <tr>
                        <td>Invoice ID</td>
                        <td>Time</td>
                        <td>Profit</td>
                    </tr>
                </thead>

                <tbody>
                    <?php
          $total = 0;
                         while($row = $data['profit']->fetch_assoc()){
                           
                           echo "<tr>";
                            echo "<td><a href=\"".BASE_URL."admin/invoice/".$row['invoiceID']."\">".$row['invoiceID']."</td>";
                            echo "<td>".date("h:i:s a", strtotime($row['invoiceTime']))."</td>";
                            echo "<td>".$_SESSION['data']['businessCurrency']." ".$row['profit']."</td>";
                            echo "</tr>";
                           $total+= (float)$row['profit'];
                        }
                          echo "<tr>";
                            echo "<td></td>";
                            echo "<td><b>Total Profit</b></td>";
                            echo "<td>".$_SESSION['data']['businessCurrency']." ".$total."</td>";
                            echo "</tr>";
                    ?>
                </tbody>
            </table>
      </div>  
        
      <?php
        }
      ?>
    </div>
    <!-- /#page-wrapper -->
</body>