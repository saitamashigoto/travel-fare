<?php
ini_set('display_errors', 1);
require '../../src/Piyush/autoload.php';

use Piyush\Model\FareManagement;

if (!empty($_GET['hash'])) {
    FareManagement::update($_GET['hash']);
}

header('Location: /travel-fare/view/fare/index.php');

