<?php

namespace DocasDev\LaravelMoodle\Clients\ResponseFormat;

use DocasDev\LaravelMoodle\Clients\Contracts\ResponseFormatContract;
use DocasDev\LaravelMoodle\Exceptions\MoodleException;

class ResponseFormatXml extends ResponseFormatContract
{
    public function formatResponse(string $responseContents)
    {
        $this->formatedResponse = simplexml_load_string($responseContents);
        $this->handleException();
    }

    protected function handleException()
    {
        if (isset($this->formatedResponse['class']) && $this->formatedResponse['class'] == 'moodle_exception') {
            throw new MoodleException($this->formatedResponse->ERRORCODE, $this->formatedResponse->MESSAGE);
        }
    }
}
