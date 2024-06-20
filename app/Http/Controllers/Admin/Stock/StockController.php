<?php

namespace App\Http\Controllers\Admin\Stock;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Milon\Barcode\DNS2D;
use Morilog\Jalali\Jalalian;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;


class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'expire_date' => 'nullable|date',
            'entry_date' => 'nullable|date',

        ]);

        try {


        $total_quantity = $request->input('total_quantity');
        $available_quantity = $request->input('available_quantity');
        $reserved_quantity = $request->input('reserved_quantity');
        $reorder_level = $request->input('reorder_level');

        $location = $request->input('location');
        $location_code = $request->input('location_code');
        $section = $request->input('section');
        $shelf = $request->input('shelf');
        $entry_date = $request->input('entry_date') ?? null;
        $expire_date = $request->input('expire_date') ?? null;
        $cost_price = $request->input('cost_price');
        $sale_price = $request->input('sale_price');
        $is_valuable = $request->input('is_valuable') ?? 0;
        $fda_license_number = $request->input('fda_license_number');
        $din = $request->input('din');
        $standard_type = $request->input('standard_type');
        $country = $request->input('country');
        $consumption_type = $request->input('consumption_type');
        $approval_status = $request->input('approval_status');

       $stock = Stock::findorfail($id);

        // Update the model with the new values
        $stock->total_quantity = $total_quantity;
        $stock->available_quantity = $available_quantity;
        $stock->reserved_quantity = $reserved_quantity;
        $stock->reorder_level = $reorder_level;
        $stock->standard_type = $standard_type;

        $stock->location = $location;
        $stock->location_code = $location_code;
        $stock->section = $section;
        $stock->shelf = $shelf;

        if ($entry_date != null)
        {

            $stock->entry_date = toSystemDate($entry_date);



        }
        if ($expire_date != null)
        {
            $expire_date = toSystemDate($expire_date);

            $now = date('Y-m-d H:i');
            if ( $expire_date <= $now )
            {
               Alert::warning('خطا','تاریخ انقضاء وارد شده معتبر نیست');
               return redirect()->back();
            }


            $stock->expire_date = $expire_date ;
        }

        $stock->cost_price = $cost_price;
        $stock->sale_price = $sale_price;
        $stock->is_valuable = $is_valuable ?? 0;
        $stock->fda_license_number = $fda_license_number;
        $stock->din = $din;
        $stock->country = $country;
        $stock->consumption_type = $consumption_type;
        $stock->approval = $approval_status ?? null;


// Save the updated model to the database
        $stock->save();


        Alert::success('اطلاعات وارد شده ذخیره شد','مقادیر وارد شده برای محصول ذخیره شدند');
        return redirect()->back();
        }
        catch (Throwable $e)
        {
            setLog('Update-Stock',$e->getMessage(),'danger');
            return redirect()->route('log-system');
        }





    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function increaseSales()
    {
        return response()->json('data',201);
    }




}
