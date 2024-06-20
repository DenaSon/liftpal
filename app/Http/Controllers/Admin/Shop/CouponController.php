<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::orderbyDesc('created_at')->paginate(getSetting('default_pagination_number'));
        return view('admin.store.coupons.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.store.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'discountCode' => 'required|string',
            'discountType' => 'required|in:percentage,fixed_amount',
            'discountAmount' => 'required|numeric',
            'expirationDate' => 'required',
        ]);

        // Create a new Coupon record
        $coupon = new Coupon();
        $coupon->code = $request->input('discountCode');
        $coupon->type = $request->input('discountType');
        $coupon->value = $request->input('discountAmount');
        $coupon->end_date = toSystemDate($request->input('expirationDate'));
        $coupon->start_date = toSystemDate($request->input('expirationDate'));
        $coupon->save();
        Alert::success('کوپن جدید اضافه شد.');
        return redirect()->route('coupons.index');


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
       $coupon = Coupon::findorfail($id);
       if ($coupon)
       {
           $coupon->delete();
            Alert::success('کوپن حذف شد');
            return redirect()->route('coupons.index');
       }
    }
}
