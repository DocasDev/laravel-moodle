<?php

namespace DocasDev\LaravelMoodle\Clients\Adapters;

use DocasDev\LaravelMoodle\Clients\BaseAdapter;
use DocasDev\LaravelMoodle\Connection;
use Assert\Assertion;
use GuzzleHttp\Client as HttpClient;

class RestClient extends BaseAdapter
{
    const OPTION_FORMAT = 'moodlewsrestformat';

    const RESPONSE_FORMAT_JSON = 'json';

    const RESPONSE_FORMAT_XML = 'xml';

    protected string $responseFormat;

    protected Connection $connection;

    public function __construct()
    {
        $this->setResponseFormat(config('laravel-moodle.format'));
        $this->setConnection(config('laravel-moodle.url'), config('laravel-moodle.token'));

        parent::__construct($this->getConnection());
    }

    public function sendRequest(string $function, array $arguments = []): mixed
    {
        $configuration = [
            self::OPTION_FUNCTION => $function,
            self::OPTION_FORMAT   => $this->responseFormat,
            self::OPTION_TOKEN    => $this->getConnection()->getToken(),
        ];

        $response = $this->getClient()->post('', [
            'form_params' => array_merge($configuration, $arguments)
        ]);

        $this->handleException($response);

        $formattedResponse = $this->responseFormat === self::RESPONSE_FORMAT_JSON ?
            json_decode($response->getBody(), true) :
            simplexml_load_string($response->getBody());

        return $formattedResponse;
    }

    protected function buildClient(): HttpClient
    {
        return new HttpClient([
            'base_url' => $this->getEndPoint(),
            'base_uri' => $this->getEndPoint()
        ]);
    }

    protected function setResponseFormat(string $format)
    {
        Assertion::inArray($format, [self::RESPONSE_FORMAT_JSON, self::RESPONSE_FORMAT_XML]);
        $this->responseFormat = $format;
    }

    protected function getConnection(): Connection
    {
        return $this->connection;
    }

    protected function setConnection(string $url, string $token)
    {
        $this->connection = new Connection($url, $token);
    }
}
