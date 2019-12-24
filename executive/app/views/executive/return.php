<body>
    <?php include 'asset/includes/sidebar.php';?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Invoice Return</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-inline">
              <div class="form-group">
                <label class="sr-only">Enter Invoice ID</label>
                <input type="number" class="form-control" id="invoiceID" placeholder="Enter Invoice ID...">
              </div>
              <button class="btn btn-primary" onclick="loadInvoice()">Load Invoice</button>
            </div>
         `</div>
          <div class="col-md-12">
            <div class="catStatusHeight">
              <div id="catStatusTrue" style="display: none">
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong><i class="glyphicon glyphicon-ok"></i>Invoice Updated Successfully!</strong> 
                </div>
              </div>
              <div id="catStatusFalse" style="display: none">
                <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong><i class="glyphicon glyphicon-remove"></i> Failed to Update Invoice!</strong> 
                </div>
              </div>
              <div id="catStatusEmpty" style="display: none">
                <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong><i class="glyphicon glyphicon-info-sign"></i> Fill All Fields...</strong> 
                </div>
              </div>
              <div id="catStatusLoading" style="display: none">
                <div class="alert alert-default" role="alert">
                  <strong><p align="center"><img src="<?php echo BASE_URL; ?>asset/reload.gif">  Please Wait..</p> </strong>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="col-md-12" id="invoiceArea">
          
        </div>
      </div>
  </div>
</body>