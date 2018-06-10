<?php

    require_once __DIR__ . '/../../vendor/autoload.php';
    date_default_timezone_set('UTC');

    define('CITY_TABLE', "city");
    define('USER_TABLE', "users");
    define('STORE_TABLE', "stores");
    define('VOUCHER_TABLE', "voucher");
    define('NOTIFICATION_TABLE', "notification");

    $awsSDK = new Aws\Sdk([
        'endpoint' => 'http://localhost:8000',
        'region' => 'us-west-2',
        'version' => 'latest'
    ]);

    foreach (glob(__DIR__ . "/../model/*.php") as $filename) {
        require_once $filename;
    }
?>