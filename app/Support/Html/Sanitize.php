<?php

namespace App\Support\Html;

use DOMElement;

class Sanitize
{
    public function __invoke(string $text): string
    {
        return str($text)
            ->replace('&nbsp', ' ')
            ->replace('_', ' ')
            ->trim();
    }
}
