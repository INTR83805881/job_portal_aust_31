<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Jobs;
use App\Services\HFEmbeddingService;

class ComputeJobEmbeddings extends Command
{
    protected $signature = 'jobs:embed {--rebuild : Recompute embeddings even if present}';
    protected $description = 'Compute and store embeddings for jobs using Hugging Face';

    public function handle(HFEmbeddingService $hf)
    {
        $this->info('Starting job embedding job...');
        $query = Jobs::query()->where('status', 'enlisted');
        if (! $this->option('rebuild')) {
            $query->whereNull('embedding');
        }

        $jobs = $query->get();

        $this->info("Found {$jobs->count()} jobs to process.");

        foreach ($jobs as $job) {
            $skills = $job->jobSkillsets()->with('skill')->get()
                        ->pluck('skill.skill_name')->filter()->values()->all();

            $text = trim($job->title . ' ' . $job->description . ' ' . implode(' ', $skills));

            try {
                $vec = $hf->embed($text);
                if (empty($vec)) {
                    $this->error("Job {$job->id}: got empty embedding (skipping).");
                    continue;
                }
                $job->embedding = $vec;
                $job->save();
                $this->info("Job {$job->id}: embedding saved.");
                // sleep a bit if you want to avoid rate limits:
                usleep(200000); // 0.2s
            } catch (\Throwable $e) {
                $this->error("Job {$job->id}: error: " . $e->getMessage());
            }
        }

        $this->info('Done.');
        return 0;
    }
}
