<?php

namespace DocasDev\LaravelMoodle\Clients\Contracts;

use ReflectionClass;

abstract class ResponseFormatContract
{
    protected mixed $formatedResponse;

    abstract public function formatResponse(string $responseContents);
    abstract protected function handleException();

    public function getFormatedResponse(): mixed
    {
        return $this->formatedResponse;
    }

    public function getFormatType(): string
    {
        $reflectionClass = new ReflectionClass(static::class);
        return str_replace('responseformat', '', strtolower($reflectionClass->getShortName()));
    }
}
