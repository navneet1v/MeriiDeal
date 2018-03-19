<?php

    /**
     * Class Customer, this is responsible for containing fields related to customer
     */
    class Customer {

        public $phoneNumber;
        public $city;
        public $gcmId;
        public $name;

        function __construct () {

        }
    }

    $customer = new Customer();
?>