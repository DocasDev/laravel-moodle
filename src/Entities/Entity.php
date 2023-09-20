<?php

namespace DocasDev\LaravelMoodle\Entities;

use DocasDev\LaravelMoodle\Shared\StaticCreateSelf;
use DocasDev\LaravelMoodle\Shared\ToArray;

abstract class Entity
{
    use StaticCreateSelf;
    use ToArray;

    public abstract function toDTO();
}
