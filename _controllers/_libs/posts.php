<?php 

require_once('Unirest/Unirest.php'); 

class Bucket {
	private $posts; 

	public function __construct() {
		$this->posts = array(); 
	}

	public function addPost($post) {
		$temp = new Post($post); 
		array_push($this->posts, $temp); 
	} 

	public function getPosts() {
		return $this->posts; 
	}

	public function sort() {
		$this->mergeSort($this->posts); 
	}

	private function mergeSort($array) {
		if(count($array) > 1) {
			$left = $this->leftHalf($array); 
			$right = $this->rightHalf($array); 

			$this->mergeSort($left); 
			$this->mergeSort($right); 

			$this->merge($array, $left, $right); 
		}
	}

	private function leftHalf($array) {
		$size = count($array)/2; 
		$left = array(); 
		for($i = 0; $i< $size; $i++) {
			$left[$i] = $array[$i]; 
		}
		return $left; 
	}

	private function rightHalf($array) {
		$size = count($array)/2; 
		$count = count($array)-$size; 
		$right = array(); 
		for($i = 0; $i < $count; $i++) {
			$right[$i] = $array[$i + $size]; 
		}
		return $right; 
	}

	private function merge($result, $left, $right) {
		$l = 0; 
		$r = 0; 

		for($i = 0; $i < count($result); $i++) {
			if($r >= count($right) || ($l < count($left) && $left[$l]->getLikes() <= $right[$r]->getLikes())) {
				$result[$i] = $left[$l]; 
				$l++; 
			} else {
				$result[$i] = $right[$r]; 
				$r++; 
			}
		}
	}
}

class Post {
	private $post; 				// actual json instagram post 
	private $text; 				// text from post 
	private $img; 				// image from post 
	private $partsOfSpeech; 	// text tagged with parts of speech 
	private $adjectives; 		// count of adjectives 
	private $likes; 			// count of likes 
	private $sentiment; 		// sentiment analysis probabilities 
	private $sentimentType; 	// highest sentiment probability: 
								// 		-1 : negative 
								// 		0 : neutral 
								// 		1 : positive 
	private $lamda; 

	public function __construct($instagram_post) { 
		if(is_object($instagram_post) && (count(get_object_vars($instagram_post)))) {
			$this->post = $instagram_post; 
			$this->sentiment = array(); 
			$this->sentiment["pos"] = 0; 
			$this->sentiment["neg"] = 0; 
			$this->sentiment["neu"] = 0; 
			$this->lambda = 1; 
			$this->adjectives += $this->lambda; 
			$this->getInfoFromPost(); 
		}
	} 

	private function getInfoFromPost() {
		// get post
		$post = $this->post; 

		// get text 
		$this->text = $post->caption->text; 

		// get image 
		$this->img = $post->images->standard_resolution->url; 
		
		// get parts of speech 
		$response = Unirest::post(
			"https://japerk-text-processing.p.mashape.com/tag/", 
			array(
				"X-Mashape-Authorization" => "ZIgUr7Mpn4QrBOfdKJQYfvejZsYKyGFQ"
			), 
			array(
				"language" => "english",
				"output" => "tagged",
				"text" => $this->text 
			)
		); 
		// echo $response->raw_body.'<br>'; 
		$json = json_decode($response->raw_body); 
		$this->partsOfSpeech = $json->{"text"}; 
		// echo $this->partsOfSpeech.'<br>'; 

		// counting adjectives 
		$temp = explode(" ",$this->partsOfSpeech); 
		foreach($temp as $key => $value) {
			$tag = explode("/",$value);
			if($tag[1]=="JJ") $this->adjectives += 1; 
		}

		// counting likes 
		$this->likes = $post->likes->count+$lamda; 

		// get sentiment analysis 
		$response = Unirest::post(
			"https://japerk-text-processing.p.mashape.com/sentiment/",
			array(
		    	"X-Mashape-Authorization" => "ZIgUr7Mpn4QrBOfdKJQYfvejZsYKyGFQ"
			),
			array(
		 		"text" => $this->text,
				"language" => "english"
			) 
		);
		// echo $response.'<br>'; 
		// $sent = json_decode($response); 
		$sent = json_decode($response->raw_body); 
		$this->sentiment["pos"] = $sent->{"probability"}->pos; 
		$this->sentiment["neg"] = $sent->{"probability"}->neg; 
		$this->sentiment["neu"] = $sent->{"probability"}->neutral; 
		// echo "P(pos) = ".$this->sentiment["pos"].'<br>'; 
		// echo "P(neg) = ".$this->sentiment["neg"].'<br>'; 
		// echo "P(neutral) = ".$this->sentiment["neu"].'<br>'; 

		// getting sentiment type 
		if($this->sentiment["pos"] > $this->sentiment["neg"] && $this->sentiment["pos"] > $this->sentiment["neu"])
			$this->sentimentType = 1; 
		elseif($this->sentiment["neg"] > $this->sentimentType["pos"] && $this->sentiment["neg"] > $this->sentiment["neu"])
			$this->sentimentType = -1; 
		else $this->sentimentType = 0; 
	}

	public function getPost() { return $this->post; } 
	public function getText() { return $this->text; } 
	public function getImg() { return $this->img; } 
	public function getPartsOfSpeech() { return $this->partsOfSpeech; } 
	public function getAdjectiveCount() { return $this->adjectives; } 
	public function getLikes() { return $this->likes; }
	public function getProbabilityPositive() { return $this->sentiment["pos"]; } 
	public function getProbabilityNegative() { return $this->sentiment["neg"]; } 
	public function getProbabilityNeutral() { return $this->sentiment["neu"]; } 
	public function getSentimentType() { return $this->sentimentType; } 

}

?>
