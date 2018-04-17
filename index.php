<?php
// include configuration file
include_once 'config/core.php';
 
// include the head template
//include_once "layout_head.php";

require_once 'config/database.php';

/* ini_set("post_max_size", "30M");
ini_set("upload_max_filesize", "30M"); */
	
session_start();
//include 'index1.php';
$_SESSION['app_error'] = '';
$_SESSION['company_disp_name'] = 'Suncom Mobile';
 

// Exception Handler starts
// Kuppuram has added following 2 lines on 30-Nov-2017 - to overcome 500 Internal Server Error
// After adding following 2 lines, the class files not found was disclosed as error.
ini_set('display_errors', 1);
error_reporting(E_ALL);

set_exception_handler('exception_handler'); 
set_error_handler("error_handler");
function error_handler($code, $message, $file, $line)
{
    if (0 == error_reporting())
    {
        return;
    }
    throw new ErrorException($message, 0, $code, $file, $line);
}
 
function exception_handler($e) { 
 
    // public message 
	
    $results = array();
	$results['errorReturnAction'] = "";
	$err = '';
	$retresult['success'] = false;
	if (contains($e->getMessage(), '18KSoftec Error:'))
	{
		$retresult['errors']  = strstr($e->getMessage(), '18KSoftec Error:');
		$results['errorMessage'] = strstr($e->getMessage(), '18KSoftec Error:');
		K18_utility::saveError(strstr($e->getMessage(), '18KSoftec Error:'));
	
	}
	else
	{
		$retresult['errors']  = $e->getMessage();
		$results['errorMessage'] = '18K Softec Error : ' . $e->getMessage() . ' - Source of Error : line - ' . $e->getLine() . ' in ' . $e->getFile() . ' Please send screen shot to Kuppuram' ;
		$err = '18K Softec Error : ' . $e->getMessage() . ' - Source of Error : line - ' . $e->getLine() . ' in ' . $e->getFile() . ' Please send screen shot to Kuppuram' ;
		K18_utility::saveError($err);
	}
	//echo $results['errorMessage'];
	
	
	echo json_encode($retresult);
	
	//echo "<a href='" . TEMPLATE_PATH . "/errorDialog.php'" . " target=\'_blank\'>Error</a>";
	
	//echo '[{"Error - status":"' . $results['errorMessage'] . '"}]'; // It seems this is good json format. but it is not returning back to called ajax function
	//trigger_error( '[{"Error - status":"' . $results['errorMessage'] . '"}]');
	
	//trigger_error( $results['errorMessage']);
	
	//require( TEMPLATE_PATH . "/errorDialog.php" );
	//viewError();
 
} 
// Exception Handler ends


 global $controller;
 global $controllerAction;

if(isset($_GET['uid'])&&isset($_GET['type']))
{
	if(checkUserAccess($_GET['uid'],$_GET['type']) > 0)
	{
		login();
	}
	else
	{
		require( TEMPLATE_PATH . "/login_page.php" );
		exit;
	}

}
else
{
	if(isset($_GET['action']) || isset($_POST['action']))
	{
		if(isset($_SESSION['uid']) || isset($_POST['login']))
		{
			if(isset($_GET['action']))
				$action = $_GET['action'];
			else
				$action = $_POST['action'];
			if(function_exists($action))
			{
				$action();
			}
			else
			{
				logout();
			}
		}
		else
		{
		require( TEMPLATE_PATH . "/login_page.php" );
		exit;			
		}
			
	}
	else
	{
	require( TEMPLATE_PATH . "/login_page.php" );
	exit;
	}
}

function login()
{
	require( TEMPLATE_PATH . "/district_views_page.php" );
}

function logout()
{
	session_destroy();
	require( TEMPLATE_PATH . "/login_page.php" );
}
 
function inprocess()
{
	require( TEMPLATE_PATH . "/inprocess_page.php" );
}
function globalsearch()
{
	require( TEMPLATE_PATH . "/global_search.php" );
}
function settings()
{
	require( TEMPLATE_PATH . "/settings_page.php" );
}
function marketPage()
{
	require( TEMPLATE_PATH . "/market_views_page.php" );
}
function regionPage()
{
	require( TEMPLATE_PATH . "/region_views_page.php" );
}
function storesPage()
{
	require( TEMPLATE_PATH . "/stores_views_page.php" );
}

function blankPage()
{
	require( TEMPLATE_PATH . "/blankPage.php" );
}

function DMPage()
{
	require( TEMPLATE_PATH . "/district_views_page.php" );
}

function homePage()
{
	require( TEMPLATE_PATH . "/district_views_page.php" );
}

function viewChangePasswordPage()
{
	require( TEMPLATE_PATH . "/changePassword_page.php" );
}

function usersPage()
{
	require( TEMPLATE_PATH . "/users_views_page.php" );
}

function hrreportPage()
{
	require( TEMPLATE_PATH . "/upload_hr_report_views_page.php" );
}

function rentfilePage()
{
	require( TEMPLATE_PATH . "/upload_rent_file_views_page.php" );
}
function dailydashboard()
{
	require( TEMPLATE_PATH . "/dailydashboard_views_page.php" );
}

function storesdocsPage()
{
	require( TEMPLATE_PATH . "/stores_docs_views_page.php" );
}

function monthlyEbitPage()
{
	require( TEMPLATE_PATH . "/monthly_ebit_upload_views_page.php" );
}

function Export_Store_Masterlist()
{
	require( TEMPLATE_PATH . "/stores_export_page.php" );
}

function userAuthPage()
{
	require( TEMPLATE_PATH . "/user_auth_views_page.php" );
}

// Save Regular Expense
function saveRegExp() {

	$results = array();
	$results['errorReturnAction'] = "saveRegExp";
	if ($_REQUEST['mode'] == 'add')
	{
		regular_expense::add();
	}
	else if ($_REQUEST['mode'] == 'update')
	{
		regular_expense::update();
	}
	if ($_REQUEST['mode'] == 'approve')
	{
		regular_expense::approve();
	}
}

function userCreation() {

	$results = array();
	$results['errorReturnAction'] = "userCreation";
	if ($_REQUEST['mode'] == 'add')
	{
		userCreation::add();
	}
	else if ($_REQUEST['mode'] == 'update')
	{
		userCreation::update();
	}
	if ($_REQUEST['mode'] == 'delete')
	{
		userCreation::deleteuser();
	}
}

function storesCreation() {

	$results = array();
	$results['errorReturnAction'] = "storesCreation";
	if ($_REQUEST['mode'] == 'add')
	{
		storesCreation::add();
	}
	else if ($_REQUEST['mode'] == 'update')
	{
		storesCreation::update();
	}
	if ($_REQUEST['mode'] == 'delete')
	{
		storesCreation::deletestores();
	}
}

function userProfileUpdate() {

	$results = array();
	$results['errorReturnAction'] = "userProfileUpdate";

		userProfile::update();


}
// Assign Ticket Tech

function saveSettings()
{
	$results = array();
	$results['errorReturnAction'] = "storesCreation";
	if ($_REQUEST['mode'] == 'add')
	{
		settings_op::add_settings();
	}
	else if ($_REQUEST['mode'] == 'update')
	{
		settings_op::update_settings();
	}
	else if($_REQUEST['mode'] == 'delete')
	{
		settings_op::delete_settings();
	}
}

function saveDistrict()
{
	$results = array();
	$results['errorReturnAction'] = "saveDistrict";
	if ($_REQUEST['mode'] == 'add')
	{
		district_op::add_district();
	}
	else if ($_REQUEST['mode'] == 'update')
	{
		district_op::update_district();
	}
	else if($_REQUEST['mode'] == 'delete')
	{
		district_op::delete_district();
	}
}

function saveMarket()
{
	$results = array();
	$results['errorReturnAction'] = "saveMarket";
	if ($_REQUEST['mode'] == 'add')
	{
		market_op::add_market();
	}
	else if ($_REQUEST['mode'] == 'update')
	{
		market_op::update_market();
	}
	else if($_REQUEST['mode'] == 'delete')
	{
		market_op::delete_market();
	}
}

function saveRegion()
{
	$results = array();
	$results['errorReturnAction'] = "saveRegion";
	if ($_REQUEST['mode'] == 'add')
	{
		region_op::add_region();
	}
	else if($_REQUEST['mode'] == 'delete')
	{
		region_op::delete_region();
	}
}

function saveStore()
{
	$results = array();
	$results['errorReturnAction'] = "saveStore";
	if ($_REQUEST['mode'] == 'add')
	{
		store_op::add_store();
	}
	else if ($_REQUEST['mode'] == 'update')
	{
		store_op::update_store();
	}
	else if($_REQUEST['mode'] == 'delete')
	{
		store_op::delete_store();
	}
}

function saveUsers()
{
	try
	{
		$results = array();
		$results['errorReturnAction'] = "saveUsers";
		if ($_REQUEST['mode'] == 'add')
		{
			users_op::add_users();
		}
		else if($_REQUEST['mode'] == 'update')
		{
			users_op::update_users();
		}
		else if($_REQUEST['mode'] == 'delete')
		{
			users_op::delete_users();
		}
		else if($_REQUEST['mode'] == 'clearFlood')
		{
			users_op::clear_flood();
		}
	}
	catch (Exception $e)
    {

		$retresult['success'] = false;
		if (contains($e->getMessage(), '18KSoftec Error:'))
		{
			$retresult['errors']  = strstr($e->getMessage(), '18KSoftec Error:');
		}
		else
		{
			$retresult['errors']  = "Submission is not successful" . $e->getMessage();
		}
		echo json_encode($retresult);
		$conn = null;
		return;
	}
}


function saveHRReport()
{
	$results = array();
	$results['errorReturnAction'] = "saveHRReport";
	hrreport_op::update_hrreport();
}

function saveRentFile()
{
	$results = array();
	$results['errorReturnAction'] = "saveRentFile";
	rentfile_op::update_rentfile();
}

function saveDocType()
{
	$results = array();
	$results['errorReturnAction'] = "saveRegion";
	if ($_REQUEST['mode'] == 'add')
	{
		doc_type_op::add_doctype();
	}
	else if($_REQUEST['mode'] == 'update')
	{
		doc_type_op::update_doctype();
	}
}

function saveUrlAuth() 
{

	$results = array();
	$results['errorReturnAction'] = "saveUrlAuth";
	if ($_REQUEST['mode'] == 'add')
	{
		user_url_access::addURL();
	}
	else if ($_REQUEST['mode'] == 'delete')
	{
		user_url_access::deleteURL();
	}
}

function saveMonthlyebit()
{
	$results = array();
	$results['errorReturnAction'] = "saveMonthlyebit";
	monthlyebit_op::update_monthlyebit(); 
}

function checkUserAccess($uid,$type)
{
	$database = new Database();
	$conn = $database->getConnection();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
	$qry =	"select count(SA.auth_id) from sun_settings_user_auth SA,
				users U 
				where SA.uid=$uid
				and SA.auth_type='$type'
				and U.uid=SA.uid
				and U.status=1";
	$st = $conn->prepare( $qry );	
	$st->execute();
	$number_of_rows = $st->fetchColumn(); 
	if($number_of_rows > 0)
	{
		$qry =	"select count(SA.auth_id),U.uid,U.name from sun_settings_user_auth SA,
			users U 
			where SA.uid=$uid
			and SA.auth_type='$type'
			and U.uid=SA.uid
			and U.status=1";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$_SESSION['uid'] = $value["uid"];
			$_SESSION['name'] = $value["name"];
		}	
		
	}
	return $number_of_rows;
}


//trigger_error("before calling getUsers");
				
//$action();				

// returns true if $needle is a substring of $haystack
function contains($haystack, $needle)
{
	return strpos($haystack, $needle) !== false;
}

/* function login()
{

	
	require (TEMPLATE_PATH . "/login_form.html");

}
 */
function login_form() {

$_SESSION['conn'] = null;
  $_SESSION['18K_user'] = null;
  $results = array();
  

  if ( isset( $_POST['login'] ) ) {

    // User has posted the login form: attempt to log the user in
	//session_id(uniqid()); 
	//session_start();
    $_SESSION['app_error'] = '';	
	$user_pwd = $_POST['user_pwd'];	
	$_SESSION['user_pwd'] = $_POST['user_pwd'];
	$_SESSION['user_id'] = $_POST['user_id'];
	$_SESSION['fin_year'] = $_POST['fin_year'];
	$_SESSION['group_name'] = "";
	$now = new DateTime('now');
	$_SESSION['curr_date'] = strval($now->format('Y-m-d'));
	$_SESSION['curr_month'] = intval($now->format('m'));
	$_SESSION['curr_year'] = intval($now->format('Y'));
   
	/* echo ' $_SESSION[curr_month] - ' . $_SESSION['curr_month'];
	echo ' $_SESSION[curr_year] - ' . $_SESSION['curr_year'];
	echo ' $_SESSION[fin_year] - ' . $_SESSION['fin_year']; */
	
	//echo ' $_SESSION[curr_date] - ' . $_SESSION['curr_date']; 
	
	if ($user = K18_user::checkuserid( $_POST['user_id'] , $_POST['user_pwd']))
	{

		$_SESSION['18K_user'] = $user;
		$_SESSION['session_id'] = session_id();
			$_SESSION['login_status'] = 'SUCCESS';
			$_SESSION['company_id'] = $user->company_id;
			$_SESSION['company_seq'] = $user->company_seq;
			$_SESSION['company_name'] = $user->company_name;
			$_SESSION['user_id'] = $user->login_user_id;
			$_SESSION['user_name'] = $user->user_name;
			$_SESSION['login_user_id'] = $user->login_user_id;
			$_SESSION['last_master_update_date'] = $user->last_master_update_date;
			$_SESSION['company_address1'] = $user->company_address1;
			$_SESSION['company_address2'] = $user->company_address2;
			$_SESSION['company_city'] = $user->company_city;
			$_SESSION['company_state'] = $user->company_state;
			$_SESSION['company_pincode'] = $user->company_pincode;
			$_SESSION['company_country'] = $user->company_country;
			$_SESSION['cin_no'] = $user->cin_no;
			$_SESSION['company_phone'] = $user->company_phone;
			$_SESSION['company_email'] = $user->company_email;
			$_SESSION['tin_no'] = $user->tin_no;
			$_SESSION['cst_no'] = $user->cst_no;
			$_SESSION['cst_date'] = $user->cst_date;
			$_SESSION['service_tax_no'] = $user->service_tax_no;
			$_SESSION['pancard_no'] = $user->pancard_no;
			$_SESSION['ucwords'] = "";
			$_SESSION['uid'] = $user->uid;
			$_SESSION['name'] = $user->name;
			$_SESSION['reporting_to'] = $user->login_user_id;
			$_SESSION['reportees'] = '';
			if (!isset($_SESSION['reportees']))
			{
				$_SESSION['reportees'] = '';
			}
			$_SESSION['short_designation'] = substr($_SESSION['user_id'],0,2);
			$_SESSION['user_name'] = $user->user_name;
			$_SESSION['user_email'] = $user->user_email;
			$_SESSION['department'] = $user->department;
			$_SESSION['designation'] = $user->designation;
			$_SESSION['region_code'] = $user->region_code;
			//$_SESSION['role'] = $user->role;
			$_SESSION['reporting_to'] = $user->reporting_to;
			$_SESSION['division_code'] = $user->division_code;
						
			// The following lines were added by Kuppuram - 14-11-2017
			$user_name = $_SESSION['login_user_id'];
			//$all_menu_rights = $_SESSION['uar'];
			//homePage();
			$retresult['success'] = true;
			$retresult['msg']  = "Login successful";
		
			$_SESSION['app_error'] = $retresult['success'];
			echo json_encode($retresult);

		/* if ( $user->checkPassword( $_POST['user_pwd'] ) ) {
			// If checkPassword is enabled, session variables should be assigned here.
		
		}
		else
		{
			$results['errorReturnAction'] = "login";
			$results['errorMessage'] = "User Not Found or Incorrect user id or password. Please try again.";
			//require( TEMPLATE_PATH . "/errorDialog.php" );
			$retresult['success'] = false;
			$retresult['errors']  = "User Not Found or Incorrect user id or password. Please try again.";
		
			$_SESSION['app_error'] = $retresult['success'];
			echo json_encode($retresult);
		} */
    } 
	else {
			
		$retresult['success'] = false;
		$retresult['errors']  = "User Not Found or Incorrect user id or password. Please try again.";
	
		$_SESSION['app_error'] = $retresult['success'];
		echo json_encode($retresult);
		}

    } else {

    // User has not posted the login form yet: display the form
	//echo 'Login successful - time - ' . time(); ;
    require( TEMPLATE_PATH . "/login_page.php" );
	//require( TEMPLATE_PATH . "/login_form.html" );
	//require( "index.html" );
  }

}
/* function excelOpen()
{
	 require( TEMPLATE_PATH . "/excelOpen.php" );
} */

function handleRequest()
{
	$controller = "K18_Controller";
	$controllerAction = "";
	if (isset($_REQUEST['c']))
	{
		$controller = $_REQUEST['c'];
		$controllerAction = $_REQUEST['a'];
	}
	
	$c = null;
	
	//echo $controller . " - " . $controllerAction;
	switch ($controller)
	{
		case "K18_Controller" :
			$c = new K18_Controller();
			$c->handleRequest($controllerAction);
			break;
		
	}		
}

// Changes Password
// Password reset
function staticresetpwd() {
	$login_user_id = isset( $_REQUEST['reset_login_user_id'] ) ? $_REQUEST['reset_login_user_id'] : "";
	K18_User::staticresetpwd($login_user_id);
	echo '<script>window.location="index.php?action=homePage"</script>';
	//homePage();
	
} 
 
function changePassword() {

  $results = array();
  $results['errorReturnAction'] = "changePassword";



    // User has posted the password edit form
    $retresult = array();
	$currentPassword = isset( $_REQUEST['currentPassword'] ) ? $_REQUEST['currentPassword'] : "";
    $newPassword = isset( $_REQUEST['newPassword'] ) ? $_REQUEST['newPassword'] : "";
    $newPasswordConfirm = isset( $_REQUEST['newPasswordConfirm'] ) ? $_REQUEST['newPasswordConfirm'] : "";
	$user = K18_User::checkuserid( $_SESSION['company_id'],$_SESSION['user_id'], $currentPassword );
    
	if (!$user)
	{
		
		$retresult['success'] = false;
		$retresult['errors'] =  "18KSoftec Error: Please give correct credentials.";
		K18_utility::saveError("18KSoftec Error: Please give correct credentials.");
		trigger_error("18KSoftec Error: Please give correct credentials.");
		
		/* $results['errorMessage'] = "Please give correct credentials.";
		require( TEMPLATE_PATH . "/errorDialog.php" ); */
		return;
	}
    // Do some checks
	
	// Change Log - 2014.04.30-1
	// 30-Apr-2014 - Kuppuram
	// Checking for correct Current Password

	if ( !$user->checkPassword( $currentPassword ) ) 
	{
		$results['errorMessage'] = "Current Password is not valid. Please try again.";
		trigger_error("18KSoftec Error: Please give correct credentials.");
		//require( TEMPLATE_PATH . "/errorDialog.php" );
		return;
	} 
	
	/* if ( $newPassword == $currentPassword ) {
      $results['errorMessage'] = "Current Password and New Password cannot be the same. Please try again.";
      require( TEMPLATE_PATH . "/errorDialog.php" );
      return;
    }

    if ( !$currentPassword || !$newPassword || !$newPasswordConfirm ) {
      $results['errorMessage'] = "Please fill in all the fields in the form.";
      require( TEMPLATE_PATH . "/errorDialog.php" );
      return;
    }

    if ( $newPassword != $newPasswordConfirm ) {
      $results['errorMessage'] = "The two new passwords you entered didn't match. Please try again.";
      require( TEMPLATE_PATH . "/errorDialog.php" );
      return;
    } */


    // All OK: change password
    
    $ret = $user->updatepwd($currentPassword, $newPassword );
	if ($ret = 'SUCCESS')
	{
		$retresult['success'] = true;
		$retresult['errors'] =  "18KSoftec Error: Password has been changed successfully.";
		//echo json_encode($retresult);
		return;
	}
	else
	{
		$retresult['success'] = false;
		$retresult['errors'] =  "18KSoftec Error: Password change failed...Please try again...";
		//echo json_encode($retresult);
		return;
	}

}


?>
