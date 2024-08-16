<?php

namespace App\Services;

use GuzzleHttp\Client;

class NeshanService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('NESHAN_API_KEY');
    }

    public function getStaticMap($latitude, $longitude, $zoom = 14, $width = 800, $height = 600)
    {
        $url = "https://api.neshan.org/v1/static?key={$this->apiKey}&center={$latitude},{$longitude}&zoom={$zoom}&size={$width}x{$height}";

        $response = $this->client->get($url);

        return $response->getBody()->getContents();
    }

    public function searchLocation($term, $lat, $lng)
    {
        $url = "https://api.neshan.org/v1/search?term={$term}&lat={$lat}&lng={$lng}";

        $response = $this->client->get($url, [
            'headers' => [
                'Api-Key' => $this->apiKey,
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    // Add other methods for different API endpoints...
}
