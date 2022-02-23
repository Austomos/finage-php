<?php

namespace Finage;

use Finage\Api\{
    Crypto,
    Index,
    Stock
};
use Finage\Exception\FinageException;

final class Finage
{
    public const BASE_URI = 'https://api.finage.co.uk/';
    private static string $token;

    /**
     * @param string $token API Key is mandatory
     * @throws \Finage\Exception\FinageException
     */
    public function __construct(string $token)
    {
        $this->setToken($token);
    }

    /**
     * @return string
     */
    public static function getStaticToken(): string
    {
        return self::$token;
    }

    /**
     * @param string $token
     * @throws \Finage\Exception\FinageException
     */
    public function setToken(string $token): void
    {
        if (empty($token)) {
            throw new FinageException('Token is missing !', 400);
        }
        self::$token = $token;
    }

    /**
     * @return \Finage\Api\Index
     */
    public function index(): Index
    {
        return new Index();
    }

    /**
     * @return \Finage\Api\Stock
     */
    public function stock(): Stock
    {
        return new Stock();
    }

    public function crypto(): Crypto
    {
        return new Crypto();
    }

}