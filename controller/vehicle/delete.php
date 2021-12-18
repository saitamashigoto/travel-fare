<?php

require '../../src/Piyush/autoload.php';
use Piyush\Model\VehicleManagement;

if (!empty($_GET['value'])) {
    $value = $_GET['value'];
    VehicleManagement::delete($value);
}
header('Location: /travel-fare/view/vehicle/index.php');