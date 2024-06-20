<?php

namespace App\Jobs;

use App\Models\Batch;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Throwable;

class CheckBatchesExpire implements ShouldQueue
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

        $expireDate = Carbon::parse($batch->expire_date);
        $expireAlertDays = $batch->expire_alert;
        // اگر expire_date و expire_alert هر دو وجود داشته باشند
        $currentDate = Carbon::now();
        if ( ($expireDate && $expireAlertDays) && !$currentDate->gte($expireDate) )
        {

            // محاسبه تاریخ انقضای مورد نظر
            $expireAlertDate = $expireDate->subDays($expireAlertDays);
            $balance = $batch->quantity - $batch->sales_number;
            // اگر تاریخ فعلی نزدیک به تاریخ انقضای expire_date باشد
            if ($currentDate->gte($expireAlertDate) && !$batch->expire_alert_send)
            {

                $str1 = 'هشدار تاریخ انقضاء در دسته شماره : ' . $batch->id . ' ';
                $str2 = ' برای محصول :  ' . $productName. ' ' . ' و کد محصول :  ' . $product->sku;
                $str3  = ' با موجودی دسته :  '. $balance. ' ' . ' و تاریخ انقضاء : ' .' '. jdate($batch->expire_date)->toDateString();
                $description = $str1.$str2.$str3;
                setLog('ExpireDate_AlertSchedule', $description, 'warning');

                // Update expiry_alert_send status to prevent duplicate alerts
                $batch->expire_alert_send = true;
                $batch->save();

            }



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
