<?php

namespace Piyush\Model;

use Piyush\Model\Driver;
use Piyush\Exception\DriverNotFoundException;

class DriverManagement
{
    private static $drivers = [];

    public static function register(
        $name,
        $surname,
        $email,
        $vehicleType,
        $baseFarePrice,
        $baseFareDistance
    ) {
        $driver = new Driver(
            $name,
            $surname,
            $email,
            $vehicleType,
            $baseFarePrice,
            $baseFareDistance
        );
        self::$drivers[$driver->getEmail()] = $driver;

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
            $driver->setBaseFarePrice($baseFarePrice);
        }
        if (!empty($baseFareDistance)) {
            $driver->setBaseFareDistance($baseFareDistance);
        }

        return $driver;
    }

    public static function delete($email)
    {
        $driver = self::$drivers[$email];
        unset(self::$drivers[$email]);
        return $driver;
    }

    public static function getList()
    {
        return array_values(self::$drivers);
    }

    public static function get($email)
    {
        if (isset(self::$drivers[$email])) {
            return self::$drivers[$email];
        }
        return null;
    }

    private static function validateDriver($email)
    {
        if (empty(self::$drivers[$email])) {
            throw new DriverNotFoundException(
                sprintf('Driver with "%s" does not exist.', $email)
            );
        }
    }
}