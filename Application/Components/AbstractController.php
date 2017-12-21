<?php

namespace Application\Components;

abstract class AbstractController extends AbstractCleaner
{
    
    public function redirectTo($location = false)
    {
        if ($location) {
            header("Location: {$location}");
            exit;
        }
    }
}
