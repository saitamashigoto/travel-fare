<?php

namespace Piyush\Model;

class Driver
{
    private $name;
    private $surname;
    private $email;
    private $vehicleType;
    private $baseFarePrice;
    private $baseFareDistance;

    public function __construct(
        $name,
        $surname,
        $email,
        $vehicleType,
        $baseFarePrice,
        $baseFareDistance
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->vehicleType = $vehicleType;
        $this->baseFarePrice = $baseFarePrice;
        $this->baseFareDistance = $baseFareDistance;
    }

    public function getName()
    {
        return $this->name;
    }    
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }    
    
    public function getSurname()
    {
        return $this->surname;
    }    
    
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }    
    
    public function getEmail()
    {
        return $this->email;
    }    
    
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }    
    
    public function getVehicleType()
    {
        return $this->vehicleType;
    }    
    
    public function setVehicleType($vehicleType)
    {
        $this->vehicleType = $vehicleType;
        return $this;
    }    

    public function getBaseFarePrice()
    {
        return $this->baseFarePrice;
    }    
    
    public function setBaseFarePrice($baseFarePrice)
    {
        $this->baseFarePrice = $baseFarePrice;
        return $this;
    }    

    public function getBaseFareDistance()
    {
        return $this->baseFareDistance;
    }    
    
    public function setBaseFareDistance($baseFareDistance)
    {
        $this->baseFareDistance = $baseFareDistance;
        return $this;
    }

    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'email' => $this->getEmail(),
            'vehicleType' => $this->getVehicleType(),
            'baseFarePrice' => $this->getBaseFarePrice(),
            'baseFareDistance' => $this->getBaseFareDistance(),
        ];
    }


    public function calculateFare(
        $distanceTraveled,
        $traveledUnit,
        $costPerDistanceTraveled
    ) {
        if ($this->doNeedToPayExtra($distanceTraveled)) {
            $distanceTraveledUnits = $this->calculateDistanceTraveledUnits($distanceTraveled);
            $distanceTraveledUnitsCost = $this->calculateDistanceTraveledUnitsCost(
                $distanceTraveledUnits,
                $traveledUnit,
                $costPerDistanceTraveled
            );
            return $this->baseFarePrice + $distanceTraveledUnitsCost;
        }
        return $this->baseFarePrice;
    }

    public function doNeedToPayExtra($distanceTraveled)
    {
        return $this->baseFareDistance < $distanceTraveled;
    }

    protected function calculateDistanceTraveledUnits($distanceTraveled)
    {
        return $distanceTraveled - $this->baseFareDistance;
    }

    protected function calculateDistanceTraveledUnitsCost(
        $distanceTraveledUnits,
        $traveledUnit,
        $costPerDistanceTraveled
    ) {
        return $distanceTraveledUnits / $traveledUnit * $costPerDistanceTraveled;
    }
}