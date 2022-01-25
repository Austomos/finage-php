<?php

namespace Finage;

use GuzzleHttp\Client;

abstract class Request
{
    protected const REQUEST_TYPE_AGG = 'agg';
    protected const REQUEST_TYPE_LAST = 'last';
    protected const REQUEST_TYPE_HISTORY = 'history';
    private string $token;
    private string $baseURI;
    private Client $client;

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
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    protected function get(string $uri, array $query = []): array
    {
        $query['apikey'] = $this->getToken();
        $response = $this->client->request('GET', $uri, );
        $this->client->get($uri, [
            'query' => $query
        ]);

        $result = json_decode($response->getBody(), false, 512, JSON_THROW_ON_ERROR | JSON_OBJECT_AS_ARRAY);
        return is_array($result) ? $result : [];
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
