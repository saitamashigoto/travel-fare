<?php

require '../../src/Piyush/autoload.php';
use Piyush\Model\VehicleManagement;

if (!empty($_GET['value'])) {
    $value = $_GET['value'];
    header('Location: /travel-fare/view/vehicle/form.php?value='.$value);
} else {
    header('Location: /travel-fare/view/vehicle/index.php');
}