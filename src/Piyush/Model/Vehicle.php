<?php

namespace Piyush\Model;

class Vehicle
{
    private $value;
    private $label;

    public function __construct(
        $value,
        $label
    ) {
        $this->value = $value;
        $this->label = $label;
    }

    public function getLabel()
    {
        return $this->label;
    }    
    
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }    
    
    public function getValue()
    {
        return $this->value;
    }    
    
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function toArray()
    {
        return [
            'label' => $this->getLabel(),
            'value' => $this->getValue(),
        ];
    }
}