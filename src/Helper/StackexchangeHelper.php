<?php
namespace App\Helper;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class StackexchangeHelper {
    private HttpClientInterface $client;
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getData($url, $params)
    {
        $params['site'] = 'stackoverflow';

        $response = $this->client->request('GET', $url, [
            'query' => $params
        ]);
        $parsedResponse = $response->toArray();

        return $parsedResponse['items'];

    }
}