<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Jobs;
use App\Services\HuggingFaceService;

class GenerateJobEmbeddings extends Command
{
    protected $signature = 'jobs:embed';
    protected $description = 'Generate AI embeddings for all jobs';

    public function handle(HuggingFaceService $ai)
    {
        $this->info("Generating embeddings...");
        $jobs = Jobs::all();

        foreach ($jobs as $job) {
    $text = $job->title . ' ' . $job->skills; // keep it short to avoid API errors

    $vector = [];
    for ($i = 0; $i < 3; $i++) {        // try up to 3 times
        $vector = $ai->embed($text);     // call Hugging Face
        if (!empty($vector)) break;      // if successful, stop retrying
        sleep(2);                        // wait 2 seconds before retry
    }

    if (empty($vector)) {
        $this->warn("⚠️ Failed to generate embedding for: {$job->title}");
        continue; // skip this job if embedding failed
    }

    $job->embedding = json_encode($vector);
    $job->save();

    $this->info("✅ Embedded: {$job->title}");
}


        $this->info("Done!");
    }
}
