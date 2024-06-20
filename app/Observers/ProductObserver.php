<?php

namespace App\Observers;

use App\Models\Product;


class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        $description = 'محصول جدید با شماره : '. $product->sku . ' و نام ' . $product->name .  ' افزوده شد.';
        setLog('Create-Product',$description,'info');
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {


//         $description = 'محصول با شماره : '. $product->sku . ' و نام ' . $product->name .  ' بروز رسانی شد.';
//         setLog('Update-Product',$description,'info');


    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $description = 'محصول با شماره : '. $product->sku . ' و نام  ' . $product->name .  ' حذف شد.';
        setLog('Delete-Product',$description,'info');
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
