<?php

namespace App\Support\Html;

use DOMElement;

class MapDomElementInTextContent
{
    public function __invoke(DOMElement $element): string
    {
        return $element->textContent;
    }
}
