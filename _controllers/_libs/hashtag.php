<?php
	//this php file is the same in instagram.class.php as getImagesFromHashtag($hashtag)
	require 'instagram.class.php';

	//bdcb8439e7c54c8494667b8d6e05ba2e //client secret
	//a7bc3ca739bc49c092767a8607aff9b3 // client id
	// Initialize class for public requests
	$instagram = new Instagram('a7bc3ca739bc49c092767a8607aff9b3');

	$hashtag = "cars";
	$limit = 30;
	// Get popular media
	$popular = $instagram->getTagMedia($hashtag, $limit);

	//$popular.getImagesFromInstagram();
	// Display results
	foreach ($popular->data as $data) {
 	 echo "<img src=\"{$data->images->thumbnail->url}\">";
	}

?>