<?php

namespace Application\Components;

abstract class AbstractCleaner
{
    public function clearStr($str = '', $nl2br = false)
    {
        if ($nl2br) {
            return nl2br(trim(htmlentities($str, ENT_QUOTES)));
        } else {
            return trim(htmlentities($str, ENT_QUOTES));
        }
    }
    
    public function clearInt($int)
    {
        return abs((int)$int);
    }
}
