<body>
    <?php include 'asset/includes/sidebar.php';?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"><?php echo $adminSettings['settings']; ?></h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-lg-4">
            <h3 class="page-header"><?php echo $adminSettings['language']; ?></h3>
            
            <?php
            if($data['langMsg']=='success'){
              echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="glyphicon glyphicon-ok"></i> '.$adminSettings['successLang'].'!</strong></div>';
            }else if($data['langMsg']=='failed'){
              echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="glyphicon glyphicon-remove"></i> '.$adminSettings['failedLang'].'!</strong></div>';
            }
            
            ?>
            
            
            
            <form method="POST" action="<?php echo BASE_URL; ?>admin/settings/language">
              <div class="form-group">
                <label><?php echo $adminSettings['selectLanguage']; ?></label>
                <select name="language" class="form-control">
                  <option value="en">English</option>
                  <option value="bn">বাংলা</option>
                </select>
              </div>
              
              <input type="submit" class="btn btn-primary" value="<?php echo $adminSettings['changeLanguage']; ?>">
            </form>
          </div>

        </div>
    </div>
    <!-- /#page-wrapper -->
</body>