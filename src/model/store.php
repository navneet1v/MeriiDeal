<?php

    /**
     * This class is the model class for Store
     */
    class Store {

        public $storeId;
        public $name;
        public $landmark;
        public $description;
        public $latLong;
        public $howToRedeem;
        public $photoLink;
        public $updateTime;
        public $city;
        public $phoneNumber;

        function __construct () {
            // empty constructor
        }
    }

    $store = new Store();
?>