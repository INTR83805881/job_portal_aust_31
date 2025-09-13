<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class HFEmbeddingService
{
    protected string $model;
    protected string $apiHost;
    protected ?string $token;

    public function __construct()
    {
        $this->model = config('services.hf.model') ?? env('HF_MODEL');
        $this->apiHost = config('services.hf.host') ?? env('HF_API_HOST', 'https://api-inference.huggingface.co');
        $this->token = env('HF_API_TOKEN');
    }

    /**
     * Returns a 1-D embedding vector (array of floats) for the given text.
     *
     * Handles both 1-D results and token-level (2-D) results by averaging tokens.
     *
     * @throws \Exception
     */
    public function embed(string $text): array
    {
        if (empty($this->token)) {
            throw new \Exception('Hugging Face token missing (HF_API_TOKEN).');
        }

        $url = rtrim($this->apiHost, '/') . "/pipeline/feature-extraction/{$this->model}";

        $resp = Http::withToken($this->token)
            ->timeout(60)
            ->post($url, ['inputs' => $text]);

        if (! $resp->ok()) {
            $body = $resp->body();
            // Try to show short error for debugging
            throw new \Exception("HF API error: HTTP {$resp->status()} - " . substr($body, 0, 500));
        }

        $data = $resp->json();

        if (empty($data)) {
            return [];
        }

        // If response is like [[...],[...]] (token vectors), average them
        if (is_array($data) && isset($data[0]) && is_array($data[0])) {
            // If it's a flat numeric vector, $data[0] will be numeric; handle below.
            // Check whether elements are numeric or arrays:
            if (is_numeric($data[0][0] ?? null)) {
                // token vectors: average across rows
                $rows = $data;
                $dim = count($rows[0]);
                $sum = array_fill(0, $dim, 0.0);
                foreach ($rows as $r) {
                    for ($i = 0; $i < $dim; $i++) {
                        $sum[$i] += floatval($r[$i]);
                    }
                }
                $count = count($rows);
                for ($i = 0; $i < $dim; $i++) $sum[$i] = $sum[$i] / $count;
                return $sum;
            }
        }

        // If it's single-dimension vector (list of floats)
        if (is_array($data) && is_numeric($data[0] ?? null)) {
            return array_map('floatval', $data);
        }

        // Fallback: try to flatten
        return array_map('floatval', Arr::flatten($data));
    }
}
