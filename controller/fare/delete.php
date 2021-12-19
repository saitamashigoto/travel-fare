<?php

require '../../src/Piyush/autoload.php';
use Piyush\Model\FareManagement;

if (!empty($_GET['hash'])) {
    $hash = $_GET['hash'];
    FareManagement::delete($hash);
}
header('Location: /travel-fare/view/fare/index.php');