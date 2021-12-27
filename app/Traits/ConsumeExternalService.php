<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumeExternalService
{
    /**
     * Send request to any service
     * @param $method
     * @param $requestUrl
     * @param array $formParams
     * @param array $headers
     * @return string
     */
    public function performRequest($method, $requestUrl, $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri'  =>  $this->baseUri,
        ]);

        $headers['fcn'] = 'aseawcxasdqweqeqwfasfasfdasewqqew13e234er32ew2eq22e22e2qe12aw1d21a1';

        if (isset($this->secret)) {
            $headers['Authorization'] = "Bearer ".$this->secret;
        }

        $response = $client->request($method, $requestUrl, [
            'json' => $formParams,
            'headers' => $headers,
        ]);

        return $response->getBody()->getContents();
    }

    public function performRequestImage($method, $requestUrl, $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri'  =>  $this->baseUri,
        ]);

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        $response = $client->request($method, $requestUrl, [
            'multipart' => $formParams,
            'headers' => $headers,
        ]);

        return $response->getBody()->getContents();
    }
}
