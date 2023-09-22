<?php

namespace DocasDev\LaravelMoodle\Clients\Adapters;

use DocasDev\LaravelMoodle\Clients\BaseAdapter;
use DocasDev\LaravelMoodle\Clients\Contracts\ResponseFormatContract;
use Exception;
use GuzzleHttp\Client as HttpClient;

class RestClient extends BaseAdapter
{
    const OPTION_FORMAT = 'moodlewsrestformat';

    protected ResponseFormatContract $responseFormat;

    public function __construct()
    {
        $this->buildResponseFormat();
        $this->setConnection(config('laravel-moodle.url'), config('laravel-moodle.token'));

        parent::__construct($this->getConnection());
    }

    public function sendRequest(string $function, array $arguments = []): mixed
    {
        $configuration = [
            self::OPTION_FUNCTION => $function,
            self::OPTION_FORMAT   => $this->responseFormat->getFormatType(),
            self::OPTION_TOKEN    => $this->getConnection()->getToken(),
        ];

        $response = $this->getClient()->post('', [
            'form_params' => array_merge($configuration, $arguments)
        ]);

        $this->responseFormat->formatResponse($response->getBody()->getContents());

        return $this->responseFormat->getFormatedResponse();
    }

    protected function buildClient(): HttpClient
    {
        return new HttpClient([
            'base_url' => $this->getEndPoint(),
            'base_uri' => $this->getEndPoint()
        ]);
    }

    protected function buildResponseFormat()
    {
        $formatClassName = 'DocasDev\LaravelMoodle\Clients\ResponseFormat\ResponseFormat' . mb_convert_case(config('laravel-moodle.format'), MB_CASE_TITLE);
        if(!class_exists($formatClassName))
            throw new Exception("Class '$formatClassName' not found");

        $formatObject = new $formatClassName();
        if(!($formatObject instanceof ResponseFormatContract))
            throw new Exception("Class '$formatClassName' mismatch with 'ResponseFormatContract'");

        $this->responseFormat = $formatObject;
    }
}
