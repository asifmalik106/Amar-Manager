<body class="wrapper">
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit Product Information</h4>
            </div>
            <div class="modal-body">

            	<div class="catStatusHeight">
					<div id="productEditStatusTrue" style="display: none">
						<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-ok"></i> Product Updated Successfully!</strong> 
						</div>
						
					</div>
					<div id="productEditStatusFalse" style="display: none">
						<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-remove"></i> Failed to Update Product!</strong> 
						</div>
					</div>
					<div id="productEditStatusEmpty" style="display: none">
						<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-info-sign"></i> Fill All Fields...</strong> 
						</div>
					</div>
					<div id="productEditStatusDuplicate" style="display: none">
						<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-warning-sign"></i> Product Already Exists!!!</strong> 
						</div>
					</div>
					<div id="productEditStatusLoading" style="display: none">
						<div class="alert" role="alert">
		  				<strong><img src="<?php echo BASE_URL; ?>asset/reload.gif">  Please Wait..</strong> 
						</div>
					</div>
				</div>

	        	<form>
					<div class="form-group">
						<input type="hidden" class="form-control" id="editProductID">
					</div>
					<div class="form-group">
						<label>Edit Product Name</label>
						<input type="text" class="form-control" id="editProductName">
					</div>
					<div class="form-group">
						<strong>Edit Product Category</strong><br>
						<select id="editProductCategory">
							<option value="" disabled="1" selected>Select a Category</option>
						<?php 
							while($row = $data['data']['category']->fetch_assoc())
							{
								echo "<option value=\"".$row['categoryID']."\">".$row['categoryName']." (".$row['categoryUnit'].")</option>";
							}
						?>
						</select>
					</div>
					<div class="form-group">
						<label>Edit Product Description</label>
						<textarea id="editProductDescription" class="form-control" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label>Edit Warning Limit</label>
						<input type="text" class="form-control" id="editProductLimit">
					</div>
				</form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="editProduct()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Delete Product Category</h4>
            </div>
            <div class="modal-body">
                <h3 align="center">Are you sure to DELETE Product Category?</h3>
                <form class="form">
	        		<div class="form-group">
	        			<label>Category ID</label>
	        			<input id="deleteCategoryID" type="text" name="" class="form-control" readonly>
	        		</div>
	        		<div class="form-group">
	        			<label>Edit Category Name</label>
	        			<input id="deleteCategoryName" type="text" name="" class="form-control">
	        		</div>
	        		<div class="form-group">
	        			<label>Edit Category Unit</label>
	        			<input id="deleteCategoryUnit" type="text" name="" class="form-control">
	        		</div>
	        	</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No, Back...</button>
                <button type="button" class="btn btn-danger">Yes, Delete!</button>
            </div>
        </div>
    </div>
</div>

<?php include 'asset/includes/sidebar.php';?>
<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Add New Product</h3>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-8">
		<form class="form-inline">
			<div class="form-group">
				<input class="form-control" placeholder="Search Product..." id="searchProductKeyword" oninput="searchProduct()">
			</div>
			<div class="form-group" style="display: none;" id="loadingProduct">
    			<div class="form-control loadingProductStyle">
    			<p><img src="<?php echo BASE_URL; ?>asset/reload.gif"> Loading</p>
    			</div>
  			</div>	
			<div class="form-group">
				<button type="button" class="reloadCategory btn btn-primary pull-right reloadCategory" onclick="loadProduct()"><i class="glyphicon glyphicon-refresh"></i></button>
			</div>
		</form>
			
			<table id="categoryTable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Product Description</th>
						<th>Product Category</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="loadProduct">
                         
                </tbody>
			</table>
		</div>
		<div class="col-lg-4">
			<div class="catStatusHeight">
				<div id="productStatusTrue" style="display: none">
					<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  				<strong><i class="glyphicon glyphicon-ok"></i> Product Added Successfully!</strong> 
					</div>
				</div>
				<div id="productStatusFalse" style="display: none">
					<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  				<strong><i class="glyphicon glyphicon-remove"></i> Failed to Add Product!</strong> 
					</div>
				</div>
				<div id="productStatusEmpty" style="display: none">
					<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  				<strong><i class="glyphicon glyphicon-info-sign"></i> Fill All Fields...</strong> 
					</div>
				</div>
				<div id="productStatusDuplicate" style="display: none">
					<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  				<strong><i class="glyphicon glyphicon-warning-sign"></i> Product Already Exists!!!</strong> 
					</div>
				</div>
				<div id="productStatusLoading" style="display: none">
					<div class="alert" role="alert">
                        <p align="center"><img src="<?php echo BASE_URL; ?>asset/reload.gif">  <strong>Please Wait..</strong></p> 
                        </div>
				</div>
			</div>
				<div class="panel panel-primary">
					<div class="panel-heading"><h4 align="center"><b>Add New Product</b></h4></div>
					<div class="panel-body">
						<form>
							<div class="form-group">
								<label>Product Name</label>
								<input type="text" class="form-control" id="newProductName">
							</div>
							<div class="form-group">
								<strong>Select Product Category</strong>
								<select id="newProductCategory" class="form-control">
									<option value="" disabled="1" selected>Select a Category</option>
								<?php 
									while($row = $data['data']['category2']->fetch_assoc())
									{
										echo "<option value=\"".$row['categoryID']."\">".$row['categoryName']." (".$row['categoryUnit'].")</option>";
									}
								?>
								</select>
							</div>
							<div class="form-group">
								<label>Product Description</label>
								<textarea id="newProductDescription" class="form-control" rows="3"></textarea>
							</div>
							<div class="form-group">
								<label>Product Warning Limit</label>
								<input type="text" class="form-control" id="newProductLimit">
							</div>
						</form>
					</div>
					<div class="panel-footer">
						<button type="button" class="btn btn-primary" onclick="addProduct()">Add Product</button>
					</div>
				</div>
			</div>
		</div>
    </div>
</body>