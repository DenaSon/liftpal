<?php

namespace App\Http\Controllers\Admin\Shop;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\History;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Crypt;
use MojtabaaHN\PersianNumberToWords\Converter;
use MojtabaaHN\PersianNumberToWords\Dictionary;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $request->validate(['search' => 'nullable|string']);

    $search = $request->input('search');
    $paginate_number = getSetting('default_pagination_number');
    $query = Order::query();

    if ($search)
    {
        $query->when(is_numeric($search) && strlen($search) < 10, function ($query) use ($search) {
            return $query->where('id', $search);
        })->when(strlen($search) == 11 && str_starts_with($search, '0'), function ($query) use ($search) {
            return $query->whereHas('user', function ($subQuery) use ($search) {
                $subQuery->where('phone', $search);
            });
        })->when(is_string($search) && !is_numeric($search), function ($query) use ($search) {
            return $query->whereHas('user.profile', function ($subQuery) use ($search) {
                $subQuery->where('last_name', 'like', '%' . $search . '%');
            });
        });
    }

    $orders = $query ->where('payment_status','paid')  ->orderByDesc('created_at')
        ->paginate($paginate_number)
        ->appends(request()->query());



    return view('admin.store.orders.index', compact('orders'));
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
public function show(string $order_number)
{

    $dictionary = new Dictionary();
    $converter = new Converter($dictionary);
    $auth_id = auth()->id();
     $order = Order::with('history')->where('order_number', $order_number)->where('user_id',$auth_id)->firstOrFail();

    $grand_total = $order->grand_total;
    $word_price = $converter->convert($grand_total);

    $totalPrice =0;
    foreach ($order->history as $item)
    {
        $totalPrice += $item->quantity * $item->price;

    }


    return view('admin.store.orders.show', compact('order','word_price','grand_total','totalPrice'));
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
        try {

            $order = Order::find($id);

            History::where('order_id',$order->id)->delete();


            $order->delete();


        }
        catch (Throwable $e)
        {
            setLog('Delete-Order',$e->getMessage().  ' File :  ' . $e->getFile(),'danger');
            return response()->json(['message' => 'Error happen and logged',],400);
        }

        return response()->json(['message' => 'Product Deleted', 'status' => 200]);
    }












}
