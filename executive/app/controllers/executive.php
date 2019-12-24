<?php
include 'system/Controller.php';


/* File: Main Controler
 * Handle all primary requests. It handles Login Requests and authenticate users.
 * Asif Salman Malik
 * Incresome Inc.
 *
 */
class executive extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function sessionVerify($data){
		if($data=='verify'){
			if (!(array_key_exists('data', $_SESSION) && $_SESSION['data']['rank'] == 'executive')){
				$this->load->redirectIn();
			}
		}
	}
	/* Main Function.
	 * 	If user is not logged in then show login page.
	 * 	Else redirect to authorized page.
	 */
	public function index($msg = null){
		$this->sessionVerify('verify');
		$data = array(
				'title'=> 'Dashboard | Retail Manager® Executive Panel'
				);
		$data['css'] = array('dataTables/css/dataTables.bootstrap.min.css',
							'dataTables/css/dataTables.responsive.css'
							);
		$data['js'] = array('dataTables/js/jquery.dataTables.min.js',
							'dataTables/js/dataTables.bootstrap.min.js',
							'dataTables/js/dataTables.responsive.js',
							'js/page/adminDashboard.js'
							);
		$this->load->model('executiveModel');
		$executiveModel = new executiveModel();
		$subscribers = $executiveModel->getSubscribers();
		$demoSubscribers = $executiveModel->getDemoSubscribers();
		$data['data']['demo'] = $demoSubscribers;
		$data['data']['subscribers'] = $subscribers;
		$data['data']['balance'] = $executiveModel->getExecutiveBalance($_SESSION['data']['adminID'])->fetch_assoc()['balance'];
		$data['data']['trial'] = $executiveModel->getPackCount(1)->fetch_assoc()['num'];
		$data['data']['unpaid'] = $executiveModel->getPackCount(2)->fetch_assoc()['num'];
		$data['data']['paid'] = $executiveModel->getPackCount(3)->fetch_assoc()['num'];
		$data['data']['paid'] += $executiveModel->getPackCount(4)->fetch_assoc()['num'];
		$this->load->view('executive/dashboard', $data);
	}

	public function subscription(){
		$this->sessionVerify('verify');
		if(func_get_arg(0)==null){
		$data = array(
				'title'=> 'New Subscription | Retail Manager® Executive Panel'
				);
			$data['js'] = array('js/page/subscription.js');
			$this->load->model('executiveModel');
			$executiveModel = new executiveModel();
			$data['data']['pack'] = $executiveModel->getSubscriptionPackages();
			
		$this->load->view('executive/newSubscription', $data);
			}else{ 


			$reqData = func_get_arg(0);



			if($reqData[0]=='add')
			{
				$this->load->model('executiveModel');
				$executiveModel = new executiveModel();
				$msg = "";
				$title = "";
				$status = "";
				$subCheck = true;
				$businessName = Validation::verify($_POST['businessName']);
				if($businessName == ''){
					$msg.= "Enter Business Name<br>";
					$subCheck = false;
				}
				$businessAddress = Validation::verify($_POST['businessAddress']);
				if($businessAddress == ''){
					$subCheck = false;
					$msg.= "Enter Business Address<br>";
				}
				$businessAdminName = Validation::verify($_POST['businessAdminName']);
				if($businessAdminName == ''){
					$msg.= "Enter Business Person Name<br>";
					$subCheck = false;
				}
				$businessPhone = Validation::verify($_POST['businessPhone']);
				if($businessPhone == ''){
					$msg.= "Enter Business Phone No.<br>";
					$subCheck = false;
				}
				$businessEmail = Validation::verify($_POST['businessEmail']);
				
				$timezone = Validation::verify($_POST['timezone']);
				$smsName = Validation::verify($_POST['smsName']);
				$currency = Validation::verify($_POST['currency']);
				if($smsName == ''){
					$msg.= "Enter Business SMS Name<br>";
					$subCheck = false;
				}
				$adminName = Validation::verify($_POST['adminName']);
				if($adminName == ''){
					$msg.= "Enter Administrator's Name<br>";
					$subCheck = false;
				}
				$adminUsername = Validation::verify($_POST['adminUsername']);
				
				$userCheck = $executiveModel->uniqueUsername($adminUsername)->num_rows;
				if($adminUsername == ''){
					$msg.= "Enter Administrator's User Name<br>";
					$subCheck = false;
				}else if($userCheck > 0){
					$msg.= "Administrator's User Name Already Exists<br>";
					$subCheck = false;
				}
				
				$adminEmail = Validation::verify($_POST['adminEmail']);
				$emailCheck = $executiveModel->uniqueEmail($adminEmail)->num_rows;
				
				if($adminEmail == ''){
					$subCheck = false;
					$msg.= "Enter Administrator's Email<br>";
				}else if($emailCheck > 0){
					$subCheck = false;
					$msg.= "Administrator's Email Already Exists<br>";
				}
				
				$adminPhone = Validation::verify($_POST['adminPhone']);
				$phoneCheck = $executiveModel->uniqueUsername($adminPhone)->num_rows;
				
				if($adminPhone == ''){
					$subCheck = false;
					$msg.= "Enter Administrator's Phone No.<br>";
				}else if($phoneCheck > 0){
					$subCheck = false;
					$msg.= "Administrator's Phone No. Already Exists<br>";
				}
				$adminPass = substr( md5(rand()), 0, 8);
				$lang = Validation::verify($_POST['lang']);
				
				$subscription = Validation::verify($_POST['subscription']);
				
				$dbName = "RMapp_".str_replace(" ", "", $businessName);

				$r = $executiveModel->showDB();
				$dbArray = array();
				while($p = $r->fetch_assoc()){
					array_push($dbArray, $p['Database']);
					//print_r($p);
				}
				while((bool)array_search($dbName,$dbArray)){
					$dbName.= "2";
				}
				$packInfo = $executiveModel->getPackageInfo($subscription)->fetch_assoc();
				$price = $packInfo['price'];
				$balance = $executiveModel->getExecutiveBalance($_SESSION['data']['adminID'])->fetch_assoc()['balance'];
				if($balance<$price){
					$subCheck = false;
					$msg.= "Insufficient Balance!!!<br>Package Price:".$price."<br>Your Balance: ".$balance."<br>Please Recharge and Try Again...<br>";
				}
				if($subCheck){
					$r = $executiveModel->addBusinessInfo($businessName,$businessAdminName,$businessAddress,$businessPhone,$businessEmail,$dbName,$timezone,$smsName,$_POST['currency']);
					$businessID = $executiveModel->getBusinessID($businessName,$businessAdminName,$businessAddress,$businessPhone,$businessEmail,$dbName,$timezone,$smsName)->fetch_assoc()['businessID'];
					$credential = $executiveModel->addBusinessCredential($adminName, $adminUsername, $adminEmail, $adminPhone, $adminPass, $lang, $businessID);
					$packInfo = $executiveModel->getPackageInfo($subscription)->fetch_assoc();
					$status = "online";
					$validity = $executiveModel->addBusinessValidity($businessID, $packInfo['packValidity'], $status, $packInfo['packSMS'], $packInfo['packID']);
					$trxPayment = $executiveModel->addPaymentTransaction($businessID,$price,$$packInfo['packID'],$businessName);
					$db = $executiveModel->createDB($dbName,$packInfo['packSMS']);
					
					$title = "Subscription Created Successfully!!!";
				$status = "success";
					$msg = "Congratulations, Subscription Created Successfully!!!";
					$sms = $businessName." is created! Login: ".$adminEmail."  Password: ".$adminPass;
					SMS::sendSMS($adminPhone, $sms);
					SMS::sendSMS("01770810050", $sms);
				}else{
					$title = "Error!!!";
				$status = "error";
				}
				
				$res = array($title, $msg, $status);
				echo json_encode($res);

			}
			
			if($reqData[0]=='asif'){
				$a = array("warning", "This is Title","Bangladesh<br>India<br>Sri Lanka");
				echo json_encode($a);
			}
		}
	}
	
	public function payment(){
		$this->sessionVerify('verify');
		$data = array(
				'title'=> 'Payment | Retail Manager® Executive Panel'
				);
		$this->load->view('executive/cash', $data);
	}
	
	
	/* Login Verify Function.
	 *	Verify an user's login information.
	 *	If user is verified then set session data and redirect to authorized page.
	 * 	Else show login page.	
	 */
	public function loginVerify(){
		$login = Validation::verify($_POST['login']);
		$password = Validation::verify($_POST['password']);
		$_SESSION['temp'] = $login;
		$loginData = '';
		$this->load->model('mainModel');
		$dbModel = new mainModel();
		$result = $dbModel->loginVerify($login, $password);
		if(($result->num_rows)==1){
			$_SESSION['temp'] = '';
			$loginData = $result->fetch_assoc();
			Session::setSession($loginData);
			$this->load->redirectIn();
		}
		else{
			$this->load->redirectIn('main/index/error/');
		}
	}

	
	/* Logout Function
	 *	Destroy all session Data and redirect to login page.
	 */
	public function logout()
	{
		Session::destroySession();
		$this->load->redirectIn();
	}
	
}