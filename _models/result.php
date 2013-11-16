<?php
require_once("../_controllers/settings.php"); 
require_once("../_controllers/_libs/instagram.class.php"); 
require_once("../_controllers/_libs/posts.php");
?>

<html>
<head>

<script>
function bigImg(x) {
	x.style.height="256px";
	x.style.width="256px";
}

function normalImg(x) {
	x.style.height="32px";
	x.style.width="32px";
}
</script>

<style type="text/css">
table.bottomBorder { border-collapse:collapse; }
table.bottomBorder td, table.bottomBorder th { border-bottom:1px dotted black;padding:5px; }
</style>

</head>
<body>

<?php
$restaurant = $_POST["menu"];

/* Connect to Database Server */
// $username = "root";
// $password = "utexas";
// $hostname = "10.146.34.25";
// $db_name = "Restaurants";

// $con = mysqli_connect($hostname, $username, $password, $db_name) 
$con = $dblink; 
 // or die("Unable to connect to MySQL");

$hashtags = array();

function extractWords($str, &$hashtags) {
	$words = explode(' ', $str);
	$combined = "";
	foreach($words as $word) {
		if(strlen($word) > 3)
		//	array_push($hashtags, $word);
			$combined = $combined.$word;
	}
	array_push($hashtags, $combined);
}

/* Restaurant name */
$menu_id = 1;
$query = "SELECT * FROM menu WHERE name='".$restaurant."'";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result)) {
	//extractWords($row{'name'}, $hashtags);
	$menu_id = $row{'id'};
}

/* Restaurant Dishes */
?> <table class="bottomBorder"> <?php
$query = "SELECT * FROM dish WHERE menu_id='".$menu_id."' LIMIT 1";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($result)) {
	$dish = $row{'name'};
	$url = $row{'url'};
	?> <tr>
		<td> <?php echo $dish; ?> </td>
		<td> <img onmouseover="bigImg(this)" onmouseout="normalImg(this)"
					src="<?php echo $url; ?>" width="32" height="32"> </td>
	</tr> <?php
	extractWords($row{'name'}, $hashtags);
}
?> </table> <?php

//print_r($hashtags);
mysqli_close($con);

$bucket = new Bucket();
$instagram = new Instagram('a7bc3ca739bc49c092767a8607aff9b3');

foreach($hashtags as $tag) {
	$popular = $instagram->getImagesFromHashtag($tag);

	foreach($popular as $key => $val) {
		$bucket->addPost($val);
		$post = $val->caption->text; 
		echo $post.'<br>';
	}
	
	$instagram->writeRDataFrame($bucket);
	$bucket->sort();
	
	/*$posts = $bucket->getPosts();
	foreach($posts as $post) {
	echo 'text: '.$post->getText().'<br>'; 
	echo 'likes: '.$post->getLikes().'<br>'; 
	echo 'P(pos): '.$post->getProbabilityPositive().'<br>'; 
	echo 'P(neg): '.$post->getProbabilityNegative().'<br>'; 
	echo 'P(neu): '.$post->getProbabilityNeutral().'<br>'; 
	echo '<img src="'.$post->getImg().'"><hr>'; 
	echo '<br>'; 
	}*/
	echo "Yeeee";
	$output = shell_exec('r --slave -f regress.r');
	echo gettype($output);

	echo $output;
	echo "Boooo";
}

?>

</body>
</html>