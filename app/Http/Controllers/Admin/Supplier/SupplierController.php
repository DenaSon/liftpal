<?php

namespace App\Http\Controllers\Admin\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {




        $request->validate(['name'=> 'nullable|string|max:50']);

        $name = $request->query('name', '');
        $suppliers = Supplier::orderByDesc('created_at')
            ->when($name, function ($query) use ($name) {
                return $query->where('name','like',"%$name%")->orWhere('contact_name','like',"%$name%");
            })

            ->paginate( getSetting('default_pagination_number') )->appends( request()->query() );

        return view('admin.store.suppliers.index',compact('suppliers'));
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

        $request->validate([
            'name' => 'nullable|string|max:199',
            'person_name' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:11',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'license_number' => 'nullable|string',
            'description' => 'nullable|string:max:250',
            'rating' => 'nullable|numeric|max:20|min:0',
            'address'=> 'nullable|string|max:200'

        ]);
        try {
            $name = $request->input('name');
            $person_name = $request->input('person_name');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $website = $request->input('website');
            $license_number = $request->input('license_number');
            $address = $request->input('address');
            $rating = $request->input('rating');
            $description = $request->input('description');

            $supplier = new Supplier();

            $supplier->name = $name;
            $supplier->contact_name = $person_name;
            $supplier->phone = $phone;
            $supplier->email = $email;
            $supplier->website = $website;
            $supplier->address = $address;
            $supplier->license_number = $license_number;
            $supplier->rating = $rating;
            $supplier->description = $description;
            $supplier->save();

            Alert::success('ثبت موفق', 'تامین کننده جدید اضافه شد');
            return redirect()->back();

        }
        catch (Throwable $e)
        {
            setLog('Store-Supplier',$e->getMessage(),'danger');
            return redirect()->route('log-system');
        }
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




       $request->validate([
            'name' => 'nullable|string|max:200',
            'person_name' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:11',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'license_number' => 'nullable|string',
            'description' => 'nullable|string:max:250',
           'rating' => 'nullable|numeric|max:20|min:0'

        ]);
        try {

            $name = $request->input('name');
            $person_name = $request->input('person_name');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $website = $request->input('website');
            $address = $request->input('address');
            $license_number = $request->input('license_number');
            $rating = $request->input('rating');
            $description = $request->input('description');

            $supplier = Supplier::findorfail($id);
            $supplier->name = $name;
            $supplier->contact_name = $person_name;
            $supplier->phone = $phone;
            $supplier->email = $email;
            $supplier->website = $website;
            $supplier->address = $address;
            $supplier->license_number = $license_number;
            $supplier->rating = $rating;
            $supplier->description = $description;
            $supplier->save();

            Alert::success('ویرایش موفق', 'اطلاعات تامین کننده بروزرسانی شد.');
            return redirect()->back();

        }
        catch (Throwable $e)
        {
            setLog('Update-Supplier',$e->getMessage(),'danger');
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
}
