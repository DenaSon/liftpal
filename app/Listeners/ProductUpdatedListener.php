<?php

namespace App\Listeners;

use App\Events\ProductUpdated;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProductUpdatedListener implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductUpdated $event): void
    {
        $productName = Product::whereId($event->product->id )->firstorfail()->name;
        $message = 'محصول  ' . $productName.  ' بروزرسانی شد. ';
        setLog('Update-Product',$message,'info');
    }
}
