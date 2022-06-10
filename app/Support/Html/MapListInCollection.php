<?php

namespace App\Support\Html;

use Illuminate\Support\Collection;
use IteratorAggregate;

class MapListInCollection
{
    public function __invoke(IteratorAggregate $list): Collection
    {
        $collection = collect();

        foreach ($list as $item) {
            $collection->push($item);
        }

        return $collection;
    }
}
