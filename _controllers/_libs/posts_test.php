<?

require_once("instagram.class.php"); 

$instagram = new Instagram('a7bc3ca739bc49c092767a8607aff9b3'); 

$hashtag = 'enchiladas'; 
$popular = $instagram->getImagesFromHashtag($hashtag); 

echo $popular; 

?>