<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class JsonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAPI()
    {
        $url = 'https://jsonplaceholder.typicode.com/posts';
        $accessToken = auth()->user()->token->access_token;

        // Create a new GuzzleHttp client
        $client = new Client([
            'verify' => false,
            'headers' => [
                'User-Agent' => 'PHP',
                'Authorization' => 'Bearer ' . $accessToken,
                'X-CSRF-TOKEN' => csrf_token()
            ]
        ]);

        // Send a GET request to the API
        $response = $client->request('GET', $url);

        // Get the response body
        $data = $response->getBody();

        // Return the response with the correct content type
        return response($data)->header('Content-Type', 'application/json');
    }

    public function createAPI(Request $request)
    {
        $url = 'https://jsonplaceholder.typicode.com/posts';
        $accessToken = auth()->user()->token->access_token;

        // Create a new GuzzleHttp client
        $client = new Client([
            'verify' => false,
            'headers' => [
                'User-Agent' => 'PHP',
                'Authorization' => 'Bearer ' . $accessToken,
                'X-CSRF-TOKEN' => csrf_token()
            ]
        ]);

        // Send a POST request to the API with JSON data
        $response = $client->request('POST', $url, [
            'json' => [
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'userId' => $request->input('userId')
            ]
        ]);

        // Get the response body
        $data = $response->getBody();

        // Return the response with the correct content type
        return response($data)->header('Content-Type', 'application/json');
    }

    public function updateAPI(Request $request, $id)
    {
        $url = 'https://jsonplaceholder.typicode.com/posts/'.$id;
        $accessToken = auth()->user()->token->access_token;

        // Create a new GuzzleHttp client
        $client = new Client([
            'verify' => false,
            'headers' => [
                'User-Agent' => 'PHP',
                'Authorization' => 'Bearer ' . $accessToken,
                'X-CSRF-TOKEN' => csrf_token()
            ]
        ]);

        // Send a PUT request to the API with JSON data
        $response = $client->request('PUT', $url, [
            'json' => [
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'userId' => $request->input('userId')
            ]
        ]);

        // Get the response body
        $data = $response->getBody();

        // Return the response with the correct content type
        return response($data)->header('Content-Type', 'application/json');
    }
}
