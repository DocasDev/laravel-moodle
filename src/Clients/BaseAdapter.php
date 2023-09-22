<?php

namespace DocasDev\LaravelMoodle\Clients;

use DocasDev\LaravelMoodle\Clients\Contracts\ClientAdapterContract;
use DocasDev\LaravelMoodle\Connection;
use GuzzleHttp\Client as HttpClient;
use \SoapClient as BaseSoapClient;
use ReflectionClass;

abstract class BaseAdapter implements ClientAdapterContract
{
    const SERVER_SCRIPT_PATH_TEMPLATE = 'webservice/%s/server.php';
    const OPTION_TOKEN = 'wstoken';
    const OPTION_FUNCTION = 'wsfunction';

    protected Connection $connection;

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

    protected function getConnection(): Connection
    {
        return $this->connection;
    }

    protected function setConnection(string $url, string $token)
    {
        $this->connection = new Connection($url, $token);
    }
}
