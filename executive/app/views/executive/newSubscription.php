<body>
    <?php include 'asset/includes/sidebar.php';?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">New Subscription</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-8">
            <h4>
              Business Information
            </h4>
            <hr> 
            <form class="form-horizontal" method="POST">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Business Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="businessName" name="businessName" placeholder="Enter Business Name...">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">Address</label>
                <div class="col-sm-8">
                  <textarea class="form-control" rows="3" id="businessAddress" placeholder="Enter Business Address..."></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Business Person's Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="businessAdminName" name="businessAdminName" placeholder="Enter Business Person's Name...">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Business Phone</label>
                <div class="col-sm-8">
                  <input type="phone" class="form-control" id="businessPhone" name="businessPhone" placeholder="Enter Business Phone...">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Business Email</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" id="businessEmail" name="businessEmail" placeholder="Enter Business Email...">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Business Currency</label>
                <div class="col-sm-8">
                  <select name="currency" id="currency" class="form-control">
                    <option value="৳">Bangladeshi Taka (৳)</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Business Time Zone</label>
                <div class="col-sm-8">
                  <select name="timezone" id="timezone" class="form-control">
                    <option value="Asia/Dhaka">Asia/Dhaka</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Business SMS Title</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="smsName" name="smsName" placeholder="Enter Business SMS Title...">
                  <i id="helpBlock" class="help-block">10 Characters Left</i>
                </div>
              </div>
             
               <h4>
              Administrator's Information
            </h4>
            <hr>
              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                  <div class="checkbox">
                    <label><input type="checkbox" value="" id="same">Same as Business Person</label>
                  </div>
                </div>
              </div>             
              
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Administrator's Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="adminName" name="adminName" placeholder="Enter Administrator's Name...">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Administrator's User Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="adminUsername" name="adminUsername" placeholder="Enter Administrator's User Name...">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Administrator's Email</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" id="adminEmail" name="adminEmail" placeholder="Enter Administrator's Email...">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Administrator's Phone</label>
                <div class="col-sm-8">
                  <input type="phone" class="form-control" id="adminPhone" name="adminPhone" placeholder="Enter Administrator's Phone...">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Administrator's Language</label>
                <div class="col-sm-8">
                 <select id="lang" class="form-control">
                    <option value="en">English</option>
                    <option value="bn">বাংলা</option>
                  </select>
                </div>
              </div>
               <h4>
              Official Part
            </h4>
            <hr>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Select Subscription</label>
                <div class="col-sm-8">
                 <select id="subscription" class="form-control">
                    <option disabled selected>Select Subscription</option>
                   <?php
                    while($row = $data['data']['pack']->fetch_assoc()){
                      echo '<option value="'.$row['packID'].'">'.$row['packName'].' (Company Fee: $'.$row['price'].')</option>';
                    }
                   ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  
                </div>
              </div>
            </form>
            <button class="btn btn-default" onclick="addSubscription()">Create New Subscription</button>
          </div>
        </div>
    </div>
    <!-- /#page-wrapper -->
</body>