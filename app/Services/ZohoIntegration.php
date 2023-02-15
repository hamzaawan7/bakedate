<?php

namespace App\Services;

use App\Models\Cake;
use App\Models\Customer;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;

class ZohoIntegration
{
    /**
     * @var string
     */
    private string $clientId = "1000.GSLEVDJY0H5KTZJCI3E1VW3HHEM03A";

    /**
     * @var string
     */
    private string $clientSecret = "2184381cf471a57432f0adf1d3c203ce2e09aaed85";

    /**
     * @var string
     */
    private string $refreshToken = "1000.397a23dab08e6c90a2deca0d6bacdabe.6e46605c160abceb49d6daab75754a3a";

    /**
     * @var string
     */
    private string $redirectUri = "http://localhost/zoho/oauth2callback";

    /**
     * @var string
     */
    private string $grantType = "refresh_token";

    /**
     * @var Client
     */
    private Client $client;

    /**
     * @param Client $client
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    protected function auth()
    {
        $res = $this->client->request('post', 'https://accounts.zoho.com/oauth/v2/token', [
            'query' => [
                'refresh_token' => $this->refreshToken,
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'redirect_uri' => $this->redirectUri,
                'grant_type' => $this->grantType,
            ]
        ]);

        return json_decode($res->getBody()->getContents());
    }

    /**
     * @throws GuzzleException
     */
    public function getCustomers()
    {
        $token = $this->auth()->access_token;

        $res = $this->client->request('GET', 'https://www.zohoapis.com/subscriptions/v1/customers', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ]
        ]);

        return json_decode($res->getBody()->getContents());
    }

    /**
     * @throws GuzzleException
     */
    public function createCustomer(Customer $customer)
    {
        $token = $this->auth()->access_token;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
            'X-com-zoho-subscriptions-organizationid' => '802152555'
        ])
            ->post('https://www.zohoapis.com/subscriptions/v1/customers', [
                'display_name' => $customer->first_name . ' ' . $customer->last_name,
                'first_name' => $customer->first_name,
                'last_name' => $customer->last_name,
                'email' => $customer->email,
                'company_name' => $customer->company_name,
                'phone' => $customer->phone
            ]);

        return json_decode($response->body());
    }

    /**
     * @throws GuzzleException
     */
    public function updateCustomer(Customer $customer)
    {
        if (!$customer->zoho_id) {
            return;
        }

        $token = $this->auth()->access_token;

        $res = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
            'X-com-zoho-subscriptions-organizationid' => '802152555'
        ])->put('https://www.zohoapis.com/subscriptions/v1/customers/' . $customer->zoho_id, [
            'display_name' => $customer->first_name . ' ' . $customer->last_name,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'email' => $customer->email,
            'company_name' => $customer->company_name,
            'phone' => $customer->phone
        ]);

        return json_decode($res->body());
    }

    /**
     * @throws GuzzleException
     */
    public function createCake(Cake $cake)
    {
        $token = $this->auth()->access_token;

        $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $token,
            'content-type' => 'application/json',
            'X-com-zoho-subscriptions-organizationid' => '802152555'
        ])
            ->post('https://www.zohoapis.com/books/v3/items?organization_id=802152555', [
                'name' => $cake->name,
                'rate' => $cake->price,
                'description' => $cake->description ?: '',
            ]);

        return json_decode($response->body());
    }

    /**
     * @throws GuzzleException
     */
    public function getCakes()
    {
        $token = $this->auth()->access_token;

        $res = $this->client->request('GET', 'https://www.zohoapis.com/books/v3/items?organization_id=802152555', [
            'headers' => [
                'Authorization' => 'Zoho-oauthtoken ' . $token,
                'Accept' => 'application/json',
            ]
        ]);

        return json_decode($res->getBody()->getContents());
    }

    /**
     * @throws GuzzleException
     */
    public function updateCake(Cake $cake)
    {
        if (!$cake->zoho_id) {
            return;
        }

        $token = $this->auth()->access_token;

        $res = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $token,
            'content-type' => 'application/json',
        ])->put('https://www.zohoapis.com/books/v3/items' . $cake->zoho_id . '?organization_id=802152555', [
            'name' => $cake->name,
            'rate' => $cake->price,
            'description' => $cake->description ?: '',
        ]);

        return json_decode($res->body());
    }

    /**
     * @throws GuzzleException
     */
    public function getInvoices()
    {
        $token = $this->auth()->access_token;

        $res = $this->client->request('GET', 'https://www.zohoapis.com/books/v3/invoices?organization_id=802152555', [
            'headers' => [
                'Authorization' => 'Zoho-oauthtoken ' . $token,
            ]
        ]);

        return json_decode($res->getBody()->getContents());
    }

}
