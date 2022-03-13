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

    /**
     * @throws \Finage\Exception\FinageException
     */
    public function snapshot(array $symbols, bool $quotes = true, bool $trades = false): array|object
    {
        $uri = '/' . self::REQUEST_TYPE_SNAPSHOT
            . '/' . self::REQUEST_CATEGORY;
        $symbolsString = implode(',', $symbols);
        return $this->get($uri, [
            'symbols' => $symbolsString,
            'quotes' => boolToString($quotes),
            'trades' => boolToString($trades),
        ]);
    }
}