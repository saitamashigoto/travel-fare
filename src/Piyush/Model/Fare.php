<?php

namespace Piyush\Model;

class Fare
{
    private $distanceTraveled;
    private $traveledUnit;
    private $costPerDistanceTraveled;
    private $cheapestFare;

    public function __construct(
        $distanceTraveled = null,
        $traveledUnit = null,
        $costPerDistanceTraveled = null,
        $cheapestFare = null
    ) {
        $this->distanceTraveled = $distanceTraveled;
        $this->traveledUnit = $traveledUnit;
        $this->costPerDistanceTraveled = $costPerDistanceTraveled;
        $this->cheapestFare = $cheapestFare;
    }

    public function getDistanceTraveled()
    {
        return $this->distanceTraveled;
    }
    
    public function setDistanceTraveled($distanceTraveled)
    {
        $this->distanceTraveled = $distanceTraveled;
        return $this;
    }    
    
    public function getTraveledUnit()
    {
        return $this->traveledUnit;
    }
    
    public function setTraveledUnit($traveledUnit)
    {
        $this->traveledUnit = $traveledUnit;
        return $this;
    }    

    public function getCostPerDistanceTraveled()
    {
        return $this->costPerDistanceTraveled;
    }
    
    public function setCostPerDistanceTraveled($costPerDistanceTraveled)
    {
        $this->costPerDistanceTraveled = $costPerDistanceTraveled;
        return $this;
    }    

    public function getCheapestFare()
    {
        return $this->cheapestFare;
    }
    
    public function setCheapestFare($cheapestFare)
    {
        $this->cheapestFare = $cheapestFare;
        return $this;
    }    
    
    public function toArray()
    {
        return [
            'distanceTraveled' => $this->getDistanceTraveled(),
            'traveledUnit' => $this->getTraveledUnit(),
            'costPerDistanceTraveled' => $this->getCostPerDistanceTraveled(),
            'cheapestFare' => $this->getCheapestFare(),
        ];
    }

    public function calculateHash()
    {
        return sha1($this->distanceTraveled.$this->traveledUnit.$this->costPerDistanceTraveled);
    }
}