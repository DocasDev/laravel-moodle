<?php

namespace DocasDev\LaravelMoodle\Shared;

use ReflectionObject;

trait StaticCreateSelf
{
    public static function create(array $data): self
    {
        $className = static::class;
        $obj = new $className();
        $ro = new ReflectionObject($obj);

        foreach ($ro->getProperties() as $property) {
            $key = mb_convert_case($property->getName(), MB_CASE_LOWER);
            if(!array_key_exists($key, $data))
                continue;

            $property->setValue($obj, $data[$key]);
        }

        return $obj;
    }
}
