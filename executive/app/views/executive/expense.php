<body>
    <?php include 'asset/includes/sidebar.php';?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Expenses</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">

             <table class="table table-striped table-bordered" cellspacing="0" id="cashList">
                <thead>
                    <tr>
                        <td>Transaction ID</td>
                        <td>Date</td>
                        <td>Time</td>
                        <td>Expense Amount</td>
                        <td>Expense Account Name</td>
                        <td>User</td>
                        <td>Note</td>
                    </tr>
                </thead>

                <tbody>
                    <?php
                         foreach($data['data'] as $row){
                            echo "<tr>";
                            echo "<td>".$row['trxID']."</td>";
                            echo "<td>".date("d/m/Y", strtotime($row['trxDate']))."</td>";
                            echo "<td>".$row['trxTime']."</td>";
                            echo "<td>".$row['trxAmount']."</td>";
                            echo "<td>".$row['expenseAccountName']."</td>";
                            echo "<td>".$row['user']."</td>";
                            echo "<td>".$row['trxNote']."</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /#page-wrapper -->
</body>