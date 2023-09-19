<?php

namespace DocasDev\LaravelMoodle\Clients\Adapters;

use DocasDev\LaravelMoodle\Clients\BaseAdapter;
use \SoapClient as BaseSoapClient;

class SoapClient extends BaseAdapter
{
    const OPTION_WSDL = 'wsdl';

    public function sendRequest(string $function, array $arguments = []): mixed
    {
        $response = $this->getClient()->__soapCall($function, $arguments);

        $this->handleException($response);

        return $response;
    }

    protected function buildClient(): BaseSoapClient
    {
        $endPoint = $this->getEndPoint([
            self::OPTION_WSDL  => 1,
            self::OPTION_TOKEN => $this->getConnection()->getToken(),
        ]);

        return new BaseSoapClient($endPoint);
    }
}
