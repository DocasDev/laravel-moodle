<?php

namespace DocasDev\LaravelMoodle\Entities;

use DocasDev\LaravelMoodle\GenericCollection;

class CategoryCollection extends GenericCollection
{
    public function __construct(Category ...$items)
    {
        $this->items = $items;
    }

    public function add(Category $item)
    {
        $this->items[$item->id] = $item;
    }

    public function remove(Category $item)
    {
        $this->removeById($item->id);
    }

    public function removeById(int $itemId)
    {
        if (array_key_exists($itemId, $this->items)) {
            unset($this->items[$itemId]);
        }
    }
}
