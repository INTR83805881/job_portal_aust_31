<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class HuggingFaceService
{
    public function getEmbeddings(string $text)
    {
        $token = config('services.huggingface.token');
        $model = config('services.huggingface.model');
        $url = config('services.huggingface.url') . $model;

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$token}",
            'Content-Type' => 'application/json',
        ])->post($url, [
            'inputs' => $text
        ]);

        if (! $response->successful()) {
            throw new \Exception("HF Error: " . $response->body());
        }

        return $response->json();  // inspect what shape you get
    }
}
