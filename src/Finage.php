<?php

namespace Finage;

use Finage\Api\{
    Index,
    Stock
};

final class Finage
{
    private const BASE_URI = 'https://api.finage.co.uk/';
    private string $token;

    /**
     * @param string $token API Key is mandatory
     */
    public function __construct(string $token)
    {
        $this->setToken($token);
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return \Finage\Api\Index
     */
    public function index(): Index
    {
        return new Index($this->getToken(), self::BASE_URI);
    }

    /**
     * @return \Finage\Api\Stock
     */
    public function stock(): Stock
    {
        return new Stock($this->getToken(), self::BASE_URI);
    }

}