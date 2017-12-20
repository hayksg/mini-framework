<?php

namespace Application\Components;

abstract class AbstractView extends AbstractCleaner
{
    public function getYear()
    {
        $year = date('Y');
        return ($year > 2017) ? "2017 - {$year}" : $year;
    }
}
