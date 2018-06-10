<?php
    require_once(__DIR__ . "/../src/accessors/cityAccessor.php");

    global $cityAccessor;
    $cites = $cityAccessor->getAllCities();
    $response = array();
    $response["success"] = 1;
    $response["cities"] = $cites;
    echo json_encode($response);
?>