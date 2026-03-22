<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AccessLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userId;

    /**
     * Create a new job instance.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $data = [
            'user_login' => $this->userId,
            'time_login' => Carbon::now()
        ];
        for ($i = 0; $i <= 100000; $i++) {
            $data[] = [
                'user_login' => $this->userId,
                'time_login' => Carbon::now()
            ];
        }
        Log::info(json_encode($data));
    }
}
