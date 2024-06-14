<?php

namespace App\Services;

use GuzzleHttp\Client;

class ZohoService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://www.zohoapis.com/crm/v2/',
        ]);
    }

    public function getAccessToken()
    {
        $response = $this->client->post('oauth/v2/token', [
            'form_params' => [
                'refresh_token' => env('ZOHO_REFRESH_TOKEN'),
                'client_id' => env('ZOHO_CLIENT_ID'),
                'client_secret' => env('ZOHO_CLIENT_SECRET'),
                'redirect_uri' => env('ZOHO_REDIRECT_URI'),
                'grant_type' => 'refresh_token',
            ],
        ]);

        return json_decode($response->getBody()->getContents())->access_token;
    }

    public function createDeal($dealData)
    {
        $accessToken = $this->getAccessToken();
        $response = $this->client->post('Deals', [
            'headers' => [
                'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
            ],
            'json' => ['data' => [$dealData]],
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function createAccount($accountData)
    {
        $accessToken = $this->getAccessToken();
        $response = $this->client->post('Accounts', [
            'headers' => [
                'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
            ],
            'json' => ['data' => [$accountData]],
        ]);

        return json_decode($response->getBody()->getContents());
    }
}

