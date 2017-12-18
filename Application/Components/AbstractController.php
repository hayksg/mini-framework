<?php

namespace Application\Components;

class AbstractController 
{
    public static function redirectTo($location = false)
    {
        if ($location) {
            header("Location: {$location}");
            exit;
        }
    }
}
