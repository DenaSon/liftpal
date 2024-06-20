<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    public function edit(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'id' =>'required|exists:types,id',
            'newName' =>'string|max:100|required',
            'newPrice' =>'required|numeric|max:5000000000000'
            // Add more validation rules as needed
        ]);
        if ($validator->fails()) {
            // Validation failed
            return response()->json(

                ['errors' => $validator->errors()],403);

        }

        $typeName = $request->input('newName');
        $typePrice = $request->input('newPrice');

        // You can use the received $typeName and $typePrice to update your database or perform necessary actions for editing the type
        // For example, if you have a Type model and want to update its name and price:

        // Assuming you have a Type model
        $type = Type::find( $request->id ); // You may use your appropriate method to fetch the type by its ID
        if ($type) {
            $type->name = $typeName;
            $type->price = $typePrice;
            $type->save();

            return response()->json(['message' => 'Type updated successfully'], 200);
        }
        else
        {
            return response()->json(['message' => 'Type not found'], 404);
        }
    }



    public function destroy(Request $request)
    {

        $type = Type::find($request->id); // You may use your appropriate method to fetch the type by its ID
        if ($type) {

            $batch = Batch::where('type_id',$request->id)->first();
            if ($batch)
            {

                $batch->delete();
            }
            $type->delete();

            return response()->json(['message' => 'Type Deleted successfully'], 200);
        }
        else
        {
            return response()->json(['message' => 'Type not found'], 404);
        }
    }









}
