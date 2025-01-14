<?php

namespace DocasDev\LaravelMoodle\Entities;

use DocasDev\LaravelMoodle\GenericCollection;

class CourseCollection extends GenericCollection
{
    public function __construct(Course ...$items)
    {
        $this->items = $items;
    }

    public function add(Course $item)
    {
        $this->items[$item->id] = $item;
    }

    public function remove(Course $item)
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
