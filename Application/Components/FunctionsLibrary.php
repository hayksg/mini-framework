<?php

namespace Application\Components;

class FunctionsLibrary 
{
    public static function clearStr($str = '')
    {
        return trim(htmlentities($str, ENT_QUOTES));
    }
    
    public static function clearInt($int)
    {
        return abs((int)$int);
    }
    
    public static function catchAllExceptions($e)
    {
        echo $e->getMessage();
        exit;
    }
    
    public static function redirectTo($location = false)
    {
        if ($location) {
            header("Location: {$location}");
            exit;
        }
    }
}
