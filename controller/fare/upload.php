<?php
ini_set('display_errors', 1);
require '../../src/Piyush/autoload.php';

use Piyush\Model\FareManagement;

if(
    isset($_POST["upload"]) &&
    isset($_POST["upload"]) &&
    isset($_FILES["fareData"]) &&
    $_FILES["fareData"]['error'] === UPLOAD_ERR_OK
) {
    FareManagement::calculateCheapestFaresFromCsvFile($_FILES["fareData"]['tmp_name']);
}

header('Location: /travel-fare/view/fare/index.php');