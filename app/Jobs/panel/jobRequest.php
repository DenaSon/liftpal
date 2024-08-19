<?php

namespace App\Jobs\panel;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class jobRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $jobRequest;
    public function __construct(Request $jobRequest)
    {
        $this->jobRequest = $jobRequest;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->jobRequest->update(['status' => 'expired']);
    }
}
