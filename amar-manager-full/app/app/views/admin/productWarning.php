<body>
  <?php include 'asset/includes/sidebar.php';?>
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="page-header"><?php echo $adminIndex['stock']; ?></h2>
      </div>

          <div class="col-lg-12 custom-table-height">
              <table class="table table-striped table-bordered" cellspacing="0" id="dStock">
                  <thead>
                      <tr>
                          <td><?php echo $adminIndex['serial']; ?></td>
                          <td><?php echo $adminIndex['productName']; ?></td>
                          <td><?php echo $adminIndex['category']; ?></td>
                          <td><?php echo $adminIndex['batch']; ?></td>
                          <td><?php echo $adminIndex['stockLimit']; ?></td>
                          <td><?php echo $adminIndex['stockQuantity']; ?></td>
                          <td><?php echo $adminIndex['retailPrice']; ?></td>
                      </tr>
                  </thead>

                  <tbody>
                      <?php
                          $i = 1;
                          while($row = $data['data']['stock']->fetch_assoc()){
                            if($data['data']['type']=='warning'){
                              if($row['productLimit']>$row['quantity']){
                                echo "<tr>";
                                echo "<td>".$i."</td>";
                                echo "<td>".$row['productName']."</td>";
                                echo "<td>".$row['categoryName']." (".$row['categoryUnit'].")</td>";
                                echo "<td>".$row['batch']."</td>";
                                echo "<td>".$row['productLimit']."</td>";
                                echo "<td>".$row['quantity']."</td>";
                                echo "<td>".$row['saleUnit']."</td>";
                                echo "</tr>";
                                $i++;
                              }
                            }else if($data['data']['type']=='outOfStock'){
                              if($row['quantity']==0){
                                echo "<tr>";
                                echo "<td>".$i."</td>";
                                echo "<td>".$row['productName']."</td>";
                                echo "<td>".$row['categoryName']." (".$row['categoryUnit'].")</td>";
                                echo "<td>".$row['batch']."</td>";
                                echo "<td>".$row['productLimit']."</td>";
                                echo "<td>".$row['quantity']."</td>";
                                echo "<td>".$row['saleUnit']."</td>";
                                echo "</tr>";
                                $i++;
                              }
                            }
                              
                          }
                      ?>
                  </tbody>
              </table>

          </div>
    </div>
  </div>
</body>