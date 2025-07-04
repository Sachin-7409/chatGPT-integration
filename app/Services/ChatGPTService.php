<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class ChatGPTService
{

    protected $apiKey;
    protected $client;


    public function __construct()
    {
       $this->client = new Client();
       $this->apiKey = config('chatGPT.api_key');   
    }


    public function getResponse($promt) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => 'Say Hello!']
            ],
        ]);

        $chatResponse = $response->json()['choices'][0]['message']['content'] ?? 'Sorry, I could not understand that.';
        return response()->json(['message' => $chatResponse]);
    
    }
}