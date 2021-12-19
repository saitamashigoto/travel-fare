<?php

namespace Piyush\Model;

use Piyush\Model\Driver;
use Piyush\Model\NumberFormatter;
use Piyush\Model\JsonFileIO;
use Piyush\Exception\DriverNotFoundException;

class DriverManagement
{
    private static $drivers = [];

    public const DRIVER_FILE_PATH = '/files/drivers.json';

     public function __construct()
    {
        self::readDriversFromFile();
    }

    private static function readDriversFromFile()
    {
        $drivers = JsonFileIO::readFile(self::DRIVER_FILE_PATH);
        self::populateDriversFromArray($drivers);
    }

    private static function populateDriversFromArray($array)
    {
        self::$drivers = [];
        foreach ($array as $email => $driver) {
            self::$drivers[$email] = new Driver(
                $driver['name'],
                $driver['surname'],
                $driver['email'],
                $driver['vehicleType'],
                $driver['baseFarePrice'],
                $driver['baseFareDistance']
            );
        }
    }

    private static function writeDriversToFile()
    {
        $driversArray = self::convertDriversToArray();
        self::$drivers = JsonFileIO::writeFile(self::DRIVER_FILE_PATH, $driversArray);
    }

    private static function convertDriversToArray()
    {
        $array = [];
        foreach (self::$drivers as $email => $driver) {
            $array[$email] = $driver->toArray();
        }
        return $array;
    }

    public static function register(
        $name,
        $surname,
        $email,
        $vehicleType,
        $baseFarePrice,
        $baseFareDistance
    ) {
        self::readDriversFromFile();
        $driver = new Driver(
            $name,
            $surname,
            $email,
            $vehicleType,
            NumberFormatter::formatCost($baseFarePrice),
            NumberFormatter::formatDistance($baseFareDistance)
        );
        self::$drivers[$driver->getEmail()] = $driver;
        self::writeDriversToFile();
        return $driver;
    }

    public static function update(
        $oldEmail,
        $name = null,
        $surname = null,
        $newEmail = null,
        $vehicleType = null,
        $baseFarePrice = null,
        $baseFareDistance = null
    ) {
        self::readDriversFromFile();
        self::validateDriver($oldEmail);
        $driver = self::$drivers[$oldEmail];
        if (!empty($name)) {
            $driver->setName($name);
        }
        if (!empty($surname)) {
            $driver->setSurname($surname);
        }
        if (!empty($newEmail)) {
            $driver->setEmail($newEmail);
            unset(self::$drivers[$oldEmail]);
            self::$drivers[$newEmail] = $driver;
        }
        if (!empty($vehicleType)) {
            $driver->setVehicleType($vehicleType);
        }
        if (!empty($baseFarePrice)) {
            $driver->setBaseFarePrice(NumberFormatter::formatCost($baseFarePrice));
        }
        if (!empty($baseFareDistance)) {
            $driver->setBaseFareDistance(NumberFormatter::formatDistance($baseFareDistance));
        }
        self::writeDriversToFile();
        return $driver;
    }

    public static function delete($email)
    {
        self::readDriversFromFile();
        $driver = self::$drivers[$email];
        unset(self::$drivers[$email]);
        self::writeDriversToFile();
        return $driver;
    }

    public static function getList()
    {
        self::readDriversFromFile();
        return array_values(self::$drivers);
    }

    public static function get($email)
    {
        self::readDriversFromFile();
        if (isset(self::$drivers[$email])) {
            return self::$drivers[$email];
        }
        return null;
    }

    private static function validateDriver($email)
    {
        self::readDriversFromFile();
        if (empty(self::$drivers[$email])) {
            throw new DriverNotFoundException(
                sprintf('Driver with "%s" does not exist.', $email)
            );
        }
    }
}