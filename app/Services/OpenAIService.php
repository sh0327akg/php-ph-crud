<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class OpenAIService
{
  public function generateTextFromKeywords(string $keywords): string
    {
        $response = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => '次のキーワードを使って200字以内の文章を作成してください: ' . $keywords,
            'max_tokens' => 200,
            'n' => 1,
            'stop' => null,
            'temperature' => 0.7,
        ]);

        $choices = $response['choices'];

        if (count($choices) > 0) {
            return $choices[0]['text'];
        }

        return '';
  }
}
