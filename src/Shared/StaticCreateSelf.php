<?php

namespace DocasDev\LaravelMoodle\Shared;

use ReflectionProperty;

trait StaticCreateSelf
{
    public static function create(array $data): self
    {
        $dto = new self();

        foreach ($data as $key => $value) {
            if (!property_exists($dto, $key))
                continue;

            $rp = new ReflectionProperty(get_class($dto), $key);
            if(gettype($value) !== $rp->hasType())
                continue;

            $dto->$key = $value;
        }

        return $dto;
    }
}
