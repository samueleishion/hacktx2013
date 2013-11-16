<?php

	class Bucket
	{
		@var
		private $_restaurantName;
		private $_bucket;
	}

  	public function __construct($name) {
   	 	this._restaurantName = $name;
  	}

	public function addPost($post)
	{
		foreach ($this->_bucket as $i) {
  			//$i->getPos
		}
	}

	//exec("r --slave ");

}