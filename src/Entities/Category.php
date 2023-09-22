<?php

namespace DocasDev\LaravelMoodle\Entities;

use DocasDev\LaravelMoodle\Entities\Dto\CategoryDTO;

class Category extends Entity
{
    public int $id;

    public string $name;

    public ?string $idNumber;

    public string $description;

    public int $descriptionformat;

    public int $parent;

    public int $sortorder;

    public int $coursecount;

    public int $visible;

    public int $visibleold;

    public int $timemodified;

    public int $depth;

    public string $path;

    public string $theme;

    public function toDTO()
    {
        return CategoryDTO::create($this->toArray());
    }
}
