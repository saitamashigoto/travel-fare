<?php

namespace Piyush\Model;

class NumberFormatter
{
    public static function formatDistance($distance)
    {
        return self::formatNumber($distance);
    }
    
    public static function formatCost($cost)
    {
        return self::formatNumber($cost);
    }
    
    private static function formatNumber($num)
    {
        return number_format($num, 2, '.', '');
    }
}