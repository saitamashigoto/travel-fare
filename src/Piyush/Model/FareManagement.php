<?php

namespace Piyush\Model;

use Piyush\Model\DriverManagement;
use Piyush\Model\CsvFileReader;
use Piyush\Exception\FareException;

class FareManagement
{
    private static $fares = [];

    public static function calculateFareHash(
        $distanceTraveled,
        $traveledUnit,
        $costPerDistanceTraveled
    ) {
        return sha1($distanceTraveled.$traveledUnit.$costPerDistanceTraveled);
    }

    public static function calculateCheapestFare(
        $distanceTraveled,
        $traveledUnit,
        $costPerDistanceTraveled
    ) {
        self::valdateDrivers();
        $fareHash = $this->calculateFareHash($distanceTraveled, $traveledUnit, $costPerDistanceTraveled);
        if (empty(self::$fares[$fareHash])) {
            $drivers = DriverManagement::getList();
            $driverFares = [];
            foreach ($drivers as $driver) {
                $driverFares[] = $driver->calculateFare($distanceTraveled, $traveledUnit, $costPerDistanceTraveled);
            }
            sort($driverFares);
            $cheapestFare = reset($driverFares);
            self::$fares[$fareHash] = $cheapestFare;
        }
        return self::$fares[$fareHash];
    }

    public static function calculateCheapestFaresFromCsvFile($filePath)
    {
        self::valdateDrivers();
        $fareData = CsvFileReader::readFile($filePath);
        self::valdateFareData($fareData);
        foreach ($fareData as $row) {
            self::calculateCheapestFare(...$row);
        }
    }

    private static function valdateDrivers()
    {
        $drivers = DriverManagement::getList();
        if (count($drivers) === 0) {
            throw new FareException('No Driver Exists. Please add some Drivers.');
        }
    }

    private static function valdateFareData($fareData)
    {
        if (count($fareData) === 0) {
            throw new FareException('Empty Fair Data. Please provide fare data.');
        }
    }
}