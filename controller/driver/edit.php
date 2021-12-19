<?php

require '../../src/Piyush/autoload.php';
use Piyush\Model\DriverManagement;

if (!empty($_GET['email'])) {
    $email = $_GET['email'];
    header('Location: /travel-fare/view/driver/form.php?email='.$email);
} else {
    header('Location: /travel-fare/view/driver/index.php');
}