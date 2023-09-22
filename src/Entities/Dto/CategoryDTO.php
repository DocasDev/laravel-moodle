<?php

namespace DocasDev\LaravelMoodle\Entities\Dto;

use DocasDev\LaravelMoodle\Shared\StaticCreateSelf;
use DocasDev\LaravelMoodle\Shared\ToArray;

class CategoryDTO
{
    use StaticCreateSelf;
    use ToArray;

    public string $name;

    public int $parent;

    public string $idNumber;

    public string $description;

    public int $descriptionformat;

    public string $theme;
}
