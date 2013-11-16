<?php
	require 'instagram.class.php';

	// Initialize class for public requests
	$instagram = new Instagram('YOUR_APP_KEY');

	$hashtag = "";
	// Get popular media
	$popular = $instagram->getImagesFromHashTag($hashtag);

	// Display results
	foreach ($popular->data as $data) {
 	 echo "<img src=\"{$data->images->thumbnail->url}\">";
	}


?>