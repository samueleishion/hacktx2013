<?

require_once('_libs/functions.php'); 
require_once('settings.php'); 

if(isset($_POST) || isset($_REQUEST)) {
	$action = (isset($_REQUEST)) ? clean($_REQUEST['action']) : clean($_POST['action']);
	switch($action) {
		// case 'signup':
		// 	require_once('../_models/model.User.php'); 
		// 	$uname = clean($_POST['uname']); 
		// 	$pword = clean($_POST['pword']); 
		// 	$user = new User($dblink); 
		// 	$user->instantiate($uname,$pword); 
		// 	$user->save(); 
		// 	if($user->login()) echo 'success'; 
		// 	else echo 'failure'; 
		// 	break; 
		default:
			break; 
	} 
}

?>