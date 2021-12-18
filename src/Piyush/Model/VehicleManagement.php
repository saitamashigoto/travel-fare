<?php

namespace Piyush\Model;

use Piyush\Model\Vehicle;
use Piyush\Exception\VehicleNotFoundException;

class VehicleManagement
{
    private static $vehicles = [];

    public function register(
        $value,
        $label
    ) {
        $vehicle = new Vehicle(
            $value,
            $label
        );
        self::$vehicles[$vehicle->getValue()] = $vehicle;

        return $vehicle;
    }

    public function update(
        $value,
        $label = null,
        $newValue = null
    ) {
        if (!isset(self::$vehicles[$value])) {
            throw new VehicleNotFoundException(
                sprintf('Vehicle with "%s" does not exist.', $value)
            );
        }
        $vehicle = self::$vehicles[$value];
        if (!empty($label)) {
            $vehicle->setLabel($label);
        }
        if (!empty($newValue)) {
            $vehicle->setValue($newValue);
            unset(self::$vehicles[$newValue]);
            self::$vehicles[$newValue] = $vehicle;
        }
        return $vehicle;
    }

    public function delete($value)
    {
        $vehicle = self::$vehicles[$value];
        unset(self::$vehicles[$value]);
        return $vehicle;
    }

    public function getList()
    {
        return self::$vehicles;
    }
}