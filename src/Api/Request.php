<?php

namespace Finage\Api;

use Finage\Exception\FinageException;
use Finage\Finage;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

abstract class Request
{
    protected const REQUEST_TYPE_AGG = 'agg';
    protected const REQUEST_TYPE_LAST = 'last';
    protected const REQUEST_TYPE_HISTORY = 'history';
    private string $token;
    private Client $client;

    public function __construct()
    {
        $this->setToken(Finage::getStaticToken());
        $this->client = new Client([
            'base_uri' => Finage::BASE_URI,
        ]);
    }

    /**
     * @throws \Finage\Exception\FinageException
     */
    protected function get(string $uri, array $query = []): array|object
    {
        $query['apikey'] = $this->getToken();
        try {
            $response = $this->client->get($uri, [
                'query' => $query
            ]);
        } catch (GuzzleException $e) {
            if (!method_exists($e, 'getResponse')) {
                throw new FinageException($e->getMessage(), $e->getCode(), $e);
            }
            $response = $e->getResponse();
        } finally {
            try {
                $result = json_decode($response->getBody(), false, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException $e) {
                throw new FinageException($e->getMessage(), $e->getCode(), $e);
            }
            if (!is_array($result) && !is_object($result)) {
                throw new FinageException('Result from json is invalid', 400);
            }
            if (isset($e)) {
                throw new FinageException($result->error ?? $e->getMessage(), $e->getCode());
            }
            return $result;
        }
    }

    /**
     * @return string
     */
    protected function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    protected function setToken(string $token): void
    {
        $this->token = $token;
    }

}
