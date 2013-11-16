<?

$sitename = 'hacktx2013'; 	// The name of your company/brand/website
$siteurl = ''; 	// The domain of your website
$dbhost = '10.146.34.25'; 	// The hosting server of your database
$dbuser = 'root'; 		// The username of your database
$dbpass = 'utexas'; 		// The password to your database
$dbname = 'Restaurants'; 	// The database name 


// Connect to database
header("Access-Control-Allow-Origin: ".$siteurl); 
try {
	$dblink = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die(); 
} catch (mysqli_sql_exception $e) {
	echo "Database error. Please try again later."; 
}

// Start session
session_start(); 
$_SESSION['HACKpath'] 	= '/'.$sitename.'/';  
$_SESSION['HACKlogged'] = 0; 

?>