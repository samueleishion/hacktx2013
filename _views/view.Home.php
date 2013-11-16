<?

require_once("_controllers/_libs/instagram.class.php"); 
require_once("_controllers/_libs/posts.php"); 
require_once("_models/model.Restaurant.php"); 

$restaurant = new Restaurant($dblink,"Kerbey Lane Cafe"); 
$bucket = new Bucket(); 
$instagram = new Instagram("a7bc3ca739bc49c092767a8607aff9b3"); 

$hashtags = array();
$page = 'home'; 
HTMLhead($page); 
HTMLnav($page); 

?>

<section id="home">
  hacktx2013<br><br><br>
  <? 
	$menu = $restaurant->getMenu()->getDishes(); 
	foreach($menu as $item) {
		// echo '<img src="'.$item->getURL().'">'; 
		extractWords($item->getName(), $hashtags);
	}

	echo "<hr>"; 

	foreach($hashtags as $tag) { 
		$popular = $instagram->getImagesFromHashtag($tag); 
		foreach($popular as $key=>$val) { 
			$bucket->addPost($val); 
			// $post = $val->caption->text; 
			// echo $post.'<Br>'; 
		} 
	} 

	$instagram->writeRDataFrame($bucket); 
	$bucket->sort(); 

	echo "<hr>"; 

	echo "out: "; 
	exec("r --slave -f _controllers/_libs/regress.r",$output); 
	print_r($output); 
  ?>
</section>

<?
HTMLfoot($page); 
?>