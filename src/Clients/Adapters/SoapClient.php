<?php

namespace DocasDev\LaravelMoodle\Clients\Adapters;

use DocasDev\LaravelMoodle\Clients\BaseAdapter;
use DocasDev\LaravelMoodle\Connection;
use DocasDev\LaravelMoodle\Exceptions\MoodleException;
use \SoapClient as BaseSoapClient;

class SoapClient extends BaseAdapter
{
    const OPTION_WSDL = 'wsdl';

    public function __construct()
    {
        $this->setConnection(config('laravel-moodle.url'), config('laravel-moodle.token'));

        parent::__construct($this->getConnection());
    }

    public function sendRequest(string $function, array $arguments = []): mixed
    {
        try{
            $response = $this->getClient()->__soapCall($function, $arguments);
            return $response;
        }catch(\SoapFault $ex){
            throw new MoodleException($ex->faultactor, $ex->getMessage());
        }
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
