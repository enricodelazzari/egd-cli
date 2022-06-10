<?php

namespace App\Support\Html;

use DOMElement;

class TableToArray
{
    public function __invoke(DOMElement $table): array
    {
        $rows = $table->childNodes;

        $ths = [];
        $trs = [];

        foreach ($rows as $row) {
            $ths[] = $this->getElementByTagName('th', $row);
            $trs[] = $this->getElementByTagName('tr', $row)?->childNodes;
        }

        $ths = collect($ths)
            ->filter()
            ->map
            ->textContent
            ->map(new Sanitize());

        return collect($trs)
            ->filter()
            ->map(new MapListInCollection())
            ->map
            ->map(new MapDomElementInTextContent())
            ->map(fn ($td) => $ths->combine($td))
            ->values()
            ->toArray();
    }

    protected function getElementByTagName($tagName, $row)
    {
        if (! property_exists($row, 'tagName')) {
            return null;
        }

        if ($row->tagName !== $tagName) {
            return null;
        }

        return $row;
    }
}
