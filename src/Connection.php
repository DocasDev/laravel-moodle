<?php

namespace DocasDev\LaravelMoodle;

use Assert\Assertion;

class Connection
{
    protected string $url;

    protected string $token;

    public function __construct(string $url, string $token)
    {
        $this->setUrl($url);
        $this->token = $token;
    }

    protected function setUrl(string $url)
    {
        Assertion::url($url);
        $this->url = trim($url, '/');
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
