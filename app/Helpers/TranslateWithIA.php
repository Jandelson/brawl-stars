<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Http;

class TranslateWithIA
{
    public static function translate(string $text, string $language): string
    {
        try {
            $translate = '';

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
                $translate = $responseData['candidates'][0]['content']['parts'][0]['text'];
            }

            return $translate;

        } catch (Exception $error) {
            throw new \Exception('Translation request failed: ' . $error->getMessage());
        }
    }
}
