<?php
    require_once(__DIR__ . "/../src/accessors/cityAccessor.php");
    require_once(__DIR__ . "/../include/commonFunctions.php");

    global $cityAccessor;
    $response = array();
    $cites = $cityAccessor->getAllCities();
    $fileName = exportToExcel("cities", array("Name", "State", "Country"), createCitiesDataArray($cites));
    $response["success"] = 0;
    $response["message"] = "Not to able to download the file";
    if($fileName != NULL) {
        $response["success"] = 1;
        $response["filename"] = $fileName;
        $response["message"] = "File ready to download";
    }
    echo json_encode($response);

    function createCitiesDataArray($cities) {
        $citiesDataArray = array();
        foreach($cities as $city) {
            $cityArray = array($city->name, $city->state, $city->country);
            array_push($citiesDataArray, $cityArray);
        }
        return $citiesDataArray;
    }
?>