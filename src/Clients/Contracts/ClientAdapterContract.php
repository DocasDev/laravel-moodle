<?php

namespace DocasDev\LaravelMoodle\Clients\Contracts;

interface ClientAdapterContract
{
    public function sendRequest(string $function, array $arguments = []): mixed;
}
