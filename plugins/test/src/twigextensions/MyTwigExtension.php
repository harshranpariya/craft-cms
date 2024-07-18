<?php

namespace harsh\crafttest\twigextensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

// Custom filter for converting string to uppercase
class MyTwigExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('to_upper', [$this, 'toUpperCase']),
        ];
    }

    public function toUpperCase($string)
    {
        return strtoupper($string);
    }
}