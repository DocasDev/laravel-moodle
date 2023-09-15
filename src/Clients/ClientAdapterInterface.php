<?php

namespace DocasDev\LaravelMoodle\Clients;

/**
 * Interface ClientAdapterInterface
 * @package DocasDev\LaravelMoodle\Clients
 */
interface ClientAdapterInterface
{
    /**
     * Send API request
     * @param $function
     * @param array $arguments
     * @return mixed
     */
    public function sendRequest($function, array $arguments = []);
}
