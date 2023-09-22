<?php

namespace DocasDev\LaravelMoodle\Exceptions;

use Exception;

class MoodleException extends Exception
{
    public string $errorCode;

    public function __construct(string $errorCode, string $message)
    {
        $this->errorCode = $errorCode;
        parent::__construct($message);
    }
}
