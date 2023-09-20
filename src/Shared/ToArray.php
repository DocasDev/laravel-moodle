<?php

namespace DocasDev\LaravelMoodle\Shared;

trait ToArray
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
