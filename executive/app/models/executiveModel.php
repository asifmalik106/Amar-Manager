<?php
include 'system/Model.php';
class executiveModel extends Model
{
	public function getSubscribers()
	{
		$sql = "SELECT * From businessInfo inner join businessValidity on businessInfo.businessID = businessValidity.businessID where businessInfo.businessID<1001";
		return $this->db->fetch($sql);
	}
	
		public function getDemoSubscribers()
	{
		$sql = "SELECT * From businessInfo inner join businessValidity on businessInfo.businessID = businessValidity.businessID inner join businessCredentials on businessInfo.businessID = businessCredentials.businessID where businessInfo.businessID>1000";
		return $this->db->fetch($sql);
	}
	
	public function createDB($dbName,$sms){
		$sql = "CREATE Database IF NOT EXISTS ".$dbName;
		$this->db->execute($sql);
		$sql = "USE ".$dbName;
		$this->db->execute($sql);
		$sql = "CREATE TABLE IF NOT EXISTS account (accountID int(11) NOT NULL AUTO_INCREMENT,accountName varchar(1000) NOT NULL,accountType varchar(50) NOT NULL,PRIMARY KEY (`accountID`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
		$this->db->execute($sql);
		$sql = "INSERT INTO `account` (`accountID`, `accountName`, `accountType`) VALUES(1, 'Cash', 'cash')";
		$this->db->execute($sql);
		$sql = "CREATE TABLE IF NOT EXISTS invoice (invoiceID int(11) NOT NULL,productID int(11) NOT NULL,invoiceQuantity double(10,2) NOT NULL,invoiceBatch varchar(255) NOT NULL,invoicePurchase double(10,2) NOT NULL,invoiceSale double(10,2) NOT NULL,invoiceProductCategoryID int(11) NOT NULL,invoiceProductName varchar(1000) NOT NULL,invoiceProductCategoryName varchar(1000) NOT NULL,invoiceProductCategoryUnit varchar(1000) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		$this->db->execute($sql);
		$sql = "CREATE TABLE IF NOT EXISTS invoiceInfo (invoiceID int(11) NOT NULL AUTO_INCREMENT,userID int(11) NOT NULL,scID int(11) NOT NULL,invoiceAmount double(10,2) NOT NULL,invoiceDiscount double(10,2) NOT NULL,invoiceDate date NOT NULL,invoiceTime time NOT NULL,invoiceStatus varchar(20) NOT NULL,invoiceType varchar(20) NOT NULL,invoiceNote varchar(2500) NOT NULL,PRIMARY KEY (invoiceID)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
		$this->db->execute($sql);
		$sql = "CREATE TABLE IF NOT EXISTS product (productID int(11) NOT NULL AUTO_INCREMENT,productName varchar(1000) NOT NULL,productDescription varchar(2500) NOT NULL,productLimit int(11) NOT NULL,productCategoryID int(11) NOT NULL,PRIMARY KEY (productID)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ";
		$this->db->execute($sql);
		$sql = "CREATE TABLE IF NOT EXISTS productCategory (categoryID int(11) NOT NULL AUTO_INCREMENT,categoryName varchar(1000) NOT NULL,categoryUnit varchar(1000) NOT NULL,PRIMARY KEY (categoryID)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
		$this->db->execute($sql);
		$sql = "CREATE TABLE IF NOT EXISTS smsLog (smsNo int(11) NOT NULL AUTO_INCREMENT,scID int(10) NOT NULL,mobileNo varchar(20) NOT NULL,userID int(10) NOT NULL,smsDate date NOT NULL,smsTime time NOT NULL,text varchar(2500) NOT NULL,quantity int(11) NOT NULL,byte int(11) NOT NULL,PRIMARY KEY (smsNo)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ";
		$this->db->execute($sql);
		$sql = "INSERT INTO smsLog (quantity) VALUES('$sms')";
		$this->db->execute($sql);
		$sql = "CREATE TABLE IF NOT EXISTS `sms_template` (smsID int(11) NOT NULL AUTO_INCREMENT,smsName varchar(50) NOT NULL,smsTemplate varchar(2500) NOT NULL,PRIMARY KEY (smsID)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
		$this->db->execute($sql);
		$sql = "INSERT INTO sms_template (smsID, smsName, smsTemplate) VALUES(1, 'sale', '#SHOPNAME#:Invoice# #INV_NO# is genereted on #TIME#, #DATE#. Invoice Total: #TOTAL#, Paid Total: #PAID#. Due Amount is #DUE#. Thanks for shopping.'),(2, 'due_reminder', '#SHOPNAME#: Dear #CUSTOMER#, Your total due is #TOTAL_DUE# on #TIME#, #DATE#. Pay your due amount as soon as possible.'),(3, 'payment_received', '#SHOPNAME#: Payment received #PAYMENT# on #TIME#, #DATE# for Invoice# #INV_NO#. Total Invoice: #TOTAL#, Paid Amount #PAID#, Due is #DUE#.'),(4, 'deposit_received', '#SHOPNAME#:Payment received #PAYMENT# on #TIME#, #DATE#. Thank You.')";
		$this->db->execute($sql);
		$sql = "CREATE TABLE IF NOT EXISTS `stock` (productID int(11) NOT NULL,quantity double(10,2) NOT NULL, purchaseUnit double(10,2) NOT NULL,saleUnit double(10,2) NOT NULL,batch varchar(255) NOT NULL, barcode varchar(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		$this->db->execute($sql);
		$sql = "CREATE TABLE IF NOT EXISTS supplierCustomer (scID int(11) NOT NULL AUTO_INCREMENT,scNameCompany varchar(1000) NOT NULL,scFatherContactPerson varchar(1000) NOT NULL,scContactNo varchar(20) NOT NULL,scAddress varchar(5000) NOT NULL,scLimit double(10,2) NOT NULL,scDate date NOT NULL,scType varchar(25) NOT NULL,PRIMARY KEY (scID)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ";
		$this->db->execute($sql);
		$sql = "CREATE TABLE IF NOT EXISTS transaction (trxID int(11) NOT NULL AUTO_INCREMENT, userID int(11) NOT NULL,trxDate date NOT NULL,trxTime time NOT NULL, trxType varchar(10) NOT NULL,trxReference int(100) NOT NULL,trxAmount double(10,2) NOT NULL,scID int(11) NOT NULL,trxInfo varchar(2500) NOT NULL,PRIMARY KEY (trxID)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ";
		$this->db->execute($sql);
	}
	
	public function showDB(){
		$sql = "SHOW DATABASES";
		return $this->db->fetch($sql);
	}
	
	public function getPackCount($packID){
		$sql = "SELECT count(*) as num from businessValidity where packID = '$packID'";
		return $this->db->fetch($sql);
	}
	public function getPackageInfo($packID){
		$sql = "SELECT * FROM subscriptionPackages where packID ='$packID'";
		return $this->db->fetch($sql);
	}
	public function getSubscriptionPackages(){
		$sql = "SELECT * FROM subscriptionPackages";
		return $this->db->fetch($sql);
	}
	public function getExecutiveBalance($executiveID){
		$sql = "SELECT sum(trxAmount) as balance FROM administrationTransaction WHERE adminID ='$executiveID'";
		return $this->db->fetch($sql);
	}
	public function addBusinessInfo($businessName,$businessPerson,$businessAddress,$businessPhone,$businessEmail,$dbName,$timezone,$sms, $currency){
		$sql = "INSERT INTO businessInfo (businessName, businessPerson, businessAddress, businessPhone, businessEmail, businessDBName, businessTimeZone, businessNameSMS, businessCurrency) VALUES ('$businessName', '$businessPerson', '$businessAddress', '$businessPhone', '$businessEmail', '$dbName', '$timezone', '$sms', '$currency')";
		return $this->db->execute($sql);
	}
	
	public function addPaymentTransaction($businessID,$amount,$packID,$note){
		date_default_timezone_set($_SESSION['data']['businessTimeZone']);
		$date = date('Y-m-d');
		$time = date('H:i:s');
		$adminID = $_SESSION['data']['adminID'];
		$amount = (-1)*$amount;
		$sql = "INSERT INTO administrationTransaction (adminID, businessID, trxDate, trxTime, trxAmount, trxType, trxRef, trxNote) VALUES ('$adminID', '$businessID', '$date', '$time', '$amount', 'payment', '$packID', '$note')";
		return $this->db->execute($sql);
	}
	
	public function getBusinessID($businessName,$businessPerson,$businessAddress,$businessPhone,$businessEmail,$dbName,$timezone,$sms){
		$sql = "SELECT businessID from businessInfo WHERE businessName = '$businessName' AND businessPerson = '$businessPerson' AND businessAddress = '$businessAddress' AND businessPhone = '$businessPhone' AND businessEmail = '$businessEmail' AND businessDBName = '$dbName' AND businessTimeZone = '$timezone' AND businessNameSMS = '$sms'";
		return $this->db->fetch($sql);
	}
	public function addBusinessCredential($adminName, $adminUsername, $adminEmail, $adminPhone, $adminPass, $lang, $businessID){
		$sql = "INSERT INTO businessCredentials (name, username, email, phone, password, rank, language, businessID) VALUES ('$adminName', '$adminUsername', '$adminEmail', '$adminPhone', '$adminPass', 'admin', '$lang', '$businessID')";
		return $this->db->execute($sql);
	}
	
	public function addBusinessValidity($businessID, $days, $status, $sms, $packID){
	$today = date("Y-m-d");
		$duration = "+".$days." day";
		//$exp = strtotime($duration, $today);
	/*	$date=date_create((string)$today);
		date_add($date,date_interval_create_from_date_string($duration));
		$exp = date_format($date,"Y-m-d");
		*/

		$exp = date('Y-m-d',strtotime($duration)); 
		//echo $exp;
		$sql = "INSERT INTO businessValidity(businessID, dateSubscription, dateExpiration, businessStatus, sms, packID) VALUES ('$businessID', '$today', '$exp','$status', '$sms', '$packID')";
		return $this->db->execute($sql);
	}
	
	public function uniqueUsername($user){
		$sql = "SELECT * FROM businessCredentials WHERE username = '$user'";
		return $this->db->fetch($sql);
	}
	
	public function uniqueEmail($user){
		$sql = "SELECT * FROM businessCredentials WHERE email = '$user'";
		return $this->db->fetch($sql);
	}
	
	public function uniquePhone($user){
		$sql = "SELECT * FROM businessCredentials WHERE phone = '$user'";
		return $this->db->fetch($sql);
	}
		
}