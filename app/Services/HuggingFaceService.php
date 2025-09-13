<?php



namespace App\Services;

use Illuminate\Support\Facades\Http;

class HuggingFaceService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('HUGGINGFACE_API_KEY');
    }

   public function embed(string $text): array
{
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $this->apiKey,
        'Content-Type'  => 'application/json',
    ])->post(
        '
https://huggingface.co/google/embeddinggemma-300m
',
        ['inputs' => $text]
    );

    // Check if request failed
    if ($response->failed()) {
        info('Hugging Face failed', ['status' => $response->status(), 'body' => $response->body()]);
        return [];
    }

    $json = $response->json();

    // If null or invalid, return empty array to avoid TypeError
    if (!$json || !is_array($json)) {
        info('Hugging Face returned null', ['text' => $text]);
        return [];
    }

    return $json;
}


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
