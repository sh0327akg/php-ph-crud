<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;

class HelpController extends Controller
{
    private $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function index()
    {
        return view('help.index');
    }

    public function generateText(Request $request)
    {
        $keywords = $request->input('keywords');
        $generatedText = $this->openAIService->generateTextFromKeywords($keywords);
        return view('help.index', ['generatedText' => $generatedText]);
    }
}
