<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChatGPTService;

class ChatGPTController extends Controller
{
    protected $chatGPTService;

    public function __construct(ChatGPTService $chatGPTService)
    {
        $this->chatGPTService = $chatGPTService;
    }

    public function index(Request $request)
    {
        $promt = $request->input('promt');
        $response = $this->chatGPTService->getResponse($promt);
        return response()->json(['response' => $response]);
    }
}
