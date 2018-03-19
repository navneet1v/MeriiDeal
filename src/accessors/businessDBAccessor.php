<?php
    require_once( "../db/dbConnect.php" );
    require_once( "../model/city.php" );

    /**
     * This class is responsible for creating the business functionalties
     * "SELECT * FROM family,login WHERE member_id = '{$id}' && id = family_id";
     */
    class businessDBAccessor {

        private $db;

        function __construct ( $db ) {
            $this->db = $db;
        }

        function __destruct () {
            $this->db->close();
        }


        public function getCityNameFromCityId ( $cityId ) {
            $query = "SELECT * from city WHERE cityId = '{$cityId}'";
            $result = $this->db->query_db( $query );
            $cityName = "Not found";
            if ( !$result ) {
                $row = $this->db->fetch_array( $result );
                $cityName = $row[ "name" ];
            }
            return $cityName;
        }
    }

    $businessDBAccessor = new businessDBAccessor( $db );
?>