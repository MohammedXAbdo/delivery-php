<?php
namespace App\Helpers;


class CurrencyUtil {

    public static function doubleToString($currency): string
    {
     return round($currency,2);
    }




}

