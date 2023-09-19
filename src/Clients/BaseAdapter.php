<?php

namespace DocasDev\LaravelMoodle\Clients;

use DocasDev\LaravelMoodle\Connection;
use DocasDev\LaravelMoodle\Exceptions\ApiException;
use GuzzleHttp\Client as HttpClient;
use \SoapClient as BaseSoapClient;
use ReflectionClass;

abstract class BaseAdapter implements ClientAdapterInterface
{
    const SERVER_SCRIPT_PATH_TEMPLATE = 'webservice/%s/server.php';
    const OPTION_TOKEN = 'wstoken';
    const OPTION_FUNCTION = 'wsfunction';

    private Connection $connection;

    protected mixed $client;

    abstract protected function buildClient(): BaseSoapClient|HttpClient;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->client = $this->buildClient();
    }

    protected function getClient(): mixed
    {
        return $this->client;
    }

    protected function getConnection(): Connection
    {
        return $this->connection;
    }

    protected function getEndPoint(array $options = []): string
    {
        $url = $this->connection->getUrl() . '/' . $this->getScriptPath();

        return $options ? $url . '?' . http_build_query($options) : $url;
    }

    protected function getScriptPath(): string
    {
        return sprintf(self::SERVER_SCRIPT_PATH_TEMPLATE, $this->getProtocolType());
    }

    protected function getProtocolType(): string
    {
        return $this->recognizeClientType();
    }

    protected function recognizeClientType(): string
    {
        $reflectionClass = new ReflectionClass(static::class);
        return str_replace('client', '', strtolower($reflectionClass->getShortName()));
    }

    protected function handleException($response)
    {
        $resp = collect($response)->toArray();
        if (array_key_exists('exception', $resp)) {
            throw new ApiException($response['errorcode'] . ': ' . $response['message']);
        }
    }
}
