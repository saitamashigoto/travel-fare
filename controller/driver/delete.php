<?php

require '../../src/Piyush/autoload.php';
use Piyush\Model\DriverManagement;

if (!empty($_GET['email'])) {
    $email = $_GET['email'];
    DriverManagement::delete($email);
}
header('Location: /travel-fare/view/driver/index.php');