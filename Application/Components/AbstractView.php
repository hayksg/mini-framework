<?php

namespace Application\Components;

class AbstractView 
{
    public function clearStr($str = '')
    {
        return trim(htmlentities($str, ENT_QUOTES));
    }
    
    public function clearInt($int)
    {
        return abs((int)$int);
    }
}
