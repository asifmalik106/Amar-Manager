<body>
    <?php include 'asset/includes/sidebar.php';?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Purchase Entry</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <form method="POST" action="<?php echo BASE_URL; ?>admin/purchase/final/">
                <div class="col-md-9">
                    <div class="form-group">
                        <strong>Select Supplier</strong>
                        <select id="selectSupplier" name="supplierID" class="form-control" required>
                            <option value="" disabled="1" selected>Select a Supplier</option>
                        <?php 
                            foreach($data['data']['supplier'] as $row)
                            {
                              echo "<option value=\"".$row['scID']."\" balance=\"".$row['balance']."\">".$row['scID']." - ".$row['scNameCompany']." - ".$row['scContactNo']."</option>";
                            }
                        ?>
                        </select>
                    </div>

                    <table class="table table-bordered table-condensed" id="productForPurchase">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Batch</th>
                                <th>Category</th>
                                <th>Purchase Rate</th>
                                <th>Retail Price</th>
                                <th>Quantity</th>
                                <th>Limit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($data['data']['purchase'] as $product){
                                  echo "<tr class='mouseHover'><input class='cartStatus' type='hidden' value='0'>";
                                  echo "<td class='pID'>".$product['pID']."</td>";
                                  echo "<td class='pName'>".$product['pName']."</td>";
                                  echo "<td class='pBatch'>".$product['pBatch']."</td>";
                                  echo "<td class='pCategory'>".$product['pCategory']."</td>";
                                  echo "<td class='pPurchase'>".$product['purchaseUnit']."</td>";
                                  echo "<td class='pSale'>".$product['saleUnit']."</td>";
                                  echo "<td class='pQuantity'>".$product['pQuantity']."</td>";
                                  echo "<td class='pLimit'>".$product['pLimit']."</td>";
                                  echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Product Name</th>
                                <th width="12%">Batch</th>
                                <th>Quantity</th>
                                <th>Purchase Rate</th>
                                <th>Retail Price</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody class="purchase">
                           
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong><p align="center">Payment Information</p></strong>
                        </div>
                        <div class="panel-body">
                        <?php
                            foreach ($data['data']['cash'] as $row) {
                                echo '<div class="form-group">';
                                echo '<label>'.$row['cashName'].' <span class="cashLeft"> '.$row['balance'].'</span></label>';
                                echo '<input type="hidden" name="cashBalance" value="'.$row['balance'].'">';
                                echo '<input class="form-control cashAmount" name="cash['.$row['cashID'].']">';
                                echo '</div>';
                            }
                        ?>
                        </div>
                    </div>
                  
                      <div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong><p align="center">Payment From Balance</p></strong>
                        </div>
                        <div class="panel-body">
                          <div class="form-group">
                            <label>Balance: <span id="supplierBalance"></span></label>
                            <input class="form-control" id="payFromSupplierBalance" name="payFromSupplierBalance">
                          </div>
                        </div>
                      </div>
                  
                  
                  
                    <div class="panel panel-primary float-panel">
                        <div class="panel-heading">
                            <strong><p align="center">Purchase Information</p></strong>
                        </div>
                        <div class="panel-body">
                        <h4>Total: <strong class="pull-right" id="grandTotal">0.0</strong></h4>
                        <input type="hidden" name="grandTotal" value="0.0">
                        <h4>Payment: <strong class="pull-right" id="paymentTotal">0.0</strong></h4>
                        <input type="hidden" name="paymentTotal" value="0.0">
                        <hr>
                        <h4>Due: <strong class="pull-right delete" id="dueTotal">0.0</strong></h4>
                        <h4>Advance: <strong class="pull-right edit" id="advanceTotal">0.0</strong></h4>
                        
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!-- /#page-wrapper -->
</body>