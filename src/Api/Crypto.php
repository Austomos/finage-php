<?php

namespace Finage\Api;

class Crypto extends Request
{
    private const REQUEST_CATEGORY = 'crypto';

    /**
     * @throws \Finage\Exception\FinageException
     */
    public function lastTrade(string $symbol): array|object
    {
        $uri = '/' . self::REQUEST_TYPE_LAST
            . '/' . self::REQUEST_CATEGORY
            . '/' . addslashes($symbol);
        return $this->get($uri);
    }
}