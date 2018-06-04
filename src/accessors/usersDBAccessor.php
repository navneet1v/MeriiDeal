<?php
    require '../../vendor/autoload.php';

    /**
     * This class is responsible for all the functions related to Users DB.
     */
    class UsersDBAccessor {

        private $db;

        function __construct($db = NULL) {
            $this->db = $db;
        }

        function __destruct() {
            $this->db->close();
        }
    }

    $UsersDBAccessor = new UsersDBAccessor();
?>