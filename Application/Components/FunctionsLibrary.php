<?php

namespace Application\Components;

class FunctionsLibrary 
{
    public static function catchAllExceptions($e)
    {
        echo $e->getMessage();
        exit;
    }
}
