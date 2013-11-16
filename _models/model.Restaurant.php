<?

require_once("_controllers/settings.php"); 
require_once("_controllers/_libs/functions.php"); 

class Restaurant {
	private $dblink; 
	private $id; 
	private $name; 
	private $location; 
	private $menu; 

	public function __construct($dblink,$restaurant) {
		$this->dblink = $dblink; 
		$restaurant = clean($restaurant); 
		$result = mysqli_query($this->dblink,"SELECT * FROM menu WHERE name='$restaurant' LIMIT 1"); 
		while($row = mysqli_fetch_array($result)) {
			$this->id = $row["id"]; 
			$this->name = $row["name"]; 
			$this->location = $row["location"]; 
		}
		$this->menu = new Menu($this->dblink,$this->id); 
	}

	public function getId() { return $this->id; } 
	public function getName() { return $this->name; } 
	public function getLocation() { return $this->location; } 
	public function getMenu() { return $this->menu; }
}

class Menu {
	private $dblink; 
	private $restaurant_id; 
	private $dishes; 

	public function __construct($dblink,$restaurant) {
		$this->dblink = $dblink; 
		$this->dishes = array(); 
		$restaurant = clean($restaurant); 
		$result = mysqli_query($this->dblink,"SELECT * FROM dish WHERE menu_id='$restaurant'"); 
		while($row = mysqli_fetch_array($result)) {
			$dish = new Dish($this->dblink,$row['name']); 
			array_push($this->dishes, $dish); 
		}
	}

	public function getDishes() { return $this->dishes; }
	public function getMenuId() { return $this->restaurant_id; } 
}

class Dish {
	private $dblink; 
	private $name; 
	private $type; 
	private $menu_id; 
	private $url; 

	public function __construct($dblink,$name) {
		$this->dblink = $dblink; 
		$name = clean($name); 
		$result = mysqli_query($this->dblink,"SELECT * FROM dish WHERE name='$name'"); 
		while($row = mysqli_fetch_array($result)) {
			$this->name = $row['name']; 
			$this->type = $row['type']; 
			$this->menu_id = $row['menu_id']; 
			$this->url = $row['url']; 
		}
	}

	public function getName() { return $this->name; } 
	public function getType() { return $this->type; } 
	public function getMenuId() { return $this->menu_id; } 
	public function getURL() { return $this->url; } 
}

?>	