<?php
    $city_name = $_POST["cityName"];
    $country = $_POST["country"];
    $state = $_POST["state"];
    $response["success"] = 1;
    $response["message"] = "City Added Successfully";
    echo json_encode($response);
?>