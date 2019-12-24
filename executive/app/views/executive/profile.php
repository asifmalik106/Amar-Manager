<body>
    <?php include 'asset/includes/sidebar.php';?>
    <div id="page-wrapper">
      <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"><?php echo $data['data']['type']; ?> Profile</h2>
            </div>
      </div>
      <div class="row">
				<div id="loadProfile">
						<div class="col-md-4">
							<input id="scID" type="hidden" value="<?php echo $data['data']['sc']['scID']; ?>">
							<h4> Name: </h4>
							<h4> <strong id="SCName"><?php echo $data['data']['sc']['scNameCompany']; ?></strong> </h4>
							<h4> Contact No: </h4>
							<h4> <strong id="SCPhone"><?php echo $data['data']['sc']['scContactNo']; ?></strong> </h4>
							<h4> Credit Limit: </h4>
							<h4> <strong id="SCLimit"><?php echo $data['data']['sc']['scLimit']; ?></strong> </h4>
						</div>
						<div class="col-md-4">
							<h5> Father/Contact Person: </h5>
							<h5> <strong id="SCFather"><?php echo $data['data']['sc']['scFatherContactPerson']; ?></strong> </h5>
							<h5> Address: </h5>
							<h5> <strong id="SCAddress"><?php echo $data['data']['sc']['scAddress']; ?></strong> </h5>
							<h5> Registration Date: </h5>
							<h5> <strong><?php echo $data['data']['sc']['scDate']; ?></strong> </h5>
						</div>
					</div>
        <div class="col-md-4">
          <h2> Balance </h2>
					<div id="balance">
					</div>
        </div>
      	
			</div>
			<button class="btn btn-primary" data-toggle="modal" data-target="#editProfile" onclick="fillEditProfile()"><i class="glyphicon glyphicon-edit"></i> Edit Profile Information</button>
     <hr>
      <div class="row">
        
        <form class="form-inline">
          <div class="form-group">
            <h3>Invoices</h3>
          </div>
			    <div class="form-group" style="display: none;" id="loadingCategory">
    			<div class="form-control loadingCategoryStyle">
    			  <p><img src="<?php echo BASE_URL; ?>asset/reload.gif"> Loading</p>
    			</div>
  			</div>	
			<div class="form-group">
				<button type="button" class="reloadCategory btn btn-primary pull-right reloadCategory" onclick="loadAllInvoice()"><i class="glyphicon glyphicon-refresh"></i> Refresh Invoice List</button>
			</div>
		</form>
        
        <div class="col-md-12">
          <div id="loadInvoices">
            
          </div>
        </div>

      </div>
      <hr>
      <div class="row">
    <form class="form-inline">
          <div class="form-group">
            <h3>Transactions</h3>
          </div>
			    <div class="form-group" style="display: none;" id="loadingTransactions">
    			<div class="form-control loadingCategoryStyle">
    			  <p><img src="<?php echo BASE_URL; ?>asset/reload.gif"> Loading</p>
    			</div>
  			</div>	
			<div class="form-group">
				<button type="button" class="reloadCategory btn btn-primary pull-right reloadCategory" onclick="loadAllTransactions()"><i class="glyphicon glyphicon-refresh"></i> Refresh Transaction List</button>
			</div>
		</form>
        <div class="col-md-12" id="loadTransactions">
-
        </div>
      </div>
    </div>
	
	
	<!-- Pay Now Modal -->
	<?php 
	if($data['data']['type']=="Customer"){?>
  <div class="modal fade" id="payNow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Payment for Unpaid Invoice</h4>
        </div>
        <div class="modal-body">
				<div class="catStatusHeight">
					<div id="catStatusTrue" style="display: none">
						<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-ok"></i> Payment Added Successfully!</strong> 
						</div>
					</div>
					<div id="catStatusFalse" style="display: none">
						<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-remove"></i> Payment Failed! Try Again...</strong> 
						</div>
					</div>
					<div id="catStatusEmpty" style="display: none">
						<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-info-sign"></i> Fill All Fields...</strong> 
						</div>
					</div>
					<div id="catStatusLoading" style="display: none">
						<div class="alert" role="alert">
		  				<strong><img src="<?php echo BASE_URL; ?>asset/reload.gif">  Please Wait..</strong> 
						</div>
					</div>
				</div>
          <table class="table">
            <tr>
              <td>
                <label>Invoice ID</label>
                <h4 id="payInvoiceID"></h4></td>
              <td>
                <label>Invoice Date</label>
                <h4 id="payInvoiceDate"></h4>
              </td>
              <td>
                <label>Invoice Time</label>
                <h4 id="payInvoiceTime"></h4>
              </td>
            </tr>
            <tr>
              <td>
                <label>Invoice Total</label>
                <h4 id="payInvoiceTotal"></h4>
              </td>
              <td>
                <label>Invoice Paid</label>
                <h4 id="payInvoicePaid"></h4>
              </td>
              <td>
                <label>Invoice Due</label>
                <h2 id="payInvoiceDue" class="delete">2233</h2>
              </td>
            </tr>
          </table>
						<div id="payFromBalanceSection" style="display: none"> 
							<div class="checkbox">
								<label>
									<input type="checkbox" id="useBalance"> Use Balance
								</label>
							</div>
							<div id="payFromBalance" style="display: none">
								<p>Available Balance <strong id="availableBalance"> </strong></p>
								<div class="form-group">
									<label>Pay From Balance</label>
									<input class="form-control" id="payFromBalanceAmount" type="number" min="0">
								</div>
							</div>
						</div>
					
            <div class="form-group">
              <label>Pay Due Amount</label>
              <input class="form-control" id="payInvoicePayment" type="number" min="0">
            </div>

        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" onclick="addCashToInvoice()">Pay Due</button>
        </div>
      </div>
    </div>
	</div>
	<?php }
	else{?>
		
		
		<div class="modal fade" id="payNow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Payment for Unpaid Invoice</h4>
        </div>
        <div class="modal-body">
				<div class="catStatusHeight">
					<div id="catStatusTrue" style="display: none">
						<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-ok"></i> Payment Added Successfully!</strong> 
						</div>
					</div>
					<div id="catStatusFalse" style="display: none">
						<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-remove"></i> Payment Failed! Try Again...</strong> 
						</div>
					</div>
					<div id="catStatusEmpty" style="display: none">
						<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-info-sign"></i> Fill All Fields...</strong> 
						</div>
					</div>
					<div id="catStatusLoading" style="display: none">
						<div class="alert" role="alert">
		  				<strong><img src="<?php echo BASE_URL; ?>asset/reload.gif">  Please Wait..</strong> 
						</div>
					</div>
				</div>
          <table class="table">
            <tr>
              <td>
                <label>Invoice ID</label>
                <h4 id="payInvoiceID"></h4></td>
              <td>
                <label>Invoice Date</label>
                <h4 id="payInvoiceDate"></h4>
              </td>
              <td>
                <label>Invoice Time</label>
                <h4 id="payInvoiceTime"></h4>
              </td>
            </tr>
            <tr>
              <td>
                <label>Invoice Total</label>
                <h4 id="payInvoiceTotal"></h4>
              </td>
              <td>
                <label>Invoice Paid</label>
                <h4 id="payInvoicePaid"></h4>
              </td>
              <td>
                <label>Invoice Due</label>
                <h2 id="payInvoiceDue" class="delete">2233</h2>
              </td>
            </tr>
          </table>
						
					
					<div id="payFromBalanceSection" style="display: none"> 
							<div class="checkbox">
								<label>
									<input type="checkbox" id="useBalance"> Use Balance
								</label>
							</div>
							<div id="payFromBalance" style="display: none">
								<p>Available Balance <strong id="availableBalance"> </strong></p>
								<div class="form-group">
									<label>Pay From Balance</label>
									<input class="form-control" id="payFromBalanceAmount" type="number" min="0">
								</div>
							</div>
						</div>
					
					<div class="form-group">
						<label>Select Cash Account</label>
						<select name="cashID" id="cashSelect" class="form-control">
							<option value="" disabled selected>Select Cash Account</option>
						<?php
								foreach ($data['data']['cash'] as $row) {
										echo '<option value="'.$row['cashID'].','.$row['cashName'].','.$row['balance'].'">'.$row['cashName'].'</option>';
								}
						?>
							</select>
					</div>
					
            <div class="form-group">
							<input class="form-control" id="availableCashBalance" type="hidden" min="0" readonly>
							<label id="availableBalanceLabel"> </label><br>
              <label>Pay Due Amount</label>
              <input class="form-control" id="payInvoicePayment" type="number" min="0">
            </div>

        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" onclick="payCashToInvoice()">Pay Due</button>
        </div>
      </div>
    </div>
	</div>
		
		
		
		<?php }?>
	<!-- Pay Now Modal End -->
	
	<!-- Deposit Modal -->
	<div class="modal fade" id="depositNow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Advance Payment</h4>
        </div>
        <div class="modal-body">
				<div class="catStatusHeight">
					<div id="advStatusTrue" style="display: none">
						<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-ok"></i> Advance Payment Added Successfully!</strong> 
						</div>
					</div>
					<div id="advStatusFalse" style="display: none">
						<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-remove"></i> Advance Payment Failed! Try Again...</strong> 
						</div>
					</div>
					<div id="advStatusEmpty" style="display: none">
						<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-info-sign"></i> Fill All Fields...</strong> 
						</div>
					</div>
					<div id="advStatusLoading" style="display: none">
						<div class="alert" role="alert">
		  				<strong><img src="<?php echo BASE_URL; ?>asset/reload.gif">  Please Wait..</strong> 
						</div>
					</div>
				</div>
          <table class="table">
						<tr>
							<td>
								<label>Current Balance</label>
								<h4 id="currentBalance"> 12345</h4>
							</td>
							<?php
						if($data['data']['type']=="Customer"){?>
							<td>
								<label>New Balance</label>
								<h1 id="newBalance"> <i id="newBalanceStatus" class="delete glyphicon glyphicon-warning-sign"></i></h1>
							</td>
						<?php } ?>	
						</tr>
					</table>
            <hr>
						<?php
						if($data['data']['type']=="Customer"){?>
            <div class="form-group">
              <label>Advance Payment Amount</label>
              <input class="form-control" id="payAdvancePayment1" type="number" min="0">
            </div>
						<div class="form-group">
              <label>Repeat Advance Payment Amount</label>
              <input class="form-control" id="payAdvancePayment2" type="number" min="0">
            </div>
						<?php }
					else{ ?>
						<div class="form-group">
						<label>Select Cash Account</label>
						<select name="cashID" id="cashSelectDeposit" class="form-control">
							<option value="" disabled selected>Select Cash Account</option>
						<?php
								foreach ($data['data']['cash'] as $row) {
										echo '<option value="'.$row['cashID'].','.$row['cashName'].','.$row['balance'].'">'.$row['cashName'].'</option>';
								}
						?>
							</select>
					</div>
					
            <div class="form-group">
							<input class="form-control" id="availableCashBalanceDeposit" type="hidden" min="0" readonly>
							<label id="availableBalanceLabelDeposit"> </label><br>
              <label>Deposit Amount</label>
              <input class="form-control" id="payDepositPayment1" oninput="depositPaymentSupplier()" type="number" min="0"><br>
							 <label>Re-Enter Deposit Amount</label>
              <input class="form-control" id="payDepositPayment2" oninput="depositPaymentSupplier()" type="number" min="0">
            </div>
					<?php }?>
					
						<div class="form-group">
							<label>Transaction Note</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-list-alt"></i>
									</span>
									<textarea id="cashAvdanceNote" class="form-control">

									</textarea>
								</div>
					 </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<?php
						if($data['data']['type']=="Customer"){?>
          <button type="button" class="btn btn-success" onclick="addCashAdvance()">Pay Due</button>
					<?php }
					else{ ?>
						<button type="button" class="btn btn-success" onclick="addCashAdvancePayment()">Pay Advance</button>
					<?php } ?>
        </div>
      </div>
    </div>
	</div>
	<!-- Deposit Modal End -->
	<!-- Withdraw Modal -->
	<div class="modal fade" id="withdrawNow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Balance Withdraw</h4>
        </div>
        <div class="modal-body">
				<div class="catStatusHeight">
					<div id="wStatusTrue" style="display: none">
						<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-ok"></i> Balance Withdraw Successful!</strong> 
						</div>
					</div>
					<div id="wStatusFalse" style="display: none">
						<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-remove"></i> Balance Withdraw Failed! Try Again...</strong> 
						</div>
					</div>
					<div id="wStatusEmpty" style="display: none">
						<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-info-sign"></i> Fill All Fields...</strong> 
						</div>
					</div>
					<div id="wStatusLoading" style="display: none">
						<div class="alert" role="alert">
		  				<strong><img src="<?php echo BASE_URL; ?>asset/reload.gif">  Please Wait..</strong> 
						</div>
					</div>
				</div>
          <table class="table">
						<tr>
							<td>
								<label>Current Balance</label>
								<h4 id="currentBalanceW"> 12345</h4>
							</td>
							<td>
								<label>New Balance</label>
								<h1 id="newWithdrawBalance"> <i id="newWithdrawBalanceStatus" class="delete glyphicon glyphicon-warning-sign"></i></h1>
							</td>
							
						</tr>
					</table>
            <hr>
            <div class="form-group">
              <label>Withdraw Amount</label>
              <input class="form-control" id="withdrawBalance1" type="number" min="0">
            </div>
						<div class="form-group">
              <label>Repeat Withdraw Amount</label>
              <input class="form-control" id="withdrawBalance2" type="number" min="0">
            </div>
						<div class="form-group">
							<label>Transaction Note</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-list-alt"></i>
									</span>
									<textarea id="cashWithdrawNote" class="form-control">

									</textarea>
								</div>
					 </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<?php
						if($data['data']['type']=="Customer"){?>
          <button type="button" class="btn btn-danger" onclick="withdrawBalanceSubmit()">Withdraw Balance</button>
					<?php }
					else{ ?>
						<button type="button" class="btn btn-danger" onclick="withdrawBalanceSubmitSupplier()">Withdraw Balance</button>
					<?php } ?>
					
        </div>
      </div>
    </div>
	</div>
	<!-- Withdraw Modal End -->
	<!-- Edit Profile Modal -->
  <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit <?php echo $data['data']['type']; ?> Profile</h4>
        </div>
        <div class="modal-body">
				<div class="catStatusHeight">
					<div id="editStatusTrue" style="display: none">
						<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-ok"></i> Profile Edited Successfully!</strong> 
						</div>
					</div>
					<div id="editStatusFalse" style="display: none">
						<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-remove"></i> Failed to Edit Profile! Try Again...</strong> 
						</div>
					</div>
					<div id="editStatusEmpty" style="display: none">
						<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  				<strong><i class="glyphicon glyphicon-info-sign"></i> Fill All Fields...</strong> 
						</div>
					</div>
					<div id="editStatusLoading" style="display: none">
						<div class="alert" role="alert">
		  				<strong><img src="<?php echo BASE_URL; ?>asset/reload.gif">  Please Wait..</strong> 
						</div>
					</div>
				</div>
          <form class="form">
                           <div class="form-group">
                                <label><?php echo $data['data']['type']; ?> Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </span>
                                    <input type="text" id="editSCName" class="form-control"> 
                                </div>
                           </div>
                           <div class="form-group">
                                <label>Father's Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </span>
                                    <input type="text" id="editSCFather" class="form-control"> 
                                </div>
                           </div>
                           <div class="form-group">
                                <label>Contact Number</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-earphone"></i>
                                    </span>
                                    <input type="text" id="editSCPhone" class="form-control"> 
                                </div>
                           </div>
                           <div class="form-group">
                                <label>Customer Address</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-home"></i>
                                    </span>
                                    <textarea id="editSCAddress" class="form-control">

                                    </textarea>
                                </div>
                           </div>
                           <div class="form-group">
                                <label>Credit Limit</label>
                                <div class="input-group">
                                    <b class="input-group-addon">
                                        <i class="glyphicon glyphicon-usd"></i>
                                    </b>
                                    <input type="text" id="editSCLimit" class="form-control">
                                </div>
                           </div>
                       </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" onclick="editCustomer()">Edit Profile</button>
        </div>
      </div>
    </div>
	</div>
	<!-- Edit Profile Modal End -->
</body>