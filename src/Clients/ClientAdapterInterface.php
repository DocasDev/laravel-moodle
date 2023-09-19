<?php

namespace DocasDev\LaravelMoodle\Clients;

interface ClientAdapterInterface
{
    public function sendRequest(string $function, array $arguments = []): mixed;
}
