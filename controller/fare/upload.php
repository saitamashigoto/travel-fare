<?php
ini_set('display_errors', 1);
require '../../src/Piyush/autoload.php';

use Piyush\Model\FareManagement;

$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');

if(
    isset($_POST["upload"]) &&
    isset($_POST["upload"]) &&
    isset($_FILES["fareData"]) &&
    $_FILES["fareData"]['error'] === UPLOAD_ERR_OK
) {
    if (in_array($_FILES['fareData']['type'], $mimes)) {
        FareManagement::calculateCheapestFaresFromCsvFile($_FILES["fareData"]['tmp_name']);
    } else {
        die('File not supported.');
    }
} 

header('Location: /travel-fare/view/fare/index.php');