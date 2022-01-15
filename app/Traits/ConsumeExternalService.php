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

        $headers['fcm'] = 'aseawcxasdqweqeqwfasfasfdasewqqew13e234er32ew2eq22e22e2qe12aw1d21a1';

        if (isset($this->secret)) {
            $headers['Authorization'] = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MSwibmFtZSI6ImFkbWluIiwiYXZhdGFyIjoiMTYzODg2MTYxNUNhcHR1cmUuUE5HIiwicm9sZSI6InN1cGVyX2FkbWluIiwiZXhwIjoxNjQyMjM0NDMyNjc4fQ.1rvjYnyet4sq5zbhNu6dOXGSFwlSKFp7WuV3AidwVek";
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
