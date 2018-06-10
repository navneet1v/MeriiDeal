<?php
    require_once(__DIR__ . "/../src/accessors/cityAccessor.php");

    global $cityAccessor;

    if (isset($_POST["cityName"]) && isset($_POST["country"]) && isset($_POST["state"])) {
        $city = new City();
        $city->name = $_POST["cityName"];
        $city->country = $_POST["country"];
        $city->state = $_POST["state"];
        $city->id = uniqid('city-');

        // add city to the database.
        if($cityAccessor->insertCity($city)) {
            $response["success"] = 1;
            $response["message"] = "City Added Successfully";
            echo json_encode($response);
        } else {
            $response["success"] = 0;
            $response["message"] = "Unable to add the city";
            echo json_encode($response);
        }

    } else {
        http_response_code(400);
    }
?>