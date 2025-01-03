<?php

namespace App\Helpers;

use App\Enums\LanguageIAEnum;
use Illuminate\Support\Facades\Http;

class TranslateWithIA
{
    public static function translate(string $text, string $language): string
    {
        $data = [
            'contents' => [
                'parts' => [
                    ['text' => "translate text to $language text: '$text'"]
                ]
            ]
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key='. env('GEMINI_API_KEY'),
            $data
        );

        if ($response->successful()) {
            $responseData = $response->json();
            return $responseData['candidates'][0]['content']['parts'][0]['text'];
        } else {
            throw new \Exception('Translation request failed');
        }
    }
}
