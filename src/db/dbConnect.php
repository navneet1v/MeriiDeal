<?php
    // for including the file only once.. :)
    require_once( "dbConstants.php" );

    class DbConnect {
        private $usersDb;
        private $businessDb;
        // default is private here
        // constructor
        function __construct () {
            // connecting to database
            $this->connect();
        }

        // destructor
        function __destruct () {
            // closing db connection
            $this->close();
        }

        /**
         * Function to connect with databases
         */
        function connect () {

            // connect to users database.
            $this->businessDb = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD , DB_DATABASE_BUSINESS);
            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }

            $this->usersDb = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD , DB_DATABASE_USERS);
            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }
        }

        /**
         * Function to close db connection
         */
        function close () {
            // closing db connection
            mysqli_close( $this->businessDb );
            mysqli_close( $this->usersDb );
        }

        // Removing the SQL injections from the query..
        function mysql_prep ( $value, $dbConnection ) {
            $magic_quotes_active = get_magic_quotes_gpc();
            $new_enough_php = function_exists( "mysql_real_escape_string" );

            if ( $new_enough_php ) {
                if ( $magic_quotes_active ) {
                    $value = stripslashes( $value );
                }
                $value = mysqli_real_escape_string( $dbConnection, $value );
            } else {
                if ( !$magic_quotes_active ) {
                    $value = addslashes( $value );
                }
            }
            return $value;
        }

        // querying in the database
        function query_db ( $query_string, $dbConnection, $use_sql_prep = 1 ) {
            $result = mysqli_query( $dbConnection, $query_string );
            $this->confirm_query($result, $dbConnection);

            if ( !$result ) {
                echo "Query has failed : ";
                echo mysqli_error($dbConnection);
            }
            return $result;
        }

        // Confirming the query..
        private function confirm_query ( $result, $dbConnection ) {
            if ( !$result ) {
                die( "Query has failed : " . mysqli_error($dbConnection) );
            }
        }

        // for number of rows
        function number_of_rows ( $result ) {
            return mysqli_num_rows( $result );
        }

        function fetch_array ( $result ) {
            return mysqli_fetch_array( $result );
        }

        function rows_affected ($dbConnection) {
            return mysqli_affected_rows( $dbConnection );
        }

        function getUserDBConnection () {
            return $this->usersDb;
        }

        function getBusinessDBConnection () {
            return $this->businessDb;
        }

    }

    $db = new DbConnect();
    //echo "Conection is made";
?>