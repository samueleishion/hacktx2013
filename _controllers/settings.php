<?

$sitename = 'hacktx2013'; 	// The name of your company/brand/website
$siteurl = ''; 	// The domain of your website
$dbhost = ''; 	// The hosting server of your database
$dbuser = ''; 		// The username of your database
$dbpass = ''; 		// The password to your database
$dbname = ''; 	// The database name 


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

?>