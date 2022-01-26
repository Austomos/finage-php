<?php

namespace Finage;

final class Stock extends Request
{
    private const REQUEST_CATEGORY = 'stock';

    /**
     * @throws \JsonException
     * @throws \Finage\Exception\FinageException
     */
    public function prevClose(string $symbol): array|object
    {
        $symbol = addslashes($symbol);
        $uri = '/' . self::REQUEST_TYPE_AGG
            . '/' . self::REQUEST_CATEGORY
            . '/prev-close/'
            . $symbol;
        return $this->get($uri);
    }

}