<?php
ini_set('display_errors', 1);
require '../../src/Piyush/autoload.php';
use Piyush\Model\VehicleManagement;

if ( (!empty($_POST['value'])) && (!empty($_POST['label'])) && empty($_POST['oldValue']) ) {
    VehicleManagement::register($_POST['value'], $_POST['label']);
} else if (((!empty($_POST['value'])) || (!empty($_POST['label']))) && (!empty($_POST['oldValue'])) ) {
    VehicleManagement::update($_POST['oldValue'], $_POST['label'], $_POST['value']);
}
header('Location: /travel-fare/view/vehicle/index.php');