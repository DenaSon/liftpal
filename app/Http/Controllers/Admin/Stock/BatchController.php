<?php

namespace App\Http\Controllers\Admin\Stock;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Product;

use App\Models\Supplier;
use App\Models\Type;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $id = $request->input('product_id');
        $product = Product::with('batches')->findOrFail($id);

        $batches = Batch::where('product_id',$id)->get();
        $suppliers = Supplier::get(['id','name']);

        $returned_profit = [];
        $total_returned_profit = 0;
        $totalCostValue = 0;
        $totalSaleValue = 0;
        $totalSalesValue = 0;
        $total = 0;
        foreach ($batches as $batch)
        {

            $profit =  $batch->sale_price  * $batch->sales_number;
            $starting_capital = ($batch->cost_price * $batch->quantity);
            $returned_profit[] =  (($profit - $starting_capital) / $starting_capital) * 100;

           //
           $totalCostValue += $batch->cost_price * $batch->quantity;
           $totalSaleValue += $batch->sale_price * $batch->quantity;
           $totalSalesValue += $batch->sale_price * $batch->sales_number;

           $total += (($profit - $starting_capital) / $starting_capital) * 100;

           //


        }



        return view('admin.inventory.batch.index',compact(['product','suppliers','returned_profit','batches','totalCostValue','totalSaleValue','totalSalesValue','total']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'expire_date' => 'required|date',
            'expire_alert' => 'required|numeric',
            'entry_date' => 'nullable|date',
            'reorder_level' => 'required|numeric',
            'cost_price' => 'required|numeric|max:10000000000|min:1',
            'sale_price' => 'required|numeric|max:10000000000|min:1',
            'quantity' => 'required|numeric|max:10000000|min:0',
            'product_id','exists:products,id',
            'supplier' => 'required',
            'type_id' =>'required|numeric|exists:types,id'
        ]);


        //Start Saving Supplier
        $supplier = $request->input( 'supplier' );
        $type_id = $request->input( 'type_id' );

        $supplierModel = Supplier::firstOrCreate( [ 'name' => $supplier ] );
        $supplierId = $supplierModel->id;

        $product_id = $request->input('id');

       $product = Product::where('id',$product_id)->first();
       if (count($product->batches) > 15)
       {
           Alert::warning('خطا','تعداد دسته ها نباید بیشتر از 15 عدد باشد');
           return redirect()->back();
       }

        $quantity = $request->input('quantity');
        $reorder_level = $request->input('reorder_level');
        $expire_alert = $request->input('expire_alert');
        $location = $request->input('location');
        $location_code = $request->input('location_code');
        $section = $request->input('section');
        $shelf = $request->input('shelf');
        $entry_date = $request->input('entry_date') ?? null;
        $expire_date = $request->input('expire_date') ?? null;
        $cost_price = $request->input('cost_price');
        $sale_price = $request->input('sale_price');





        $batch = new Batch();
        $batch->product_id = $product_id;
        $batch->supplier_id = $supplierId;
        $batch->type_id = $type_id;
        $batch->quantity = $quantity;
        $batch->expire_alert = $expire_alert;
        $batch->reorder_level = $reorder_level;

        $batch->location = $location;
        $batch->location_code = $location_code;
        $batch->section = $section;
        $batch->shelf = $shelf;
        $batch->cost_price = $cost_price;
        $batch->sale_price = $sale_price;


        if ($entry_date != null)
        {
            $batch->entry_date = toSystemDate($entry_date);

        }
        if ($expire_date != null) {
            $expire_date = toSystemDate($expire_date);

            $now = date('Y-m-d H:i');
            if ($expire_date <= $now) {
                Alert::warning('خطا', 'تاریخ انقضاء وارد شده معتبر نیست');
                return redirect()->back();
            }
            $batch->expire_date = $expire_date;


        }

            $batch->save();


            $msg = ' دسته جدید برای محصول افزوده شد ';
            Alert::success('دسته افزوده شد.',$msg);
            return redirect()->back();


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

            'quantity' => 'required|numeric|min:0|max:5000000000',
            'cost_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'location_code' => 'nullable',
            'location' => 'nullable|string',
            'section' => 'nullable|string',
            'shelf' => 'nullable|string'
        ]);

        try {



        $batch = Batch::findorfail($id);
        $batch->quantity = $request->input('quantity');
        $batch->cost_price = $request->input('cost_price');
        $batch->sale_price = $request->input('sale_price');
        $batch->location_code = $request->input('location_code');
        $batch->location = $request->input('location');
        $batch->section = $request->input('section');
        $batch->shelf = $request->input('shelf');
        $batch->save();
        }
        catch (Throwable $e)
        {
            setLog('Update-Batch',$e->getMessage(),'danger');
            Alert::warning('خطایی رخ داده است');
            return redirect()->back();
        }
        Alert::success('دسته ویرایش شد');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        $isConfirmed = $request->post('isConfirmed');
        $isConfirmed = request('isConfirmed');
        if ($isConfirmed)
        {
            $batch = Batch::findorfail($id);
            $batch->delete();
            return response()->json(['message' => 'DeleteOK'],200);

        }
        else
        {
            return response()->json(['message' => 'DeleteFAIL'],405);
        }


    }



}
