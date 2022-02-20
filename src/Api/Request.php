<?php

namespace Finage\Api;

use Finage\Exception\FinageException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

abstract class Request
{
    protected const REQUEST_TYPE_AGG = 'agg';
    protected const REQUEST_TYPE_LAST = 'last';
    protected const REQUEST_TYPE_HISTORY = 'history';
    private string $token;
    private string $baseURI;
    private Client $client;

    /**
     * @param string $token
     * @param string $baseURI
     */
    public function __construct(string $token, string $baseURI)
    {
        $this->setToken($token);
        $this->setBaseURI($baseURI);
        $this->client = new Client([
            'base_uri' => $this->getBaseURI(),
        ]);
    }

    /**
     * @return string
     */
    public function getBaseURI(): string
    {
        return $this->baseURI;
    }

    /**
     * @param string $baseURI
     */
    public function setBaseURI(string $baseURI): void
    {
        $this->baseURI = $baseURI;
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
