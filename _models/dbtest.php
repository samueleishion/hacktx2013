<?

require_once("../_controllers/settings.php"); 

echo "<h1>menu</h1>"; 
$query = "SELECT * FROM menu";
$result = mysqli_query($dblink, $query);
while($row = mysqli_fetch_array($result)) {
	foreach($row as $k => $v) {
		echo $k." => ".$v.'<br>'; 
	}
	echo '<hr>'; 
} 

echo "<h1>dish</h1>"; 
$query = "SELECT * FROM dish";
$result = mysqli_query($dblink, $query);
while($row = mysqli_fetch_array($result)) {
	foreach($row as $k => $v) {
		echo $k." => ".$v.'<br>'; 
	}
	echo '<hr>'; 
} 

?> 