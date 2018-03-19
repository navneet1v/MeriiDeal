<?php  
	/**
	* This is the model class for the City Table
	*/
	class City {
		
		public $cityId;
		public $cityName;
		public $cityState;
		public $cityPincode;
		
		function __construct() {
			// empty constructor
		}
	}

	$city = new City();
?>