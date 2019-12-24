<body>
    <?php include 'asset/includes/sidebar.php';?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Income Statement</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
          <form class="form-inline" method="GET" action="">
            <div class="form-group">
              <label for="exampleInputName2">From Date</label>
              <input type="text" class="form-control datepicker" name="from" placeholder="Select Date">
            </div>
            <div class="form-group">
              <label for="exampleInputName2">To Date</label>
              <input type="text" class="form-control datepicker" name="to" placeholder="Select Date">
            </div>
            <button type="submit" class="btn btn-default">Generate Report</button>
          </form>
        </div>
      <?php 
        if(isset($data['profit'])){
          ?>
      <div class="row">
        <h4><u>Profit</u></h4>
             <table class="table table-striped table-bordered" cellspacing="0" id="cashList">
                <thead>
                    <tr>
                        <td width="50%">Date</td>
                        <td>Profit</td>
                    </tr>
                </thead>

                <tbody>
                    <?php
          $totalProfit = 0;
                         while($row = $data['profit']->fetch_assoc()){
                           $profitDate = date("d-m-Y", strtotime($row['invoiceDate']));
                           echo "<tr>";
                            echo "<td><a href='".BASE_URL."admin/report/profit?date=".$profitDate."' target='_blank'>".$profitDate."</a></td>";
                            echo "<td>".$_SESSION['data']['businessCurrency']." ".$row['FinalProfit']."</td>";
                            echo "</tr>";
                           $totalProfit+= (float)$row['FinalProfit'];
                        }
                          echo "<tr>";
                            echo "<td><h4 align='right'><b>Total Profit</b></h4></td>";
                            echo "<td><h4><b>".$_SESSION['data']['businessCurrency']." ".(float)$totalProfit."</b></h4></td>";
                            echo "</tr>";
                    ?>
                </tbody>
            </table>
      </div>  
              <div class="row">
        <h4><u>Expense</u></h4>
             <table class="table table-striped table-bordered" cellspacing="0" id="cashList">
                <thead>
                    <tr>
                        <td width="50%">Date</td>
                        <td>Expense</td>
                    </tr>
                </thead>

                <tbody>
                    <?php
          $totalExpense = 0;
                         while($row = $data['expense']->fetch_assoc()){
                           echo "<tr>";
                            echo "<td>".date("d-m-Y", strtotime($row['trxDate']))."</td>";
                            echo "<td>".$_SESSION['data']['businessCurrency']." ".$row['expense']."</td>";
                            echo "</tr>";
                           $totalExpense+= (float)$row['expense'];
                        }
                          echo "<tr>";
                            echo "<td><h4 align='right'><b>Total Expense</b></h4></td>";
                            echo "<td><h4><b>".$_SESSION['data']['businessCurrency']." ".(float)$totalExpense."</b></h4></td>";
                            echo "</tr>";
                    ?>
                </tbody>
            </table>
      </div>  
      
      <div class="row">
        <h4><u>Summary</u></h4>
             <table class="table table-striped table-bordered" cellspacing="0" id="cashList">
                <tbody>
                  <tr>
                    <td width="50%">Net Profit</td>
                    <td><?php echo $_SESSION['data']['businessCurrency']." ".$totalProfit; ?></td>
                  </tr>
                  <tr>
                    <td>Net Expense</td>
                    <td><?php echo $_SESSION['data']['businessCurrency']." ".$totalExpense; ?></td>
                  </tr>
                  <tr>
                    <td><h4 align='right'><b>
                      <?php 
                        if((float)$totalProfit>(float)$totalExpense){
                          echo "Net Profit";
                        }else{
                          echo "Net Loss";
                        }
                      ?></b></h4>
                    </td>
                    <td><h4><b>
                      <?php 
                       echo $_SESSION['data']['businessCurrency']." ";
                       if((float)$totalProfit>(float)$totalExpense){
                          echo (float)$totalProfit-(float)$totalExpense;
                        }else{
                          echo (float)$totalExpense-(float)$totalProfit;
                        }
                      ?></b></h4>
                    </td>
                  </tr>
                  
                </tbody>
            </table>
      </div>  
      
      <?php
        }
      ?>
    </div>
    <!-- /#page-wrapper -->
</body>