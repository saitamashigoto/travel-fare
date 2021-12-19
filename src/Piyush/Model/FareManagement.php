<?php

namespace Piyush\Model;

use Piyush\Model\DriverManagement;
use Piyush\Model\Fare;
use Piyush\Model\CsvFileReader;
use Piyush\Exception\FareException;
use Piyush\Exception\FareNotFoundException;

class FareManagement
{
    private static $fares = [];

    public const FARE_FILE_PATH = '/files/fares.json';

     public function __construct()
    {
        self::readFaresFromFile();
    }

    private static function readFaresFromFile()
    {
        $fares = JsonFileIO::readFile(self::FARE_FILE_PATH);
        self::populateFaresFromArray($fares);
    }

    private static function populateFaresFromArray($array)
    {
        self::$fares = [];
        foreach ($array as $hash => $fare) {
            self::$fares[$hash] = new Fare(
                $fare['distanceTraveled'],
                $fare['traveledUnit'],
                $fare['costPerDistanceTraveled'],
                $fare['cheapestFare']
            );
        }
    }

    private static function writefaresToFile()
    {
        $faresArray = self::convertFaresToArray();
        self::$fares = JsonFileIO::writeFile(self::FARE_FILE_PATH, $faresArray);
    }

    private static function convertFaresToArray()
    {
        $array = [];
        foreach (self::$fares as $hash => $fare) {
            $array[$hash] = $fare->toArray();
        }
        return $array;
    }

    public static function register(
        $distanceTraveled,
        $traveledUnit,
        $costPerDistanceTraveled,
        $cheapestFar = 0
    ) {
        self::readFaresFromFile();
        $fare = new Fare(
            NumberFormatter::formatDistance($distanceTraveled),
            NumberFormatter::formatDistance($traveledUnit),
            NumberFormatter::formatCost($costPerDistanceTraveled),
            NumberFormatter::formatDistance($cheapestFar)
        );
        $fare->setCheapestFare(self::calculateCheapestFareFromFare($fare));
        self::$fares[$fare->calculateHash()] = $fare;
        self::writeFaresToFile();
        return $fare;
    }

    public static function update(
        $hash
    ) {
        self::readFaresFromFile();
        self::validateFare($hash);
        $fare = self::get($hash);
        $fare->setCheapestFare(self::calculateCheapestFareFromFare($fare));
        self::$fares[$hash] = $fare;
        self::writefaresToFile();
        return $fare;
    }

    public static function delete($hash)
    {
        self::readFaresFromFile();
        $fare = self::$fares[$hash];
        unset(self::$fares[$hash]);
        self::writefaresToFile();
        return $fare;
    }

    public static function getList()
    {
        self::readFaresFromFile();
        return array_values(self::$fares);
    }

    public static function get($hash)
    {
        self::readFaresFromFile();
        if (isset(self::$fares[$hash])) {
            return self::$fares[$hash];
        }
        return null;
    }

    private static function validateFare($hash)
    {
        self::readFaresFromFile();
        if (empty(self::$fares[$hash])) {
            throw new FareNotFoundException(
                sprintf('fare with "%s" does not exist.', $hash)
            );
        }
    }

    public static function calculateCheapestFareFromFare($fare)
    {
        return self::calculateCheapestFare(
            $fare->getDistanceTraveled(),
            $fare->getTraveledUnit(),
            $fare->getCostPerDistanceTraveled()
        );
    }

    public static function calculateCheapestFare(
        $distanceTraveled,
        $traveledUnit,
        $costPerDistanceTraveled
    ) {
        self::valdateDrivers();
        $drivers = DriverManagement::getList();
        $driverFares = [];
        foreach ($drivers as $driver) {
            $driverFares[] = $driver->calculateFare($distanceTraveled, $traveledUnit, $costPerDistanceTraveled);
        }
        sort($driverFares);
        $cheapestFare = reset($driverFares);
        return $cheapestFare;
    }

    public static function calculateCheapestFaresFromCsvFile($filePath)
    {
        self::valdateDrivers();
        $fareData = CsvFileReader::readFile($filePath);
        self::valdateFareData($fareData);
        foreach ($fareData as $row) {
            self::register(...$row);
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
            throw new FareException('Empty fare Data. Please provide fare data.');
        }
    }
}