<?php
ini_set('display_errors', 1);
require '../../src/Piyush/autoload.php';

use Piyush\Model\DriverManagement;

function canRegisterDriver()
{
    return
    (!empty($_POST['name'])) &&
    (!empty($_POST['surname'])) &&
    (!empty($_POST['email'])) &&
    (!empty($_POST['vehicleType'])) &&
    (!empty($_POST['baseFarePrice'])) &&
    (!empty($_POST['baseFareDistance']));
}

function getDriverFields()
{
    return [
        $_POST['name'] ?? "",
        $_POST['surname'] ?? "",
        $_POST['email'] ?? "",
        $_POST['vehicleType'] ?? "",
        $_POST['baseFarePrice'] ?? "",
        $_POST['baseFareDistance'] ?? ""
    ];
}


if (empty($_POST['oldEmail']) && canRegisterDriver()) {
    DriverManagement::register(...getDriverFields());
} elseif (!empty($_POST['oldEmail'])) {
    DriverManagement::update($_POST['oldEmail'], ...getDriverFields());
}

header('Location: /travel-fare/view/driver/index.php');

