<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Repositories\LinkVisitRepository;

class CreateLinkVisitJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected int $linkId,
        protected string $ip
    ) {}

    /**
     * Execute the job.
     */
    public function handle(LinkVisitRepository $linkVisitRepository): void
    {
        $linkVisitRepository->create($this->linkId, $this->ip);
    }
}
