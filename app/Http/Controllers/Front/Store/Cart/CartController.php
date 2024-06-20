<?php
namespace App\Http\Controllers\Front\Store\Cart;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Cart;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Throwable;


class CartController extends Controller
{
    public function update(Request $request)
    {
        if (Session::has('price') && Session::has('discount'))
        {
            session()->forget(['price','discount']);

        }


        $validator = Validator::make($request->all(), [
            'type_id' =>'required|numeric|exists:types,id',
            'product_id' =>'required|numeric|exists:products,id',
            'quantity' => 'required|min:0|max:1000|numeric'
        ]);

        if ($validator->fails()) {
            // Validation failed
            return response()->json(['error' => 422, 'message' => ''], 422);
        }


        $type_id = $request->input('type_id');
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (!$this->InventoryPassed($type_id,$product_id,$quantity))
        {
            return response()->json(['error' => 404], 404);


        }
        if (!auth()->id())
        {
            return response()->json(['error' => 401], 401);
        }

        $this->addToCart($type_id,$product_id,$quantity);



    }

     private function InventoryPassed($type_id,$product_id,$quantity): bool
     {

        $batches = Batch::where('type_id', $type_id)->get();
        $totalRemainingQuantity = 0;
        foreach ($batches as $index => $batch)
        {

            $batchQuantity = $batch->quantity;
            $batchSalesNumber = $batch->sales_number;
            $remainingQuantity = $batchQuantity - $batchSalesNumber;
            $totalRemainingQuantity += $remainingQuantity;

        }

        if ( $quantity <= $totalRemainingQuantity  )
        {
            return true;
        }
        else
        {
            return false;
        }



    }

    private function addToCart($type_id,$product_id,$quantity) : void
    {


        $user_id = auth()->id();
        $cartData = [
            'type_id' => $type_id,
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'status' => 'pending',
            'updated_at' => Carbon::now()
        ];

        Cart::updateOrInsert(['user_id' => $user_id, 'type_id' => $type_id,'product_id'=>$product_id,'status'=>'pending'], $cartData);


    }

    public function getQuantity(Request $request)
    {

        if (auth()->check()) {
            $validator = Validator::make($request->all(), [
                'type_id' => 'required|numeric|exists:types,id',
            ]);

            if ($validator->fails()) {
                // Validation failed
                return response()->json(['error' => true, 'message' => 'Validation failed'], 422);
            }

            $type_id = $request->input('type_id');
            $auth_user = auth()->user()->id;

            // Fetch quantity from the database based on $type_id
            $quantity = Cart::where('type_id', $type_id)
                ->where('user_id', $auth_user)
                ->where('status', 'pending')
                ->value('quantity') ?? 0;

            return response()->json(['quantity' => $quantity]);
        }
        else
        {
            // User not authenticated
            return response()->json(['quantity' => 0]);
        }

    }

    public function getCartInfo()
    {

        $auth_user = auth()->user();
        if (!$auth_user) {

            return response()->json([
                'totalQuantity' =>  0,
                'totalPrices' =>  0,
                'unitQuantity' => 0,
            ]);

        }


        $auth_user = auth()->id();
        $cart = Cart::with('Type.Product')
        ->where('user_id', $auth_user)
        ->select('quantity', 'type_id')
        ->get();

        $totalQuantity = 0;
        $totalPrices = 0;
        $unitQuantity = 0;

        foreach ($cart as $item) {
            $totalQuantity += $item->quantity;

            $type = $item->type ?? 0;
            $product = $type->product ?? 0;
            $price = $type->price ?? 0;
            $discount = $product->discount ?? 0;

            $totalPrices += round($item->quantity * ($price * (1 - $discount / 100)));

            if ($unitQuantity === 0) {
                $unitQuantity = $item->quantity;
            }
        }

        return response()->json([
            'totalQuantity' => $totalQuantity ?? 0,
            'totalPrices' => $totalPrices ?? 0,
            'unitQuantity' => $unitQuantity ?? 0,
        ]);
    }

/**
 * The function removes an item from the user's cart based on the provided item ID.
 * If the item exists in the cart and is successfully removed, it returns a success response with status code 200.
 * If the item does not exist in the cart, it returns an error response with status code 404.
 * If any exception occurs during the process, it logs the error message in Control unit, and returns an error response with status code 400.
 */

public function liveBasketRemove(Request $request)
{
    $request->validate([
        'itemId' => 'required|exists:carts,id|numeric'
    ]);

    try {
        $authId = $request->user()->id; // Use dependency injection
        $itemId = $request->input('itemId');
        $cartItem = Cart::where('user_id', $authId)->find($itemId);

        if ($cartItem) {
            $cartItem->delete();
            return response()->json('success', 200);
        } else {
            return response()->json('error', 404);
        }
    } catch (Throwable $e) {
        setLog('Remove-Basket-Item', $e->getMessage() . ' - ' . $e->getFile(), 'danger');
        return response()->json('error', 400);
    }
}


}
