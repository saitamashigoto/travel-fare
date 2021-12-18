<?php

namespace Piyush\Model;

class CsvFileReader
{
    public static function readFile($path)
    {
        $csvData = [];
        try {
            if (($open = fopen($path, "r")) !== false) {
                while (($data = fgetcsv($open, 1000, ",")) !== false) {        
                    $csvData[] = $data; 
                }
                fclose($open);
            }
        } catch (\Exception $e) {
            //
        }
        return $csvData;
    }
}