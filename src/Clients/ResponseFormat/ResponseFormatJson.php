<?php

namespace DocasDev\LaravelMoodle\Clients\ResponseFormat;

use DocasDev\LaravelMoodle\Clients\Contracts\ResponseFormatContract;
use DocasDev\LaravelMoodle\Exceptions\MoodleException;

class ResponseFormatJson extends ResponseFormatContract
{
    public function formatResponse(string $responseContents)
    {
        $this->formatedResponse = json_decode($responseContents, true);
        $this->handleException();
    }

    protected function handleException()
    {
        if(!is_array($this->formatedResponse))
            return;

        if (array_key_exists('exception', $this->formatedResponse)) {
            $message = $this->formatedResponse['message'] . ' | ERRORCODE: ' . $this->formatedResponse['errorcode'];
            throw new MoodleException($this->formatedResponse['errorcode'], $message);
        }
    }
}
