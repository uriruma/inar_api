<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TrelloController extends Controller
{
    protected $apiKey = 'c4d0da0bc77271dda074c798eed4c530';
    protected $apiToken = 'ATTA8baf7c0b31faa5a4e3f6a2c8205388b5aaa282ba6c5ebb1977b9485ba7de50684F2A6615';
    protected $baseURL = 'https://api.trello.com/1';

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $request->headers->set('Authorization', 'Bearer ' . $this->apiToken);
            return $next($request);
        });
    }

    public function createCard(Request $request)
    {
        // Build the URL for the Trello API request
        $url = $this->baseURL . '/cards';

        // Create a new GuzzleHttp client
        $client = new Client([
            'verify' => false
        ]);

        // Send the request to the Trello API
        $response = $client->request('POST', $url, [
            'form_params' => [
                'key' => $this->apiKey,
                'token' => $this->apiToken,
                'idList' => $request->input('listId'),
                'name' => $request->input('name'),
                'desc' => $request->input('description'),
            ]
        ]);

        // Get the card data from the response body
        $data = $response->getBody();

        // Return the card data as a response with the correct content type
        return response($data)->header('Content-Type', 'application/json');
    }

    public function updateCard(Request $request, $cardId)
    {
        // Build the URL for the Trello API request
        $url = $this->baseURL . '/cards/' . $cardId;

        // Create a new GuzzleHttp client
        $client = new Client([
            'verify' => false
        ]);

        // Send the request to the Trello API
        $response = $client->request('PUT', $url, [
            'form_params' => [
                'key' => $this->apiKey,
                'token' => $this->apiToken,
                'name' => $request->input('name'),
                'desc' => $request->input('description'),
            ]
        ]);

        // Get the card data from the response body
        $data = $response->getBody();

        // Return the card data as a response with the correct content type
        return response($data)->header('Content-Type', 'application/json');
    }

    public function getCards(Request $request)
    {
        // Build the URL for the Trello API request
        $url = $this->baseURL . '/members/me/boards';

        // Create a new GuzzleHttp client
        $client = new Client([
            'verify' => false
        ]);

        // Send the request to the Trello API
        $response = $client->request('GET', $url, [
            'query' => [
                'key' => $this->apiKey,
                'token' => $this->apiToken,
            ]
        ]);

        // Get the card data from the response body
        $data = $response->getBody();

        // Return the card data as a response with the correct content type
        return response($data)->header('Content-Type', 'application/json');
    }
}
