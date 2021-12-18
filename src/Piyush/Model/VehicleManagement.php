<?php

namespace Piyush\Model;

use Piyush\Model\Vehicle;
use Piyush\Model\JsonFileIO;
use Piyush\Exception\VehicleNotFoundException;

class VehicleManagement
{
    public const VEHICLE_FILE_PATH = '/files/vehicles.json';

    private static $vehicles = [];

    public function __construct()
    {
        self::readVehiclesFromFile();
    }

    private static function readVehiclesFromFile()
    {
        $vehicles = JsonFileIO::readFile(self::VEHICLE_FILE_PATH);
        self::populateVehiclesFromArray($vehicles);
    }

    private static function populateVehiclesFromArray($array)
    {
        self::$vehicles = [];
        foreach ($array as $value => $vehicle) {
            self::$vehicles[$value] = new Vehicle($vehicle['value'], $vehicle['label']);
        }
    }

    private static function writeVehiclesToFile()
    {
        $vehiclesArray = self::convertVehiclesToArray();
        self::$vehicles = JsonFileIO::writeFile(self::VEHICLE_FILE_PATH, $vehiclesArray);
    }

    private static function convertVehiclesToArray()
    {
        $array = [];
        foreach (self::$vehicles as $value => $vehicle) {
            $array[$value] = $vehicle->toArray();
        }
        return $array;
    }

    public function register(
        $value,
        $label
    ) {
        self::readVehiclesFromFile();
        $vehicle = new Vehicle(
            $value,
            $label
        );
        self::$vehicles[$vehicle->getValue()] = $vehicle;
        self::writeVehiclesToFile();
        return $vehicle;
    }

    public function update(
        $value,
        $label = null,
        $newValue = null
    ) {
        self::readVehiclesFromFile();
        self::validateVehicle($value);
        $vehicle = self::$vehicles[$value];
        if (!empty($label)) {
            $vehicle->setLabel($label);
        }
        if (!empty($newValue)) {
            $vehicle->setValue($newValue);
            unset(self::$vehicles[$value]);
            self::$vehicles[$newValue] = $vehicle;
        }
        self::writeVehiclesToFile();
        return $vehicle;
    }

    public function delete($value)
    {
        self::readVehiclesFromFile();
        $vehicle = self::$vehicles[$value];
        unset(self::$vehicles[$value]);
        self::writeVehiclesToFile();
        return $vehicle;
    }

    public function getList()
    {
        self::readVehiclesFromFile();
        return self::$vehicles;
    }

    public static function get($value)
    {
        self::readVehiclesFromFile();
        if (isset(self::$vehicles[$value])) {
            return self::$vehicles[$value];
        }
        return null;
    }

    private static function validateVehicle($value)
    {
        self::readVehiclesFromFile();
        if (empty(self::$vehicles[$value])) {
            throw new VehicleNotFoundException(
                sprintf('Vehicle with "%s" does not exist.', $value)
            );
        }
    }
}