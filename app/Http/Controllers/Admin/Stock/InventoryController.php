<?php

namespace App\Http\Controllers\Admin\Stock;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;

class InventoryController extends Controller
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


        return view('admin.inventory.stock.withdraw');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function increaseSales(Request $request)
    {
//        $request->validate([
//            'sales'=>'number',
//            
//        ]);
        // Retrieve data from the request
        $sales = $request->input('sales');
        $batchId = $request->input('batchId');

        $batch = Batch::findorfail($batchId);

        if ($sales <= $batch->quantity)
        {
            $batch->sales_number = $sales;
            $batch->save();
        }
        else
        {
            return response()->json(['message' => 'Sales is >  available Quantity'], 400);
        }
        return response()->json(['message' => 'Sales increased successfully', 'sales' => $sales, 'batchId' => $batchId], 201);
    }

}
