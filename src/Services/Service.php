<?php

namespace DocasDev\LaravelMoodle\Services;

use DocasDev\LaravelMoodle\Clients\ClientAdapterInterface;
use ReflectionClass;

abstract class Service
{
    private ClientAdapterInterface $client;

    public function __construct(ClientAdapterInterface $client)
    {
        $this->client = $client;
    }

    public function getAlias(): string
    {
        $reflectionClass = new ReflectionClass(static::class);
        return strtolower($reflectionClass->getShortName());
    }

    protected function prepareEntityForSending(...$entities): array
    {
        $convertedEntities = [];

        foreach ($entities as $entity) {
            $filledData = [];
            $entityData = $entity->toArray();
            foreach ($entityData as $property => $value) {
                if (!empty($value)) {
                    $filledData[strtolower($property)] = $value;
                }
            }

            $convertedEntities[] = $filledData;
        }

        return $convertedEntities;
    }

    final protected function sendRequest(string $function, array $arguments = []): array
    {
        $response = $this->client->sendRequest($function, $arguments);

        return (array)$response;
    }
}
