<?php

namespace Finage;

class Index extends Request
{
    private const REQUEST_CATEGORY = 'index';

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function prevClose(string $symbol): array
    {
        $symbol = addslashes($symbol);
        $uri = '/' . self::REQUEST_TYPE_AGG
            . '/' . self::REQUEST_CATEGORY
            . '/prev-close/'
            . $symbol;
        return $this->get($uri);
    }
}