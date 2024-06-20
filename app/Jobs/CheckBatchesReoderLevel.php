<?php

namespace App\Jobs;

use App\Models\Batch;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Throwable;

class CheckBatchesReoderLevel implements ShouldQueue
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
        try {


            // Fetch all batches with associated products
            $batches = Batch::with('product')->get();

            // Fetch products associated with fetched batches
            $products = Product::whereIn('id', $batches->pluck('product_id'))->get();

            // Group batches by product_id
            $batchesByProduct = $batches->groupBy('product_id');

            // Iterate through batches grouped by product_id
            foreach ($batchesByProduct as $productId => $batches) {
                // Find the product related to the batches and check its status
                $product = $products
                    ->where('stop_selling', false)
                    ->where('is_active', true)
                    ->firstWhere('id', $productId);
                $productName = $product ? $product->name : false;

                // Proceed if the product exists and is active
                if ($productName) {
                    // Calculate the total quantity for batches within the current product
                    $totalQuantity = $batches->sum('quantity') - $batches->sum('sales_number');
                    foreach ($batches as $batch) {
                        // Calculate balance and reorder level for each batch
                        $balance = $batch->quantity - $batch->sales_number;
                        $reorder_level = $batch->reorder_level;

                        // Check if a low-quantity alert needs to be sent
                        if (($balance <= $reorder_level || $balance == 0) && !$batch->reorder_alert_send) {
                            // Compose alert description and send the low-quantity alert
                            $description = 'هشدار کاهش موجودی : ' . $productName . '('. $product->sku .')'. ' برای دسته شماره :  ' . $batch->id . ' با موجودی کل :  ' . $totalQuantity;

                            DB::transaction(function () use ($description,$batch) {
                                // عملیات دیتابیسی
                                setLog('LowQuantity_Alert', $description, 'warning');

                                // Update reorder_alert_send status to prevent duplicate alerts
                                $batch->reorder_alert_send = true;
                                $batch->save();
                            });


                        }
                    }
                }
            }
        } catch (Throwable $e)
        {
            $description = $e->getMessage(). ' ' . $e->getFile().  ' ' . $e->getLine();
            setLog('ReorderLevel_AlertSchedule', $description, 'danger');
        }
    }

}



















