<?

require_once("instagram.class.php"); 
require_once("posts.php"); 

$bucket = new Bucket(); 
$instagram = new Instagram('a7bc3ca739bc49c092767a8607aff9b3'); 

$hashtag = 'enchiladas'; 
$popular = $instagram->getImagesFromHashtag($hashtag); 

echo '<br><br>'; 
foreach($popular as $key => $val) {
	$bucket->addPost($val); 
	$post = $val->caption->text; 
	echo $post.'<br>'; 
}

$bucket->sort(); 
echo '<hr>'; 
$posts = $bucket->getPosts(); 
// foreach($posts as $key => $val) { 
	// $post = $val->caption->text; 
	// echo $post.'<br>'; 
// }
foreach($posts as $post) {
	echo 'text: '.$post->getText().'<br>'; 
	echo 'likes: '.$post->getLikes().'<br>'; 
	echo 'P(pos): '.$post->getProbabilityPositive().'<br>'; 
	echo 'P(neg): '.$post->getProbabilityNegative().'<br>'; 
	echo 'P(neu): '.$post->getProbabilityNeutral().'<br>'; 
	echo '<img src="'.$post->getImg().'"><hr>'; 
	echo '<br>'; 
}


?>