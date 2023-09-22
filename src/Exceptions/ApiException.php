<?php

namespace DocasDev\LaravelMoodle\Exceptions;

use Exception;

class ApiException extends Exception
{
    const ERROR_CODE_INVALID_TOKEN = 'invalidtoken';
    const ERROR_CODE_REGISTRATION_DISABLED = 'registrationdisabled';
    const ERROR_CODE_ACCESS_EXCEPTION = 'accessexception';
}
