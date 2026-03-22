<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\Receipt;

class DatabaseLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Xuat ra file log bang receipts
        $receipts = Receipt::orderBy('id', 'DESC')->get();
        foreach ($receipts as $receipt) {
            // Xuat file log
            $data = [
                'id' => $receipt->id,
                'storage_id' => $receipt->storage_id,
                'category_id' => $receipt->category_id,
                'total_price' => $receipt->total_price,
                'quantity' => $receipt->quantity,
                'created_at' => $receipt->created_at
            ];
            Log::info(json_encode($data));
        }
        // Ghi vao file log.
        
    }
}
