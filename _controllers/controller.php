<?

if(isset($_GET['view'])) $view = cleanView($_GET['view']); 
else {
	if(isset($_SESSION['HACKlogged']) || $_SESSION['HACKlogged']==1) $view = 'home'; 
	else $view = 'other'; 
}

switch($view) {
	default:
		require_once('_views/view.Home.php');  
		break; 
}

?>